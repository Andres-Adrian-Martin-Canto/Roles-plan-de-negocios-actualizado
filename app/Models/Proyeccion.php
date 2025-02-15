<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    use HasFactory;

    // Especifica 
    protected $table = 'proyeccion_de_sueldo';

   
    protected $fillable = [
        'plan_de_negocio_id',
        'descripcion_de_puesto_id',
        'sueldo',
        'total'
    ];
    public function proyecciondesueldoanual()  {
        return $this->hasMany(proyecciondesueldoanual::class,'proyección_de_sueldos');
    }
    public function pertenecedescripcionpuesto(){
        return $this->belongsTo(DescripcionPuesto::class,'descripcion_de_puesto_id');
    }
    public function proyeccionCincoAnios(){
        return $this->hasMany(ProyeccionCincoAnios::class,'proyección_de_sueldos');
    }
}
