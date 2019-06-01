<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthResetPasswordController extends ResetPasswordController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
