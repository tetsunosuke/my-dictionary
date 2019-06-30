@extends('commons.app')

@section('content')
<div class="container">
    <p class="text-right mb-3">{!! link_to_route('users.test_index', 'テストを終了', ['id' => Auth::id()]) !!}</p>
    @if (!isset($card))
        <h5 class="text-center">カードがありません。</h5>
    @elseif ($style == 'english_question')
        <div class="card">
            <div class="card-body">
                <p class="card-title">English 英語：</p>
                <p class="card-text">{{ $card->english }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-4">Japanese 日本語：</p>
                <textarea rows="4" class="form-control"></textarea>
            </div>
        </div>
        <div class="hidden_box">
            <label for="answer" class="btn btn-dark btn-block">答えを見る</label>
            <input type="checkbox" id="answer">
            <div class="hidden_show">
                <div class="card">
                    <div class="card-body">  
                        <p class="card-title">Answer 答え：</p>
                      	<p class="card-text">{{ $card->japanese }}</p>
                    </div>
                </div>
            </div>
        </div>            
    <p class="text-center mb-3">{!! link_to_route('users.test', '次の問題へ', ['id' => Auth::id(), 'scope' => $scope, 'style' => $style, 'previous_card_id' => $previous_card_id, 'class' => 'btn btn-primary btn-block']) !!}</p>
    @else
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Japanese 日本語：</p>
                        <p class="card-text">{{ $card->japanese }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">English 英語：</p>
                        <textarea rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="hidden_box">
                    <label for="answer" class="btn btn-dark btn-block">答えを見る</label>
                    <input type="checkbox" id="answer">
                    <div class="hidden_show">
                        <div class="card">
                            <div class="card-body">  
                                <p class="card-title">Answer 答え：</p>
                              	<p class="card-text">{{ $card->english }}</p>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    <p class="text-center mb-3">{!! link_to_route('users.test', '次の問題へ', ['id' => Auth::id(), 'scope' => $scope, 'style' => $style, 'previous_card_id' => $previous_card_id, 'class' => 'btn btn-primary btn-block']) !!}</p>
    @endif
</div>
@endsection
