<?php

namespace App\Models\Organization\Organization;

use App\Models\Organization\Holding\Holding;
use App\Models\Organization\Organization\Dept\OrgDept;
use App\Models\Organization\SalaryItem\SalaryItemOfYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "organizations";
    protected $guarded = [];

    public function holding()
    {
        return $this->belongsTo(Holding::class, "holding_id");
    }

    public function salaryitemofyears()
    {
        return $this->hasMany(SalaryItemOfYear::class, "org_id");
    }

    public function depts()
    {
        return $this->hasMany(OrgDept::class, "org_id");
    }
}
