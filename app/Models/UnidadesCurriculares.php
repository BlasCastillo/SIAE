<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesCurriculares extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (opcional si sigue la convención)
    protected $table = 'unidades_curriculares';

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'cod_unidad_curricular',
        'estatus',
        'h_academicas',
        'fk_pnf',
        'fk_trayecto',
        'fk_tipo_unidadad_curricular',
    ];

    // Relación con el modelo pnfs
    public function Pnfs()
    {
        return $this->belongsTo(Pnfs::class, 'fk_pnf');

    }

    // Relación con el modelo trayectos
    public function Trayectos()
    {
        return $this->belongsTo(Trayectos::class, 'fk_trayecto');

    }

    // Relación con el modelo TipoAulas
    public function TipoUnidadCurricular()
    {
        return $this->belongsTo(TipoUnidadesCurriculares::class, 'fk_tipo_unidad_curricular');

    }
}
