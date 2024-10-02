<?php

namespace App\Policies;

use App\Models\Komentar;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class KomentarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the komentar.
     */
    public function delete(User $user, Komentar $komentar)
    {
        return $user->id === $komentar->user_id || $user->id === $komentar->komunitas->user_id;
    }
}
