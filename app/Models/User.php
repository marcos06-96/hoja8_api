<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory,  Notifiable, HasApiTokens;
    use HasRoles;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'nombre',
    'apellidos',
    'email',
    'password',
    'role',
    'telefono',
    'direccion',
    'localidad',
    'protectora_id',
    'es_responsable',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'es_responsable' => 'boolean',
            'protectora_id' => 'integer',
        ];
    }

    // ========== RELACIONES ==========

   
    public function protectora()
    {
        return $this->belongsTo(Protectora::class);
    }

    
    public function favoritos()
    {
        return $this->belongsToMany(Animal::class, 'favoritos', 'usuario_id', 'animal_id')
                    ;
    }

    
    public function protectorasComoResponsable()
    {
        return $this->hasOne(Protectora::class, 'usuario_principal_id');
    }

    // ========== SCOPES ==========

   
    public function scopeAdoptantes($query)
    {
        return $query->where('role', 'adoptante');
    }

   
    public function scopeProtectoras($query)
    {
        return $query->where('role', 'protectora');
    }

   
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

   
    public function scopeResponsables($query)
    {
        return $query->where('es_responsable', true);
    }

    // ========== ACCESSORS ==========

 
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

   
    public function getEsAdoptanteAttribute()
    {
        return $this->role === 'adoptante';
    }

   
    public function getEsProtectoraAttribute()
    {
        return $this->role === 'protectora';
    }

    /**
     * Verificar si es admin
     */
    public function getEsAdminAttribute()
    {
        return $this->role === 'admin';
    }

   

    
    public function agregarFavorito($animalId)
    {
        if (!$this->favoritos()->where('animal_id', $animalId)->exists()) {
            $this->favoritos()->attach($animalId);
            return true;
        }
        return false;
    }

    
    public function quitarFavorito($animalId)
    {
        return $this->favoritos()->detach($animalId);
    }

   
    public function tieneFavorito($animalId)
    {
        return $this->favoritos()->where('animal_id', $animalId)->exists();
    }

   
    public function toggleFavorito($animalId)
    {
        if ($this->tieneFavorito($animalId)) {
            $this->quitarFavorito($animalId);
            return false; // Quitado
        } else {
            $this->agregarFavorito($animalId);
            return true; // Añadido
        }
    }

    // ========== MÉTODOS DE NEGOCIO ==========

   
    public function asignarAProtectora($protectoraId, $esResponsable = false)
    {
        $this->update([
            'role' => 'protectora',
            'protectora_id' => $protectoraId,
            'es_responsable' => $esResponsable,
        ]);

        return $this;
    }

    
    public function pasarAAdmin()
    {
        $this->update(['role' => 'admin']);
        return $this;
    }

    
    public function pasarAAdoptante()
    {
        $this->update([
            'role' => 'adoptante',
            'protectora_id' => null,
            'es_responsable' => false,
        ]);
        
        return $this;
    }
}