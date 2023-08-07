<?php

namespace App\Listeners;

use App\Events\UserDelete;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserDelete
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserDelete  $event
     * @return void
     */
    public function handle(UserDelete $event)
    {
        $user = $event->user;
        $logMessage = "Usuario {$user->id} eliminado";
        // Guardar el registro en el archivo de log
        Log::channel('users')->info($logMessage);
    }
}
