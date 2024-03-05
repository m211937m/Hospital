<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invoice_id;
    public $patient_id;

    public function __construct($data)
    {
        $this->patient_id = $data['patient_id'] ;
        $this->invoice_id = $data['invoice_id'] ;
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }
}
