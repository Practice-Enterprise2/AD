<?php

namespace App\Events;

use App\Models\User;
use App\Models\chatBox;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class complaint implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private chatBox $chatBox;
    private User $user;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message, chatBox $chatBox, User $user)
    {
        $this->message = $message;
        $this->chatBox = $chatBox;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new privateChannel('private.chat.' . $this->chatBox->id);
        
    }
    public function broadcastAs(){
        return 'chat-message';
    }
    public function broadcastWith(){
        return [
            'message' => $this->message,
            'name' => $this->user->name,
            'userId' => $this->user->id,
            'employee_id' =>$this->chatBox->employee_id,
            'customer_id' => $this->chatBox->customer_id
            
        ];
    }
}