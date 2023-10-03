<?php

namespace App\Models\Exchange\Exchange\AttrValue;

use App\Models\Exchange\Exchange\Exchange\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeAttrValue extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "exchange_attr_values";
    protected $guarded = [];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class, "exchange_id");
    }
}
