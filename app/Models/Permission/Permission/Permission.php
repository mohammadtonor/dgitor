<?php

namespace App\Models\Permission\Permission;

use App\Models\Organization\OrgPosition\OrgPosition;
use App\Models\Permission\Role\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "permissions";
    protected $guarded = [];

    public function vippermissions()
    {
        return $this->belongsToMany(User::class, 'vip_permission', 'permission_id', 'user_id')->withTimestamps();
    }

    public function blockpermissions()
    {
        return $this->belongsToMany(User::class, 'block_permission', 'permission_id', 'user_id')->withTimestamps();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_permission", "permission_id", "role_id");
    }

    public function org_positions()
    {
        return $this->belongsToMany(OrgPosition::class, "permission_position", "permission_id", "position_id");
    }


}
