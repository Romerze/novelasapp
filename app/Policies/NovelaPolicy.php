<?php

namespace App\Policies;

use App\Models\Novela;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NovelaPolicy
{
    /**
     * Determina si el usuario puede ver cualquier lista de novelas.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los usuarios autenticados pueden ver la lista de novelas
    }

    /**
     * Determina si el usuario puede ver una novela específica.
     */
    public function view(?User $user, Novela $novela): bool
    {
        // Las novelas publicadas pueden ser vistas por cualquier usuario
        if ($novela->publicada) {
            return true;
        }

        // El propietario siempre puede ver sus propias novelas
        return $user && $user->id === $novela->user_id;
    }

    /**
     * Determina si el usuario puede crear novelas.
     */
    public function create(User $user): bool
    {
        return true; // Cualquier usuario autenticado puede crear novelas
    }

    /**
     * Determina si el usuario puede actualizar una novela.
     */
    public function update(User $user, Novela $novela): bool
    {
        return $user->id === $novela->user_id; // Solo el autor puede actualizar
    }

    /**
     * Determina si el usuario puede eliminar una novela.
     */
    public function delete(User $user, Novela $novela): bool
    {
        return $user->id === $novela->user_id; // Solo el autor puede eliminar
    }

    /**
     * Determina si el usuario puede restaurar una novela.
     */
    public function restore(User $user, Novela $novela): bool
    {
        return $user->id === $novela->user_id; // Solo el autor puede restaurar
    }

    /**
     * Determina si el usuario puede eliminar permanentemente una novela.
     */
    public function forceDelete(User $user, Novela $novela): bool
    {
        return $user->id === $novela->user_id; // Solo el autor puede eliminar permanentemente
    }
}
