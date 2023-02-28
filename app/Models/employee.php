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
        return $this->hasMany(Role::class, 'employee_project_role');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'employee_project_role');
    }
    

    public function Employee_kpi() {
        return $this->hasMany(Employeekpi::class);
    }

}
