<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\DailySales;
use App\Models\ProductImages;
use App\Models\ProductVariation;
use App\Models\Variation;
use App\Models\VariationsOptions;
use App\Models\AssignedProducts;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){
        $this->view_path = "admin.products.";
    }

    public function index()
    {
        $data['title'] = 'Products';
        $data['proucts'] = Product::all();
        $data['categories'] = Category::where('visibility',1)->get();
        return view($this->view_path.'index')->with($data);
    }

    public function get_products_by_category_id(Request $request){
        $dailysales_id = DailySales::where('outing_date',date('Y-m-d'))->where('salesman_id',$request->user()->id)->value('id');
        $assign_products_json = AssignedProducts::where('daily_sales',$dailysales_id)->value('products');
        $assign_products = json_decode($assign_products_json, true);
        $product_ids = array_column($assign_products, 'product');
        $products = Product::where('category', $request->category_id)
                            ->whereIn('id', $product_ids)
                            ->get();
        $products_with_quantity = $products->map(function($product) use ($assign_products) {
            $quantity = collect($assign_products)->firstWhere('product', $product->id)['quantity'];
            $product->quantity = $quantity;
            // return $product;
            return [
                'product_id' => $product->id,
                "name" => $product->name,
                "total_price" => $product->total_price,
                "box_quantity" => $product->box_quantity,
                "product_main_image" => $product->product_main_image,
                "quantity" => $product->quantity,
                // "variations" => get_product_variations($product->id)
            ];
        });
        return response()->json($products_with_quantity);
    }

    public function update_product_stock(Request $request){
        $product = Product::find($request->product_id);
        $product->stock	 += $request->stock;
        $res = $product->update();
        if($res){
            return redirect()->back()->with(['success'=>'Stock Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }


    public function basic_info_create(){
        $data['title'] = 'Products';
        $data['categories'] = Category::where('visibility',1)->get();
        return view($this->view_path.'basic_info')->with($data);
    }

    public function basic_info_process(Request $request){
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_billing_name' => 'required',
            'category_id' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->product_name;
        $product->billing_name = $request->product_billing_name;
        $product->slug = createSlug($request->product_name, Product::class);
        $product->category = $request->category_id;
        $product->description = $request->description;
        $product->price = 0.00;
        $product->product_price = 0.00;
        $product->discount_rate = 0;
        $product->discount_price = 0.00;
        $product->gst_rate = 0;
        $product->gst_amount = 0.00;
        $product->total_price = 0.00;
        $product->visibility = $request->is_visible;
        $res = $product->save();
        if($res){
            return redirect(route('products.price-edit',$product->id))->with(['success'=>'Basic Information Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function basic_info_edit(Request $request){
        $data['title'] = 'Products';
        $data['categories'] = Category::where('visibility',1)->get();
        $data['product'] = Product::find($request->id);
        return view($this->view_path.'basic_info_edit')->with($data);
    }

    public function basic_info_edit_process(Request $request){
        $product = Product::find($request->product_id);
        if($product->name != $request->product_name){
            $product->name = $request->product_name;
            $product->slug = createSlug($request->product_name, Product::class);
        }
        $product->billing_name = $request->product_billing_name;
        $product->category = $request->category_id;
        $product->description = $request->description;
        $product->visibility = $request->is_visible;
        $res = $product->update();
        if($res){
            return redirect(route('products.price-edit',$product->id))->with(['success'=>'Basic Information Added Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function price_edit(Request $request){
        if(request()->segment(4) == ''){
			return redirect(route('products.basic-info-create'))->with(['error'=>'Please Fill Basic Information']);
		}
        $data['title'] = 'Products';
        $data['product'] = Product::find($request->id);
        return view($this->view_path.'price_edit')->with($data);
    }

    public function price_edit_process(Request $request){
        $product = Product::find($request->product_id);
        $product->price = $request->product_price;
        $product->discount_rate = $request->discount_rate;
        // $product->discounted_price = $request->product_price - (($request->discount_rate / 100) * $request->product_price);
        $product->gst_rate = $request->gst_rate;
        $product->total_price = $request->total_price;
        // $product->gst_amount = ($request->gst_rate / 100) * $product->discounted_price;
        $product->discount_price = ($request->discount_rate / 100) * $request->product_price;
        $gstRate = $request->gst_rate/100;
        $product->gst_amount = ($request->total_price * $gstRate) / (1 + $gstRate);
        $product->product_price = $request->total_price - $product->gst_amount;
        $res = $product->update();
        if($res){
            return redirect(route('products.inventory-edit',$product->id))->with(['success'=>'Price Details Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function inventory_edit(Request $request){
        if(request()->segment(4) == ''){
			return redirect(route('products.basic-info-create'))->with(['error'=>'Please Fill Basic Information']);
		}
        $data['title'] = 'Products';
        $data['product'] = Product::find($request->id);
        return view($this->view_path.'inventory_edit')->with($data);
    }

    public function inventory_edit_process(Request $request){ 
        $product = Product::find($request->product_id);
        // $product->sku = $request->sku;
        $product->box_quantity = $request->box_quantity;
        $product->stock	 = $request->stock;
        $res = $product->update();
        if($res){
            // return redirect(route('products.variation-edit',$product->id))->with(['success'=>'Inventory Updated Successfully']);
            return redirect(route('products.product-images-edit',$product->id))->with(['success'=>'Inventory Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function variation_edit(){
        if(request()->segment(4) == ''){
			return redirect(route('products.basic-info-create'))->with(['error'=>'Please Fill Basic Information']);
		}
        $data['title'] = 'Products';
        // $data['variations'] = ProductVariation::where('product_id',request()->segment(4))->get();
        $data['variations'] = Variation::where('product_id',request()->segment(4))->get();
        return view($this->view_path.'variation_edit')->with($data);
    }

    public function variation_edit_process(Request $request){ 
        $res = 1;
        if($res){
            return redirect(route('products.product-images-edit',$request->product_id));
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function product_images_edit(Request $request){
        if(request()->segment(4) == ''){
			return redirect(route('products.basic-info-create'))->with(['error'=>'Please Fill Basic Information']);
		}
        $data['title'] = 'Products';
        $data['product_images'] = ProductImages::where('product_id',$request->id)->get();
        return view($this->view_path.'product_images_edit')->with($data);
    }

    public function product_images_edit_process(Request $request){ 
        $product_images = $request->file('product_images');
        $res = 0;
        if (!empty($product_images)) {
            foreach ($product_images as $img) {
                $product_img = new ProductImages();
                $filename = time() . '_' . $img->getClientOriginalName();
                $directory = public_path('web_directory/product_images');
                $img->move($directory, $filename);
                $filePath = "web_directory/product_images/" . $filename;
                $product_img->images = $filePath;
                $product_img->product_id = $request->product_id;
                $product_img->visiblity = 1;
                $res = $product_img->save();
            }
        }

        if($res){
            return redirect()->back()->with(['success'=>'Successfully Updated']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }


    public function destroy(Request $request){
        $product = Product::find($request->id);
        $res = $product->delete();

        if($res){
            return redirect()->back()->with(['success'=>'Product Successfully Deleted']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }

    public function destroy_product_image(Request $request){
        $product_image = ProductImages::find($request->id);
        $res = $product_image->delete();

        if($res){
            return redirect()->back()->with(['success'=>'Image Successfully Deleted']);
        }else{
            return redirect()->back()->with(['error'=>'Some error occurs!']);
        }
    }












    //============================== Variation Process =====================

    // public function add_variation(Request $request){
    //     $variation = new ProductVariation();
    //     $variation->product_id = $request->product_id;
    //     $variation->lable_name = $request->label_name;
    //     $variation->is_visible = $request->is_visible;
    //     $variation->is_use_different_price = $request->use_different_price;
    //     $res = $variation->save();
    //     if($res){
    //         return redirect()->back()->with(['success'=>'Updated Successfully']);
    //     }else{
    //         return redirect()->back()->with(['error'=>'Some Error Occurs']);
    //     }
    // }

    public function add_variation(Request $request){
        $variation = new Variation();
        $variation->product_id = $request->product_id;
        $variation->variation_name = $request->label_name;
        $variation->is_visible = $request->is_visible;
        if($request->use_different_price == 1){
            $variation->price = $request->new_price;
        }else{
            $product = Product::find($request->product_id);
            $variation->price = $product->total_price;
        }
        $res = $variation->save();
        if($res){
            return redirect()->back()->with(['success'=>'Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some Error Occurs']);
        }
    }

    public function add_variation_option(Request $request){
        $variation_option = new VariationsOptions();
        $variation_option->variation_id = $request->variation_id;
        $variation_option->options_names = $request->option_name;
        $variation_option->stock = $request->option_stock;
        $variation_option->price = $request->option_price;
        $res = $variation_option->save();
        if($res){
            return redirect()->back()->with(['success'=>'Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some Error Occurs']);
        }
    }

    public function get_variation_options(Request $request){
        $resp = VariationsOptions::where('variation_id',$request->variation_id)->get();
        return response()->json($resp);
    }

    public function delete_variation(Request $request){
        // $variation = ProductVariation::find($request->id);
        $variation = Variation::find($request->id);
        $res = $variation->delete();
        if($res){
            return redirect()->back()->with(['success'=>'Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Some Error Occurs']);
        }
    }
}
