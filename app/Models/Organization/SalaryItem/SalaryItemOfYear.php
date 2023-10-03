<?php

namespace App\Models\Organization\SalaryItem;

use App\Models\Organization\Organization\Organization;
use App\Models\Organization\PositionPaySalary\PositionPaySalary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryItemOfYear extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "mavarede_hoghooghe_sals";
    protected $guarded = [];

    public function organization()
    {
        return $this->hasMany(Organization::class, "org_id");
    }

    public function position_pay_salaries()
    {
        return $this->hasMany(PositionPaySalary::class, "salary_id");
    }

    public function fiscal_years()
    {
        return $this->hasMany(FiscalYear::class, "salary_item_id");
    }
}
