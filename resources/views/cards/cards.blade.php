<ul class="list-unstyled">
    @foreach ($cards as $card)
        <li class="media mb-3 text-white" style="background-color:#c71585">
            {{--<img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">--}}
            <i class="fas fa-user-alt"></i>
            <div class="media-body">
                <div>
                    {!! link_to_route('users.show', $card->user->name, ['id' => $card->user->id]) !!} <span class="text-muted">{{ $card->updated_at }}</span>
                </div>
                <div>
                    <p>{!! nl2br(e($card->japanese)) !!}</p>
                </div>
                <hr>
                <div>
                    <p>{!! nl2br(e($card->english)) !!}</p>
                </div>                
                <div class="d-flex flex-row mx-2">
                    {{--<!--include('favorite.favorite_button', ['micropost' => $micropost])-->--}}
                    @if (Auth::id() == $card->user_id)
                        {!! link_to_route('cards.edit', '編集', ['id' => $card->id], ['class' => 'btn btn-info btn-sm']) !!}
                        
                        {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $cards->render('pagination::bootstrap-4') }}
