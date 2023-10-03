<?php

namespace App\Models\PeriodicService\Archive;

use App\Models\PeriodicService\PeriodicService\PeriodicService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodicServiceArchive extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "periodic_service_archives";
    protected $guarded = [];

    public function periodic_service()
    {
        return $this->belongsTo(PeriodicService::class, "periodic_service_id");
    }
}
