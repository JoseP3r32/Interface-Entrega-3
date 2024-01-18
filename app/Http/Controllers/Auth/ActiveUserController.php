<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserStatusNotification;

class ActiveUserController extends Controller
{
    /**
     * Activate a user.
     */
    public function activateUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('admin')->with('error', 'Usuario no encontrado');
        }

        $user->actived = 1;
        $user->save();

        // Send notification
        Notification::send($user, new UserStatusNotification(['status' => 1]));

        return redirect()->route('admin')->with('success', 'Usuario activado correctamente');
    }

    /**
     * Deactivate a user.
     */
    public function deactivateUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('admin')->with('error', 'Usuario no encontrado');
        }

        $user->actived = 0;
        $user->save();

        // Send notification
        Notification::send($user, new UserStatusNotification(['status' => 0]));

        return redirect()->route('admin')->with('success', 'Usuario desactivado correctamente');
    }
}
