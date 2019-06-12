@if (Auth::check())
    @if (Auth::id() == $card->user->id)
        <div>
            <button><i class='far fa-thumbs-up'></i></button>
        </div>
        <div class="count mr-2">
            {{ $card->good_users()->count() }}
        </div>
        <div>
            <button><i class='far fa-thumbs-down'></i></button>
        </div>
        <div class="count">
            {{ $card->bad_users()->count() }}
        </div>
    @elseif (Auth::user()->pressed_good($card->id))
        <div>
            {{--goodした場合はgood削除ボタンとBadボタン--}}
            {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
                <button style="cursor:pointer"><i class='fas fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count mr-2">
            {{ $card->good_users()->count() }}
        </div>
        <div>
            {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count">
            {{ $card->bad_users()->count() }}
        </div>
        
    @elseif (Auth::user()->pressed_bad($card->id))
        <div>
            {{--badした場合はGoodボタンとbad削除ボタン--}}
            {!! Form::open(['route' => ['user.good', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count mr-2">
            {{ $card->good_users()->count() }}
        </div>        
        <div>
            {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
                <button style="cursor:pointer"><i class='fas fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count">
            {{ $card->bad_users()->count() }}
        </div>
        
    @else
        <div>
            {{--何もしてない場合はGoodボタンとBadボタン--}}
            {!! Form::open(['route' => ['user.good', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-up'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count mr-2">
            {{ $card->good_users()->count() }}
        </div>
        <div>
            {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
                <button style="cursor:pointer"><i class='far fa-thumbs-down'></i></button>
            {!! Form::close() !!}
        </div>
        <div class="count">
            {{ $card->bad_users()->count() }}
        </div>
    @endif
@else
    <div class="balloon">
        <button><i class='far fa-thumbs-up'></i></button>
        <div class="balloon_box">
            <p class="balloon_text">評価するには{!! link_to_route('login', 'ログイン') !!}してください。</p>
        </div>
    </div>
    <div class="count mr-2">
        {{ $card->good_users()->count() }}
    </div>    
    <div class="balloon">
        <button><i class='far fa-thumbs-down'></i></button>
        <div class="balloon_box">
            <p class="balloon_text">評価するには{!! link_to_route('login', 'ログイン') !!}してください。</p>
        </div>        
    </div>
    <div class="count">
        {{ $card->bad_users()->count() }}
    </div>
@endif