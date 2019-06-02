@extends('commons.app')

@section('content')
    @if (Auth::id() == $user->id)
    <div class="text-center mb-5">
        <h1>Delete Account アカウント削除</h1>
    </div>

    <div class="row">
        
        <div class="col-sm-6 offset-sm-3"> 
            <p class="text-right mb-3">{!! link_to_route('users.account', '<アカウント情報へ戻る>', ['id' => $user->id]) !!}</p>
            <div>
                <p style="font-size: 120%;">Do you really wish to delete your account?<br>
                アカウントを削除します。よろしいですか？</p>
                <div class="text-center">
                    {!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete Account アカウント削除', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection