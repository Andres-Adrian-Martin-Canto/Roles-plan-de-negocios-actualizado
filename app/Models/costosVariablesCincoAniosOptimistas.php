<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costosVariablesCincoAniosOptimistas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'Id_estudio_financiero',
        'Id_costo_variable',
        'anio',
        'monto_optimista',
    ];
}
