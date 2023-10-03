<?php

namespace App\Models\Exchange\Exchange\Status;

use App\Models\Exchange\Exchange\Exchange\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeStatus extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "exchange_statuses";
    protected $guarded = [];

    public function exchanges()
    {
        return $this->hasMany(Exchange::class, "status_id");
    }
}
