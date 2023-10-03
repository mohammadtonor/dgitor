<?php

namespace App\Models\Financial\Exchange\DetailFin;

use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeDetailFin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "exchange_detailfins";
    protected $guarded = [];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class, "exchange_id");
    }

    public function exchange_detail_fin_tran()
    {
        return $this->hasMany(ExchangeDetailFinTrans::class, "detailfin_id");
    }
}
