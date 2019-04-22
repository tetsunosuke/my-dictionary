@extends('commons.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <!--<h3 class="card-title">{{ $user->name }}</h3>-->
                    <h3  class="card-title">〇〇さん</h3>
                </div>
                <div class="card-body">
                    <i class="fas fa-user-alt"></i>
                </div>
            </div>
        </aside>
        <!--
        <div class="col-sm-8">
            <ul class="list-unstyled">
                @foreach ($words as $word)
                    <li class="media mb-3 text-white" style="background-color:#c71585">
                        <!--<img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
                        <i class="fas fa-user-alt"></i>
                        <div class="media-body">
                            <div>
                                {!! link_to_route('users.show', $word->user->name, ['id' => $word->user->id]) !!} <span class="text-muted">{{ $word->created_at }}</span>
                                <span>〇〇さん</span>
                            </div>
                            <div>
                                @if ($micropost->content)
                                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                                @endif
                            </div>
                            <div>
                                @if ($micropost->image_url)
                                    <p><img src="{{ env('IMAGE_URL') . $micropost->image_url }}" height="150" class="mt-3"></p>
                                @endif
                            </div>
                            <div class="d-flex flex-row mx-2">
                                @include('favorite.favorite_button', ['micropost' => $micropost])
                                @if (Auth::id() == $micropost->user_id)
                                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $microposts->render('pagination::bootstrap-4') }}
        </div>
    </div>-->
@endsection