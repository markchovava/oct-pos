<?php

namespace App\Http\Controllers\Print;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

use App\Http\Controllers\Controller;
use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    public function print(){
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $info = BasicInfo::where('id', $user->info_id)->first();
        /* Operation */
        $operation = Operation::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        /* Order */
        $order = Order::where('operation_id', $operation->id)->orderBy('created_at', 'desc')->first();
        /* Order Item */
        $order_items = OrderItem::where('order_id', $order->id)->get();
        /* Tax */
        $tax_percent = ( isset($order->tax) ) ? ($order->tax / $order->grandtotal) * 100 : '';

        /* Open the printer; this will change depending on how it is connected */
        $connector = new FilePrintConnector("/dev/usb/lp0");
        $printer = new Printer($connector);

        /* Information for the receipt */
        $items = array();
        foreach($order_items as $item){
            $usd_unit_price = $item->usd_unit_price / 100;
            $zwl_unit_price = $item->zwl_unit_price / 100;
            if( $order->currency == 'USD' ){
                $unit_price = number_format($usd_unit_price, 2, '.', '');
            }
            elseif( $order->currency == 'ZWL' ){
                $unit_price = number_format($zwl_unit_price, 2, '.', '');
            }
            $item_total = (int)$item->product_total / 100;
            $product_total = number_format($item_total, 2, '.','');
            $items[] .= 
                new item($item->product_name . ', $' . $unit_price . ', QTY: ' . $item->quantity, 
                    '$' . $product_total);
        }

        $subtotal_calculate = $order->subtotal / 100;
        $subtotal_format = number_format($subtotal_calculate, 2, '.', '');

        $subtotal = new item('Subtotal', '$' .$subtotal_format);
        
        $tax_calculate = $order->tax / 100;
        $tax_format = number_format($tax_calculate, 2, '.', '');
        $tax = new item('Tax (' . $tax_percent . '%) ', '$' . $tax_format);

        $grandtotal_calculate = $order->grandtotal / 100;
        $grandtotal_format = number_format($grandtotal_calculate, 2, '.', '');
        $total = new item('Total', '$' . $grandtotal_format, true);

        $date = \Carbon\Carbon::parse($order->created_at)->format('j M Y');

        /* Start the printer */
        //$logo = EscposImage::load("resources/escpos-php.png", false);
        $printer = new Printer($connector);

        /* Print top logo */
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        //$printer -> graphics($logo);

        /* Name of shop */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text($info->name . "\n");
        $printer -> selectPrintMode();
        $printer -> text($info->address . "Shop No. 42.\n");
        $printer -> feed();

        /* Title of receipt */
        $printer -> setEmphasis(true);
        $printer -> text("RECEIPT \n");
        $printer -> setEmphasis(false);

        /* Items */
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> setEmphasis(true);
        $printer -> text(new item('', '$'));
        $printer -> setEmphasis(false);

        foreach ($items as $item) {
            $printer -> text($item);
        }
        $printer -> setEmphasis(true);
        $printer -> text($subtotal);
        $printer -> setEmphasis(false);
        $printer -> feed();
        
        /* Tax and total */
        $printer -> text($tax);
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer -> text($total);
        $printer -> selectPrintMode();
        
        /* Footer */
        $printer -> feed(2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("Thank you for shopping at " . $info->name . "\n");
        $printer -> feed(2);
        $printer -> text($date . "\n");
        
        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();

        $printer -> close();

        return redirect()->route('admin.pos');
        
    }
}

/* A wrapper to do organise item names & prices into columns */
class Item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}