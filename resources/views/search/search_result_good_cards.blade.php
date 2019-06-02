@extends('commons.app')

@section('content')
<div class="text-center">
    <h1>Like一覧</h1>
</div>
<div class="mx-0 my-2 border">     
    {!! Form::open(['route' => ['search.good_cards', $user->id]]) !!}
    @include('search.search_box')        
    {!! Form::close() !!}     
</div>
    <p class="text-right">{!! link_to_route('users.good_cards', '<Like一覧へ戻る>', ['id' => $user->id]) !!}</p>
    <h2 class="mb-3">検索結果　{{ count($cards) }}件</h2>
<div>
    @include('cards.cards', ['cards' => $cards])
</div>    
@endsection