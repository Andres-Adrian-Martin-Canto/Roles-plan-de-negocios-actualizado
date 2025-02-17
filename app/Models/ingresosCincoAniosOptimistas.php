<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresosCincoAniosOptimistas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Id_estudio_financiero',
        'Id_ingresos',
        'anio',
        'monto_optimista',
    ];
}
