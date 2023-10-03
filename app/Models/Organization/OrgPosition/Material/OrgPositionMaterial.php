<?php

namespace App\Models\Organization\OrgPosition\Material;

use App\Models\Organization\OrgPosition\OrgPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgPositionMaterial extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "org_position_materials";
    protected $guarded = [];

    public function org_position()
    {
        return $this->belongsTo(OrgPosition::class, "org_position_id");
    }
}
