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
        return $this->belongTo(Team::class);
    }
}
