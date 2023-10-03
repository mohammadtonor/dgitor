<?php

namespace App\Models\Financial\TransType;

use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use App\Models\Financial\PeriodicService\DetailFinTrans\PeriodicServiceDetailFinTrans;
use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransType extends Model
{

    public const NAGHDI = 1;     //نقدی
    public const DARGAH = 2;       // درگاه
    public const CART_BE_CART = 3;       // کارت به کار
    public const AGHSAT = 4;       // اقساط
    public const LINKE_PARDAKHT = 5;       // لینک پرداخت
    public const POSE = 6;       // پز
    public const PARDAKHT_DARBE_MANZEL = 7;       // پرداخت درب منزل
    public const SABTE_KHARID = 8;      // ثبت خرید
    public const SABTE_KHARID_HOZOORI = 9;      // ثبت خرید حضوری


    use HasFactory,SoftDeletes;
    protected $table = "transtypes";
    protected $guarded = [];

    public function purchase_detail_fin_trans()
    {
        return $this->hasMany(PurchaseDetailFinTrans::class, "transtype_id");
    }

    public function exchange_detail_fin_trans()
    {
        return $this->hasMany(ExchangeDetailFinTrans::class, "transtype_id");
    }

    public function periodic_service_detail_fin_trans()
    {
        return $this->hasMany(PeriodicServiceDetailFinTrans::class, "transtype_id");
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, "transtype_id");
    }
}
