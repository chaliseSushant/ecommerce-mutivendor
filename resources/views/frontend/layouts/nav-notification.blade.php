<span class="cursor-pointer dropdown notification">
    <div class="dropbtn"><i class="fa fa-bell-o" aria-hidden="true"></i></div>
    <div class="dropdown-content" style="text-align: left">
        <div class="header">Notifications</div>

        @if(!empty(auth::user()->notifications) && auth::user()->unreadNotifications->count() >=10)
            @foreach(auth::user()->unreadNotifications->take(10) as $notification)
                <a href="{{url('redirect/notification/'.$notification->id)}}" class="unread">
                    <p class="message">{{$notification->data['message']}}</p>
                    <p class="sent-at">{{$notification->created_at->diffForHumans()}}</p>
                </a>
            @endforeach
        @elseif(!empty(auth::user()->notifications))
            @php($count = 0)
            @foreach(auth::user()->unreadNotifications as $notification)
                @php($count++)
                <a href="{{url('redirect/notification/'.$notification->id)}}" class="unread">
                    <p class="message">{{$notification->data['message']}}</p>
                    <p class="sent-at">{{$notification->created_at->diffForHumans()}}</p>
                </a>
            @endforeach
            @if($count<10)
             @foreach(auth::user()->notifications->whereNotNull('read_at')->take(10-$count) as $notification)
                 <a href="{{url('redirect/notification/'.$notification->id)}}">
                     <p class="message">{{$notification->data['message']}}</p>
                     <p class="sent-at">{{$notification->created_at->diffForHumans()}}</p>
                 </a>
             @endforeach
            @endif
        @else

        @endif
        {{--<a href="#" class="unread">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>--}}
    </div>
</span>

