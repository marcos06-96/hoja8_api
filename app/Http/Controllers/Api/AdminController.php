<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\ProtectoraResource;
use App\Models\Animal;
use App\Models\Protectora;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function usuarios()
    {
        $usuarios = User::paginate(10);

        return response()->json($usuarios);
    }

    public function cambiarRol(Request $request, User $usuario)
{
    $request->validate([
        'role'         => 'required|in:admin,protectora,adoptante',
        'protectora_id' => 'required_if:role,protectora|exists:protectoras,id',
    ]);

    if ($request->role === 'protectora') {
        $usuario->update([
            'role'          => 'protectora',
            'protectora_id' => $request->protectora_id,
        ]);
    } elseif ($request->role === 'adoptante') {
        $usuario->update([
            'role'          => 'adoptante',
            'protectora_id' => null,
            'es_responsable'=> false,
        ]);
    } else {
        $usuario->update([
            'role'          => 'admin',
            'protectora_id' => null,
        ]);
    }

    return response()->json([
        'message' => 'Rol actualizado correctamente',
        'usuario' => $usuario->nombre,
        'role'    => $usuario->role,
    ]);
}

    public function cambiarEstadoProtectora(Request $request, Protectora $protectora)
    {
        $request->validate([
            'estado' => 'required|in:activa,inactiva',
        ]);

        $protectora->update(['estado' => $request->estado]);

        return response()->json([
            'message'   => 'Estado actualizado correctamente',
            'protectora'=> $protectora->nombre_protectora,
            'estado'    => $protectora->estado,
        ]);
    }

    public function destroyAnimal(Animal $animal)
    {
        $animal->delete();

        return response()->json(['message' => 'Animal eliminado correctamente']);
    }

    public function estadisticas()
    {
        return response()->json([
            'usuarios'    => User::count(),
            'adoptantes'  => User::where('role', 'adoptante')->count(),
            'protectoras' => User::where('role', 'protectora')->count(),
            'animales'    => Animal::count(),
            'disponibles' => Animal::where('estado', 'disponible')->count(),
            'adoptados'   => Animal::where('estado', 'adoptado')->count(),
            'urgentes'    => Animal::where('adopcion_urgente', true)->count(),
        ]);
    }

    public function estadisticasProtectoras()
    {
        $protectoras = Protectora::withCount([
            'animales',
            'animales as adopciones' => fn($query) => $query->where('estado', 'adoptado')
        ])
        ->orderBy('adopciones', 'desc')
        ->get(['id', 'nombre_protectora', 'estado']);

   return ProtectoraResource::collection($protectoras);
    }
    public function adopcionesUltimoMes()
{
    $animales = Animal::where('estado', 'adoptado')
        ->where('updated_at', '>=', now()->subMonth())
        ->get();

    return response()->json([
        'total'    => $animales->count(),
        'animales' => AnimalResource::collection($animales),
    ]);
}
}