<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

interface ClientConfigInterface
{
    public function setClientId($clientId);
    public function getClientId();
    public function setClientSecret($clientSecret);
    public function getClientSecret();
    public function setAuthorizeEndpoint($authorizeEndpoint);
    public function getAuthorizeEndpoint();
    public function setTokenEndpoint($tokenEndpoint);
    public function getTokenEndpoint();
    public function setRedirectUri($redirectUri);
    public function getRedirectUri();
    public function setCredentialsInRequestBody($credentialsInRequestBody);
    public function getCredentialsInRequestBody();
    public function setDefaultTokenType($defaultTokenType);
    public function getDefaultTokenType();
    public function setEnableDebug($enableDebug);
    public function getEnableDebug();
}

// end