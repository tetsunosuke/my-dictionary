@extends('commons.app')

@section('content')
<div class="text-center">
    <h1>Good一覧</h1>
</div>
<div>
    @include('cards.cards', ['cards' => $cards])
</div>    
@endsection