<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Protectora extends Model
{
    /** @use HasFactory<\Database\Factories\ProtectoraFactory> */
    use HasFactory;

    protected $table = 'protectoras';
    public $timestamps = false; 

    protected $fillable = [
        'nombre_protectora',
        'slug',
        'cif',
        'numero_registro',
        'direccion_protectora',
        'telefono_protectora',
        'email_protectora',
        'descripcion',
        'logo',
        'web',
        'estado',
        'usuario_principal_id',
    ];

    protected $casts = [
        'usuario_principal_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Al crear una protectora
        static::creating(function ($protectora) {
            if (empty($protectora->slug)) {
                $protectora->slug = Str::slug($protectora->nombre_protectora);
            }
        });
        
        // Al actualizar el nombre
        static::updating(function ($protectora) {
            if ($protectora->isDirty('nombre_protectora') && empty($protectora->slug)) {
                $protectora->slug = Str::slug($protectora->nombre_protectora);
            }
        });
    }



    public function animales()
    {
        return $this->hasMany(Animal::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function usuarioPrincipal()
{
    return $this->belongsTo(User::class, 'usuario_principal_id');
}

}
