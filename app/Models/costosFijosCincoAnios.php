<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costosFijosCincoAnios extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',  
        'Id_estudio_financiero',
        'Id_costo_fijo',
        'anio',
        'monto_conservador',
    ];
}
