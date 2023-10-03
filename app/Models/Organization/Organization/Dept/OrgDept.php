<?php

namespace App\Models\Organization\Organization\Dept;

use App\Models\Organization\Organization\Organization;
use App\Models\Organization\OrgPosition\OrgPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgDept extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "org_depts";
    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class, "org_id");
    }

    public function org_positions()
    {
        return $this->hasMany(OrgPosition::class, "org_dept_id");
    }

    public function relations1()
    {
        return $this->hasMany(OrgDeptRelation::class, "org_dept1_id");
    }

    public function relations2()
    {
        return $this->hasMany(OrgDeptRelation::class, "org_dept2_id");
    }


}
