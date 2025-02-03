<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Trucks;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shops;
use App\Models\Expence;

use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function dashboard(){
        $data['title'] = 'Dashboard';
        $data['total_dealers'] = Shops::all()->count();
        $data['total_product'] = Product::all()->count();
        $data['todays_order'] = Order::whereDate('created_at',date('Y-m-d'))->count();
        $data['todays_sell'] = Order::whereDate('created_at',date('Y-m-d'))->sum('grand_total');

        $data['todays_online_sell'] = Order::whereDate('created_at', date('Y-m-d'))
                                            ->where(function($query) {
                                                $query->where('payment_mode', 'Online')
                                                    ->orWhere('payment_mode', 'Online&Cash');
                                            })
                                            ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));

        $data['todays_cash_sell'] = Order::whereDate('created_at', date('Y-m-d'))
                                            ->where(function($query) {
                                                $query->where('payment_mode', 'Cash')
                                                    ->orWhere('payment_mode', 'Online&Cash');
                                            })
                                            ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));

        $data['todays_expences'] = Expence::whereDate('created_at',date('Y-m-d'))->sum('amount');

        $data['cash_in_hand'] = $data['todays_cash_sell'] - $data['todays_expences'];

        $data['items'] = Order::whereDate('created_at',date('Y-m-d'))->get();
        return view("admin/dashboard")->with($data);
    }
}