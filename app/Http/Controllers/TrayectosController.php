<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trayectos;
use App\Models\UnidadesCurriculares;

class TrayectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla tipo_aulas
        $trayectos = Trayectos::all();

        // Pasar los datos a la vista
        return view('trayectos.index', compact('trayectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar la vista del formulario de creación
        return view('trayectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:100',
            'estatus' => 'required|boolean',
        ]);

        // Crear un nuevo registro en la base de datos
        Trayectos::create($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('trayectos.index')->with('success', 'Tipo de aula creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el registro por su ID
        $trayectos = Trayectos::findOrFail($id);

        // Mostrar la vista con los detalles del registro
        return view('trayectos.show', compact('trayectos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el registro por su ID
        $trayectos = Trayectos::findOrFail($id);

        // Mostrar la vista del formulario de edición
        return view('trayectos.edit', compact('trayectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:100',
            'estatus' => 'required|boolean',
        ]);

        // Obtener el registro por su ID
        $trayectos = Trayectos::findOrFail($id);

        // Actualizar el registro con los nuevos datos
        $trayectos->update($request->all());

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('trayectos.index')->with('success', 'Tipo de aula actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener el registro por su ID
        $trayectos = Trayectos::findOrFail($id);

        // Cambiar el estatus a inactivo (eliminación lógica)
        $trayectos->update(['estatus' => false]);

         // Desactivar todas las aulas relacionadas con este tipo de aula
        UnidadesCurriculares::where('fk_trayectos', $id)->update(['estatus' => false]);

        // Redirigir a la lista de tipos de aulas con un mensaje de éxito
        return redirect()->route('trayectos.index')->with('success', 'Tipo de aula desactivado correctamente.');
    }

    public function activate($id)
    {
        $trayectos = Trayectos::findOrFail($id);
        $trayectos->update(['estatus' => true]);

        return redirect()->route('trayectos.index')->with('success', 'Tipo de aula activado correctamente.');
    }


}
