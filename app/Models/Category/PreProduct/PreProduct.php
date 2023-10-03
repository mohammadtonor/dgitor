<?php

namespace App\Models\Category\PreProduct;

use App\Models\Category\Category\Category;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Exchange\Favorite\Favorite;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Product\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "pre_products";
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }






    public function periodic_services()
    {
        return $this->hasMany(PeriodicService::class, "pre_product_id");
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, "pre_product_id");
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, "pre_product_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
