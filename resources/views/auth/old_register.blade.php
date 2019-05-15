@extends('commons.app')

@section('content')

    <div class="text-center mb-5">
        <h1>新規アカウントを作成</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nickname ニックネーム') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('native', 'Native Language 母国語') !!}<br>
                    {!! Form::select('native', array('Japanese' => '日本語', 'English' => 'English', 'both' => 'English & Japanese', 'others' => 'その他 others'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('email', 'Email メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Re-enter Password パスワードを再入力') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <p style="font-size:14px;">※単語カード作成時にカードを公開設定にすると、登録したニックネームと母国語が<br>公開されます。</p>
                {!! Form::submit('登録', ['class' => 'btn btn-dark btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection