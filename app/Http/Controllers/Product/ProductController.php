<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Price;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add(){
        return view('backend.product.add');
    }

    public function store(Request $request){
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
    }
}
