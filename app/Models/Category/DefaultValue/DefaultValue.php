<?php

namespace App\Models\Category\DefaultValue;

use App\Models\Category\Attribute\Attribute;
use App\Models\Exchange\Exchange\AttrDefaultValExchange\AttrDefaultValExchange;
use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultValue extends Model
{
    use HasFactory;
    protected $table = "default_values";
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, "default_val_product", "default_val_id", "product_id");
    }

    public function attr_default_val_exchanges()
    {
        return $this->hasMany(AttrDefaultValExchange::class, "default_value_id");
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, "attribute_id");
    }

}
