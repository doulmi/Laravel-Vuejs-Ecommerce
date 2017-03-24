<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;

class AfterLogin
{
  use InteractsWithSockets, SerializesModels;

  public $user;
  public $carts;
  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(User $user, $carts)
  {
    $this->user = $user;
    $this->carts = $carts;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return Channel|array
   */
  public function broadcastOn()
  {
    return new PrivateChannel('channel-name');
  }
}
