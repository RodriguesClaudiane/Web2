<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function admin(User $user): bool
    {
        return $user->role === "administrador";
    }

    public function client(User $user): bool
    {
        return $user->role === "cliente" || $user->role === "bibliotecario" || $user->role === "administrador" || $user->role === null;
    }

    public function librarian(User $user): bool
    {
        return $user->role === "bibliotecario" || $user->role === "administrador";
    }
}
