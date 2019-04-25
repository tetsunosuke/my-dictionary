@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center">
        <h1>Dictionary</h1>
        <p>{!! link_to_route('signup.get', 'アカウント作成', []) !!}してオリジナルディクショナリーを作成</p>
    </div>
    @endif
    <div>
        @include('cards.cards', ['cards' => $cards])
    </div>    
@endsection