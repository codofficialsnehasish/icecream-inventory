<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Shops;
use App\Models\Salesman;

class BillingController extends Controller
{
    public function __construct(){
        $this->view_path = "admin.billings.";
    }

    public function index(){
        $data['title'] = 'All Bills';
        $data['bills'] = Order::all();
        return view($this->view_path.'index')->with($data);
    }

    public function todays_bills(){
        $data['title'] = 'Todays Bills';
        $data['bills'] = Order::whereDate('created_at',date('Y-m-d'))->get();
        return view($this->view_path.'todays_bills')->with($data);
    }

    public function bill_details(Request $request){
        $data['title'] = 'Bill Details';
        $order = Order::find($request->id);
        if($order){
            $data['order'] = $order;
            $data['buyer_details'] = Shops::find($order->shop_id);
            $data['salesman_details'] = Salesman::find($order->salesman_id);
            $data['order_items'] =  OrderItems::leftJoin('products','order_items.product_id','products.id')->where('order_items.order_id',$order->id)->get(['order_items.*','products.name as product_name']);
            return view($this->view_path.'bill_details')->with($data);
        }
    }
}
