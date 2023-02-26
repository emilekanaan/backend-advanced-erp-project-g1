<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kpi extends Model
{
    use HasFactory;
    protected $fillable= [
        "name",

    ];
    
    public function employees() {
        return $this->belongsToMany(Employee::class, "employee_kpi_evaluation")
            ->withPivot("evaluation_id")
            ->withTimestamps();
    }

    public function evaluations() {
        return $this->belongsToMany(Evaluation::class, "evaluation_kpi_evaluation")
            ->withPivot("employee_id")
            ->withTimestamps();
    }

}
