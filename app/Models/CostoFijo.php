<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostoFijo extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudio_financiero_id',
        'nombre',
        'valor_unitario',
        'monto_unitario'
    ];

    public function estudioFinanciero()
    {
        return $this->belongsTo(EstudioFinanciero::class);
    }

    public function costos_fijos_anuales()
    {
        return $this->hasMany(CostosFijosAnuales::class, 'Id_costo_fijo');
    }
}
