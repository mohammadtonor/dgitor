<?php

namespace App\Models\Financial\PaymentGateway;

use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use App\Models\Financial\PeriodicService\DetailFinTrans\PeriodicServiceDetailFinTrans;
use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use App\Models\Financial\TransType\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGateway extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "payment_gateways";
    protected $guarded = [];

    public function purchase_detail_fin_trans()
    {
        return $this->hasMany(PurchaseDetailFinTrans::class, "gateway_id");
    }

    public function exchange_detail_fin_trans()
    {
        return $this->hasMany(ExchangeDetailFinTrans::class, "gateway_id");
    }

    public function periodic_service_detail_fin_trans()
    {
        return $this->hasMany(PeriodicServiceDetailFinTrans::class, "gateway_id");
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, "gateway_id");
    }
}
