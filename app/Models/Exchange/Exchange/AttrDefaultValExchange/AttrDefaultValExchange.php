<?php

namespace App\Models\Exchange\Exchange\AttrDefaultValExchange;

use App\Models\Category\Attribute\Attribute;
use App\Models\Category\DefaultValue\DefaultValue;
use App\Models\Exchange\Exchange\Exchange\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttrDefaultValExchange extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "attribute_default_val_exchange";
    protected $guarded = [];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class, "exchange_id");
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, "attribute_id");
    }

    public function default_value()
    {
        return $this->belongsTo(DefaultValue::class, "default_value_id");
    }
}
