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
            @include('cards.cards', ['cards' => $cards])
        </div>
    </div>
@endsection