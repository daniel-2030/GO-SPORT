<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use App\Models\Temporada;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    public function index()
    {
        $ligas = Liga::with('temporada')->paginate(6);
        return view('ligas.index', compact('ligas'));
    }

    public function show($id)
    {
        $liga = Liga::with(['temporada', 'partidos.local', 'partidos.visitante', 'tablaPosiciones.equipo'])
            ->findOrFail($id);

        return view('ligas.show', compact('liga'));
    }

    // =================== CRUD ===================

    
    public function manage()
    {
        $ligas = Liga::all(); // 👈 usa el modelo correcto
        return view('ligas.manage', compact('ligas'));
    }


    public function create()
    {
        $temporadas = Temporada::all();
        return view('ligas.create', compact('temporadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:ligas,nombre|string|max:255',
            'descripcion' => 'nullable|string',
            'id_temporada' => 'required|exists:temporadas,id_temporada',
        ]);

        Liga::create($request->all());

        return redirect()->route('ligas.index')->with('success', 'Liga creada correctamente.');
    }

    public function edit($id)
    {
        $liga = Liga::findOrFail($id);
        $temporadas = Temporada::all();
        return view('ligas.edit', compact('liga', 'temporadas'));
    }

    public function update(Request $request, $id)
    {
        $liga = Liga::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'id_temporada' => 'required|exists:temporadas,id_temporada',
        ]);

        $liga->update($request->all());

        return redirect()->route('ligas.index')->with('success', 'Liga actualizada correctamente.');
    }

    public function destroy($id)
    {
        $liga = Liga::findOrFail($id);
        $liga->delete();

        return redirect()->route('ligas.index')->with('success', 'Liga eliminada correctamente.');
    }
}

