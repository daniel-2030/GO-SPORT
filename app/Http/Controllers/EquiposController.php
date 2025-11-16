<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquiposController extends Controller
{
    /**
     * Mostrar listado de equipos
     */
    public function index()
    {
        $equipos = Equipos::orderBy('nombre_equipo')->paginate(10);
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Guardar nuevo equipo
     */
public function store(Request $request)
{
    $request->validate([
        'nombre_equipo' => 'required|string|max:255',
        'categoria' => 'nullable|string|max:100',
        'estado' => 'required|in:Activo,Inactivo',
        'fundacion' => 'nullable|date',
        'escudo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación para imagen
    ]);

    $data = $request->only(['nombre_equipo', 'categoria', 'estado', 'fundacion']);

    // Si se subió una imagen
    if ($request->hasFile('escudo')) {
        $path = $request->file('escudo')->store('escudos', 'public');
        $data['escudo_url'] = $path;
    }

    Equipos::create($data);

    return redirect()->route('equipos.index')->with('success', 'Equipo creado correctamente.');
}


    /**
     * Mostrar detalle de un equipo
     */
    public function show($id)
    {
        $equipo = Equipos::findOrFail($id);
        return view('equipos.show', compact('equipo'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        $equipo = Equipos::findOrFail($id);
        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Actualizar equipo
     */
    public function update(Request $request, $id)
    {
        $equipo = Equipos::findOrFail($id);

        $request->validate([
            'nombre_equipo' => 'required|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'fundacion' => 'nullable|date',
            'escudo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'nullable|string|max:100',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $data = $request->except('escudo');

        // Subir nuevo escudo si existe
        if ($request->hasFile('escudo')) {
            // Eliminar escudo anterior si existe
            if ($equipo->escudo_url) {
                Storage::disk('public')->delete($equipo->escudo_url);
            }
            $path = $request->file('escudo')->store('escudos', 'public');
            $data['escudo_url'] = $path;
        }

        $equipo->update($data);

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo actualizado exitosamente.');
    }

    /**
     * Eliminar equipo
     */
    public function destroy($id)
    {
        $equipo = Equipos::findOrFail($id);

        // Eliminar escudo si existe
        if ($equipo->escudo_url) {
            Storage::disk('public')->delete($equipo->escudo_url);
        }

        $equipo->delete();

        return redirect()->route('equipos.index')
            ->with('success', 'Equipo eliminado exitosamente.');
    }
}