<?php

namespace App\Models\Organization\PaySlip;

use App\Models\Organization\PositionPaySalary\PositionPaySalary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaySlip extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "pay_slips";
    protected $guarded = [];

    public function position_pay_salaries()
    {
        return $this->hasMany(PositionPaySalary::class, "pay_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
