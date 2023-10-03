<?php

namespace App\Models\Financial\Exchange\DetailFinTrans;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\Exchange\DetailFin\ExchangeDetailFin;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\TransType\TransType;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeDetailFinTrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "exchange_detailfins_trans";
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
        return $this->hasMany(UserBonTrans::class, "exchange_detailfins_tran_id");
    }

    public function wallets()
    {
        return $this->hasMany(UserWalletTrans::class, "exchange_detailfins_tran_id");
    }

    public function total_fin_trans()
    {
        return $this->hasMany(TotalFinTrans::class, "exchange_detailfins_tran_id");
    }

    public function exchange_detail_fins()
    {
        return $this->belongsTo(ExchangeDetailFin::class, "detailfin_id");
    }
}
