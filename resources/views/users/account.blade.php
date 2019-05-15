@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>アカウント情報</h1>
    </div>

    <div class="row">
        <table class="col-sm-6 offset-sm-3">
            <tr>
                <th>Nickname ニックネーム</th>
                <td>{{ $user->name }}</td>
                <td>{!! link_to_route('users.edit_name', '編集', ['id'=> $user->id], ['class' => 'btn btn-info btn-sm']) !!}</td>
            </tr>
            <tr>
                <th>Native Language 母国語</th>
                <td>{{ $user->native }}</td>
                <td></td>
            </tr>
            <tr>
                <th>Email メールアドレス</th>
                <td>{{ $user->email }}</td>
                <td>{!! link_to_route('users.edit_email', '編集', ['id'=> $user->id], ['class' => 'btn btn-info btn-sm']) !!}</td>
            </tr>
            <tr>
                <th>Password パスワード</th>
                <td>{!! link_to_route('users.edit_password', 'パスワードを変更', ['id'=> $user->id]) !!}</td>
                <td></td>
            </tr>            
        </table>
    </div>
@endsection