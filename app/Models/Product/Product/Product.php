<?php

namespace App\Models\Product\Product;

use App\Models\Category\Category\Category;
use App\Models\Category\DefaultValue\DefaultValue;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Exchange\Favorite\Favorite;
use App\Models\Financial\Purchase\Order\OrderDetail;
use App\Models\Location\City;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Product\AttrValue\ProductAttrValue;
use App\Models\Product\Pic\ProductPic;
use App\Models\Product\ProductService\ProductService;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "products";
    protected $guarded = [];

    public function attr_values()
    {
        return $this->hasMany(ProductAttrValue::class, "product_id");
    }

    public function pics()
    {
        return $this->hasMany(ProductPic::class, "product_id");
    }

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }

    public function product_service()
    {
        return $this->belongsTo(ProductService::class, "product_service_id");
    }

    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, "product_id");
    }

    public function product1_periodic_services()
    {
        return $this->hasMany(PeriodicService::class, "product1_id");
    }

    public function product2_periodic_services()
    {
        return $this->hasMany(PeriodicService::class, "product2_id");
    }

    public function pre_products()
    {
        return $this->hasMany(PreProduct::class, "product_id");
    }

    public function product1_exchanges()
    {
        return $this->hasMany(Exchange::class, "product1_id");
    }

    public function product2_exchanges()
    {
        return $this->hasMany(Exchange::class, "product2_id");
    }

    public function default_values()
    {
        return $this->belongsToMany(DefaultValue::class, "default_val_product", "product_id", "default_val_id");
    }

    public function purchase_order_details()
    {
        return $this->hasMany(OrderDetail::class, "product_id");
    }
}
