<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //テキストでは$userを引数にしていたけど良いのか？このメソッドは誰が呼び出すのか？
    public function counts($card) {
        $count_good_users = $card->good_users()->count();
        return $count_good_users;
    }
}
