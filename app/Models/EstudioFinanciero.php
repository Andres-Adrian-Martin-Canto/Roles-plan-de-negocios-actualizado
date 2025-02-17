<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudioFinanciero extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_de_negocio_id',
        'total_costo_fijo',
        'total_costo_variable',
        'total_ingresos'
    ];

    public function planDeNegocios()
    {
        return $this->belongsTo(Plan_de_negocio::class);
    }
    // TODO: Relaciones mensuales.
    public function costosFijos()
    {
        return $this->hasMany(CostoFijo::class);
    }

    public function costosVariables()
    {
        return $this->hasMany(CostosVariable::class);
    }

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
    // TODO: Relaciones Conservador.
    // Costos Fijos Anuales Conservador
    public function costos_fijos_anuales()
    {
        return $this->hasMany(CostosFijosAnuales::class, 'Id_estudio_financiero');
    }
    // Costos variables anuales conservador
    public function costos_variables_anuales()
    {
        return $this->hasMany(CostosVariablesAnualesConservador::class, 'Id_estudio_financiero');
    }
    // Ingreso anuales conservador
    public function ingresos_anuales()  {
        return $this->hasMany(IngresosAnualesConservador::class, 'Id_estudio_financiero');
    }

    // TODO: Relaciones Pesimistas
    // * Costos Variables Pesimistas
    public function variables_pesimistas(){
        return $this->hasMany(CostosVariablesAnualesPesimista::class, 'Id_estudio_financiero');
    }

    // * Ingresos Pesimistas
    public function ingresos_pesimistas(){
        return $this->hasMany(IngresosAnualesPesimista::class, 'Id_estudio_financiero');
    }
    // TODO: Relaciones Optimista
    // * Variables Optimista
    public function variables_optimista(){
        return $this->hasMany(CostosVariablesAnualesOptimista::class,'Id_estudio_financiero');
    }
    // * Ingresos Optimista
    public function ingresos_optimista(){
        return $this->hasMany(IngresosAnualesOptimista::class,'Id_estudio_financiero');
    }

    /**
     * TODO: Proyecciones cinco años.
     *
     * * Relación de cinco años pesimista ingresos
     */
    public function ingresos_pesimista_cincoAnios(){
        return $this->hasMany(ingresosCincoAniosPesimista::class,'Id_estudio_financiero');
    }

    // * Relación de cinco años fijos
    public function fijos_cincoAnios(){
        return $this->hasMany(costosFijosCincoAnios::class, 'Id_estudio_financiero');
    }

    // * Relación de cinco años variables pesimista
    public function variables_pesimista_cincoAnios(){
        return $this->hasMany(costosVariablesCincoAniosPesimistas::class, 'Id_estudio_financiero');
    }

    // * Relación de cinco años variables conservador
    public function variables_conservador_cincoAnios() {
        return $this->hasMany(costosVariablesCincoAniosConservador::class, 'Id_estudio_financiero');
    }

    // * Relación de cinco años ingresos conservador
    public function ingresos_conservador_CincoAnios() {
        return $this->hasMany(ingresosCincoAniosConservador::class, 'Id_estudio_financiero');
    }

    // * Relación de cinco años variables Optimista
    public function variables_optimistas_CincoAnios(){
        return $this->hasMany(costosVariablesCincoAniosOptimistas::class,'Id_estudio_financiero');
    }

    // * Relación de cinco años ingresos Optimista
    public function ingresos_optimistas_CincoAnios(){
        return $this->hasMany(ingresosCincoAniosOptimistas::class,'Id_estudio_financiero');
    }
}
