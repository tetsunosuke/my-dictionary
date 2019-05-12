@if (Auth::check())
    @if (Auth::user()->pressed_good($card->id))
        <div class="mr-2">
            {{--goodした場合はgood削除ボタンとBadボタン--}}
            {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
                <button style="cursor:pointer"><i class='fas fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
        
    @elseif (Auth::user()->pressed_bad($card->id))
        <div class="mr-2">
            {{--badした場合はGoodボタンとbad削除ボタン--}}
            {!! Form::open(['route' => ['user.good', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
                <button style="cursor:pointer"><i class='fas fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
        
    @else
        <div class="mr-2">
            {{--何もしてない場合はGoodボタンとBadボタン--}}
            {!! Form::open(['route' => ['user.good', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div>
            {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
    @endif
@else
    <div class="mr-2 balloon">
        <button><i class='far fa-thumbs-up'></i></button>
        <div class="balloon_box">
            <p class="balloon_text">評価するには{!! link_to_route('login', 'ログイン') !!}してください。</p>
        </div>
    </div>
    <div class="mr-2 balloon">
        <button><i class='far fa-thumbs-down'></i></button>
        <div class="balloon_box">
            <p class="balloon_text">評価するには{!! link_to_route('login', 'ログイン') !!}してください。</p>
        </div>        
    </div>
@endif