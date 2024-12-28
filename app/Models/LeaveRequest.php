<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function natureOfLeave()
    {
        return $this->belongsTo(NatureOfLeave::class,'nature_of_leave_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function adminRole()
    {
        return $this->belongsTo(AdminRole::class, 'admin_id');
    }

}
