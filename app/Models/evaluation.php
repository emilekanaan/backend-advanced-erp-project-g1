<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    use HasFactory;
    protected $fillable=[
        "evaluation",

        

        
    ];
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_kpi_evaluation')
            ->withPivot('kpi_id')
            ->withTimestamps();
    }

    public function Kpi()
    {
        return $this->belongsTo(Kpi::class, 'employee_kpi_evaluation')
            ->withPivot('employee_id')
            ->withTimestamps();
    }
}
