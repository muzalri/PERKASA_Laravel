<?php

namespace App\Policies;

use App\Models\Komunitas;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class KomunitasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the komunitas.
     */
    public function update(User $user, Komunitas $komunitas)
    {
        return $user->id === $komunitas->user_id;
    }

    /**
     * Determine whether the user can delete the komunitas.
     */
    public function delete(User $user, Komunitas $komunitas)
    {
        return $user->id === $komunitas->user_id;
    }
}
