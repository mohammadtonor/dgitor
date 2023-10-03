<?php

namespace App\Models\Exchange\Favorite;

use App\Models\Category\PreProduct\PreProduct;
use App\Models\Product\Product\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "favorites";
    protected $guarded = [];

    public function pre_product()
    {
        return $this->belongsTo(PreProduct::class, "pre_product_id");
    }

    public function register_user()
    {
        return $this->belongsTo(User::class, "register_user_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
