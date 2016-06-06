<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\TokenResponseException;
use Royalcms\Component\OAuth\Common\Scope;

class TokenResponse
{
    private $accessToken;
    private $tokenType;
    private $expiresIn;
    private $refreshToken;
    private $scope;

    public function __construct(array $data)
    {
        foreach (array('access_token', 'token_type') as $key) {
            if (!array_key_exists($key, $data)) {
                throw new TokenResponseException(sprintf("missing field '%s'", $key));
            }
        }
        $this->setAccessToken($data['access_token']);
        $this->setTokenType($data['token_type']);

        $this->expiresIn = null;
        $this->refreshToken = null;
        $this->scope = null;
        if (array_key_exists('expires_in', $data)) {
            $this->setExpiresIn($data['expires_in']);
        }
        if (array_key_exists('refresh_token', $data)) {
            $this->setRefreshToken($data['refresh_token']);
        }
        if (array_key_exists('scope', $data)) {
            $this->setScope($data['scope']);
        }
    }

    public function setAccessToken($accessToken)
    {
        if (!is_string($accessToken) || 0 >= strlen($accessToken)) {
            throw new TokenResponseException('access_token needs to be a non-empty string');
        }
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setTokenType($tokenType)
    {
        if (!is_string($tokenType) || 0 >= strlen($tokenType)) {
            throw new TokenResponseException('token_type needs to be a non-empty string');
        }
        $this->tokenType = $tokenType;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function setExpiresIn($expiresIn)
    {
        if (!is_int($expiresIn) || 0 >= $expiresIn) {
            throw new TokenResponseException('expires_in needs to be a positive integer');
        }
        $this->expiresIn = $expiresIn;
    }

    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    public function setRefreshToken($refreshToken)
    {
        if (!is_string($refreshToken) || 0 >= strlen($refreshToken)) {
            throw new TokenResponseException('refresh_token needs to be a non-empty string');
        }
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function setScope($scope)
    {
        $scope = Scope::fromString($scope);
        if ($scope->isEmpty()) {
            throw new TokenResponseException('scope must be non empty');
        }
        $this->scope = $scope;
    }

    public function getScope()
    {
        return $this->scope;
    }
}

// end