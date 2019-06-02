@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>Change nickname ニックネーム変更</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <p class="text-right mb-3">{!! link_to_route('users.account', '<アカウント情報へ戻る>', ['id' => $user->id]) !!}</p>
            <table class="table">
                {!! Form::model($user, ['route' => ['users.update_name', $user->id], 'method' => 'put']) !!}            
                <tr>
                    <th>変更前：</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>{!! Form::label('name', '変更後：') !!}</th>
                    <td>{!! Form::text('name', old('name')) !!}</td>
                </tr>
                <tr>
                    <td colspan="2">{!! Form::submit('変更', ['class' => 'btn btn-dark btn-block']) !!}</td>
                </tr>
                {!! Form::close() !!}
            </table>
        </div>
@endsection