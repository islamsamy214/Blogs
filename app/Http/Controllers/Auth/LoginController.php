<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct()
    {
        $this->middleware('guest:clients')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('clients');
    }
}
