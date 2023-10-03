<?php

namespace App\Models\Financial\TotalFin;

use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TotalFin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "totalfins";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function total_fin_trans()
    {
        return $this->hasMany(TotalFinTrans::class, "totalfins_id");
    }
}
