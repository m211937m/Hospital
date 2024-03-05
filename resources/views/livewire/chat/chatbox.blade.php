<div>
    @if ($selected_conversations)
    <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
            <div class="main-img-user"><img alt="" src="{{URL::asset('Dashboard/img/faces/9.jpg')}}"></div>
            <div class="main-chat-msg-name">
                <h6>{{$this->receverUser->name}}</h6>
            </div>
        </div><!-- main-chat-header -->
        <div class="main-chat-body" id="ChatBody">
            <div class="content-inner">
                @foreach ($messages as $message)
                    <div class="media {{$auth_email == $message->sender_email ? 'flex-row-reverse':''}}">
                        <div class="media-body">
                            <div class="main-msg-wrapper right">
                                {{$message->body}}
                            </div>
                            <div>
                                <span>{{$message->created_at->diffForHumans()}}</span>
                                <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>