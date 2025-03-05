<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin extends Controller
{
    public function __invoke()
    {
        return Socialite::driver('google')->redirect();
    }
}
