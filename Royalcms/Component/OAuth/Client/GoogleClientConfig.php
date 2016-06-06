<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\ClientConfigException;

class GoogleClientConfig extends ClientConfig implements ClientConfigInterface
{
    public function __construct(array $data)
    {
        // check if array is Google configuration object
        if (!isset($data['web'])) {
            throw new ClientConfigException("no configuration 'web' found, possibly wrong client type");
        }
        foreach (array('client_id', 'client_secret', 'auth_uri', 'token_uri', 'redirect_uris') as $key) {
            if (!isset($data['web'][$key])) {
                throw new ClientConfigException(sprintf("missing field '%s'", $key));
            }
        }

        // we map Google configuration to ClientConfig configuration
        $clientData = array(
            'client_id' => $data['web']['client_id'],
            'client_secret' => $data['web']['client_secret'],
            'authorize_endpoint' => $data['web']['auth_uri'],
            'token_endpoint' => $data['web']['token_uri'],
            'redirect_uri' => $data['web']['redirect_uris'][0],
            'credentials_in_request_body' => true,
        );
        parent::__construct($clientData);
    }
}

// end