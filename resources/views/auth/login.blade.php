@extends('commons.app')

@section('content')

    <div class="text-center mb-5">
        <h1>Log in ログイン</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => 'login']) !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!! Form::label('password', 'Password パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        {!! Form::checkbox('remember') !!}<span class="ml-2">ログイン状態を保存する</span>
                    </div>
                </div>
                {!! Form::submit('Log in ログイン', ['class' => 'btn btn-dark btn-block']) !!}
            {!! Form::close() !!}
            <p class="mt-4">パスワードを忘れた方は{!! link_to_route('password.request', 'こちら') !!}から</p>
            <p class="mt-2">アカウント作成は{!! link_to_route('register', 'こちら') !!}から</p>
        </div>
    </div>
@endsection
