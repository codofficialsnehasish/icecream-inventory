<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DailySales;
use App\Models\Salesman;
use App\Models\Trucks;
use App\Models\Product;
use App\Models\AssignedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DailySalesController extends Controller
{
    public function __construct(){
        $this->view_path = "admin.daily_sales.";
    }

    public function index()
    {
        $data['title'] = 'Daily Sales';
        $data['daily_sales'] = DailySales::all();
        return view($this->view_path.'index')->with($data);
    }

    public function show_assigned_products(Request $request){
        $data['title'] = 'Item List';
        $data['daily_sale'] = DailySales::find($request->id);
        return view($this->view_path.'assigned_products')->with($data);
    }

    public function show_assigned_products_report(Request $request){
        $data['title'] = 'Item List Report';
        $data['daily_sale'] = DailySales::find($request->id);
        return view($this->view_path.'assigned_products_reports')->with($data);
    }

    public function create()
    {
        $data['title'] = 'Daily Sales';
        $data['categories'] = Category::where('visibility',1)->get();
        // $data['products'] = Product::where('visibility',1)->get();
        $data['salesmans'] = Salesman::where('status',1)->get();
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        return view($this->view_path.'create')->with($data);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'salesman_id' => 'required|exists:salesmen,id',
            'truck_id' => 'required|exists:trucks,id',
            'outing_date' => 'required'
        ], [
            'salesman_id.required' => 'Please Choose a Salesman.',
            'salesman_id.exists' => 'The selected salesman is invalid.',
            'truck_id.required' => 'Please Choose a Truck.',
            'truck_id.exists' => 'The selected truck is invalid.',
            'outing_date.required' => 'Please Provide an outing date.',
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator->errors());
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            // return $request->all();die;
            $daily_sales = new DailySales();
            $daily_sales->outing_date = format_date_for_db($request->outing_date);
            $daily_sales->salesman_id = $request->salesman_id;
            $daily_sales->truck_id = $request->truck_id;
            $res1 = $daily_sales->save();

            // $dataToStore = array_map(function($product, $quantity, $closingStock) {
            //     return [
            //         'product' => $product,
            //         'quantity' => $quantity + $closingStock,
            //     ];
            // }, $request->products, $request->quantity, $request->closing_stock);

            $dataToStore = array_filter(array_map(function($product) {       
                $quantity = $product['quantity'];
                $closingStock = $product['closing_stock'] ?? 0;
                $currentStock = $product['current_stock'];
                if (($quantity !== null || $closingStock !== null)) {
                    // if($currentStock >= $quantity){
                        return [
                            'product' => $product['product_id'],
                            'category' => get_category_id_by_product_id($product['product_id']),
                            'provided_qty' => $quantity,
                            'closing_stock' => $closingStock,
                            'quantity' => $quantity + $closingStock,
                            'actual_stock' => $quantity + $closingStock,
                        ];
                    // }elseif($closingStock !== null){
                    //     return [
                    //         'product' => $product['product_id'],
                    //         'category' => get_category_id_by_product_id($product['product_id']),
                    //         'provided_qty' => null,
                    //         'closing_stock' => $closingStock,
                    //         'quantity' => $closingStock,
                    //         'actual_stock' => $closingStock,
                    //     ];
                    // }
                }
            }, $request->products));

            $dataToStore = array_values(array_filter($dataToStore));
            foreach ($dataToStore as $product) {
                $productId = $product['product'];
                $quantity = (int)$product['provided_qty'];
                $closingStock = (int)$product['closing_stock'];
            
                $currentStock = Product::where('id', $productId)->value('stock');
                if ($currentStock !== null) {
                    // if ($quantity !== null && $currentStock >= $quantity) {
                        $newStock = $currentStock - $quantity;
                        Product::where('id', $productId)->update(['stock' => $newStock]);
                    // } elseif ($closingStock !== null) {
                    //     Product::where('id', $productId)->update(['stock' => $currentStock]);
                    // }
                }
            }

            $assign = new AssignedProducts();
            $assign->daily_sales = $daily_sales->id;
            $assign->products = json_encode($dataToStore);
            $res2 = $assign->save();

            if($res1 && $res2){
                // return redirect()->back()->with(["success"=>"Data Added Successfully"]);
                return response()->json(['status'=>1,'massage'=>'Data Added Successfully']);
            }else{
                // return redirect()->back()->with(["error"=>"Data Not Added"]);
                return response()->json(['status'=>0,'massage'=>'Data Not Added']);
            }
        }
    }

    public function get_truck_products(Request $request)
    {
        $assigned_products = AssignedProducts::leftJoin('daily_sales', 'assigned_products.daily_sales', '=', 'daily_sales.id')
                        ->where('daily_sales.truck_id', $request->truck_id)
                        ->orderBy('assigned_products.created_at', 'desc')
                        ->first();
        if($assigned_products){
            return $assigned_products->products;
        }else{
            return '';
        }
    }

    public function get_asign_products(Request $request)
    {
        $assigned_products = AssignedProducts::where('daily_sales', $request->daily_sales_id)->first();
        if($assigned_products){
            return $assigned_products->products;
        }else{
            return '';
        }
    }

    public function edit(string $id)
    {
        $data['title'] = 'Daily Sales';
        $data['categories'] = Category::where('visibility',1)->get();
        // $data['products'] = Product::where('visibility',1)->get();
        $data['salesmans'] = Salesman::where('status',1)->get();
        $data['trucks'] = Trucks::where('is_visible',1)->get();
        $data['daily_sales'] = DailySales::find($id);
        $data['assigned_products'] = json_decode(AssignedProducts::where('daily_sales',$id)->value('products'));
        return view($this->view_path.'edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'salesman_id' => 'required|exists:salesmen,id',
            'truck_id' => 'required|exists:trucks,id',
            'outing_date' => 'required'
        ], [
            'salesman_id.required' => 'Please Choose a Salesman.',
            'salesman_id.exists' => 'The selected salesman is invalid.',
            'truck_id.required' => 'Please Choose a Truck.',
            'truck_id.exists' => 'The selected truck is invalid.',
            'outing_date.required' => 'Please Provide an outing date.',
        ]);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator->errors());
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            // return $request->all();die;
            $daily_sales = DailySales::find($id);
            $daily_sales->outing_date = format_date_for_db($request->outing_date);
            $daily_sales->salesman_id = $request->salesman_id;
            $daily_sales->truck_id = $request->truck_id;
            $res1 = $daily_sales->update();

            $dataToStore = array_filter(array_map(function($product) {
                $quantity = $product['quantity'];
                $closingStock = $product['closing_stock'] ?? 0;
                if ($quantity !== null || $product['closing_stock'] !== null) {
                    return [
                        'product' => $product['product_id'],
                        'category' => get_category_id_by_product_id($product['product_id']),
                        'provided_qty' => $quantity,
                        'closing_stock' => $closingStock,
                        'quantity' => $quantity + $closingStock,
                        'actual_stock' =>$quantity + $closingStock,
                    ];
                }

            }, $request->products));
            $dataToStore = array_values(array_filter($dataToStore));

            $assign = AssignedProducts::where('daily_sales',$daily_sales->id)->first();
            $assign->daily_sales = $daily_sales->id;
            $assign->products = json_encode($dataToStore);
            $res2 = $assign->update();

            if($res1 && $res2){
                return response()->json(['status'=>1,'massage'=>'Data updated Successfully']);
            }else{
                return response()->json(['status'=>0,'massage'=>'Data Not updated']);
            }
        }
    }

    public function destroy(string $id)
    {
        $daily_sales = DailySales::find($id);
        $res = $daily_sales->delete();
        if($res){
            return back()->with(['success'=>'Data Deleted Successfully.']);
        }else{
            return back()->with(['error'=>'Data Not Deleted.']);
        }
    }
}
