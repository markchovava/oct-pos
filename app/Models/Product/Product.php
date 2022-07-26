<?php

namespace App\Models\Product;

use App\Models\Operation\OperationItem;
use App\Models\Order\OrderItem;
use App\Models\Specification\Specification;
use App\Models\Stock\Stock;
use App\Models\Tag\Tag;
use App\Models\Brand\Brand;
use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'barcode', 'quantity', 'description',
        'image', 'status', 'discount_id', 'tax_id'
    ];

   /* One to One Belong To*/
    public function discount(){
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
    /* One to One */
    public function price(){
        return $this->hasOne(Price::class, 'product_id', 'id');
    }
    /* One to One Belong To*/
    public function tax(){
        return $this->belongsTo(Tax::class, 'tax_id', 'id');
    }
    /* One to One */
    public function order_item(){
        return $this->hasOne(OrderItem::class, 'product_id', 'id');
    }
    /* One to One */
    public function operation_item(){
        return $this->hasOne(OperationItem::class, 'product_id', 'id');
    }
    /* One to One */
    public function stock(){
        return $this->hasOne(Stock::class, 'product_id', 'id');
    }

    /* One to Many */
     public function specifications(){
        return $this->hasMany(Specification::class, 'product_id', 'id');
    }
      /* Many to Many for Product and Users */
    public function product_users(){
    return $this->belongsToMany(Sticker::class, 'product_users', 'product_id', 'user_id')
        ->withTimestamps();
    }

    /* Many to Many */
    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')
            ->withTimestamps();
    }

    /* Many to Many */
    public function brands(){
        return $this->belongsToMany(Brand::class, 'product_brands', 'product_id', 'brand_id')
            ->withTimestamps();
    }

    /* Many to Many */
    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }
}
