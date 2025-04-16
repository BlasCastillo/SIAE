<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (opcional si sigue la convención)
    protected $table = 'aulas';

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'capacidad',
        'estatus',
        'fk_tipo_aulas',
    ];

    // Relación con el modelo TipoAulas
    public function tipoAula()
    {
        return $this->belongsTo(TipoAulas::class, 'fk_tipo_aulas');
    }
}
