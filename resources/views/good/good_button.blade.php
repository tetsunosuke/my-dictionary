@if (Auth::user()->pressed_good($card->id))
    <div>
        {{--goodした場合はgood削除ボタンとBadボタン--}}
        {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
            {!! Form::submit('Cancel good', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
    <div class="mx-1">
        {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
            {!! Form::submit('Bad', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
    
@elseif (Auth::user()->pressed_bad($card->id))
    <div>
        {{--badした場合はGoodボタンとbad削除ボタン--}}
        {!! Form::open(['route' => ['user.good', $card->id]]) !!}
            {!! Form::submit('Good', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
    <div class="mx-1">
        {!! Form::open(['route' => ['user.cancel_good', $card->id], 'method' => 'delete']) !!}
            {!! Form::submit('Cancel bad', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
    
@else
    <div>
        {{--何もしてない場合はGoodボタンとBadボタン--}}
        {!! Form::open(['route' => ['user.good', $card->id]]) !!}
            {!! Form::submit('Good', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
    <div class="mx-1">
        {!! Form::open(['route' => ['user.bad', $card->id]]) !!}
            {!! Form::submit('Bad', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    </div>
@endif