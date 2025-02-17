<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costosVariablesCincoAniosConservador extends Model
{
    use HasFactory;

    protected $table = 'costos_variables_cinco_anios_conservador';

    protected $fillable = [
        'id',
        'Id_estudio_financiero',
        'Id_costo_variable',
        'anio',
        'monto_conservador'
    ];
}
