    <div class="nk-msg-head">
        <h4 class="title d-none d-lg-block">{{$channel->account->name ?? $channel->account->mobile}}</h4>
        <div class="nk-msg-head-meta">
            <div class="d-none d-lg-block">
                <ul class="nk-msg-tags">
                    <li><span class="label-tag"><em
                                class="icon ni ni-flag-fill"></em> <span>الدعم الفني </span></span>
                    </li>
                </ul>
            </div>
            <ul class="nk-msg-actions">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"
                       href="#">
                        <i class="fa fa-ellipsis-h fa-x"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">تميز المحادثة كمنتهيه </a>
                        </li>
                        <li><a href="#">التحويل الى مقدم اخر </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <a href="#" class="nk-msg-profile-toggle profile-toggle active"><em
                class="icon ni ni-arrow-left"></em></a>
    </div>

    @foreach($messages as $message)
        <div class="chat-message @if($message->sender_type == 'account') right @elseif($message->sender_type == 'agent') left @else @endif">
            <img class="message-avatar" src="{{asset('assets/img/chat-person.png')}}" alt="">
            <div class="message">
                <a class="message-author" href="#">
                    @if($message->sender_type == 'account')
                        {{$message->account->name ?? $message->account->mobile}}
                    @elseif($message->sender_type == 'agent')
                        {{$message->agent->name}}
                    @else

                    @endif </a>
                <span
                    class="message-date">  {{$message->message_time}} </span>
                <span class="message-content">
{{$message->message}}
                </span>
            </div>
        </div>
    @endforeach


