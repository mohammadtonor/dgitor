<?php

namespace App\Models\Product\Pic;

use App\Models\Product\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPic extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "product_pics";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }
}
