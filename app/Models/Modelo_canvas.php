<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo_canvas extends Model
{
    use HasFactory;
    protected $table = 'modelo_canvas';

    protected $guarded = [];

    public function plan_de_negocio():BelongsTo
    {
        return $this->belongsTo(Plan_de_negocio::class);
    }
}
