@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>Reset Password パスワードリセット</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            @if (Auth::check())
                <form class="form-horizontal" method="POST" action="{{ route('auth_password.reset') }}">
            @else
                <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
            @endif
                {{ csrf_field() }}
    
                <input type="hidden" name="token" value="{{ $token }}">
    
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">Email メールアドレス</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password パスワード</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label">Re-enter Password パスワードを再入力</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
    
                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-dark btn-block">
                            Reset Password パスワードリセット
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
