@extends('commons.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Dictionary</h1>
            {!! link_to_route('signup.get', 'Make my dictionary!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
<!--
    ・投稿たちをincludeする
    ・-->
@endsection