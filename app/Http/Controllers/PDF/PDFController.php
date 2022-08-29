<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Libraries\Fpdf\FPDF;
use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    
    public function reciept(){

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $info = BasicInfo::where('id', $user->info_id)->first();
        /* Operation */
        $operations = Operation::where('user_id', $user->id)->get();
        $operation = $operations[count($operations) - 1]; 
       
        /* Order */
        $orders = Order::where('operation_id', $operation->id)->get();
        $order = $orders[count($orders) - 1];
        //$order = DB::table('orders')->where('operation_id', $operation->id)->latest('created_at')->first();
        //dd($order->created_at);
        /* Order Item */
        $items = OrderItem::where('order_id', $order->id)->get();

        /* Tax */
        $tax_percent = ($order->tax / $order->grandtotal) * 100;

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        // Cell(width, height, text, border, end line, [align])
        /* Row */
        $pdf->Cell(120, 5, $info->name , 0, 0);
        $pdf->Cell(69, 5, 'RECEIPT', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        /* Row */
        $pdf->Cell(120, 5, $info->address, 0, 0);
        $pdf->Cell(25, 5, 'Currency: ', 0, 0);
        $pdf->Cell(69, 5, $order->currency, 0, 1); // end of line
        /* Row */
        $pdf->Cell(120, 5, $info->phone, 0, 0);
        $pdf->Cell(25, 5, 'POS:', 0, 0);
        $pdf->Cell(44, 5, 'Till Online', 0, 1); // end of line
        /* Row */
        $pdf->Cell(120, 5, 'VAT Reg: ' . $info->vat_number, 0, 0);
        $pdf->Cell(25, 5, 'Date', 0, 0);
        $pdf->Cell(44, 5, $order->created_at, 0, 1); // end of line
        $pdf->SetFont('Arial', 'B', 12);
        /* Row */
        $pdf->Cell(120, 5, 'Staff: ' . $user->name, 0, 0);
        $pdf->Cell(25, 5, 'Reciept #:', 0, 0);
        $pdf->Cell(44, 5, $order->transaction_id, 0, 1); // end of line

        /* 
        *   Row 
        *   Vertical Spacer
        **/
        $pdf->Cell(189, 10, '', 0, 1);

        /*  Row Vertical Spacer  */
        $pdf->Cell(189, 10, '', 0, 1);


        $pdf->SetFont('Arial', 'B', 12);

        /* Row */
        $pdf->Cell(90, 7, 'Description', 1, 0);
        $pdf->Cell(35, 7, 'Unit Price', 1, 0);
        $pdf->Cell(30, 7, 'Quantity', 1, 0);
        $pdf->Cell(34, 7, 'Amount', 1, 1); // end of line

        $pdf->SetFont('Arial', '', 11);

        $pdf->Cell(189, 2, '', 0, 1);
        foreach($items as $item){
            /* Row */
            $pdf->Cell(90, 5, $item->product_name, 0, 0);
            $usd_unit_price = $item->usd_unit_price / 100;
            $zwl_unit_price = $item->zwl_unit_price / 100;
            if( $order->currency == 'USD' ){
                $unit_price = number_format($usd_unit_price, 2, '.', '');
            }
            elseif( $order->currency == 'ZWL' ){
                $unit_price = number_format($zwl_unit_price, 2, '.', '');
            }
            $pdf->Cell(35, 5, $unit_price, 0, 0);
            $pdf->Cell(30, 5, $item->quantity, 0, 0);
            $item_total = (int)$item->product_total / 100;
            $product_total = number_format($item_total, 2, '.','');
            $pdf->Cell(34, 5, $product_total, 0, 1); // end of line
            $pdf->Cell(189, 1, '', 0, 1);
        }

        /* *********************** */
        $pdf->Cell(189, 3, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 12);
        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);
        
        $subtotal_calculate = $order->subtotal / 100;
        $subtotal = number_format($subtotal_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $subtotal, 0, 1, 'R'); // end of line

        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Tax (' . $tax_percent . '%)', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);

        $tax_calculate = $order->tax / 100;
        $tax = number_format($tax_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $tax, 0, 1, 'R'); // end of line

        /* Row */
        $pdf->Cell(125, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Grand Total', 0, 0);
        $pdf->Cell(4, 5, '$', 0, 0);

        $grandtotal_calculate = $order->grandtotal / 100;
        $grandtotal = number_format($grandtotal_calculate, 2, '.', '');

        $pdf->Cell(30, 5, $grandtotal, 0, 1, 'R'); // end of line

        $pdf->Output();

        exit;
    }
}
