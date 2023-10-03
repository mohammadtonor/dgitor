<?php

namespace App\Models\Organization\Organization\Dept;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgDeptRelation extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "relations";
    protected $guarded = [];

    public function orgdept1()
    {
        return $this->belongsTo(OrgDept::class, "org_dept1_id");
    }

    public function orgdept2()
    {
        return $this->belongsTo(OrgDept::class, "org_dept2_id");
    }
}
