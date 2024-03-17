<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chatlist extends Component
{
    public $conversations;
    public $auth_email;
    public $receverUser;
    public $selected_conversations;
    protected $listeners = ['refresh' => '$refresh'];

    public function mount(){
        $this->auth_email = auth()->user()->email;
    }
    public function render()
    {
        $this->conversations = Conversation::where('sender_email',$this->auth_email)->orwhere('receiver_email',$this->auth_email)->
        orderBy('created_at','DESC')->get();
        return view('livewire.chat.chatlist');
    }
    public function get_users(Conversation $conversation,$request){
        if($conversation->sender_email == $this->auth_email){
            $this->receverUser = Doctor::where('email',$conversation->receiver_email)->first();
        }
        else{
            $this->receverUser = Patient::where('email',$conversation->sender_email)->first();
        }
        if(isset($request)){
            return $this->receverUser->$request;
        }
    }

    public function chatuserselected(Conversation $conversation,$receiver_id){
      $this->selected_conversations = $conversation;
      $this->receverUser = Doctor::find($receiver_id);
      if(Auth::guard('web')->check()){
          $this->emitTo('chat.chatbox','load_conversationDocrtor',$this->selected_conversations,$this->receverUser);
      }
      else{
        $this->emitTo('chat.chatbox','load_conversationPatient',$this->selected_conversations,$this->receverUser);
      }
        $this->emitTo('chat.sendmessage','updateMessage',$this->selected_conversations,$this->receverUser);
    }

}
