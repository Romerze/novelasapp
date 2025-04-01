<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Novela;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion'
    ];

    public function novelas()
    {
        return $this->belongsToMany(Novela::class, 'genero_novela');
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
