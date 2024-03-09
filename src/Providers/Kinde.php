<?php

/*
 * This file is part of umhelper/oauth-clerk.
 *
 * Copyright (c) 2023 UMHelper.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace UMHelper\OAuthClerk\Providers;

use Flarum\Forum\Auth\Registration;
use FoF\OAuth\Provider;
use League\OAuth2\Client\Provider\AbstractProvider;

class Clerk extends Provider
{
    /**
     * @var ClerkProvider
     */
    protected $provider;

    public function name(): string
    {
        return 'clerk';
    }

    public function link(): string
    {
        return 'https://api.clerk.com/authentication/sign-in-with-clerk)';
    }

    public function fields(): array
    {
        return [
            'client_id'     => 'required',
            'client_secret' => 'required',
            'oauth_domain' => 'required',
        ];
    }

    public function provider(string $redirectUri): AbstractProvider
    {
        return $this->provider = new ClerkProvider([
            'clientId'     => $this->getSetting('client_id'),
            'clientSecret' => $this->getSetting('client_secret'),
            'oauthDomain' => $this->getSetting('oauth_domain'),
            'redirectUri'  => $redirectUri,
        ]);
    }

    public function options(): array
    {
        return ['scope' => ['email profile']];
    }

    public function suggestions(Registration $registration, $user, string $token)
    {
        $this->verifyEmail($email = $user->getEmail());

        $registration
            ->provideTrustedEmail($email)
            ->provideAvatar($user->getImage192())
            ->suggestUsername($user->getName())
            ->setPayload($user->toArray());
    }
}
