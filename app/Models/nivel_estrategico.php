<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nivel_estrategico extends Model
{
    use HasFactory;
    protected $fillable=['dato','description','sunrise'];
    protected $table='nivelesEstrategico';
}
