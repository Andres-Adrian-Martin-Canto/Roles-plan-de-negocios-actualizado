<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostosFijosAnuales extends Model
{
    use HasFactory;
    protected $fillable = [
        'Id_estudio_financiero',
        'Id_costo_fijo',
        'mes',
        'monto_conservador'
    ];

    public function estudio_financiero()
    {
        return $this->belongsTo(EstudioFinanciero::class);
    }

    public function costo_fijo()
    {
        return $this->belongsTo(CostoFijo::class, 'Id_costo_fijo');
    }

}
