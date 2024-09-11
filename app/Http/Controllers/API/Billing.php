<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\BillingCart;
use App\Models\Product;
use App\Models\AssignedProducts;
use App\Models\DailySales;
use Illuminate\Http\Request;
use App\Models\Variation;
use App\Models\Shops;
use App\Models\Order;
use App\Models\OrderItems;

class Billing extends Controller
{
    public function is_assign_product_stock_avaliable($product_id, $salesman_id, $quantity){
        $cart_quantity = BillingCart::where('salesmen_id',$salesman_id)
                                    ->where('product_id',$product_id)
                                    ->value('quantity') ?? 0;

        $daily_sales = DailySales::where('salesman_id',$salesman_id)
                                ->where('outing_date',date('Y-m-d'))
                                ->first();

        if (!$daily_sales) { return false; }

        $assign_products = AssignedProducts::where('daily_sales',$daily_sales->id)->first();

        if (!$assign_products) { return false; }

        $products = json_decode($assign_products->products);

        foreach ($products as $product) {
            if ($product->product == $product_id) {
                return ($quantity+$cart_quantity) <= $product->quantity;
            }
        }
        return false;
    }

    public function add_to_billing_cart(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric|exists:products,id',
            'variation_id' => 'nullable|numeric|exists:variations,id',
            'quantity' => 'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }else{
            $check = BillingCart::where('salesmen_id',$request->user()->id)
                                ->where('product_id',$request->product_id)
                                ->where('variation_id',$request->variation_id)->exists();
            if($check){
                $cart = BillingCart::where('salesmen_id',$request->user()->id)
                ->where('product_id',$request->product_id)
                ->where('variation_id',$request->variation_id)->first();
                if($this->is_assign_product_stock_avaliable($request->product_id,$request->user()->id,$request->quantity)){
                    $cart->quantity += $request->quantity;
                    $res = $cart->update();
                    $product = Product::find($request->product_id);
                    if($res){
                        return response()->json([
                            'status'=>'true',
                            'massage'=>$product->name.' updated to bill successfully'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>'false',
                            'massage'=>$product->name.' not updated to bill'
                        ]);
                    }
                }else{
                    return response()->json([
                        'status'=>'false',
                        'massage'=>'Out of Stock'
                    ]);
                }
            }else{
                if($this->is_assign_product_stock_avaliable($request->product_id,$request->user()->id,$request->quantity)){
                    $product = Product::find($request->product_id);
                    $cart = new BillingCart();
                    $cart->salesmen_id = $request->user()->id;
                    $cart->product_id = $request->product_id;
        
                    $cart->product_billing_name = $product->billing_name;
                    $cart->variation_id = $request->variation_id;
                    $cart->quantity = $request->quantity;
                    $res = $cart->save();
                    if($res){
                        return response()->json([
                            'status'=>'true',
                            'massage'=>$product->name.' added to bill successfully'
                        ]);
                    }else{
                        return response()->json([
                            'status'=>'false',
                            'massage'=>$product->name.' not added to bill'
                        ]);
                    }
                }else{
                    return response()->json([
                        'status'=>'false',
                        'massage'=>'Out of Stock'
                    ]);
                }
            }
        }
    }

    public function bill_preview(Request $request)
    {
        $cart = BillingCart::where('salesmen_id',$request->user()->id)
                            ->get()
                            ->map(function($item){
                                $item->product = Product::find($item->product_id);
                                $item->variation = Variation::find($item->variation_id);
                                return $item;
                            });
        $total_amount = BillingCart::leftJoin('products', 'billing_carts.product_id', '=', 'products.id')
                        ->leftJoin('variations', 'billing_carts.variation_id', '=', 'variations.id')
                        ->where('billing_carts.salesmen_id', $request->user()->id)
                        ->selectRaw('SUM(
                            CASE 
                                WHEN billing_carts.variation_id IS NOT NULL THEN variations.price * products.box_quantity * billing_carts.quantity
                                ELSE products.total_price * products.box_quantity * billing_carts.quantity
                            END
                        ) as total_price')
                        ->pluck('total_price')
                        ->first();
                    
        if($cart->isNotEmpty()){
            return response()->json([
                'status'=>'true',
                'total_amount'=>$total_amount,
                'data'=>$cart
            ]);
        }else{
            return response()->json([
                'status'=>'true',
                'massage'=>'Cart Not Found 404',
                'data'=>[]
            ]);
        }
    }

    public function remove_cart_item($id){
        $res = BillingCart::where('id',$id)->delete();
        if($res){
            return response()->json([
                'status'=>'true',
                'massage'=>'Cart item Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'false',
                'massage'=>'Cart item Not Deleted'
            ]);
        }
    }

    public function get_all_shops(){
        $shops = Shops::where('is_visible',1)->get();
        if($shops->isNotEmpty()){
            return response()->json([
                'status'=>'true',
                'data'=>$shops
            ]);
        }else{
            return response()->json([
                'status'=>'true',
                'massage'=>'Not Found any data',
                'data'=>[]
            ]);
        }
    }


    public function process_bill(Request $request)
    {
        $cart = BillingCart::where('salesmen_id',$request->user()->id)->get();
        if($cart->isNotEmpty()){
            $order = new Order();
            $order->order_number = generateOrderNumber();
            $order->salesman_id = $request->user()->id;
            $order->shop_id = $request->shop_id;
            $order->total_product_count = BillingCart::where('salesmen_id',$request->user()->id)->sum('quantity');
            $order->sub_total = BillingCart::leftJoin('products', 'billing_carts.product_id', '=', 'products.id')
                                ->leftJoin('variations', 'billing_carts.variation_id', '=', 'variations.id')
                                ->where('billing_carts.salesmen_id', $request->user()->id)
                                ->selectRaw('SUM(
                                    CASE 
                                        WHEN billing_carts.variation_id IS NOT NULL THEN variations.price * products.box_quantity * billing_carts.quantity
                                        ELSE products.price * products.box_quantity * billing_carts.quantity
                                    END
                                ) as total_amount')
                                ->pluck('total_amount')
                                ->first();
            $order->grand_total = BillingCart::leftJoin('products', 'billing_carts.product_id', '=', 'products.id')
                                ->leftJoin('variations', 'billing_carts.variation_id', '=', 'variations.id')
                                ->where('billing_carts.salesmen_id', $request->user()->id)
                                ->selectRaw('SUM(
                                    CASE 
                                        WHEN billing_carts.variation_id IS NOT NULL THEN variations.price * products.box_quantity * billing_carts.quantity
                                        ELSE products.total_price * products.box_quantity * billing_carts.quantity
                                    END
                                ) as total_price')
                                ->pluck('total_price')
                                ->first();
            // return abs($order->sub_total - $order->grand_total);
            $order->discount = abs($order->sub_total - $order->grand_total);
            $order->gst = BillingCart::leftJoin('products', 'billing_carts.product_id', '=', 'products.id')
                            ->leftJoin('variations', 'billing_carts.variation_id', '=', 'variations.id')
                            ->where('billing_carts.salesmen_id', $request->user()->id)
                            ->selectRaw('SUM(
                                CASE 
                                    WHEN billing_carts.variation_id IS NOT NULL THEN variations.price * products.box_quantity * billing_carts.quantity
                                    ELSE products.gst_amount * products.box_quantity * billing_carts.quantity
                                END
                            ) as total_price')
                            ->pluck('total_price')
                            ->first();
            $order->payment_mode = $request->payment_mode;
            if($request->payment_mode == 'Online&Cash'){
                $order->cash = $request->cash;
                $order->online = $request->online;
            }
            $order->is_paid = $request->is_paid;
    
            $res = $order->save();
            update_order_number($order->id,$order->order_number);
            $this->add_order_items($order->id,$request->user()->id);
            $this->decrese_salesman_product_stock($request->user()->id);
            $this->clear_cart($request->user()->id);
    
            if($res){
                return response()->json([
                    'status'=>'true',
                    'massage'=>'Bill Created Successfully',
                    'order' => $order
                ]);
            }else{
                return response()->json([
                    'status'=>'false',
                    'massage'=>'Bill not created',
                ]);
            }
        }else{
            return response()->json([
                'status'=>'false',
                'massage'=>'Cart is empty',
            ]);
        }
    }
   
    private function add_order_items($order_id,$salesman_id){
        $cart_items = BillingCart::where('salesmen_id',$salesman_id)->get();
        foreach($cart_items as $cart_item){
            // return $cart_item->product_id;
            $product = Product::find($cart_item->product_id);
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $product->id;
            $order_items->product_billing_name = $product->billing_name;
            $order_items->quantity = $cart_item->quantity;
            $order_items->mrp = $product->price * $product->box_quantity;
            // $order_items->discount = $product->discount_price;
            $order_items->discount = ($product->discount_rate / 100) * $order_items->mrp;
            $order_items->gst = $product->gst_amount * $product->box_quantity;
            $order_items->total_price = ($product->total_price * $product->box_quantity) * $cart_item->quantity;
            $order_items->save();
        }
    }

    private function decrese_salesman_product_stock($salesman_id){
        $cart_items = BillingCart::where('salesmen_id',$salesman_id)->get();
        $daily_sales = DailySales::where('salesman_id',$salesman_id)->where('outing_date',date('Y-m-d'))->first();
        $assign_products = AssignedProducts::where('daily_sales',$daily_sales->id)->first();
        $products = json_decode($assign_products->products);
        foreach($cart_items as $item){
            foreach($products as $p){
                if($p->product == $item->product_id){
                    $p->quantity = max(0, $p->quantity - $item->quantity);
                    break;
                }
            }
        }
        $assign_products->products = json_encode($products);
        $assign_products->update();
    }

    private function clear_cart($salesman_id){
        $cart_items = BillingCart::where('salesmen_id',$salesman_id)->delete();
    }



    public function get_all_orders(Request $request)
    {
        // $orders = Order::where('salesman_id',$request->user()->id)->get();
        $orders = Order::leftJoin('shops','orders.shop_id','shops.id')
                    ->where('orders.salesman_id',$request->user()->id)
                    ->orderBy('id','desc')
                    ->get(['orders.*','shops.shop_name','shops.owner_name','shops.whatsapp_number']);
        if($orders->isNotEmpty()){
            return response()->json([
                'status'=>'true',
                'data'=>$orders
            ]);
        }else{
            return response()->json([
                'status'=>'false',
                'massage'=>'No Order Created'
            ]);
        }
    }

    public function get_order_items($id){
        // $order_items = OrderItems::where('order_id',$id)->get();
        $order_items = OrderItems::leftJoin('products','order_items.product_id','products.id')
                                    ->where('order_id',$id)
                                    ->get(['order_items.*','products.name as product_name']);
        if($order_items->isNotEmpty()){
            return response()->json([
                'status'=>'true',
                'data'=>$order_items
            ]);
        }else{
            return response()->json([
                'status'=>'false',
                'massage'=>'No Order Found'
            ]);
        }
    }
}
