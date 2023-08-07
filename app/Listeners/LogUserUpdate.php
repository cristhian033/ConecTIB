<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserUpdate
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
     * @param  \App\Events\UserUpdated  $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $user = $event->user;
        $logMessage = "Usuario {$user->id} modificado, los nuevos datos son: ";
        $logMessage.="name={$user->name}, ";
        $logMessage.="phone={$user->phone}, ";
        $logMessage.="birth_date={$user->birth_date}, ";
        $logMessage.="city_id={$user->city_id}, ";
        $logMessage.="password={$user->password} ";
        // Guardar el registro en el archivo de log
        Log::channel('users')->info($logMessage);
    }
}
