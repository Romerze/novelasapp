<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Capitulo;

class CapituloLike extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'capitulo_id',
    ];

    /**
     * Obtener el usuario al que pertenece este like.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el capítulo al que pertenece este like.
     */
    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class);
    }
}
