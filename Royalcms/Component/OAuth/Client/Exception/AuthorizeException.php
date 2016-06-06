<?php
namespace Royalcms\Component\OAuth\Client\Exception;
defined('IN_ROYALCMS') or exit('No permission resources.');

class AuthorizeException extends \Exception
{
    private $description;

    public function __construct($message, $description, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

// end