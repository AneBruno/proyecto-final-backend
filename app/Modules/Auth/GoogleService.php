<?php

namespace App\Modules\Auth;

use Laravel\Socialite\SocialiteManager;

class GoogleService
{
    /**
     * @var SocialiteManager
     */
    protected $socialite;

    /**
     * GoogleService constructor.
     * @param SocialiteManager $socialiteManager
     */
    public function __construct(SocialiteManager $socialiteManager)
    {
        $this->socialite = $socialiteManager;
    }

    public function login(string $gooToken)
    {
        $rawUser = $this->socialite->driver('google')
            ->userFromToken($gooToken)
            ->getRaw();
        return $rawUser;
    }
}
