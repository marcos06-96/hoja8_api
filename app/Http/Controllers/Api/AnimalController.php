<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\RankingFavoritosResource;
use App\Http\Resources\AnimalListResource;
use App\Http\Resources\AnimalshowResource;
use App\Models\Animal;
use App\Models\Protectora;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = Animal::with('protectora')
            ->where('estado', 'disponible')
            ->orderBy('fecha_ingreso', 'desc')
            ->paginate(10);

        return AnimalListResource::collection($animales);
    }

    public function indexAll()
    {
        $animales = Animal::with('protectora')
            ->orderBy('fecha_ingreso', 'desc')
            ->paginate(10);

        return AnimalListResource::collection($animales);
    }

    public function show(Animal $animal)
    {
        return new AnimalshowResource($animal->load('protectora'));
    }

    public function store(AnimalRequest $request)
    {
        $validated = $request->validated();
        $validated['protectora_id'] = $request->user()->protectora_id;

        return new AnimalshowResource(Animal::create($validated));
    }

    public function update(AnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

        return new AnimalshowResource($animal->load('protectora'));
    }

    public function destroy(Animal $animal)
    {
        $animal->delete();

        return response()->json(['message' => 'Animal eliminado correctamente']);
    }

    public function animales(Request $request, Protectora $protectora)
    {
        $query = Animal::where('protectora_id', $protectora->id);

        if ($request->has('especie')) {
            $query->where('especie', $request->especie);
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('tipo_anuncio')) {
            $query->where('tipo_anuncio', $request->tipo_anuncio);
        }

        return response()->json([
        'protectora' => $protectora->nombre_protectora,
        'animales'   => AnimalResource::collection($query->paginate(10)),
    ]);
    }

    

    

   
}