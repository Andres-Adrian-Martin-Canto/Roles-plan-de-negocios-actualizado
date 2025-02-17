<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public function estudio():BelongsTo
    {
        return $this->belongsTo(Estudio::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function formularios()
    {
        return $this->hasMany(Formulario::class);
    }
}
