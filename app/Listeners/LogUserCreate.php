<?php

namespace App\Listeners;

use App\Events\UserCreate;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserCreate
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
     * @param  \App\Events\UserCreate  $event
     * @return void
     */
    public function handle(UserCreate $event)
    {
        $user = $event->user;
        $logMessage = "Usuario {$user->id} creado con los siguientes datos: ";
        $logMessage.="email={$user->email} ";
        $logMessage.="document={$user->document} ";
        $logMessage.="name={$user->name}, ";
        $logMessage.="phone={$user->phone}, ";
        $logMessage.="birth_date={$user->birth_date}, ";
        $logMessage.="city_id={$user->city_id}, ";
        $logMessage.="password={$user->password} ";
        // Guardar el registro en el archivo de log
        Log::channel('users')->info($logMessage);
    }
}
