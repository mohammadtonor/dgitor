<?php

namespace App\Models\Organization\OrgPosition;

use App\Models\Organization\Organization\Dept\OrgDept;
use App\Models\Organization\OrgPosition\Material\OrgPositionMaterial;
use App\Models\Organization\OrgPosition\PositionUserArchive\PositionUserArchive;
use App\Models\Organization\PositionPaySalary\PositionPaySalary;
use App\Models\Permission\Permission\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgPosition extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "org_positions";
    protected $guarded = [];

    public function position_pay_salaries()
    {
        return $this->hasMany(PositionPaySalary::class, "position_id");
    }

    public function org_dept()
    {
        return $this->belongsTo(OrgDept::class, "org_dept_id");
    }

    public function position_user_archives()
    {
        return $this->hasMany(PositionUserArchive::class, "position_id");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "position_user", "position_id", "user_id");
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "permission_position", "position_id", "permission_id");
    }

    public function materials()
    {
        return $this->hasMany(OrgPositionMaterial::class, "org_position_id");
    }
    public function childrens()
    {
        return $this->hasMany(OrgPosition::class, 'org_position_id');
    }

    public function parent()
    {
        return $this->belongsTo(OrgPosition::class, 'org_position_id');
    }
}
