<?php

namespace App\Models\Financial\PeriodicService\DetailFinTrans;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\PeriodicService\DetailFin\PeriodicServiceDetailFin;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\TransType\TransType;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicServiceDetailFinTrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "periodic_service_detailfins_trans";
    protected $guarded = [];

    public function payment_gateway()
    {
        return $this->belongsTo(PaymentGateway::class, "gateway_id");
    }

    public function trans_type()
    {
        return $this->belongsTo(TransType::class, "transtype_id");
    }

    public function bons()
    {
        return $this->hasMany(UserBonTrans::class, "periodic_service_detailfins_tran_id");
    }

    public function wallets()
    {
        return $this->hasMany(UserWalletTrans::class, "periodic_service_detailfins_tran_id");
    }

    public function total_fin_trans()
    {
        return $this->hasMany(TotalFinTrans::class, "periodic_service_detailfins_tran_id");
    }

    public function periodic_service_detail_fins()
    {
        return $this->belongsTo(PeriodicServiceDetailFin::class, "detailfin_id");
    }
}
