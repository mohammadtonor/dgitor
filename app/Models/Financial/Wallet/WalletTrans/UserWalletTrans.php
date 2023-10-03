<?php

namespace App\Models\Financial\Wallet\WalletTrans;

use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use App\Models\Financial\PeriodicService\DetailFinTrans\PeriodicServiceDetailFinTrans;
use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use App\Models\Financial\Wallet\UserWallet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWalletTrans extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_wallet_trans";
    protected $guarded = [];

    public function purchase_detail_fin_trans()
    {
        return $this->belongsTo(PurchaseDetailFinTrans::class, "purchase_detailfins_tran_id");
    }

    public function exchange_detail_fin_trans()
    {
        return $this->belongsTo(ExchangeDetailFinTrans::class, "exchange_detailfins_tran_id");
    }

    public function periodic_service_detail_fin_trans()
    {
        return $this->belongsTo(PeriodicServiceDetailFinTrans::class, "periodic_service_detailfins_tran_id");
    }

    public function user_wallet()
    {
        return $this->belongsTo(UserWallet::class, "user_wallet_id");
    }
}
