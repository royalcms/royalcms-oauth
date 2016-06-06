<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\ClientConfigException;

class GitHubClientConfig extends ClientConfig implements ClientConfigInterface
{
    public function __construct(array $data)
    {
        foreach (array('client_id', 'client_secret') as $key) {
            if (!isset($data[$key])) {
                throw new ClientConfigException(sprintf("missing field '%s'", $key));
            }
        }

        $clientData = array(
            'client_id' => $data['client_id'],
            'client_secret' => $data['client_secret'],
            'authorize_endpoint' => 'https://github.com/login/oauth/authorize',
            'token_endpoint' => 'https://github.com/login/oauth/access_token',
            'use_comma_separated_scope' => true,
            'credentials_in_request_body' => true,
        );
        parent::__construct($clientData);
    }
}

// end