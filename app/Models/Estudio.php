<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function plan_de_negocio():BelongsTo
    {
        return $this->belongsTo(Plan_de_negocio::class);
    }

    public function conceptos()
    {
        return $this->hasMany(Concepto::class);
    }

    public function conclusion()
    {
        return $this->hasOne(Conclusion::class);
    }

    public function encuestas()
    {
        return $this->hasMany(Poll::class);
    }
}
