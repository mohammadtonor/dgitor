<?php

namespace App\Models\Experting\Type;

use App\Models\Category\Category\Category;
use App\Models\Experting\Experting\Experting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertingType extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "experting_types";
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function expertings()
    {
        return $this->hasMany(Experting::class, "type_id");
    }
}
