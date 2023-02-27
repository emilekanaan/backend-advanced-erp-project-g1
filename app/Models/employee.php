<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $fillable=[
        "first_name",
        "last_name",
        "email",
        "phone_num",
        "picture"
    ];

    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function roles()
    {
        return $this->belongTo(Role::class, 'employee_project_role', 'employee_id', 'role_id')->withPivot('project_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project_role', 'employee_id', 'project_id')->withPivot('role_id');
    }
    
    public function Employee_kpi() {
        return $this->hasMany(Employeekpi::class);
    }
}
