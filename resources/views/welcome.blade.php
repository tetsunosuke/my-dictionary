@extends('commons.app')

@section('content')
    @if (!Auth::check())
    <div class="text-center mb-4">
        <h1 style="color:#cc0066">My Dictionary</h1>
    </div>
    <div class="row border mx-0 py-3" style="background-color: #d3d3d3;">
        <aside class="col-sm-6 text-center align-middle my-auto pb-3">
            <a class="p-0">{!! link_to_route('register', 'アカウント作成', [], ['class' => 'btn btn-dark btn-register']) !!}</a>
        </aside>
        <aside class="col-sm-6">
            <p class="font-weight-bold"><u>アカウントを作成するとできること</u></p>
            <ul>
                <li>単語カード（公開／非公開）作成・編集</li>
                <li>他のユーザのカードを評価</li>
                <li>単語テスト</li>
            </ul>
            <div class="hidden_box mx-auto">
                <label for="sample" class="btn btn-dark btn-sm">サンプルアカウントで試す</label>
                <input type="checkbox" id="sample">
                <div class="hidden_show">
                    <!--非表示ここから-->
                    <table style="border: none;">
                        <tr>
                            <th>メールアドレス：</th>
                            <td>sample@mail.com</td>
                        </tr>
                        <tr>
                            <th>パスワード　　：</th>
                            <td>sample</td>
                        </tr>
                    </table>
                    <!--ここまで-->
                </div>
            </div>                    
        </aside>
    </div>
    @endif
    <div class="mx-0 my-2 border">    
        {!! Form::open(['route' => 'search.index', 'method' => 'get']) !!}
        @include('search.search_box')            
        {!! Form::close() !!}     
    </div>
    <div>
        @include('cards.cards', ['cards' => $cards])
    </div>    
    <div class="col-sm-6 offset-sm-3">
        <a class="twitter-timeline" data-height="300" data-theme="light" href="https://twitter.com/MyDictionary19?ref_src=twsrc%5Etfw">Tweets by MyDictionary19</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
@endsection