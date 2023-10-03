<?php

namespace App\Models\Organization\PositionPaySalary;

use App\Models\Organization\OrgPosition\OrgPosition;
use App\Models\Organization\PaySlip\PaySlip;
use App\Models\Organization\SalaryItem\SalaryItemOfYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionPaySalary extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "position_pay_salary";
    protected $guarded = [];

    public function org_position()
    {
        return $this->belongsTo(OrgPosition::class, "position_id");
    }

    public function salaryitemofyear()
    {
        return $this->belongsTo(SalaryItemOfYear::class, "salary_id");
    }

    public function payslip()
    {
        return $this->belongsTo(PaySlip::class, "pay_id");
    }
}
