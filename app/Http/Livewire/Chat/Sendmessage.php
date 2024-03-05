<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use Livewire\Component;

class Sendmessage extends Component
{
    public $body;
    public $selected_conversations;
    public $receverUser;
    public $auth_email;
    protected $listeners = ['updateMessage'];

    public function mount(){
        $this->auth_email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.chat.sendmessage');
    }
    public function updateMessage(Conversation $conversation,Doctor $reciver){
        $this->selected_conversations = $conversation;
        $this->receverUser = $reciver;
    }
    public function sendMessage(){
        if($this->body == null){
            return null;
        }
        $createdMessage = new Message();
        $createdMessage->conversation_id = $this->selected_conversations->id;
        $createdMessage->body = $this->body;
        $createdMessage->sender_email = $this->auth_email;
        $createdMessage->receiver_email = $this->receverUser->email;
        $createdMessage->save();
        $this->selected_conversations->last_time_message = $createdMessage->created_at;
        $this->selected_conversations->save();
        $this->reset('body');
    }
}