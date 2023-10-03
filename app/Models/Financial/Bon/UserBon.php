<?php

namespace App\Models\Financial\Bon;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBon extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "user_bons";
    protected $guarded = [];

    public function bon_trans()
    {
        return $this->hasMany(UserBonTrans::class, "user_bon_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
