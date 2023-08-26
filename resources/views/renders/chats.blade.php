@if($channels->count() > 0)
    @foreach($channels as $channel)
        <div class="feed-element chat-channel" data-id="{{$channel->id}}">
            <a href="#" class="pull-right">
                <img alt="image" class="img-circle" src="{{asset('assets/img/chat-person.png')}}">
            </a>
            <div class="media-body">
                <div class="nk-msg-sender">
                    <div class="name">{{$channel->account->name ?? $channel->account->mobile ?? ''}} </div>
                    <div class="lable-tag dot bg-pink"></div>
                </div>
                <br>
                {{$channel->last_message}}
                <br>
                <small class="text-muted">{{$channel->last_message_time}}</small>
                <br>
                <small class="text-muted">مقدم الخدمة : {{$channel->last_agent}}</small>
                <br>
                <small class="text-muted"> حالة الرسالة : @if($channel->communicate_status) تم التواصل @else   فى انتظار
                    الرد@endif</small>
            </div>
        </div>

    @endforeach
@else


@endif
