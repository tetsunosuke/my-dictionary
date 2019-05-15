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
            $exists = $cards->exists();
            if (!$exists){
                return redirect('/');                
            }
        }

        $cards = $cards->orderBy('created_at', 'desc')->paginate(20);            
        return view('users.show', [
            'user' => $user,
            'cards' => $cards,
        ]);            
    }
    
    //ログインユーザのidが来る
    public function good_cards($id)
    {
        if (\Auth::id() == $id){  
            $user = User::find($id);
            $cards = $user->good_cards()->where('good', 'good')->orderBy('created_at', 'desc')->paginate(20);

            return view('users.good_cards', [
                'user' => $user,
                'cards' => $cards,
            ]);
        } else {
            return back();
        }
    }    
    public function account($id)//要らない？？//
    {
        if (\Auth::id() == $id){
            $user = User::find($id);
            return view('users.account', [
                'user' => $user,   
            ]);
        } else {
            return redirect('/');
        }
    }
    public function edit_name($id)
    {
        if (\Auth::id() == $id){
            $user = User::find($id);
            return view('users.edit_name', [
                'user' => $user,   
            ]);
        } else {
            return redirect('/');
        }
    }
}
