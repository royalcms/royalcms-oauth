<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\TokenException;
use Royalcms\Component\OAuth\Common\Scope;

class Token
{
    /** @var string */
    private $clientConfigId;

    /** @var string */
    private $userId;

    /** @var Scope | null */
    private $scope;

    /** @var int */
    private $issueTime;

    public function __construct(array $data)
    {
        foreach (array('client_config_id', 'user_id', 'scope', 'issue_time') as $key) {
            if (!array_key_exists($key, $data)) {
                throw new TokenException(sprintf("missing field '%s'", $key));
            }
        }
        $this->setClientConfigId($data['client_config_id']);
        $this->setUserId($data['user_id']);
        $this->setScope($data['scope']);
        $this->setIssueTime($data['issue_time']);
    }

    public function setClientConfigId($clientConfigId)
    {
        if (!is_string($clientConfigId) || 0 >= strlen($clientConfigId)) {
            throw new TokenException('client_config_id needs to be a non-empty string');
        }
        $this->clientConfigId = $clientConfigId;
    }

    public function getClientConfigId()
    {
        return $this->clientConfigId;
    }

    public function setUserId($userId)
    {
        if (!is_string($userId) || 0 >= strlen($userId)) {
            throw new TokenException('client_config_id needs to be a non-empty string');
        }
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setScope(Scope $scope)
    {
        $this->scope = $scope;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function setIssueTime($issueTime)
    {
        if (!is_numeric($issueTime) || 0 >= $issueTime) {
            throw new TokenException('issue_time should be positive integer');
        }
        $this->issueTime = (int) $issueTime;
    }

    public function getIssueTime()
    {
        return $this->issueTime;
    }
}

// end