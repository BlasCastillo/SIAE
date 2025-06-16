<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnfs extends Model
{
    use HasFactory;

    protected $table = 'pnfs';

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'estatus', 'fk_sede'];

    // 🔥 Relación con Sedes
    public function sede()
    {
        return $this->belongsTo(Sedes::class, 'fk_sede');
    }

    // 🔥 Método para desactivar un PNF
    public function desactivar()
    {
        $this->update(['estatus' => '0']);
    }

    // 🔥 Método para activar un PNF
    public function activar()
    {
        $this->update(['estatus' => '1']);
    }
}
