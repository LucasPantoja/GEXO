<?php

namespace gexo\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use gexo\SocialAccountService;

class SocialAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service){
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/');
    }

    public function callback2(SocialAccountService $service){
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/');
    }
}
