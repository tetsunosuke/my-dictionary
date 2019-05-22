@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center">
        <h1 style="color:#cc0066">My Dictionary</h1>
        <p>{!! link_to_route('register', 'アカウント作成', []) !!}してオリジナルディクショナリーを作成</p>
    </div>
    @endif
    <div class="mx-0 my-2 border">    
        {!! Form::open(['route' => 'search.index', 'method' => 'get']) !!}
        @include('search.search_box')            
        {!! Form::close() !!}     
    </div>
    <div>
        @include('cards.cards', ['cards' => $cards])
    </div>    
@endsection