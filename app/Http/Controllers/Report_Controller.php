<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Shops;
use App\Models\Salesman;
use App\Models\Trucks;
use App\Models\Accounts;
use App\Models\AccountsController2;

class Report_Controller extends Controller
{    
    public function dealer_wise_sales_report(){
        $data['title'] = 'Dealer Wise Sales Report';
        $data['items'] = Order::all();
        $data['dealers'] = Shops::where('is_visible',1)->get();
        return view('admin.reports.dealer_wise_sales_report')->with($data);
    }

    public function generate_dealer_wise_sales_report(Request $r){
        $data['title'] = 'Dealer Wise Sales Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        if(!empty($r->shop_id) && !empty($startDate) && !empty($endDate)){
            $data['items'] = Order::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('shop_id',$r->shop_id)
                            ->get();
        }else{
            if(!empty($r->shop_id)){
                $data['items'] = Order::where('shop_id',$r->shop_id)->get();
            }elseif(!empty($startDate) && !empty($endDate)){
                $data['items'] = Order::whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
            }
        }
        $data['dealers'] = Shops::where('is_visible',1)->get();
        return view('admin.reports.dealer_wise_sales_report')->with($data);
    }

    public function stock_report(){
        $data['title'] = 'Stock Report';
        $data['items'] = Product::where('visibility',1)->get();
        return view('admin.reports.stock_report')->with($data);
    }

    public function salesman_wise_sales_report(){
        $data['title'] = 'Salesman Wise Sales Report';
        $data['items'] = Order::all();
        $data['salesmans'] = Salesman::all();
        return view('admin.reports.salesman_wise_sales_report')->with($data);
    }

    public function generate_salesman_wise_sales_report(Request $r){
        $data['title'] = 'Salesman Wise Sales Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        if(!empty($r->salesman_id) && !empty($startDate) && !empty($endDate)){
            $data['items'] = Order::whereDate('created_at', '>=', $startDate)
                            ->whereDate('created_at', '<=', $endDate)
                            ->where('salesman_id',$r->salesman_id)
                            ->get();
        }else{
            if(!empty($r->salesman_id)){
                $data['items'] = Order::where('salesman_id',$r->salesman_id)->get();
            }elseif(!empty($startDate) && !empty($endDate)){
                $data['items'] = Order::whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
            }
        }
        $data['salesmans'] = Salesman::all();
        return view('admin.reports.salesman_wise_sales_report')->with($data);
    }

    public function trucks_wise_sales_report(){
        $data['title'] = 'Truckes Wise Sales Report';
        $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                        ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                        ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                        ->get(['orders.*', 't.name as truck_name']);
        
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        return view('admin.reports.trucks_wise_sales_report')->with($data);
    }

    public function generate_trucks_wise_sales_report(Request $r){
        $data['title'] = 'Trucks Wise Sales Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        if(!empty($r->trucks_id) && !empty($startDate) && !empty($endDate)){
            $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                            ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                            ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                            ->where('t.id',$r->trucks_id)
                            ->whereDate('orders.created_at', '>=', $startDate)
                            ->whereDate('orders.created_at', '<=', $endDate)
                            ->get(['orders.*', 't.name as truck_name']);
        }else{
            if(!empty($r->trucks_id)){
                $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                                ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                                ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                                ->where('t.id',$r->trucks_id)
                                ->get(['orders.*', 't.name as truck_name']);
            }elseif(!empty($startDate) && !empty($endDate)){
                $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                                ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                                ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                                ->whereDate('orders.created_at', '>=', $startDate)
                                ->whereDate('orders.created_at', '<=', $endDate)
                                ->get(['orders.*', 't.name as truck_name']);
            }
        }
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        return view('admin.reports.trucks_wise_sales_report')->with($data);
    }

    public function account_report(){
        $data['title'] = 'Accounts Report 1';
        $data['items'] = Accounts::all();
        return view('admin.reports.accounts_report')->with($data);
    }

    public function generate_account_report(Request $r){
        $data['title'] = 'Accounts Report 1';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = Accounts::whereDate('date', '>=', $startDate)
                        ->whereDate('date', '<=', $endDate)
                        ->get();
        return view('admin.reports.accounts_report')->with($data);
    }

    public function account_report2(){
        $data['title'] = 'Accounts Report 2';
        $data['items'] = AccountsController2::all();
        return view('admin.reports.accounts_report2')->with($data);
    }

    public function generate_account_report2(Request $r){
        $data['title'] = 'Accounts Report 2';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $data['items'] = AccountsController2::whereDate('date', '>=', $startDate)
                        ->whereDate('date', '<=', $endDate)
                        ->get();
        return view('admin.reports.accounts_report2')->with($data);
    }
}