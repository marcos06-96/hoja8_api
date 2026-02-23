<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animales'; 

public $timestamps = false; 

 protected $fillable = [
        'protectora_id',
        'nombre',
        'especie',
        'raza',
        'edad_aproximada',
        'sexo',
        'tamanio',
        'peso',
        'color',
        'chip',
        'esterilizado',
        'vacunado',
        'desparasitado',
        'bueno_con_ninos',
        'bueno_con_perros',
        'bueno_con_gatos',
        'nivel_energia',
        'adopcion_urgente',
        'necesidades_especiales',
        'descripcion',
        'historia',
        'tipo_anuncio',
        'estado',
        'localidad',
        'role',
        'fecha_ingreso',
    ];

    protected $casts = [
        'chip' => 'boolean',
        'esterilizado' => 'boolean',
        'vacunado' => 'boolean',
        'desparasitado' => 'boolean',
        'bueno_con_ninos' => 'boolean',
        'bueno_con_perros' => 'boolean',
        'bueno_con_gatos' => 'boolean',
        'peso' => 'decimal:2',
        'fecha_ingreso' => 'date',
    ];

    public function protectora()
    {
        return $this->belongsTo(Protectora::class);
    }

    public function usuariosFav()
    {
        return $this->belongsToMany(User::class, 'favoritos', 'usuario_id', 'animal_id')
                    ;
    }


















}
