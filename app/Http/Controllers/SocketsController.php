<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Pusher\Pusher;

class SocketsController extends Controller
{
    public function connect(Request $request)
    {
       $broadcaster = new PusherBroadcaster(
            new Pusher(
                env("PUSHER_KEY"),
                env("PUSHER_SECRET"),
                env("PUSHER_APP_ID"),
                []
            )
            );
            $broadcaster->validAuthenticationResponse($request, []);
           
    }
}