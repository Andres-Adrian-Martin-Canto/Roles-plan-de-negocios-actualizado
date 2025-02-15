<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proyecciondesueldoanual extends Model
{
    use HasFactory;
      // Especifica 
      protected $table = 'sueldo_anual';

   
      protected $fillable = [
          'proyección_de_sueldos',
          'mes',
          'sueldo_total_por_mes'
      ];
}
