<?php

namespace App\Models\Category\Category;

use App\Models\Category\Attribute\Attribute;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Experting\PrivateExperting\PrivateExpertingQuestion;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Product\Product\Product;
use App\Models\Tag\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "categories";
    protected $guarded = [];
//    protected $appends = ["created_at", "deleted_at"];

    /* ---------------------------------------- Relations ---------------------------------------- */

    public function childrens()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, "attribute_id");
    }












    public function pre_products()
    {
        return $this->hasMany(PreProduct::class, "category_id");
    }

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, "category_id");
    }

    public function periodic_services()
    {
        return $this->hasMany(PeriodicService::class, "category_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "category_id");
    }



    public function Private_expertings()
    {
        return $this->hasMany(PrivateExpertingQuestion::class, "category_id");
    }



    public function users()
    {
        return $this->belongsToMany(User::class, "category_user", "category_id", "user_id");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, "category_tag", "category_id", "tag_id", "id", "id");
    }

    /* ---------------------------------------- Accessors ---------------------------------------- */
    public function getCreatedAtAttribute($createdAt)
    {
        return jdate($createdAt)->format("%A, %d %B %Y");
    }

    public function getDeletedAtAttribute($deletedAt)
    {
        return $deletedAt != null ? jdate($deletedAt)->format("%A, %d %B %Y") : null;
    }
}

