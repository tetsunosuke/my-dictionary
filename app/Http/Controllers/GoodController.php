<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\User; //テキスト通りだと不要？

class GoodController extends Controller
{
    //public function good(Request $request, $id)→Requestは不要？
    //cardのidが入る
    public function good($id)
    {
        \Auth::user()->good($id);
        return back();
    }
    public function bad($id)
    {
        \Auth::user()->bad($id);
        return back();
    }
    public function destroy($id)
    {
        \Auth::user()->cancel_good($id);
        return back();
    }
}
