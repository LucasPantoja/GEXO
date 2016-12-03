<?php

namespace gexo\Providers;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Auth;
use gexo\SocialAccount;
use gexo\User;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'avatar' => $providerUser->getAvatar(),
                    'password' => 'SocialUsers'.date('YYmmddHHiiss').rand(6,11),
                ]);
            }
            $account->user()->associate($user);
            $account->save();

            if (Auth::check()) {
                Auth::user()->update(['avatar' => $providerUser->getAvatar()]);
            }
            

            return $user;

        }

    }
}