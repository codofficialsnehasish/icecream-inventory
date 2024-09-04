<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Trucks;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shops;

class Dashboard extends Controller
{
    public function dashboard(){
        $data['title'] = 'Dashboard';
        $data['total_dealers'] = Shops::all()->count();
        $data['total_product'] = Product::all()->count();
        $data['todays_order'] = Order::whereDate('created_at',date('Y-m-d'))->count();
        $data['todays_sell'] = Order::whereDate('created_at',date('Y-m-d'))->sum('grand_total');
        $data['items'] = Order::whereDate('created_at',date('Y-m-d'))->get();
        return view("admin/dashboard")->with($data);
    }
}