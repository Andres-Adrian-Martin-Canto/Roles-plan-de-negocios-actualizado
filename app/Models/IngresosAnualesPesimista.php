<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresosAnualesPesimista extends Model
{

    // protected $table = 'ingresos_anuales_pesimistas';
    use HasFactory;

    protected $fillable = [
        'Id_estudio_financiero',
        'Id_ingresos',
        'mes',
        'monto_pesimista'
    ];

    public function estudio_financiero()
    {
        return $this->belongsTo(EstudioFinanciero::class, 'Id_estudio_financiero');
    }

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'Id_ingresos');
    }
}
