<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\TokenException;

class RefreshToken extends Token
{
    /** refresh_token VARCHAR(255) NOT NULL */
    private $refreshToken;

    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach (array('refresh_token') as $key) {
            if (!array_key_exists($key, $data)) {
                throw new TokenException(sprintf("missing field '%s'", $key));
            }
        }

        $this->setRefreshToken($data['refresh_token']);
    }

    public function setRefreshToken($refreshToken)
    {
        if (!is_string($refreshToken) || 0 >= strlen($refreshToken)) {
            throw new TokenException('refresh_token needs to be a non-empty string');
        }
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }
}

// end