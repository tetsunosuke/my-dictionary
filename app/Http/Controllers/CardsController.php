<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

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
        $cards = Card::where('audience_selector', 'like', 'public');
        
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

        $request->user()->cards()->create([
            'japanese' => $request->japanese,
            'english' => $request->english,
            'audience_selector' => $request->audience_selector,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        ]);

        $card = Card::find($id);
        
        if (\Auth::id() === $card->user_id) {
            $card->japanese = $request->japanese;
            $card->english = $request->english;
            $card->audience_selector = $request->audience_selector;
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
