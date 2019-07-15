@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center mb-4">
        <h1 style="color:#cc0066">My Dictionary</h1>
    </div>
    <div class="row border mx-0 py-3" style="background-color: #d3d3d3;">
        <aside class="col-sm-6 text-center align-middle my-auto pb-3">
            <a class="p-0">{!! link_to_route('register', 'アカウント作成', [], ['class' => 'btn btn-dark btn-lg btn-search col-sm-6']) !!}</a>
        </aside>
        <aside class="col-sm-6">
            <p class="font-weight-bold"><u>アカウントを作成するとできること</u></p>
            <ul>
                <li>単語カード（公開／非公開）作成・編集</li>
                <li>他のユーザのカードを評価</li>
                <li>単語テスト</li>
            </ul>
        </aside>
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