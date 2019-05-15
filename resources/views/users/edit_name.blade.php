@extends('commons.app')

@section('content')
    <div class="text-center mb-5">
        <h1>Change nickname ニックネーム変更</h1>
    </div>
    <div class="row">
        <table class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => 'users.update_name', 'method' => 'put']) !!}            
            <tr>
                <th>変更前：</th>
                <td>{{ $user->name }}</td>
            </tr>
                <div class="form-group">
                    {!! Form::label('name', 'Nickname ニックネーム') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>            
                {!! Form::submit('登録', ['class' => 'btn btn-dark btn-block']) !!}
            {!! Form::close() !!}            
   
@endsection