@extends('commons.app')

@section('content')

@if (isset($message))
    <div class="alert alert-success" role="alert">
        <p class="my-auto">{{ $message }}</p>
    </div>
@endif

    <div class="text-center mb-5">
        <h1>アカウント情報</h1>
    </div>

    <div class="row">
        <table class="col-sm-6 offset-sm-3 table" style="border-width: 2px;">
            <tr>
                <th>Nickname<br>ニックネーム</th>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{!! link_to_route('users.edit_name', '編集', ['id'=> $user->id], ['class' => 'btn btn-link btn-sm']) !!}</td>
            </tr>
            <tr>
                <th>Native Language<br>母国語</th>
                <td class="align-middle">{{ $user->native }}</td>
                <td class="align-middle"></td>
            </tr>
            <tr>
                <th>Email<br>メールアドレス</th>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="align-middle">{!! link_to_route('users.edit_email', '編集', ['id'=> $user->id], ['class' => 'btn btn-link btn-sm']) !!}</td>
            </tr>
            <tr>
                <th>Password<br>パスワード</th>
                <td class="align-middle">{!! link_to_route('auth_password.request', 'パスワードを変更', null, ['class' => 'btn btn-link btn-sm pl-0']) !!}</td>
                <td></td>
            </tr>      
            <tr class="border-bottom">
                <th></th>
                <td colspan="2" class="align-middle">{!! link_to_route('delete_account', 'アカウント削除', ['id'=> $user->id], ['class' => 'btn btn-danger']) !!}</td>
            </tr>
        </table>
        
    </div>
@endsection