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
    
    public function Employee_kpi() {
        return $this->hasMany(Employeekpi::class);
    }

}
