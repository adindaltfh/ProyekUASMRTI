<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Assessment;

class UserObserver
{
    public function deleting(User $user)
    {
        // Periksa apakah user memiliki assessment terkait
        Assessment::where('user_id', $user->id)->update(['user_id' => null]);
    }
}
