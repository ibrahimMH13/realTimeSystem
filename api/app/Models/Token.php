<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
     protected $fillable = [
        'app_id',
        'key',
        'secret',
    ];
}
