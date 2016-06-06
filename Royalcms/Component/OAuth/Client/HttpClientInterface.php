<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

/**
 * Compatibility interface to support multiple version of Guzzle for dealing
 * with API changes.
 */
interface HttpClientInterface
{
    public function addPostFields(array $postFields);
    public function addHeader($key, $value);
    public function setBasicAuth($user, $pass);
    public function post($url);
}

// end