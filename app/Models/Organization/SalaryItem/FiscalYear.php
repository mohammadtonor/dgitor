<?php

namespace App\Models\Organization\SalaryItem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FiscalYear extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "fiscal_years";
    protected $guarded = [];

    public function salary_item_of_year()
    {
        return $this->belongsTo(SalaryItemOfYear::class, "salary_item_id");
    }
}
