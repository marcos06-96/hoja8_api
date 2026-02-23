<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritoResource;
use App\Models\Animal;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function index(Request $request)
{
    $favoritos = $request->user()->favoritos()->get();

    return response()->json([
        'total'     => $favoritos->count(),
        'favoritos' => FavoritoResource::collection($favoritos),
    ]);
}

    // POST /animales/{animal}/favoritos - añadir a favoritos
    public function store(Request $request,Animal $animal)
    {
        $existe = $request->user()->favoritos()
        ->wherePivot('animal_id', $animal->id)
        ->exists();

        if ($existe) {
            return response()->json(['message' => $animal->nombre.' ya está en favoritos'], 409);
        }

        $request->user()->favoritos()->attach($animal->id);

        return response()->json(['message' => $animal->nombre . ' Añadido a favoritos'], 201);
    }

    // DELETE /animales/{animal}/favoritos - eliminar de favoritos
    public function destroy(Request $request, Animal $animal)
{
    $eliminado = $request->user()->favoritos()
        ->wherePivot('animal_id', $animal->id)
        ->exists();

    if (!$eliminado) {
        return response()->json(['message' => $animal->nombre . ' no encontrado en favoritos'], 404);
    }

    $request->user()->favoritos()->detach($animal->id);

    return response()->json(['message' => $animal->nombre . ' eliminado de favoritos']);
}
}