<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\ContextException;
use Royalcms\Component\OAuth\Common\Scope;

class Context
{
    /** @var string */
    private $userId;

    /** @var fkooman\OAuth\Common\Scope */
    private $scope;

    public function __construct($userId, array $scope = array())
    {
        $this->setUserId($userId);
        $this->setScope($scope);
    }

    public function setUserId($userId)
    {
        if (!is_string($userId) || 0 >= strlen($userId)) {
            throw new ContextException('userId needs to be a non-empty string');
        }
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setScope(array $scope)
    {
        $this->scope = new Scope($scope);
    }

    public function getScope()
    {
        return $this->scope;
    }
}

// end