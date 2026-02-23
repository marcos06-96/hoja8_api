<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Protectora;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\RankingFavoritosResource;
use Illuminate\Http\Request;

class ProtectoraController extends Controller
{
    
    public function index()
    {
        $protectoras = Protectora::where('estado', 'activa')
            ->get(['id', 'nombre_protectora', 'email_protectora', 'telefono_protectora', 'descripcion', 'web']);

        return response()->json($protectoras);
    }

    public function show(Protectora $protectora)
    {
        return response()->json($protectora);
    }

    

 public function misAnimales(Request $request)
{
    $user = $request->user()->load('protectora');

    $query = Animal::where('protectora_id', $user->protectora_id);

    if ($request->has('especie')) {
        $query->where('especie', $request->especie);
    }
$especie = $request->especie ? $request->especie . 's' : 'animales';
    return response()->json([
        'protectora' => $user->protectora->nombre_protectora,
        $especie   => AnimalResource::collection($query->orderBy('fecha_ingreso', 'desc')->get()),
    ]);
} 


    public function miAnimal(Request $request, Animal $animal)
{
    if ($animal->protectora_id !== $request->user()->protectora_id) {
        return response()->json(['message' => 'Este animal no pertenece a tu protectora'], 403);
    }

     $animal->loadCount('usuariosFav');

    return response()->json([
        'animal'    => new AnimalResource($animal),
        'favoritos' => $animal->usuarios_fav_count,
    ]);
}


    public function cambiarEstado(Request $request, Animal $animal)
    {
        $request->validate([
            'estado' => 'required|in:disponible,reservado,adoptado',
        ]);

        $animal->update(['estado' => $request->estado]);

        return response()->json([
        'Nuevo estado' => $request->estado,
        'animal'   => new AnimalResource ($animal),
    ]);
    }
     public function misAnimalesUrgentes(Request $request)
    {
        $animales = Animal::with('protectora')
            ->where('protectora_id', $request->user()->protectora_id)
            ->where('adopcion_urgente', true)
            ->orderBy('fecha_ingreso', 'desc')
            ->paginate(10);

        return AnimalResource::collection($animales);
    }

    public function misAnimalesMasAntiguos(Request $request)
    {
        $animales = Animal::with('protectora')
            ->where('protectora_id', $request->user()->protectora_id)
            ->where('estado', 'disponible')
            ->orderBy('fecha_ingreso', 'asc')
            ->paginate(10);

        return AnimalResource::collection($animales);
    }

    public function rankingFavoritos(Request $request)
    {
        $animales = Animal::withCount('usuariosFav')
            ->where('protectora_id', $request->user()->protectora_id)
            ->orderBy('usuarios_fav_count', 'desc')->get()
            ;

        return RankingFavoritosResource::collection($animales);
    }


    public function misEstadisticas(Request $request)
    {
        $protectoraId = $request->user()->protectora_id;

        return response()->json([
            'total'       => Animal::where('protectora_id', $protectoraId)->count(),
            'disponibles' => Animal::where('protectora_id', $protectoraId)->where('estado', 'disponible')->count(),
            'reservados'  => Animal::where('protectora_id', $protectoraId)->where('estado', 'reservado')->count(),
            'adoptados'   => Animal::where('protectora_id', $protectoraId)->where('estado', 'adoptado')->count(),
            'urgentes'    => Animal::where('protectora_id', $protectoraId)->where('adopcion_urgente', true)->count(),
        ]);
    }

    public function misEstadisticasPorEspecie(Request $request)
    {
        $protectoraId = $request->user()->protectora_id;

        $estadisticas = Animal::where('protectora_id', $protectoraId)
            ->selectRaw('especie, count(*) as total,
                SUM(estado = "disponible") as disponibles,
                SUM(estado = "reservado") as reservados,
                SUM(estado = "adoptado") as adoptados,
                SUM(adopcion_urgente = 1) as urgentes')
            ->groupBy('especie')
            ->get();

        return response()->json($estadisticas);
    }


}