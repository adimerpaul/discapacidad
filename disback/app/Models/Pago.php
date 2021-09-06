<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        "tipodoc",
        "nro",
        "exp",
        "razon",
        "banco",
        "cuenta",
        "nrodocpago",
        "mes",
        "gestion",
        "fechaaprobacion",
        "fechapago",
        "monto",
        "estado",
        "foto",
        'user_id',
        'responsable_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
   

}
