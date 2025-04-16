<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aulas;
use App\Models\TipoAulas;

class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de la tabla aulas con su tipo de aula relacionado
        $aulas = Aulas::with('tipoAula')->get();

        // Pasar los datos a la vista
        return view('aulas.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los tipos de aula para el formulario
        $tipoAulas = TipoAulas::all();

        // Mostrar la vista del formulario de creación
        return view('aulas.create', compact('tipoAulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'capacidad' => 'required|integer|min:1',
            'estatus' => 'required|boolean',
            'fk_tipo_aulas' => 'required|exists:tipo_aulas,id',
        ]);

        // Crear un nuevo registro en la base de datos
        Aulas::create($request->all());

        // Redirigir a la lista de aulas con un mensaje de éxito
        return redirect()->route('aulas.index')->with('success', 'Aula creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el registro por su ID con su tipo de aula relacionado
        $aula = Aulas::with('tipoAula')->findOrFail($id);

        // Mostrar la vista con los detalles del registro
        return view('aulas.show', compact('aula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el registro por su ID
        $aula = Aulas::findOrFail($id);

        // Obtener todos los tipos de aula para el formulario
        $tipoAulas = TipoAulas::all();

        // Mostrar la vista del formulario de edición
        return view('aulas.edit', compact('aula', 'tipoAulas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'capacidad' => 'required|integer|min:1',
            'estatus' => 'required|boolean',
            'fk_tipo_aulas' => 'required|exists:tipo_aulas,id',
        ]);

        // Obtener el registro por su ID
        $aula = Aulas::findOrFail($id);

        // Actualizar el registro con los nuevos datos
        $aula->update($request->all());

        // Redirigir a la lista de aulas con un mensaje de éxito
        return redirect()->route('aulas.index')->with('success', 'Aula actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Obtener el registro por su ID
        $aula = Aulas::findOrFail($id);

        // Cambiar el estatus a inactivo (eliminación lógica)
        $aula->update(['estatus' => false]);

        // Redirigir a la lista de aulas con un mensaje de éxito
        return redirect()->route('aulas.index')->with('success', 'Aula desactivada correctamente.');
    }

    public function activate($id)
    {
        $aula = Aulas::findOrFail($id);
        $aula->update(['estatus' => true]);

        return redirect()->route('aulas.index')->with('success', 'Aula activada correctamente.');
    }


}
