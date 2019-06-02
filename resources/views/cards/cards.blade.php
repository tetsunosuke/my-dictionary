<ul class="list-unstyled">
    @foreach ($cards as $card)
        <li class="media mb-3 border border-dark rounded pb-2" style="background-color:white">
            {{--<img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">--}}
            <div class="media-body">
                <div class="my-1 m-3 d-flex justify-content-between">
                    <div><i class="fas fa-user-alt mr-2"></i>{!! link_to_route('users.show', $card->user->name, ['id' => $card->user->id]) !!}</div>
                    <div class="text-muted">{{ $card->updated_at->format('Y-m-d') }}</div>
                </div>
                <div class="ml-5 mt-3">
                    <p class="card-text mb-0">{!! nl2br(e($card->japanese)) !!}</p>
                    <p class="text-muted" style="font-size: small;">[{!! nl2br(e($card->phonetic)) !!}]</p>
                </div>
                <hr>
                <div class="ml-5 my-3">
                    <p class="card-text">{!! nl2br(e($card->english)) !!}</p>
                </div>                
                <div class="d-flex justify-content-between flex-row ml-5 mr-3" style="font-size: 22px;">
                    <div class="d-flex flex-row">
                        @include('good.good_button', ['card' => $card])
                    </div>
                    <div class="d-flex flex-row">
                    @if (Auth::id() == $card->user_id)
                        <div>
                            {!! link_to_route('cards.edit', '編集', ['id' => $card->id], ['class' => 'btn btn-info btn-sm']) !!}
                        </div>
                        <div class="ml-2">
                            {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
<div class="mb-3">
<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<span style="margin:15px 15px 15px 15px"><a href="https://developer.yahoo.co.jp/about">Web Services by Yahoo! JAPAN</a></span>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
</div>
{{ $cards->render('pagination::bootstrap-4') }}
