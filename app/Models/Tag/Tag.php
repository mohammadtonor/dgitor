<?php

namespace App\Models\Tag;

use App\Models\Category\Category\Category;
use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tags";
    protected $guarded;

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_tag", "tag_id", "product_id", "id", "id");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_tag", "tag_id", "category_id", "id", "id");
    }
}
