<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=[
        "role"
    ];
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project_role', 'role_id', 'employee_id')->withPivot('project_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project_role', 'role_id', 'project_id')->withPivot('employee_id');
    }
}
