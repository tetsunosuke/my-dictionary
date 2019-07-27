<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use DB;
use Abraham\TwitterOAuth\TwitterOAuth;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;
//        $cards = Card::where('audience_selector', 'like', 'public');

        $cards = Card::leftJoin('good', 'cards.id', '=', 'good.card_id')
                    ->leftJoin('bad', 'cards.id', '=', 'bad.card_id')
                    ->select('cards.*', 'good.good_user_id', 'bad.bad_user_id');
                    
        $cards = $cards->where('audience_selector', 'public');

        if (\Auth::check()) {
            $user = \Auth::user();
            $cards = $cards->orWhere('user_id', '=', $user->id);
        }
        
        $cards = $cards->orderBy('created_at', 'desc')->paginate(20);
        
        
        $data = [
            'cards' => $cards,
        ];
        
        return view('welcome', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (\Auth::check()) {
            return view('cards.create');
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'japanese' => 'required|max:191',
            'english' => 'required|max:191',
            'audience_selector' => 'required|in:public,private',
        ]);
        
        $japanese = $request->japanese;
        $english = $request->english;
        $audience_selector = $request->audience_selector;
        
        $api = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
        $appid = env('RUBY_WEBAPI_APPID', false);
        $params = array(
            'sentence' => $japanese,
        );
         
        $ch = curl_init($api);
        curl_setopt_array($ch, array(
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
            CURLOPT_POSTFIELDS     => http_build_query($params),
        ));
         
        $result = curl_exec($ch);
        curl_close($ch);
        
        $results = new \SimpleXMLElement($result);
        $results_array = $results->Result[0]->WordList[0]->Word;
        $phonetic = '';
        foreach($results_array as $word){
            $phonetic .= $word->Roman . " ";
        }

        $request->user()->cards()->create([
            'japanese' => $japanese,
            'english' => $english,
            'audience_selector' => $audience_selector,
            'phonetic' => $phonetic,
        ]);
        
        if ($audience_selector == "public"){
            
            $twitter_api_key = env('TWITTER_API_KEY');
            $twitter_api_secret_key = env('TWITTER_API_SECRET_KEY');
            $twitter_access_token = env('TWITTER_ACCESS_TOKEN');
            $twitter_access_token_secret = env('TWITTER_ACCESS_TOKEN_SECRET');
            
            $twitter = new TwitterOAuth($twitter_api_key, $twitter_api_secret_key, $twitter_access_token, $twitter_access_token_secret);
            
            if (mb_strlen($english) > 20){
                $short_english = mb_substr($english, 0, 20) . "...";//23
            } else {
                $short_english = $english;
            };
            
            if (mb_strlen($japanese) > 20){
                $short_japanese = mb_substr($japanese, 0, 20) . "…";//23
            } else {
                $short_japanese = $japanese;
            };

            $twitter->post("statuses/update", [
                "status" =>
                    '新しい投稿がありました!' . PHP_EOL .
                    '英：' . $short_english . PHP_EOL . '日：' . $short_japanese . PHP_EOL .
                    'http://my-dictionary2019.herokuapp.com/'
                    //140-12-39-2-2=85
            ]);            
        }

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);

        if (\Auth::id() === $card->user_id) {
            return view('cards.edit', [
                'card' => $card,
            ]);
        } else {
            return back();    
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'japanese' => 'required|max:191',
            'english' => 'required|max:191',
            'audience_selector' => 'required|in:public,private',
            'phonetic' => 'max:191',
        ]);

        $card = Card::find($id);
        
        if (\Auth::id() === $card->user_id) {
            $card->japanese = $request->japanese;
            $card->english = $request->english;
            $card->audience_selector = $request->audience_selector;
            $card->phonetic = $request->phonetic;
            $card->save();
        }
        return redirect('/');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);

        if (\Auth::id() === $card->user_id) {
            $card->delete();
        }
        return back();        
    }
}
