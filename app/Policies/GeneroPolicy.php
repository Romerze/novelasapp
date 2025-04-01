<?php

namespace App\Policies;

use App\Models\Genero;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GeneroPolicy
{
    /**
     * Determina si el usuario puede ver cualquier lista de géneros.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Cualquier usuario (autenticado o no) puede ver los géneros
    }

    /**
     * Determina si el usuario puede ver un género específico.
     */
    public function view(?User $user, Genero $genero): bool
    {
        return true; // Cualquier usuario puede ver los géneros
    }

    /**
     * Determina si el usuario puede crear géneros.
     * Solo los administradores pueden crear géneros.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin ?? false; // Asumimos un método isAdmin o atributo en el modelo User
    }

    /**
     * Determina si el usuario puede actualizar un género.
     * Solo los administradores pueden actualizar géneros.
     */
    public function update(User $user, Genero $genero): bool
    {
        return $user->isAdmin ?? false;
    }

    /**
     * Determina si el usuario puede eliminar un género.
     * Solo los administradores pueden eliminar géneros.
     */
    public function delete(User $user, Genero $genero): bool
    {
        return $user->isAdmin ?? false;
    }

    /**
     * Determina si el usuario puede restaurar un género eliminado.
     * Solo los administradores pueden restaurar géneros.
     */
    public function restore(User $user, Genero $genero): bool
    {
        return $user->isAdmin ?? false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un género.
     * Solo los administradores pueden eliminar permanentemente géneros.
     */
    public function forceDelete(User $user, Genero $genero): bool
    {
        return $user->isAdmin ?? false;
    }
}
