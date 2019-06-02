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
<div>
    @include('cards.cards', ['cards' => $cards])
</div>    
@endsection