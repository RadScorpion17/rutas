<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'descripcion',
        'horario_salida',
        'intervalo',
        'tipo',
        'linea',
        'estado'
    ];
}
