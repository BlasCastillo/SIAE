<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pnfs;
use App\Models\Sedes;

class PnfsController extends Controller
{
    public function index(Request $request)
    {
        $mostrarInactivas = $request->query('ver_inactivas', false);
        $pnfs = $mostrarInactivas
            ? Pnfs::orderBy('codigo', 'asc')->with('sede')->get()
            : Pnfs::where('estatus', '1')->orderBy('codigo', 'asc')->with('sede')->get();
        return view('pnfs.index', compact('pnfs', 'mostrarInactivas'));
    }

    public function create()
    {
        $sedes = Sedes::orderBy('nombre')->get(); // 🔥 Obtener todas las sedes para el formulario
        return view('pnfs.create', compact('sedes'));
    }

   public function store(Request $request)
{
    $request->validate([
        'codigo' => 'required|string|size:2',
        'nombre' => 'required|string|max:100',
        'descripcion' => 'required|string|max:100',
        'fk_sede' => 'required|exists:sedes,id',
    ]);

    Pnfs::create([
        'codigo' => strtoupper($request->codigo),
        'nombre' => strtoupper($request->nombre),
        'descripcion' => strtoupper($request->descripcion),
        'fk_sede' => $request->fk_sede,
        'estatus' => '1', // 🔥 Se asigna automáticamente como activo
    ]);

    return redirect()->route('pnfs.index')->with('success', 'PNF creado correctamente');
}


    public function edit(Pnfs $pnf)
    {
        $sedes = Sedes::orderBy('nombre')->get(); // 🔥 Obtener sedes para edición
        return view('pnfs.edit', compact('pnf', 'sedes'));
    }

    public function update(Request $request, Pnfs $pnf)
    {
        $request->validate([
            'codigo' => "required|string|size:2",
            'nombre' => "required|string|max:100",
            'descripcion' => 'required|string|max:100',
            'fk_sede' => 'required|exists:sedes,id',
            'estatus' => 'required|in:0,1',
        ]);

        // Verificar unicidad en la combinación
        if (Pnfs::where('codigo', $request->codigo)
                ->where('nombre', $request->nombre)
                ->where('fk_sede', $request->fk_sede)
                ->where('id', '!=', $pnf->id) // 🔥 Excluir el actual para actualización
                ->exists()) {
            return back()->withErrors(['error' => 'Ya existe un PNF con este código, nombre y sede.']);
        }

        $pnf->update([
            'codigo' => strtoupper($request->codigo),
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
            'fk_sede' => $request->fk_sede,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('pnfs.index')->with('success', 'PNF actualizado correctamente');
    }

    public function destroy(Pnfs $pnf)
    {
        $pnf->desactivar(); // 🔥 Eliminación lógica
        return redirect()->route('pnfs.index')->with('success', 'PNF inactivado correctamente');
    }
}
