<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pnfs;
use App\Models\UnidadesCurriculares;

class PnfsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla Pnfs
        $Pnfs = Pnfs::all();

        // Pasar los datos a la vista
        return view('pnfs.index', compact('Pnfs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar la vista del formulario de creación
        return view('pnfs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'estatus' => 'required|boolean',
        ]);

        // Crear un nuevo registro en la base de datos
        Pnfs::create($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('pnfs.index')->with('success', 'Tipo de aula creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el registro por su ID
        $Pnfs = Pnfs::findOrFail($id);

        // Mostrar la vista con los detalles del registro
        return view('pnfs.show', compact('Pnfs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el registro por su ID
        $Pnfs = Pnfs::findOrFail($id);

        // Mostrar la vista del formulario de edición
        return view('pnfs.edit', compact('Pnfs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:100',
            'estatus' => 'required|boolean',
        ]);

        // Obtener el registro por su ID
        $Pnfs = Pnfs::findOrFail($id);

        // Actualizar el registro con los nuevos datos
        $Pnfs->update($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('pnfs.index')->with('success', 'Tipo de aula actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener el registro por su ID
        $Pnfs = Pnfs::findOrFail($id);

        // Cambiar el estatus a inactivo (eliminación lógica)
        $Pnfs->update(['estatus' => false]);

         // Desactivar todas las Unidades Curriculares relacionadas con este tipo de aula
         UnidadesCurriculares::where('fk_pnf', $id)->update(['estatus' => false]);

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('pnfs.index')->with('success', 'Tipo de aula desactivado correctamente.');
    }

    public function activate($id)
    {
        $Pnfs = Pnfs::findOrFail($id);
        $Pnfs->update(['estatus' => true]);

        return redirect()->route('pnfs.index')->with('success', 'Tipo de aula activado correctamente.');
    }

}
