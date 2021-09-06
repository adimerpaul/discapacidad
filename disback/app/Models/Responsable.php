<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;  
      protected $fillable = [
        'ci',
        'nombre',
        'relacion'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
