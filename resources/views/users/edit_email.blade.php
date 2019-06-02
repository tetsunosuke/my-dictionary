@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>Change email メールアドレス変更</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <p class="text-right mb-3">{!! link_to_route('users.account', '<アカウント情報へ戻る>', ['id' => $user->id]) !!}</p>
            <table class="table">
                {!! Form::model($user, ['route' => ['users.update_email', $user->id], 'method' => 'put']) !!}            
                <tr>
                    <th>変更前：</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{!! Form::label('email', '変更後：') !!}</th>
                    <td>{!! Form::text('email', old('email')) !!}</td>
                </tr>
                <tr>
                    <td colspan="2">{!! Form::submit('変更', ['class' => 'btn btn-dark btn-block']) !!}</td>
                </tr>
                {!! Form::close() !!}
            </table>
        </div>
@endsection