@extends('commons.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <i class="fas fa-user-alt"></i>
                </div>
                <div>
                    <p>母国語：{{ $user->native }}</p>
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <div class="mx-0 my-2 py-2 border" style="background-color:#f0f8ff">    
                {!! Form::open(['route' => ['search.my_cards', $user->id]]) !!}
                    <div class="form-group d-flex flex-row my-auto justify-content-between">
                        {!! Form::text('keyword', null, ['class' => 'form-control col-sm-4', 'placeholder' => '日本語または英語で検索']) !!}
                        {!! Form::submit('Search', ['class' => 'btn btn-primary btn-block col-sm-2']) !!}
                    </div>               
                {!! Form::close() !!}     
            </div>
                <p class="text-right">{!! link_to_route('users.show', '<'.$user->name.'のページへ戻る>', ['id' => $user->id]) !!}</p>
            <h2 class="mb-3">検索結果　{{ count($cards) }}件</h2>            
            @include('cards.cards', ['cards' => $cards])
        </div>
    </div>
@endsection