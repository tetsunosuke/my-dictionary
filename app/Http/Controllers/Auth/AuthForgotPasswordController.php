<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AuthForgotPasswordController extends ForgotPasswordController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
