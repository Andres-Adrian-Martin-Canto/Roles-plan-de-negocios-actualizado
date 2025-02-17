<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioContestado extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}
