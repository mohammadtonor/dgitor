<?php

namespace App\Models\Organization\OrgPosition\PositionUserArchive;

use App\Models\Organization\OrgPosition\OrgPosition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionUserArchive extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "position_user_archives";
    protected $guarded = [];

    public function org_position()
    {
        return $this->belongsTo(OrgPosition::class, "position_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
