<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Card;

class TestController extends Controller
{
    //user_idが来る
    public function index($id) {
        if (\Auth::id() == $id){
            return view('test.index', [
                'id' => $id,
            ]);
        }
    }
    public function test(Request $request, $id) {
        $user = User::find($id);
        $scope = $request->input('scope');
        $style = $request->input('style');
        $previous_card_id = $request->input('previous_card_id');
        
        if ($scope == 'my_cards') {
            $cards = $user->cards();
        } else {
            $cards = $user->good_cards();
        }
        
        $count_cards = $cards->count();//カードが一枚の時に次の問題を変えないために  
        
        if($count_cards > 0) {

            $card_ids = $cards->pluck('cards.id');//取得したカードたちのid全て取得

            $max_key = $count_cards-1;
            $card_id_key = random_int(0, $max_key);
            
            $card_id = $card_ids[$card_id_key];
            
            if ($previous_card_id != null && $count_cards != 1){
                while ($card_id == $previous_card_id) {
                    $card_id_key = random_int(0, $max_key);
                    $card_id = $card_ids[$card_id_key];
                }
            }
            $card = Card::find($card_id);
            
        } else {
            $card = null;
            $card_id = null;
        }

        return view('test.test', [
            'card' => $card,
            'previous_card_id' => $card_id,
            'scope' => $scope,
            'style' => $style,
        ]);        
    }
}
