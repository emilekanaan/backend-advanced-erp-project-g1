<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeKpi extends Pivot
{
    protected $fillable=[
        "evaluation",
        "date",
       'employee_id',
       'kpi_id',
        
    ];
    public function employee()
    {
        return $this->belongsTo(employee::class, 'employee_id');
    }
    public function kpi()
    {
        return $this->belongsTo(kpi::class, 'kpi_id');
    }
}
