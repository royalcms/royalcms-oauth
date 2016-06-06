<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\TokenException;

class AccessToken extends Token
{
    /** access_token VARCHAR(255) NOT NULL */
    private $accessToken;

    /** token_type VARCHAR(255) NOT NULL */
    private $tokenType;

    /** expires_in INTEGER DEFAULT NULL */
    private $expiresIn;

    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach (array('token_type', 'access_token') as $key) {
            if (!array_key_exists($key, $data)) {
                throw new TokenException(sprintf("missing field '%s'", $key));
            }
        }
        $this->setAccessToken($data['access_token']);
        $this->setTokenType($data['token_type']);
        $expiresIn = array_key_exists('expires_in', $data) ? $data['expires_in'] : null;
        $this->setExpiresIn($expiresIn);
    }

    public function setAccessToken($accessToken)
    {
        if (!is_string($accessToken) || 0 >= strlen($accessToken)) {
            throw new TokenException('access_token needs to be a non-empty string');
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
            throw new TokenException('token_type needs to be a non-empty string');
        }
        // Google uses "Bearer" instead of "bearer", so we need to lowercase it...
        if (!in_array(strtolower($tokenType), array('bearer'))) {
            throw new TokenException(sprintf("unsupported token type '%s'", $tokenType));
        }
        $this->tokenType = $tokenType;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function setExpiresIn($expiresIn)
    {
        if (null !== $expiresIn) {
            if (!is_numeric($expiresIn) || 0 >= $expiresIn) {
                throw new TokenException('expires_in should be positive integer or null');
            }
            $expiresIn = (int) $expiresIn;
        }
        $this->expiresIn = $expiresIn;
    }

    public function getExpiresIn()
    {
        return $this->expiresIn;
    }
}

// end