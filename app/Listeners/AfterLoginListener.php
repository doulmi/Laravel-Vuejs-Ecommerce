<?php

namespace App\Listeners;

use App\Events\AfterLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AfterLoginListener
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
     * @param  AfterLogin  $event
     * @return void
     */
    public function handle(AfterLogin $event)
    {
      $carts = $event->carts;
      $user = $event->user;

      //add carts to db
      //clear cookie
    }
}
