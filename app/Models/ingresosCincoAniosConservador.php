<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresosCincoAniosConservador extends Model
{
    use HasFactory;

    protected $table = 'ingresos_cinco_anios_conservador';

    protected $fillable = [
        'id',
        'Id_estudio_financiero',
        'Id_ingresos',
        'anio',
        'monto_conservador'
    ];
}
