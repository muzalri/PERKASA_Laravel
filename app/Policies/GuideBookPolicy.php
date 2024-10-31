<?php

namespace App\Policies;

use App\Models\GuideBook;
use App\Models\User;

class GuideBookPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, GuideBook $guideBook)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isPakar();
    }

    public function update(User $user, GuideBook $guideBook)
    {
        return $user->isPakar();
    }

    public function delete(User $user, GuideBook $guideBook)
    {
        return $user->isPakar();
    }
}
