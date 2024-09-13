<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Import domPDF

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Shops;
use App\Models\BillSettings;

class PDFController extends Controller
{
    public function generatePDF($id=null)
    {
        if($id != null){
            $order = Order::find($id);
            $order_items = OrderItems::leftJoin('products','order_items.product_id','products.id')
                            ->where('order_items.order_id',$order->id)
                            ->get(['order_items.*','products.name','products.price','products.box_quantity']);
            $customer_details = Shops::find($order->shop_id);
            $bill_settings = BillSettings::find(1);

            $html = view('admin.billings.bill', compact('order', 'order_items', 'customer_details', 'bill_settings'))->render();
            $pdf = PDF::loadHTML($html)->setPaper([0, 0, 144, 288])->set_option('isHtml5ParserEnabled', true);
    
            $filename = $order->order_number . '.pdf';
            return $pdf->stream($filename);
        }
    }

    public function generate_bill_url($id){
        $order = Order::find($id);
        // $url = route('download-bill',$order->order_number);
        $url = route('download-show-bill',$order->order_number);
        return ["status"=>"true","data"=>$url];
    }

    public function download_bill($bill_number){
        $order = Order::where('order_number',$bill_number)->first();
        $order_items = OrderItems::leftJoin('products','order_items.product_id','products.id')
                        ->where('order_items.order_id',$order->id)
                        ->get(['order_items.*','products.name','products.price','products.box_quantity']);
        $customer_details = Shops::find($order->shop_id);
        $bill_settings = BillSettings::find(1);

        $html = view('admin.billings.bill', compact('order', 'order_items', 'customer_details', 'bill_settings'))->render();
        $pdf = PDF::loadHTML($html)->setPaper([0, 0, 144, 288])->set_option('isHtml5ParserEnabled', true);

        $filename = $order->order_number . '.pdf';
        return $pdf->stream($filename);
    }

    public function download_show_bill($bill_number){
        $order = Order::where('order_number',$bill_number)->first();
        $order_items = OrderItems::leftJoin('products','order_items.product_id','products.id')
                        ->where('order_items.order_id',$order->id)
                        ->get(['order_items.*','products.name','products.price','products.box_quantity']);
        $customer_details = Shops::find($order->shop_id);
        $bill_settings = BillSettings::find(1);

        return view('admin.billings.bill', compact('order', 'order_items', 'customer_details', 'bill_settings'));
    }

}
