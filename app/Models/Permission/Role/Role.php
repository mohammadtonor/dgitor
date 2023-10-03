<?php

namespace App\Models\Permission\Role;

use App\Models\Permission\Permission\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "roles";
    protected $guarded = [];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "role_permission", "role_id", "permission_id");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "role_user", "role_id", "user_id");
    }

}
