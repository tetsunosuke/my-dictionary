<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /*ログインユーザがmy wordsを押したときはログインユーザのユーザidが入る*/
    
    public function show($id)
    {
        $user = User::find($id);
        
        if (\Auth::id() === $user->id){
            $cards = $user->cards();
        } else {
            $cards = $user->cards()->where('audience_selector', 'like', 'public');
        }
        
        $cards = $cards->orderBy('created_at', 'desc')->paginate(20);
        
        return view('users.show', [
            'user' => $user,
            'cards' => $cards,
        ]);
    }
}
