@extends('commons.app')

@section('content')
    
    <div class="row justify-content-md-center">
        <div class="col-sm-6">
            <h1 class="text-center mb-3">カード編集</h1>            
            
            {!! Form::model($card, ['route' => ['cards.update', $card->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('japanese', 'Japanese 日本語') !!}
                    {!! Form::textarea('japanese', $card->japanese, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('phonetic', 'Phonetic ローマ字読み') !!}
                    {!! Form::textarea('phonetic', $card->phonetic, ['class' => 'form-control', 'rows' => '2']) !!}
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
                {!! Form::submit('変更を保存', ['class' => 'btn btn-dark btn-block']) !!}
            {!! Form::close() !!}  
            <div class="mt-3">
            <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
            <span style="margin:15px 15px 15px 15px"><a href="https://developer.yahoo.co.jp/about">Web Services by Yahoo! JAPAN</a></span>
            <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->     
            </div>            
        </div>
    </div>
@endsection