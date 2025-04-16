<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAulas;
use App\Models\Aulas;


class TipoAulasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla tipo_aulas
        $tipoAulas = TipoAulas::all();

        // Pasar los datos a la vista
        return view('tipo-aulas.index', compact('tipoAulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar la vista del formulario de creación
        return view('tipo-aulas.create');
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
            'valor' => 'required|integer',
            'estatus' => 'required|boolean',
        ]);

        // Crear un nuevo registro en la base de datos
        TipoAulas::create($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('tipo-aulas.index')->with('success', 'Tipo de aula creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el registro por su ID
        $tipoAula = TipoAulas::findOrFail($id);

        // Mostrar la vista con los detalles del registro
        return view('tipo-aulas.show', compact('tipoAula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el registro por su ID
        $tipoAula = TipoAulas::findOrFail($id);

        // Mostrar la vista del formulario de edición
        return view('tipo-aulas.edit', compact('tipoAula'));
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
            'valor' => 'required|integer',
            'estatus' => 'required|boolean',
        ]);

        // Obtener el registro por su ID
        $tipoAula = TipoAulas::findOrFail($id);

        // Actualizar el registro con los nuevos datos
        $tipoAula->update($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('tipo-aulas.index')->with('success', 'Tipo de aula actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener el registro por su ID
        $tipoAula = TipoAulas::findOrFail($id);

        // Cambiar el estatus a inactivo (eliminación lógica)
        $tipoAula->update(['estatus' => false]);

         // Desactivar todas las aulas relacionadas con este tipo de aula
        Aulas::where('fk_tipo_aulas', $id)->update(['estatus' => false]);

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('tipo-aulas.index')->with('success', 'Tipo de aula desactivado correctamente.');
    }

    public function activate($id)
    {
        $tipoAula = TipoAulas::findOrFail($id);
        $tipoAula->update(['estatus' => true]);

        return redirect()->route('tipo-aulas.index')->with('success', 'Tipo de aula activado correctamente.');
    }


}
