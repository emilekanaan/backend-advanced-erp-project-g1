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
        return $this->hasMany(Employee::class, 'employee_project_role');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'employee_project_role');
    }
}
