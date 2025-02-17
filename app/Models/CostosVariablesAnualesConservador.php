<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostosVariablesAnualesConservador extends Model
{

    use HasFactory;
    protected $table = 'costos_variables_anuales_conservador';

    protected $fillable = [
        'Id_estudio_financiero',
        'Id_costo_variable',
        'mes',
        'monto_conservador'
    ];

    public function estudio_financiero()
    {
        return $this->belongsTo(EstudioFinanciero::class, 'Id_estudio_financiero');
    }

    public function costo_variable()
    {
        return $this->belongsTo(CostosVariable::class, 'Id_costo_variable');
    }
}
