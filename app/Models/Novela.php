<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Capitulo;
use App\Models\Genero;

class Novela extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'slug',
        'sinopsis',
        'autor',
        'descripcion',
        'imagen_portada',
        'estado',
        'publicada',
        'visitas'
    ];

    protected $casts = [
        'publicada' => 'boolean',
        'visitas' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'genero_novela');
    }

    public function setTituloAttribute($value)
    {
        $this->attributes['titulo'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
