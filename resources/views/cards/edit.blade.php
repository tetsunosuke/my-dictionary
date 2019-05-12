@extends('commons.app')

@section('content')

    <h1>カード編集</h1>
    
    <div class="row justify-content-md-center">
        <div class="col-sm-6">
            
            {!! Form::model($card, ['route' => ['cards.update', $card->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('japanese', 'Japanese 日本語') !!}
                    {!! Form::textarea('japanese', $card->japanese, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('english', 'English 英語') !!}
                    {!! Form::textarea('english', $card->english, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('audience_selector', 'Audience Selector 公開設定') !!}<br>
                    
                    {!! Form::radio('audience_selector', 'public', true) !!}
                    {!! Form::label('public', 'Public 全体に公開') !!}
                    
                    {!! Form::radio('audience_selector', 'private') !!}
                    {!! Form::label('private', 'Private 非公開') !!}
                </div>
                <p style="font-size:14px;">※カードを公開設定にすると登録したニックネームと母国語が公開されます。</p>
                {!! Form::submit('変更を保存', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}        
        </div>
    </div>
@endsection