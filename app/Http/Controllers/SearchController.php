<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\User;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = [];        
        $keyword = $request->input('keyword');
        $user = null;
        
        if(empty($keyword)){
            return redirect('/');
        } else {
            if (\Auth::check()) {
                $user = \Auth::user();
                
                $cards = Card::where(function ($query) use ($user, $keyword) {
                    $query->where('audience_selector', 'like', 'public')->orWhere('user_id', '=', $user->id);
                })->where(function ($query) use ($keyword) {
                    $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
                });
            } else {
                $cards = Card::where('audience_selector', 'like', 'public')->where(function ($query) use ($keyword) {
                    $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
                });
            }
            $cards = $cards->orderBy('created_at', 'desc')->paginate(20);
            
            $data = [
                'user' => $user,
                'cards' => $cards,
            ];         
            
            return view('search.search_result', $data);
        }
    }
    
    public function my_cards(Request $request, $id)
    {
        $keyword = $request->input('keyword');
        $user = User::find($id);
        
        if(empty($keyword)){
            return redirect()->route('users.show', ['id' => $id]);
        } else {
            if (\Auth::id() == $id) {
                $cards = $user->cards()->where(function ($query) use ($keyword) {
                    $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
                })->orderBy('created_at', 'desc')->paginate(20);
            } else {
                $cards = Card::where('user_id', $id)->where('audience_selector', 'public')->where(function ($query) use ($keyword) {
                    $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
                })->orderBy('created_at', 'desc')->paginate(20);
            }
            
            $data = [
                'user' => $user,
                'cards' => $cards,
            ];
            
            return view('search.search_result_my_cards', $data);
        }
    }

    public function good_cards(Request $request, $id)
    {
        $user = User::find($id);
        $keyword = $request->input('keyword');

        if(empty($keyword)){
            return redirect()->route('users.good_cards', ['id' => $id]);
        } else {        
            if (\Auth::id() == $id) {
                $cards = $user->good_cards()->where('good', 'good')->where(function ($query) use ($keyword) {
                    $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
                })->orderBy('created_at', 'desc')->paginate(20);
                
                $data = [
                    'user' => $user,
                    'cards' => $cards,
                ];
                
                return view('search.search_result_good_cards', $data);            
            } else {
                return back();
            }
        }
    }    
}        

/* ログイン状態で検索すると必ずpublicのものが検索結果に入ってしまう        
        $cards = Card::where('audience_selector', 'like', 'public');
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $cards = Card::orWhere('audience_selector', 'like', 'public')->orWhere('user_id', '=', $user->id);
        }
        
        $cards = $cards->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%')->orderBy('created_at', 'desc')->paginate(20);
        
        $data = [
            'user' => $user,
            'cards' => $cards,
        ];         
        
        return view('search.search_result', $data);
    }
}
*/

/*英語で検索しても結果が0になるエラー        
        if (\Auth::check()) {
            $user = \Auth::user();
            $cards = Card::where('audience_selector', 'like', 'public')->orWhere('user_id', '=', $user->id);
        } else {
            $user = null;
            $cards = Card::where('audience_selector', 'like', 'public');
        }
        
        $japanese_cards = $cards->where('japanese', 'like', '%'.$keyword.'%');
        $exists = $japanese_cards->exists();
        
        if ($exists) {
            $result_cards = $japanese_cards->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $result_cards = $cards->where('english', 'like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->paginate(20);
        }
        
        $data = [
            'user' => $user,
            'cards' => $result_cards,
        ];         
        
        return view('search.search_result', $data);
    }
}
*/
/*
なぜか日本語で検索して代入もされているのにelse{}内で$keywordが'undefined variable'となるエラー。
            $cards = Card::where(function ($query) {
                $query->where('audience_selector', 'like', 'public')->orWhere('user_id', '=', $user->id);
            })->where(function ($query) {
                $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
            });
        } else {
            $cards = Card::where('audience_selector', 'like', 'public')->where(function ($query) {
                $query->where('japanese', 'like', '%'. $keyword .'%')->orWhere('english', 'like', '%'. $keyword .'%');
            });
        }
        $cards = $cards->orderBy('created_at', 'desc')->paginate(20);
*/
/*
クエリのuseで↓使ってもだめ。
            $query_variables = [
                'user' => $user,
                'keyword' => $keyword,
            ];
*/