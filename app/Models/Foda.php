<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foda extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function plan_de_negocio():BelongsTo
    {
        return $this->belongsTo(Plan_de_negocio::class);
    }
}
