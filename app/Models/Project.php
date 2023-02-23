<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function team(){
        return $this->belongsTo(Team::class);
    }
    protected $fillable=[
        "name",
      
    ];
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project_role', 'project_id', 'employee_id')->withPivot('role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'employee_project_role', 'project_id', 'role_id')->withPivot('employee_id');
    }
}
