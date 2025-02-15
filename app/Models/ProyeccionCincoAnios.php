<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyeccionCincoAnios extends Model
{
    use HasFactory;
    protected $table = 'proyeccion_cinco_anos';

   
    protected $fillable = [
        'proyección_de_sueldos',
        'anio',
        'sueldo_total_anual'
    ];
}
