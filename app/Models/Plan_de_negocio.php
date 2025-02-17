<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plan_de_negocio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fodas():HasMany
    {
        return $this->hasMany(Foda::class);
    }

    public function modelos_canvas():HasMany
    {
        return $this->hasMany(Modelo_canvas::class);
    }

    public function productos():HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function generalidades():HasOne
    {
        return $this->hasOne(Generalidades::class);
    }

    public function estructura_legal():HasOne
    {
        return $this->hasOne(Estructura_legal::class);
    }

    public function cultura_organizacional():HasOne
    {
        return $this->hasOne(Cultura_organizacional::class);
    }

    public function imagenes_corporativas():HasOne
    {
        return $this->hasOne(Imagen_corporativa::class);
    }

    public function publicidades():HasOne
    {
        return $this->hasOne(Publicidad::class);
    }

    public function estudios():HasMany
    {
        return $this->hasMany(Estudio::class);
    }

    public function estudioFinanciero()
    {
        return $this->hasOne(EstudioFinanciero::class)->select('id');
    }
    public function organigramas()
    {
        return $this->hasMany(Organigrama::class);
    }
    public function descripcionpuesto()
    {
        return $this->hasMany(DescripcionPuesto::class);
    }
    public function proyecciondesueldomensual()
    {
        return $this->hasMany(Proyeccion::class);
    }
    
}
