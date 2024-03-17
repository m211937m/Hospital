<div class="card">
    <div class="main-content-left main-content-left-chat">
        <nav class="nav main-nav-line main-nav-line-chat">
            <a class="nav-link active" data-toggle="tab" href="">المحادثات الاخيرة</a>
        </nav>
        <div class="main-chat-list" id="ChatList">
            @forelse ($conversations as $conversation)
                <div class="media new" wire:click='chatuserselected({{$conversation}},`{{$this->get_users($conversation,"id")}}`)'>
                    <div class="media-body">
                        <div class="media-contact-name">
                            <span>{{$this->get_users($conversation,'name')}}</span>
                            <span>{{$conversation->message->created_at->diffForHumans() ?? $conversation->created_at->diffForHumans()}}</span>
                        </div>
                        <p>{{$conversation->message->last()->body ?? ''}}</p>
                    </div>
                </div>
            @empty
            @endforelse
        </div><!-- main-chat-list -->
    </div>
</div>
