<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostosVariablesAnualesOptimista extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_estudio_financiero',
        'Id_costo_variable',
        'mes',
        'monto_optimista'
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
