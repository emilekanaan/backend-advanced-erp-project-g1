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
        return $this->hasMany(Employee::class, 'employee_project_role');
    }

    public function role() {
        return $this->hasMany(Role::class, "employee_project_role");
    }
}
