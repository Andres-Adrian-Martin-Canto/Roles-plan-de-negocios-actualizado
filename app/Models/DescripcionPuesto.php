<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescripcionPuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_de_negocio_id',
        'nivel',
        'codigo',
        'unidad_administrativa',
        'nombre_puesto',
        'otros_nombres_puestos',
        'numero_plaza',
        'jornada_laboral',
        'otros_jornada_laboral',
        'salario_minimo',
        'salario_maximo',
        'puesto_superior',
        'puesto_subordinado',
        'comunicacion_interna',
        'comunicacion_externa',
        'objetivos_puesto',
        'descripcion_generica',
        'descripcion_especifica',
        'forma_pago',
        'estado_civil',
        'edad',
        'nacionalidad',
        'sexo',
        'estatura',
        'antecedentes',
        'experiencia',
        'habilidades_fisicas',
        'habilidades_mentales',
    ];
    public function sueldomensual()
    {
        return $this->hasOne(Proyeccion::class, 'descripcion_de_puesto_id');
    }
}
