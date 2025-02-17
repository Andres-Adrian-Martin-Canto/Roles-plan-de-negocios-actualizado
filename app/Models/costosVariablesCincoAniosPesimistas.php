<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costosVariablesCincoAniosPesimistas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Id_estudio_financiero',
        'Id_costo_variable',
        'anio',
        'monto_pesimista',
    ];
}
