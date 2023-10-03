<?php

namespace App\Models\Financial\Experting\DetailFin;

use App\Models\Experting\Experting\Experting;
use App\Models\Financial\Experting\DetailFinTrans\ExpertingDetailFinTrans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpertingDetailFin extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "experting_detailfins";
    protected $guarded = [];

    public function experting()
    {
        return $this->belongsTo(Experting::class, "experting_id");
    }

    public function experting_detail_fin_tran()
    {
        return $this->hasMany(ExpertingDetailFinTrans::class, "detailfin_id");
    }

}
