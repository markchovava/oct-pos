<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Price;
use App\Models\Product\Product;
use App\Models\Product\ProductBrand;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductTag;
use App\Models\Specification\Specification;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Product::orderBy('updated_at', 'desc')->get();
        return view('backend.product.index', $data);
    }

    public function add(){
        return view('backend.product.add');
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
             *    Specification
             **/
            $spec_name = $request->spec_name;
            if( isset($spec_name) && isset($spec_value) ){
                $count_name = count($spec_name);
                for($i = 0; $i < $count_name; $i++){
                    $spec = new Specification();
                    $spec->product_id = $product->id;
                    $spec->spec_name = $request->spec_name[$i];
                    $spec->spec_value = $request->spec_value[$i];
                    $spec->save();           
                }
            } 
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
        
        /* Redirect to Index */
        return redirect()->route('admin.product.index');
    }

    public function edit($id){
        $data['stock'] = Stock::where('product_id', $id)->first();
        $data['price'] = Price::where('product_id', $id)->first();
        $data['specifications'] = Specification::where('product_id', $id)->get();
        $data['brands'] = Stock::where('product_id', $id)->get();
        $data['categories'] = Stock::where('product_id', $id)->get();
        $data['tags'] = Stock::where('product_id', $id)->get();
        $data['product'] = Product::with(['stock', 'tags', 'brands', 'categories', 'specifications'])
                                ->find($id);
        return view('backend.product.edit', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            $product = Product::find($id);
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
             *    Price
             **/
            $price = Price::where('product_id', $id);
            $price->product_id = $product->id;
            $price->zwl = $request->zwl;
            $price->usd = $request->usd;
            $price->save();
            /**
             *    Stock
             **/
            $stock = Stock::where('product_id', $id);
            $stock->product_id = $product->id;
            $stock->quantity = $request->quantity;
            $stock->save();
            /**
             *    Specification
             **/
            $spec_name = $request->spec_name;
            if( isset($spec_name) && isset($spec_value) ){
                $spec = Specification::where('product_id', $id)->delete();
                $count_name = count($spec_name);
                for($i = 0; $i < $count_name; $i++){
                    $spec = new Specification();
                    $spec->product_id = $product->id;
                    $spec->spec_name = $request->spec_name[$i];
                    $spec->spec_value = $request->spec_value[$i];
                    $spec->save();           
                }
            } 
            /**
             *    Brands 
             **/
            $brands = $request->brand;
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

        /* Redirect to Index */
        return redirect()->route('admin.product.index');
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
