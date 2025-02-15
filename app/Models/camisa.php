<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camisa extends Model
{
    use HasFactory;
    protected $fillable=['memo','description0','sunrise'];
    protected $table='prueba';
}
