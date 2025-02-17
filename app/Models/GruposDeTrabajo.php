<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class GruposDeTrabajo extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $attributes = [
        'integrantes' => [],
    ];
    protected $table = 'grupos_de_trabajos';

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
