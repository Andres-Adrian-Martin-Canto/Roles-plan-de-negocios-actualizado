<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $fillable = [
        'estudio_financiero_id',
        'nombre',
        'valor_unitario',
        'monto_unitario',
        'escenario_conservador',
        'escenario_optimista',
        'escenario_pesimista'
    ];

    public function estudioFinanciero()
    {
        return $this->belongsTo(EstudioFinanciero::class);
    }
}
