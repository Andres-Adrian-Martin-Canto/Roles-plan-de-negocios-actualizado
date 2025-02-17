<?php
// filepath: /c:/xampp/htdocs/Roles-plan-de-negocios-actualizado-moduloAremy/app/Models/Nodo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    public $timestamps = false; 

    protected $fillable = ['puesto', 'codigo', 'foto', 'parent_id', 'organigrama_id'];

    public function organigrama()
    {
        return $this->belongsTo(Organigrama::class);
    }

    public function children()
    {
        return $this->hasMany(Nodo::class, 'parent_id');
    }

    /**
     * Relación con el Nodo padre.
     */
    public function parent()
    {
        return $this->belongsTo(Nodo::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}