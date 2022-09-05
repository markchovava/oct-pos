<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Operation\Operation;
use App\Models\Product\Price;
use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductTag;
use App\Models\Specification\Specification;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Product::orderBy('updated_at', 'desc')->paginate(10);
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.product.index', $data);
    }

    public function view($id){
        $product = Product::with(['stock', 'price', 'brands', 'categories'])
        ->find($id);
        $stock = Stock::where('product_id', $id)->first();
        $price = Price::where('product_id', $id)->first();
        $data['product'] = $product;
        $data['stock'] = $stock;
        $data['price'] = $price;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.product.view', $data);
    }

    public function add(){
        $categories = Category::orderBy('name', 'asc')->get();
        $data['categories'] = $categories;
        $brands = Brand::orderBy('name', 'asc')->get();
        $data['brands'] = $brands;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.product.add', $data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->barcode = $request->barcode;
            $product->status = $request->status;
            if( $request->file('image') ){
                $image = $request->file('image');
                $image_extension = strtolower($image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/thumbnail/';
                if($product->image){
                    if(file_exists(public_path($upload_location . $product->image))){
                        unlink($upload_location . $product->image);
                    }
                    $image->move($upload_location, $image_name);
                    $product->image = $image_name;                    
                }else{
                    $image->move($upload_location, $image_name);
                    $product->image = $image_name;
                }              
            }
            $product->save();
           
            /**
             *    Brands 
             **/
            $brands = $request->brand;
            if(isset($brands)){
                foreach($brands as $brand){
                    $product_brand = new ProductBrand();
                    $product_brand->product_id = $product->id;
                    $product_brand->brand_id = $brand;
                    $product_brand->save();        
                }
            } 
            /**
             *    Category
             **/
            $categories = $request->category;
            if(isset($categories)){
                foreach($categories as $category){
                    $product_category = new ProductCategory();
                    $product_category->product_id = $product->id;
                    $product_category->category_id = $category;
                    $product_category->save();           
                }
            } 
            /**
             *    Tag
             **/
            $tags = $request->tag;
            if(isset($tags)){
                foreach($tags as $tag){
                    $product_tag = new ProductTag();
                    $product_tag->product_id = $product->id;
                    $product_tag->category_id = $tag;
                    $product_category->save();           
                }
            } 
            /**
             *    Price
             **/
            $price = new Price();
            $price->product_id = $product->id;
            $price->zwl = $request->zwl;
            $price->usd = $request->usd;
            $price->save();
            /**
             *    Stock
             **/
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->quantity = $request->quantity;
            $stock->save();
        });

        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        
        /* Redirect to Index */
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function edit($id){
        $data['stock'] = Stock::where('product_id', $id)->first();
        $data['price'] = Price::where('product_id', $id)->first();
        $categories = Category::orderBy('name', 'asc')->get();
        $data['categories'] = $categories;
        $brands = Brand::orderBy('name', 'asc')->get();
        $data['brands'] = $brands;
        $data['db_brands'] = ProductBrand::where('product_id', $id)->get();
        $data['db_categories'] = ProductCategory::where('product_id', $id)->get();
        $data['product'] = Product::with(['stock', 'tags', 'brands', 'categories', 'specifications'])
                                ->find($id);
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.product.edit', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            $product = Product::find($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->barcode = $request->barcode;
            $product->status = $request->status;
            $product->updated_at = now();
            if( $request->file('image') ){
                $image = $request->file('image');
                $image_extension = strtolower($image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/thumbnail/';
                if($product->image){
                    if(file_exists(public_path($upload_location . $product->image))){
                        unlink($upload_location . $product->image);
                    }
                    $image->move($upload_location, $image_name);
                    $product->image = $image_name;                    
                }else{
                    $image->move($upload_location, $image_name);
                    $product->image = $image_name;
                }              
            }
            $product->save();
            /**
             *    Price
             **/
            $price = Price::where('product_id', $id)->first();
            $price->product_id = $product->id;
            $price->zwl = $request->zwl;
            $price->usd = $request->usd;
            $price->save();
            /**
             *    Stock
             **/
            $stock = Stock::where('product_id', $id)->first();
            $stock->product_id = $product->id;
            $stock->quantity = $request->quantity;
            $stock->save();
            /**
             *    Brands 
             **/
            $brands = $request->brand;
            //dd($brands);
            if(isset($brands)){
                $brand = ProductBrand::where('product_id', $id)->delete();
                foreach($brands as $brand){
                    $product_brand = new ProductBrand();
                    $product_brand->product_id = $product->id;
                    $product_brand->brand_id = $brand;
                    $product_brand->save();        
                }
            } 
            /**
             *    Category
             **/
            $categories = $request->category;
            if(isset($categories)){
                $product_category = ProductCategory::where('product_id', $id)->delete();
                foreach($categories as $category){
                    $product_category = new ProductCategory();
                    $product_category->product_id = $product->id;
                    $product_category->category_id = $category;
                    $product_category->save();           
                }
            } 
            /**
             *    Tag
             **/
            $tags = $request->tag;
            if( isset($tags) ){
                $product_tag = ProductTag::where('product_id', $id)->delete();
                foreach($tags as $tag){
                    $product_tag = new ProductTag();
                    $product_tag->product_id = $product->id;
                    $product_tag->category_id = $tag;
                    $product_category->save();           
                }
            } 
            
        });

        $notification = [
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        ];

        /* Redirect to Index */
        return redirect()->route('admin.product.index')->with($notification);
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        ProductBrand::where('product_id', $id)->delete();
        ProductCategory::where('product_id', $id)->delete();
        ProductTag::where('product_id', $id)->delete();
        Stock::where('product_id', $id)->delete();
        Price::where('product_id', $id)->delete();
        Specification::where('product_id', $id)->delete();
        
        /* Redirect to Index */
        return redirect()->route('admin.product.index');
    }
}
