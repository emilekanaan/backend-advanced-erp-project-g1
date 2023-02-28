<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeProjectRole extends Pivot
{
    protected $fillable = [
        "employee_id",
        "project_id",
        "role_id",
        
    ];

    public function employee() {
        return $this->belongsTo(employee::class, "employee_id");
    }

    public function project() {
        return $this->belongsTo(Project::class, "project_id");
    }

    public function role() {
        return $this->belongsTo(Role::class, "role_id");
    }
    
}
