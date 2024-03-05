<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Creatchat extends Component
{
    public $users;
    public $auth_email;


    public function mount(){

        $this->auth_email = auth()->user()->email;
    }

    public function render()
    {
        if(Auth::guard('web')->check()){ 
            $this->users = Doctor::all();
        }

        else{
            $this->users = Patient::all();
        }
        
        return view('livewire.chat.creatchat')->extends('Dashboard.layouts.master');
    }
    public function createconversations($receiver_email){

        $chek_Conversation = Conversation::where('sender_email',$this->auth_email)->
        where('receiver_email',$receiver_email)->orwhere('receiver_email',$this->auth_email)->
        where('sender_email',$receiver_email)->get();

        if($chek_Conversation->isEmpty()){
            
            DB::beginTransaction();
            
               try{
                   $createConversation = new Conversation();
                   $createConversation->sender_email = $this->auth_email;
                   $createConversation->receiver_email = $receiver_email;
                   $createConversation->last_time_message = null;
                   $createConversation->save();
                   //cretate Message
                   $createMessage = new Message();
                   $createMessage->conversation_id	 = $createConversation->id;
                   $createMessage->sender_email = $this->auth_email;
                   $createMessage->receiver_email = $receiver_email;
                   $createMessage->body = 'ghghghghhg';
                   $createMessage->save(); 
       
                   DB::commit();
               }
               catch(Exception $e){
                   DB::rollback();
               }
        }
        else{
            dd( '<script>alert("found")</script>');
        }
        
    }
}
