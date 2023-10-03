<?php

namespace App\Models\Category\Attribute;

use App\Models\Category\Category\Category;
use App\Models\Category\DefaultValue\DefaultValue;
use App\Models\Exchange\Exchange\AttrDefaultValExchange\AttrDefaultValExchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "attributes";
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function default_values()
    {
        return $this->hasMany(DefaultValue::class);
    }








    public function attr_default_val_exchanges()
    {
        return $this->hasMany(AttrDefaultValExchange::class, "default_value_id");
    }



}
