<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;

class Chatbox extends Component
{
    protected $listeners = ['load_conversationDocrtor','load_conversationPatient'];
    public $reciver;
    public $selected_conversations;
    public $receverUser;
    public $messages;
    public $auth_email;


    public function load_conversationDocrtor(Conversation $conversation,Doctor $reciver){
        $this->selected_conversations = $conversation;
        $this->receverUser = $reciver;
        $this->messages = Message::where('conversation_id',$this->selected_conversations->id)->get();
    }
    public function load_conversationPatient(Conversation $conversation,Patient $reciver){
        $this->selected_conversations = $conversation;
        $this->receverUser = $reciver;
        $this->messages = Message::where('conversation_id',$this->selected_conversations->id)->get();
    }
    public function mount(){
        $this->auth_email = auth()->user()->email;
    }
    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
