@extends('commons.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title my-auto">{{ $user->name }}</h3>
                </div>
                <div class="card-body d-flex">
                    <div>
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <div class="ml-4">
                        <p>母国語：　{{ $user->native }}</p>
                    </div>
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <div class="mx-0 my-2 border">    
                {!! Form::open(['route' => ['search.my_cards', $user->id]]) !!}
                @include('search.search_box')             
                {!! Form::close() !!}
            </div>            
            @include('cards.cards', ['cards' => $cards])
        </div>
    </div>
@endsection