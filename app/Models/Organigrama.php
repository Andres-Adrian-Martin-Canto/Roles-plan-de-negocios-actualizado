<?php
// filepath: /c:/xampp/htdocs/Roles-plan-de-negocios-actualizado-moduloAremy/app/Models/Organigrama.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organigrama extends Model
{

    protected $table = 'organigramas';

    use HasFactory;

    protected $fillable = ['plan_de_negocio_id', 'nombre'];

    public function nodos()
    {
        return $this->hasMany(Nodo::class);
    }

    public function plan_de_negocio()
{
    return $this->belongsTo(Plan_de_negocio::class);
}
}
