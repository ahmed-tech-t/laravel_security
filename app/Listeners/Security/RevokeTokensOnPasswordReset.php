<?php

namespace App\Listeners\Security;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RevokeTokensOnPasswordReset implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        $user = $event->user;
        $user->tokens()->delete();

        Log::info("Password reset successful for User ID: {$user->id} from IP: " . request()->ip());


        // $user->notify(new \App\Notifications\PasswordChangedNotification());
    }
}
