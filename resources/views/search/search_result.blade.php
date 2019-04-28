@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center">
        <h1>Dictionary</h1>
        <p>{!! link_to_route('signup.get', 'アカウント作成', []) !!}してオリジナルディクショナリーを作成</p>
    </div>
    @endif
    <div class="mx-0 my-2 py-2 border" style="background-color:#f0f8ff">    
        {!! Form::open(['route' => 'search.index', 'method' => 'get']) !!}
            <div class="form-group d-flex flex-row my-auto justify-content-between">
                {!! Form::text('keyword', null, ['class' => 'form-control col-sm-4', 'placeholder' => '日本語または英語で検索']) !!}
                {!! Form::submit('Search', ['class' => 'btn btn-primary btn-block col-sm-2']) !!}
            </div>               
        {!! Form::close() !!}
    </div>
    <div>
        <p class="text-right">{!! link_to_route('home', '<一覧へ戻る>', []) !!}</p>
        <h2 class="mb-3">検索結果　{{ count($cards) }}件</h2>
        @include('cards.cards', ['cards' => $cards])
    </div>    
@endsection