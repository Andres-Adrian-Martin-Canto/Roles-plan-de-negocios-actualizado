<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagen_corporativa extends Model
{
    use HasFactory;
    protected $table = 'imagenes_corporativas';
    protected $guarded = [];

    public function plan_de_negocio():BelongsTo
    {
        return $this->belongsTo(Plan_de_negocio::class);
    }
}
