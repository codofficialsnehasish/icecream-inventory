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
use App\Models\Expence;
use Illuminate\Support\Facades\DB;

class Report_Controller extends Controller
{    
    public function sell_report(){
        $title = "Sell Report";

        $trucks = Trucks::all();
        $salesmans = Salesman::all();
        $payments_methods = Order::select('payment_mode')->distinct()->pluck('payment_mode');

        $sells = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                    ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                    ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                    ->get(['orders.*', 't.name as truck_name']);
        
        $data['expence'] = Expence::sum('amount');
        $payment_mode = '';
        $data['online_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Online')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));

        $data['cash_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Cash')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];

        return view('admin.reports.cash_online_sale_report',compact('trucks','sells','salesmans','title','payments_methods','payment_mode'))->with($data);
    }

    public function generate_sales_report(Request $request){
        $title = 'Sales Report';

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $salesman_id = $request->salesman_id;

        $payments_methods = Order::select('payment_mode')->distinct()->pluck('payment_mode');

        $sells = Order::query()
                        ->select(['orders.*', 't.name as truck_name'])
                        ->distinct()
                        ->leftJoin('daily_sales as d', 'orders.salesman_id', '=', 'd.salesman_id')
                        ->leftJoin('trucks as t', 'd.truck_id', '=', 't.id')
                        ->when(!empty($request->salesmen_id), function ($query) use ($request) {
                            $query->where('orders.salesman_id', $request->salesmen_id);
                        })
                        ->when(!empty($request->trucks_id), function ($query) use ($request) {
                            $query->where('t.id', $request->trucks_id);
                        })
                        ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                            $query->whereDate('orders.created_at', '>=', $startDate)
                                ->whereDate('orders.created_at', '<=', $endDate);
                        })
                        // ->when(!empty($request->payment_mode), function ($query) use ($request) {
                        //     $query->where('orders.payment_mode', $request->payment_mode);
                        // })
                        ->when(!empty($request->payment_mode), function ($query) use ($request) {
                            if ($request->payment_mode === 'Cash') {
                                $query->where(function ($query) {
                                    $query->where('orders.payment_mode', 'Cash')
                                        ->orWhere('orders.payment_mode', 'Online&Cash');
                                });
                            } elseif ($request->payment_mode === 'Online') {
                                $query->where(function ($query) {
                                    $query->where('orders.payment_mode', 'Online')
                                        ->orWhere('orders.payment_mode', 'Online&Cash');
                                });
                            } else {
                                $query->where('orders.payment_mode', $request->payment_mode);
                            }
                        })
                        ->get();
    
    
        $payment_mode = $request->payment_mode;

        $trucks = Trucks::all();
        $salesmans = Salesman::all();
        $data['expence'] = Expence::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesmen_id', $salesman_id);
                                })
                                // ->whereBetween('created_at', [$startDate, $endDate])
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->sum('amount');

        $data['online_sell'] = Order::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesman_id', $salesman_id);
                                })
                                ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                    // $query->whereBetween('created_at', [$startDate, $endDate]);
                                    $query->whereDate('created_at', '>=', $startDate);
                                    $query->whereDate('created_at', '<=', $endDate);
                                })
                                ->where(function ($query) {
                                    $query->where('payment_mode', 'Online')
                                          ->orWhere('payment_mode', 'Online&Cash');
                                })
                                ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));
                            
        $data['cash_sell'] = Order::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesman_id', $salesman_id);
                                })
                                ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                    // $query->whereBetween('created_at', [$startDate, $endDate]);
                                    $query->whereDate('created_at', '>=', $startDate);
                                    $query->whereDate('created_at', '<=', $endDate);
                                })
                                ->where(function ($query) {
                                    $query->where('payment_mode', 'Cash')
                                          ->orWhere('payment_mode', 'Online&Cash');
                                })
                                ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));
                            

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];

        return view('admin.reports.cash_online_sale_report',compact('trucks','sells','salesmans','title','payments_methods','payment_mode'))->with($data);
    }

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
        // $data['items'] = Order::all();
        $data['items'] = Order::selectRaw('salesman_id, DATE(created_at) as order_date, SUM(grand_total) as total_grand_total')
                            ->groupBy('salesman_id', DB::raw('DATE(created_at)'))
                            ->get();

        $data['salesmans'] = Salesman::all();

        $data['expence'] = Expence::sum('amount');

        $data['online_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Online')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));

        $data['cash_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Cash')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];

        return view('admin.reports.salesman_wise_sales_report')->with($data);
    }

    public function generate_salesman_wise_sales_report(Request $r){
        $data['title'] = 'Salesman Wise Sales Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $salesman_id = $r->salesman_id;

        $data['items'] = Order::selectRaw('salesman_id, DATE(created_at) as order_date, SUM(grand_total) as total_grand_total')
                            ->when(!empty($r->salesman_id), function ($query) use ($r) {
                                $query->where('salesman_id', $r->salesman_id);
                            })
                            ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                $query->whereDate('created_at', '>=', $startDate)
                                    ->whereDate('created_at', '<=', $endDate);
                            })
                            ->groupBy('salesman_id', DB::raw('DATE(created_at)'))
                            ->get();


        $data['salesmans'] = Salesman::all();
        $data['expence'] = Expence::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesmen_id', $salesman_id);
                                })
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->sum('amount');

        $data['online_sell'] = Order::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesman_id', $salesman_id);
                                })
                                ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                    $query->whereDate('created_at', '>=', $startDate);
                                    $query->whereDate('created_at', '<=', $endDate);
                                })
                                ->where(function ($query) {
                                    $query->where('payment_mode', 'Online')
                                          ->orWhere('payment_mode', 'Online&Cash');
                                })
                                ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));
                            
        $data['cash_sell'] = Order::query()
                                ->when(!empty($salesman_id), function ($query) use ($salesman_id) {
                                    $query->where('salesman_id', $salesman_id);
                                })
                                ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                    $query->whereDate('created_at', '>=', $startDate);
                                    $query->whereDate('created_at', '<=', $endDate);
                                })
                                ->where(function ($query) {
                                    $query->where('payment_mode', 'Cash')
                                          ->orWhere('payment_mode', 'Online&Cash');
                                })
                                ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));
                            

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];
        return view('admin.reports.salesman_wise_sales_report')->with($data);
    }

    public function trucks_wise_sales_report(){
        $data['title'] = 'Truckes Wise Sales Report';
        $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                        ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                        ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                        ->distinct()
                        ->get(['orders.*', 't.name as truck_name']);
        
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        $data['expence'] = Expence::sum('amount');

        $data['online_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Online')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Online" THEN grand_total ELSE online END'));

        $data['cash_sell'] = Order::where(function($query) {
                                        $query->where('payment_mode', 'Cash')
                                            ->orWhere('payment_mode', 'Online&Cash');
                                    })
                                    ->sum(DB::raw('CASE WHEN payment_mode = "Cash" THEN grand_total ELSE cash END'));

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];
        return view('admin.reports.trucks_wise_sales_report')->with($data);
    }

    public function generate_trucks_wise_sales_report(Request $r){
        $data['title'] = 'Trucks Wise Sales Report';
        $startDate = $r->start_date;
        $endDate = $r->end_date;
        $truck_id = $r->trucks_id;

        if(!empty($r->trucks_id) && !empty($startDate) && !empty($endDate)){
            $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                            ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                            ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                            ->where('t.id', $r->trucks_id)
                            ->whereDate('orders.created_at', '>=', $startDate)
                            ->whereDate('orders.created_at', '<=', $endDate)
                            ->distinct()
                            ->get(['orders.*', 't.name as truck_name']);

        }else{
            if(!empty($r->trucks_id)){
                $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                                ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                                ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                                ->where('t.id',$r->trucks_id)
                                ->distinct()
                                ->get(['orders.*', 't.name as truck_name']);

            }elseif(!empty($startDate) && !empty($endDate)){
                $data['items'] = Order::leftJoin('daily_sales as d', 'orders.salesman_id', 'd.salesman_id')
                                ->leftJoin('trucks as t', 'd.truck_id', 't.id')
                                ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                                ->whereDate('orders.created_at', '>=', $startDate)
                                ->whereDate('orders.created_at', '<=', $endDate)
                                ->distinct()
                                ->get(['orders.*', 't.name as truck_name']);
            }
        }

        $onlineSell = 0;            
        foreach($data['items'] as $item){
            // return $item;
            if($item->payment_mode == 'Online'){
                $onlineSell += $item->grand_total;
            }else{
                $onlineSell += $item->online;
            }
        }

        $cashSell = 0;            
        foreach($data['items'] as $item){
            // return $item;
            if($item->payment_mode == 'Cash'){
                $cashSell += $item->grand_total;
            }else{
                $cashSell += $item->cash;
            }
        }

        $data['trucks'] = Trucks::where('is_visible',1)->get();
        $data['expence'] = Expence::query()
                                ->when(!empty($truck_id), function ($query) use ($truck_id) {
                                    $query->where('trucks_id', $truck_id);
                                })
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->sum('amount');
                            
        
        // $data['online_sell'] = $onlineSell->online_sell;
        // $data['cash_sell'] = $cashSell->cash_sell;
        $data['online_sell'] = $onlineSell;
        $data['cash_sell'] = $cashSell;
                            

        $data['cash_in_hand'] = $data['cash_sell'] - $data['expence'];
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

    public function product_wise_sell_report(){
        $data['title'] = 'Product Sell Report';
        // $data['items'] = OrderItems::all();
        $data['items'] = OrderItems::select('product_id', 'product_billing_name', DB::raw('SUM(quantity) as total_quantity'))
                                    ->groupBy('product_id', 'product_billing_name')
                                    ->get();
    

        $data['products'] = Product::all();
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        return view('admin.reports.product_wise_sell_report')->with($data);
    }

    public function generate_product_wise_sell_report(Request $request){
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data['title'] = 'Product Sell Report';
        // $data['items'] = OrderItems::when(isset($request->product), function ($query) use ($request) {
        //     $query->where(function ($q) use ($request) {
        //         $q->where('product_id', $request->product)
        //             ->orWhere('variation_id', $request->product);
        //     });
        // })
        // ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
        //     $query->whereDate('created_at', '>=', $startDate)
        //             ->whereDate('created_at', '<=', $endDate);
        // })
        // ->get();

        // $data['items'] = OrderItems::select('product_id', 'product_billing_name', DB::raw('SUM(quantity) as total_quantity'))
        //                             ->when(isset($request->product), function ($query) use ($request) {
        //                                 $query->where(function ($q) use ($request) {
        //                                     $q->where('product_id', $request->product)
        //                                         ->orWhere('variation_id', $request->product);
        //                                 });
        //                             })
        //                             ->when(isset($request->trucks_id), function ($query) use ($request) {
        //                                 $query->where(function ($q) use ($request) {
        //                                     $q->where('product_id', $request->product)
        //                                         ->orWhere('variation_id', $request->product);
        //                                 });
        //                             })
        //                             ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
        //                                 $query->whereDate('created_at', '>=', $startDate)
        //                                     ->whereDate('created_at', '<=', $endDate);
        //                             })
        //                             ->groupBy('product_id', 'product_billing_name')
        //                             ->get();

        $data['items'] = OrderItems::select(
                                        'order_items.product_id',
                                        'order_items.product_billing_name',
                                        DB::raw('SUM(order_items.quantity) as total_quantity')
                                    )
                                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                                    ->leftJoin('daily_sales as d', 'orders.salesman_id', '=', 'd.salesman_id')
                                    ->leftJoin('trucks as t', 'd.truck_id', '=', 't.id')
                                    ->whereRaw('DATE(d.outing_date) = DATE(orders.created_at)')
                                    ->when(!empty($request->trucks_id), function ($query) use ($request) {
                                        $query->where('t.id', $request->trucks_id); // filter by truck only if present
                                    })
                                    ->when(!empty($startDate) && !empty($endDate), function ($query) use ($startDate, $endDate) {
                                        $query->whereDate('orders.created_at', '>=', $startDate)
                                            ->whereDate('orders.created_at', '<=', $endDate);
                                    })
                                    ->when(!empty($request->product), function ($query) use ($request) {
                                        $query->where(function ($q) use ($request) {
                                            $q->where('order_items.product_id', $request->product)
                                                ->orWhere('order_items.variation_id', $request->product);
                                        });
                                    })
                                    ->groupBy('order_items.product_id', 'order_items.product_billing_name')
                                    ->get();
    
                                

        $data['products'] = Product::all();
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        return view('admin.reports.product_wise_sell_report')->with($data);
    }
}