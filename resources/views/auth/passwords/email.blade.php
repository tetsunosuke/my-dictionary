@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>Reset Password パスワードリセット</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
    
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">Email メールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">
                        Send Password Reset Link<br>
                        パスワードリセットリンクを送信
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
