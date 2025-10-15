<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Usuario;

class TareaController extends Controller
{
    // Listar todas las tareas con su usuario asociado
    public function index()
    {
        $tareas = Tarea::with('usuario')->get();
        return response()->json($tareas);
    }

    // Crear una nueva tarea asociada a un usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'usuario_id' => 'required|exists:usuarios,id', // FK validada
        ]);

        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'usuario_id' => $request->usuario_id,
        ]);

        // Cargar relación de usuario para devolverlo al frontend
        $tarea->load('usuario');

        return response()->json(['tarea' => $tarea], 201);
    }

    // Mostrar una tarea específica con su usuario
    public function show($id)
    {
        $tarea = Tarea::with('usuario')->findOrFail($id);
        return response()->json($tarea);
    }

    // Actualizar una tarea existente
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $tarea->update($validated);

        return response()->json([
            'message' => 'Tarea actualizada correctamente',
            'tarea' => $tarea->load('usuario')
        ]);
    }

    // Eliminar una tarea
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return response()->json(['message' => 'Tarea eliminada correctamente']);
    }
}
