<?php

namespace App\Models\Financial\Purchase\DetailFinTrans;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\Purchase\DetailFin\PurchaseDetailFin;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\TransType\TransType;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetailFinTrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "purchase_detailfins_trans";
    protected $guarded = [];

    public function purchase_detail_fins()
    {
        return $this->belongsTo(PurchaseDetailFin::class, "detailfin_id");
    }

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
        return $this->hasMany(UserBonTrans::class, "purchase_detailfins_tran_id");
    }

    public function wallets()
    {
        return $this->hasMany(UserWalletTrans::class, "purchase_detailfins_tran_id");
    }

    public function total_fin_trans()
    {
        return $this->hasMany(TotalFinTrans::class, "purchase_detailfins_tran_id");
    }
}
