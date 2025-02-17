<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }

    public function respuestas()
    {
        return $this->hasMany(FormularioContestado::class);
    }
}
