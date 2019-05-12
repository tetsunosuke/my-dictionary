@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center">
        <h1>Dictionary</h1>
        <p>{!! link_to_route('signup.get', 'アカウント作成', []) !!}してオリジナルディクショナリーを作成</p>
    </div>
    @endif
    <div class="mx-0 my-2 border">     
        {!! Form::open(['route' => 'search.index', 'method' => 'get']) !!}
        @include('search.search_box')           
        {!! Form::close() !!}
    </div>
    <div>
        <p class="text-right">{!! link_to_route('home', '<一覧へ戻る>', []) !!}</p>
        <h2 class="mb-3">検索結果　{{ count($cards) }}件</h2>
        @include('cards.cards', ['cards' => $cards])
    </div>    
@endsection