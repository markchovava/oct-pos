<?php

namespace App\Http\Controllers\Print;

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

use App\Http\Controllers\Controller;
use App\Libraries\Fpdf\Paperpdf;
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
    public function print_text(){
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $info = BasicInfo::where('id', $user->info_id)->first();
        /* Operation */
        $operation = Operation::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        /* Order */
        //dd($operation->id);
        $order = Order::where('operation_id', $operation->id)->orderBy('created_at', 'desc')->first();
        /* Order Item */
        
        $items = OrderItem::where('order_id', $order->id)->get();
        /* Tax */
        $tax_percent = ( isset($order->tax) ) ? ($order->tax / $order->grandtotal) * 100 : '';
                $write = 'RECEIPT <br>';
                $write .= '*********************' . PHP_EOL;
                $write .=  $info->name;
                $write .= PHP_EOL; // Line break in txt file
                $write .= $info->address;
                $write .= PHP_EOL;
                $write .= 'Vat No.: ' . $info->vat_number; 
                $write .= PHP_EOL;
                $write .= 'Staff: ' . $user->name;
                $write .= PHP_EOL;
                $write .= 'Date: ' .$order->created_at;
                $write .= PHP_EOL;
                $write .= 'POS: Till Online';
                $write .= PHP_EOL;
                $write .= 'Staff: ' . $user->name;
                $write .= PHP_EOL;
                $write .= 'Currency: ' . $order->currency;
                $write .= PHP_EOL;
                $write .= 'Receipt No.: ' . $order->transaction_id; 
                $write .= PHP_EOL;
                $write .= PHP_EOL;
                $write .= '*********************';
                $write .= PHP_EOL;
                $write .= str_pad('Desc ', 4, ' ', STR_PAD_RIGHT);
                $write .= str_pad('U.Pr ', 4, ' ', STR_PAD_RIGHT);
                $write .= str_pad('Qty ', 4, ' ', STR_PAD_RIGHT);
                $write .= 'Amnt';
                $write .= PHP_EOL;
             // Product List Item
            foreach($items as $item){          
                $write .= $item->product_name;
                $usd_unit_price = $item->usd_unit_price / 100;
                $zwl_unit_price = $item->zwl_unit_price / 100;
                if( $order->currency == 'USD' ){
                    $unit_price = number_format($usd_unit_price, 2, '.', '');
                }
                elseif( $order->currency == 'ZWL' ){
                    $unit_price = number_format($zwl_unit_price, 2, '.', '');
                }
                    $write .= str_pad('$' . $unit_price, 5, ' ', STR_PAD_LEFT);
                    $write .= str_pad($item->quantity, 5, ' ', STR_PAD_LEFT);
                
                    $item_total = (int)$item->product_total / 100;
                    $product_total = number_format($item_total, 2, '.','');
                    $write .= str_pad('$' . $product_total, 5, ' ', STR_PAD_LEFT);
                    $write .= PHP_EOL;
                
            }
          
            // Subtotal
            $write .= str_pad('Subtotal: ', 20, ' ', STR_PAD_LEFT);
                $subtotal_calculate = $order->subtotal / 100;
                $subtotal = number_format($subtotal_calculate, 2, '.', '');
            $write .= '$' . $subtotal;
            $write .= PHP_EOL;
            // Tax
            $write .= str_pad('Tax (' . $tax_percent . '%)', 30, ' ', STR_PAD_LEFT);
                $tax_calculate = $order->tax / 100;
                $tax = number_format($tax_calculate, 2, '.', '');
            $write .= PHP_EOL;
            $write .= str_pad('$' . $tax, 20, ' ', STR_PAD_LEFT);
            // Grand Total
            $write .= PHP_EOL;
            $write .= str_pad('Grandtotal: ', 20, ' ', STR_PAD_LEFT);
                $grandtotal_calculate = $order->grandtotal / 100;
                $grandtotal = number_format($grandtotal_calculate, 2, '.', '');
            $write .= '$ ' . $grandtotal;
            $write .= PHP_EOL;
            $write .= '********************* . ';
            $write .= PHP_EOL;

            $write .= 'Thank you for shopping with us.';
            $write .= PHP_EOL;

        $file = './assets/txt/receipt.txt';
        file_put_contents($file, $write);
        
        if( file_exists('./assets/txt/receipt.txt') ){
            $file = './assets/txt/receipt.txt';
            $text = file_get_contents($file);
        }else{
            //$file = fopen('./assets/txt/receipt.txt', 'w');
            header('Refresh:0');
            $text = NULL;
        }
        return $text . '<script> window.print(); </script>';
       
    }

    public function print_html(){
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $info = BasicInfo::where('id', $user->info_id)->first();
        /* Operation */
        $operation = Operation::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        /* Order */
        //dd($operation->id);
        $order = Order::where('operation_id', $operation->id)->orderBy('created_at', 'desc')->first();
        /* Order Item */
        
        $items = OrderItem::where('order_id', $order->id)->get();
        /* Tax */
        $tax_percent = ( isset($order->tax) ) ? ($order->tax / $order->grandtotal) * 100 : '';

        $write = '<style>*{font-size: 12px;}</style>';
    
        $write .= '<table style="width:300px;">';
            $write .= '<tbody>';
            $write .= '<tr>';
            $write .= '<th>';
                $write .= '<h3> RECEIPT </h3>';
            $write .= '</th>';
            $write .= '</tr>';
            $write .= '</tbody>';
        $write .= '</table>';
        $write .= '<table style="width:300px;">';
            $write .= '<tbody>';
            $write .= '<tr>';
            $write .= '<td style="width:300px;">';
                $write .= '<b>' . $info->name . '</b>';
                $write .= '<br>';
                $write .= $info->address;
                $write .= '<br>';
                $write .= 'Vat No.: ' . $info->vat_number;
                $write .= '<br>';
                $write .= 'Staff: <b>' . $user->name. '</b>';
                $write .= '<br>';
                $write .= '&nbsp;';
            $write .= '</td>';
            $write .= '<td style="width:300px;">';
                $write .= 'Date: ' .$order->created_at;
                $write .= '<br>';
                $write .= 'POS: Till Online';
                $write .= '<br>';
                $write .= 'Staff: ' . $user->name;
                $write .= '<br>';
                $write .= 'Currency: ' . $order->currency;
                $write .= '<br>';
                $write .= 'Receipt No.: <b>' . $order->transaction_id . '</b>';
            $write .= '</td>';
            $write .= '</tr>';
            $write .= '</tbody>';
        $write .= '</table>';
        $write .= '<table style="width:300px;">';
            // Product Title List
            $write .= '<tr>';
            $write .= '<th style="width:40%; text-align:left;">';
                $write .= 'Desc';
            $write .= '</th>';
            $write .= '<th style="width:20%; text-align:left;">';
                $write .= 'U.Pr.';
            $write .= '</th>';
            $write .= '<th style="width:20%; text-align:left;">';
                $write .= 'Qty.';
            $write .= '</th>';
            $write .= '<th style="width:20%; text-align:left;">';
                $write .= 'Amnt.';
            $write .= '</th>';
            $write .= '</tr>';
             // Product List Item
            foreach($items as $item){
                $write .= '<tr>';
                $write .= '<td style="width:40%;">';
                    $write .= $item->product_name;
                $write .= '</td>';
                $usd_unit_price = $item->usd_unit_price / 100;
                $zwl_unit_price = $item->zwl_unit_price / 100;
                if( $order->currency == 'USD' ){
                    $unit_price = number_format($usd_unit_price, 2, '.', '');
                }
                elseif( $order->currency == 'ZWL' ){
                    $unit_price = number_format($zwl_unit_price, 2, '.', '');
                }
                $write .= '<td style="width:20%">';
                    $write .= '$' . $unit_price;
                $write .= '</td>';
                $write .= '<td style="width:20%">';
                    $write .= $item->quantity;
                $write .= '</td>';
                $write .= '<td style="width:20%">';
                    $item_total = (int)$item->product_total / 100;
                    $product_total = number_format($item_total, 2, '.','');
                    $write .= '$' . $product_total;
                $write .= '</td>';
                $write .= '</tr>';
            }
            $write .= '</tbody>';
        $write .= '</table>';

        $write .= '<table style="width:300px;">';
            $write .= '<tbody>';
            // Subtotal
            $write .= '<tr>';
            $write .= '<td style="width:60%;">';
            $write .= '</td>';
            $write .= '<th style="width:20%;">';
            $write .= 'Subtotal';
            $write .= '</th>';
            $write .= '<td style="width:20%;">';
                $subtotal_calculate = $order->subtotal / 100;
                $subtotal = number_format($subtotal_calculate, 2, '.', '');
                $write .= '$' . $subtotal;
            $write .= '</td>';
            $write .= '</tr>';
            // Tax
            $write .= '<tr>';
            $write .= '<td style="width:60%;">';
            $write .= '</td>';
            $write .= '<th style="width:20%;">';
            $write .= 'Tax (' . $tax_percent . '%)';
            $write .= '</th>';
            $write .= '<td style="width:20%;">';
                $tax_calculate = $order->tax / 100;
                $tax = number_format($tax_calculate, 2, '.', '');
                $write .= '$' . $tax;
            $write .= '</td>';
            $write .= '</tr>';
            // Grand Total
            $write .= '<tr>';
            $write .= '<td style="width:60%;">';
            $write .= '</td>';
            $write .= '<th style="width:20%;">';
            $write .= 'Grandtotal';
            $write .= '</th>';
            $write .= '<td style="width:20%;">';
                $grandtotal_calculate = $order->grandtotal / 100;
                $grandtotal = number_format($grandtotal_calculate, 2, '.', '');
                $write .= '$' . $grandtotal;
            $write .= '</td>';
            $write .= '</tr>';
            $write .= '</tbody>';
        $write .= '</table>';

        $write .= '<table style="width:300px;">';
            $write .= '<tbody>';
            $write .= '<tr>';
            $write .= '<th>';
                $write .= '<p>Thank you for shopping with us.</p>';
            $write .= '</th>';
            $write .= '</tr>';
            $write .= '</tbody>';
    $write .= '</table>';

        return $write . '<script> window.print(); </script>';
       
    }


    public function print_one(){
        $paperpdf = new Paperpdf();
        $paperpdf->AddPage('P');
        $paperpdf->SetMargins(0,0,0);
        $paperpdf->SetFont('Arial','','10');
        $paperpdf->SetXY(50,20);
        //$paperpdf->Write('I am going to print');

        $paperpdf->IncludeJS("print('true');");

        $paperpdf->Output('foobar.pdf','I');

        exit;
    }
    
    
    public function thermal_print(){
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