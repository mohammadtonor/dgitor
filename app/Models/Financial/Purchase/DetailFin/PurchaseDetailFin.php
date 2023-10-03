<?php

namespace App\Models\Financial\Purchase\DetailFin;

use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use App\Models\Financial\Purchase\Order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetailFin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "purchase_detailfins";
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }

    public function purchase_detailfins_tran()
    {
        return $this->hasMany(PurchaseDetailFinTrans::class, "detailfin_id");
    }
}
