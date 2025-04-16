<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAulas extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (opcional si sigue la convención)
    protected $table = 'tipo_aulas';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'valor',
        'estatus',
    ];

    // Campos que deben ser tratados como fechas (opcional)
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Casts para transformar tipos de datos (opcional)
    protected $casts = [
        'estatus' => 'boolean',
    ];
}
