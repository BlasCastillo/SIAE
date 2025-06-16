<?php

namespace App\Http\Controllers;

use App\Models\UnidadCurricular;
use App\Models\Pnfs;
use App\Models\Trayectos;
use App\Models\Duracion;
use Illuminate\Http\Request;

class UnidadCurricularController extends Controller
{
    public function index(Request $request)
    {
        $mostrarInactivas = $request->query('ver_inactivas', false);
        $filterPnf = $request->query('filter_pnf');
        $filterTrayecto = $request->query('filter_trayecto');

        $pnfs = Pnfs::all();
        $trayectos = $filterPnf
            ? Trayectos::where('fk_pnf', $filterPnf)->get()
            : Trayectos::all();

        $unidadCurricular = UnidadCurricular::with(['pnf', 'trayecto', 'duracionRelacion'])
            ->when(!$mostrarInactivas, function ($query) {
                $query->where('estatus', '1');
            })
            ->when($filterPnf, function ($query, $filterPnf) {
                $query->where('fk_pnf', $filterPnf);
            })
            ->when($filterTrayecto, function ($query, $filterTrayecto) {
                $query->where('fk_trayecto', $filterTrayecto);
            })
            ->get();

        return view('unidad_curricular.index', compact('unidadCurricular', 'mostrarInactivas', 'pnfs', 'trayectos', 'filterPnf'));
    }

    public function create()
    {
        $pnfs = Pnfs::where('estatus', '1')->get();
        $trayectos = Trayectos::where('estatus', '1')->get();
        $duraciones = Duracion::where('estatus', '1')->get();
        return view('unidad_curricular.create', compact('pnfs', 'trayectos', 'duraciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|min:3|max:5|unique:unidad_curricular,codigo',
            'nombre' => "required|string|max:100|unique:unidad_curricular,nombre,NULL,id,fk_pnf,{$request->fk_pnf},fk_trayecto,{$request->fk_trayecto}",
            'descripcion' => 'required|string|max:100',
            'horas_academicas' => 'required|integer', // Cambio: validar como entero
            'fk_pnf' => 'required|exists:pnfs,id',
            'fk_trayecto' => 'required|exists:trayectos,id',
            'fk_duracion' => 'required|exists:duraciones,id',
        ]);

        UnidadCurricular::create([
            'codigo' => strtoupper($request->codigo),
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
            'horas_academicas' => $request->horas_academicas, // Cambio
            'estatus' => '1',
            'fk_pnf' => $request->fk_pnf,
            'fk_trayecto' => $request->fk_trayecto,
            'fk_duracion' => $request->fk_duracion,
        ]);

        return redirect()->route('unidad_curricular.index')->with('success', 'Unidad Curricular creada correctamente');
    }

    public function edit(UnidadCurricular $unidadCurricular)
    {
        $pnfs = Pnfs::where('estatus', '1')->get();
        $trayectos = Trayectos::where('estatus', '1')->get();
        $duraciones = Duracion::where('estatus', '1')->get();
        return view('unidad_curricular.edit', compact('unidadCurricular', 'pnfs', 'trayectos', 'duraciones'));
    }

    public function update(Request $request, UnidadCurricular $unidadCurricular)
    {
        $request->validate([
            'codigo' => "required|string|min:3|max:5|unique:unidad_curricular,codigo,{$unidadCurricular->id}",
            'nombre' => "required|string|max:100|unique:unidad_curricular,nombre,{$unidadCurricular->id},id,fk_pnf,{$request->fk_pnf},fk_trayecto,{$request->fk_trayecto}",
            'descripcion' => 'required|string|max:100',
            'horas_academicas' => 'required|integer', // Cambio: validar como entero
            'estatus' => 'required|in:0,1',
            'fk_pnf' => 'required|exists:pnfs,id',
            'fk_trayecto' => 'required|exists:trayectos,id',
            'fk_duracion' => 'required|exists:duraciones,id',
        ]);

        $unidadCurricular->update([
            'codigo' => strtoupper($request->codigo),
            'nombre' => strtoupper($request->nombre),
            'descripcion' => strtoupper($request->descripcion),
            'horas_academicas' => $request->horas_academicas, // Cambio
            'estatus' => $request->estatus,
            'fk_pnf' => $request->fk_pnf,
            'fk_trayecto' => $request->fk_trayecto,
            'fk_duracion' => $request->fk_duracion,
        ]);

        return redirect()->route('unidad_curricular.index')->with('success', 'Unidad Curricular actualizada correctamente');
    }

    public function destroy(UnidadCurricular $unidadCurricular)
    {
        $unidadCurricular->desactivar();
        return redirect()->route('unidad_curricular.index')->with('success', 'Unidad Curricular inactivada correctamente');
    }

    public function getTrayectosPorPnf($pnfId)
    {
        $trayectos = Trayectos::where('fk_pnf', $pnfId)->get();
        return response()->json($trayectos);
    }

    public function getUnidadesPorTrayecto($pnfId, $trayectoId)
{
    $unidades = UnidadCurricular::where('fk_pnf', $pnfId)
        ->where('fk_trayecto', $trayectoId)
        ->where('estatus', '1') // Solo unidades activas
        ->get();

    return response()->json($unidades);
}

}