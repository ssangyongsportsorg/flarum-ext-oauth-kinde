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

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class ClerkProvider extends AbstractProvider
{
    protected $oauthDomain;
    
    public function getOauthDomain()
    {
        return $this->oauthDomain;
    }
    public function getBaseAuthorizationUrl()
    {
        return 'https://' . $this->getOauthDomain() . '/oauth/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://' . $this->getOauthDomain() . '/oauth/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://' . $this->getOauthDomain() . '/oauth/userinfo';
    }

    protected function getDefaultScopes()
    {
        return [];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['ok']) && $data['ok'] === false) {
            throw new IdentityProviderException($data['error'], null, $data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new ClerkResourceOwner($response);
    }

    protected function prepareAccessTokenResponse(array $result)
    {
        $result = parent::prepareAccessTokenResponse($result);

        return [
            'access_token'      => $result['access_token'],
            'resource_owner_id' => $result['id_token'],
        ];
    }

    protected function getAuthorizationHeaders($token = null)
    {
        return ['Authorization' => 'Bearer '.$token];
    }
}
