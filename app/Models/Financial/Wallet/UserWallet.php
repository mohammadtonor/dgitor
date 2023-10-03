<?php

namespace App\Models\Financial\Wallet;

use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWallet extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_wallets";
    protected $guarded = [];

    public function wallet_trans()
    {
        return $this->hasMany(UserWalletTrans::class, "user_wallet_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
