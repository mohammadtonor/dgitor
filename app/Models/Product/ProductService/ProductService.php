<?php

namespace App\Models\Product\ProductService;

use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductService extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "product_service";
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, "product_service_id");
    }
}
