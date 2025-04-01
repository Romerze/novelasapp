<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Novela;
use App\Models\User;
use App\Models\CapituloImagen;

class Capitulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'novela_id',
        'titulo',
        'slug',
        'contenido',
        'numero_capitulo',
        'publicado',
        'visitas'
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'visitas' => 'integer',
        'numero_capitulo' => 'integer',
    ];

    public function novela()
    {
        return $this->belongsTo(Novela::class);
    }

    /**
     * Obtiene las imágenes asociadas a este capítulo.
     */
    public function imagenes()
    {
        return $this->hasMany(CapituloImagen::class)->orderBy('posicion');
    }

    public function setTituloAttribute($value)
    {
        $this->attributes['titulo'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Obtiene los usuarios que han dado "me gusta" a este capítulo.
     */
    public function usuariosConLike()
    {
        return $this->belongsToMany(User::class, 'capitulo_likes')->withTimestamps();
    }

    /**
     * Obtiene los usuarios que han guardado este capítulo.
     */
    public function usuariosQueGuardaron()
    {
        return $this->belongsToMany(User::class, 'capitulo_guardados')->withTimestamps();
    }

    /**
     * Verifica si un usuario específico ha dado "me gusta" a este capítulo.
     */
    public function tieneLikeDeUsuario($userId)
    {
        return $this->usuariosConLike()->where('user_id', $userId)->exists();
    }

    /**
     * Verifica si un usuario específico ha guardado este capítulo.
     */
    public function estaGuardadoPorUsuario($userId)
    {
        return $this->usuariosQueGuardaron()->where('user_id', $userId)->exists();
    }
}
