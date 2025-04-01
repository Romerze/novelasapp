<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapituloImagen extends Model
{
    use HasFactory;
    
    protected $table = 'capitulo_imagenes';

    protected $fillable = [
        'capitulo_id',
        'ruta',
        'nombre_original',
        'tipo_mime',
        'posicion',
        'descripcion'
    ];

    /**
     * Obtiene el capítulo al que pertenece esta imagen
     */
    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class);
    }
    
    /**
     * Obtiene la URL completa de la imagen
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }
}
