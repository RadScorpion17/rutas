<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $table = 'rutas';
    protected $fillable = [
        'itinerario', 
        'ruta_hex', 
        'ruta_gtfs',
        'ruta_dec',
        'sentido',
        'id_origen',
        'id_destino',
        'tamano_ruta',
        'tipo_ruta',
        'estado',
        'ingreso_asu',
        'file'
    ];

}
