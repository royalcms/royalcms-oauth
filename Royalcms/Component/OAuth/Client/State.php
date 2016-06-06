<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\TokenException;

class State extends Token
{
    /** state VARCHAR(255) NOT NULL */
    protected $state;

    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach (array('state') as $key) {
            if (!array_key_exists($key, $data)) {
                throw new TokenException(sprintf("missing field '%s'", $key));
            }
        }

        $this->setState($data['state']);
    }

    public function setState($state)
    {
        if (!is_string($state) || 0 >= strlen($state)) {
            throw new TokenException('state needs to be a non-empty string');
        }
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

// end