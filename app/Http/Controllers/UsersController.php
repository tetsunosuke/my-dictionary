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
            $cards = $user->good_cards()->orderBy('created_at', 'desc')->paginate(20);

            return view('users.good_cards', [
                'user' => $user,
                'cards' => $cards,
            ]);
        } else {
            return back();
        }
    }    
    public function account($id)
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
    public function update_name(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);
        if (\Auth::id() == $id){
            $user = User::find($id);
            $message = 'ニックネームを変更しました';
            $user->name = $request->name;
            $user->save();            
            return view('users.account', [
                'user' => $user,   
                'message' => $message,
            ]);
        } else {
            return redirect('/');
        }
    }
    public function edit_email($id)
    {
        if (\Auth::id() == $id){
            $user = User::find($id);
            return view('users.edit_email', [
                'user' => $user,   
            ]);
        } else {
            return redirect('/');
        }
    }    
    public function update_email(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        if (\Auth::id() == $id){
            $user = User::find($id);
            $message = 'メールアドレスを変更しました';
            $user->email = $request->email;
            $user->save();            
            return view('users.account', [
                'user' => $user,   
                'message' => $message,
            ]);
        } else {
            return redirect('/');
        }
    }
    public function delete_account($id)
    {
        if (\Auth::id() == $id){
            $user = User::find($id);
            return view('users.delete_account', [
                'user' => $user,   
            ]);
        } else {
            return redirect('/');
        }        
    }
    public function destroy($id)
    {
        if (\Auth::id() == $id){
            $user = User::find($id);
            $user->delete();
        }
        return redirect('/');
    }    
}
