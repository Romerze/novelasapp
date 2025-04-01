<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
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
            'isAdmin' => 'boolean',
        ];
    }

    /**
     * Obtiene todas las novelas asociadas con este usuario.
     */
    public function novelas()
    {
        return $this->hasMany(Novela::class);
    }

    /**
     * Obtiene todos los capítulos a los que el usuario ha dado "me gusta".
     */
    public function capitulosConLike()
    {
        return $this->belongsToMany(Capitulo::class, 'capitulo_likes')->withTimestamps();
    }

    /**
     * Obtiene todos los capítulos guardados por el usuario.
     */
    public function capitulosGuardados()
    {
        return $this->belongsToMany(Capitulo::class, 'capitulo_guardados')->withTimestamps();
    }
}
