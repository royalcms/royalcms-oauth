<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Royalcms\Component\OAuth\Client\Exception\ClientConfigException;

class ShopifyClientConfig extends ClientConfig implements ClientConfigInterface
{
    public function __construct(array $data)
    {
        if (!isset($data['shopify'])) {
            throw new ClientConfigException("no configuration 'shopify' found");
        }
        foreach (array('client_id', 'client_secret', 'shopname', 'redirect_uri') as $key) {
            if (!isset($data['shopify'][$key])) {
                throw new ClientConfigException(sprintf("missing field '%s'", $key));
            }
        }

        $clientData = array(
            'client_id' => $data['shopify']['client_id'],
            'client_secret' => $data['shopify']['client_secret'],
            'authorize_endpoint' => "https://{$data['shopify']['shopname']}.myshopify.com/admin/oauth/authorize",
            'token_endpoint' => "https://{$data['shopify']['shopname']}.myshopify.com/admin/oauth/access_token",
            'redirect_uri' => $data['shopify']['redirect_uri'],
            'credentials_in_request_body' => true,
            'use_comma_separated_scope' => true,
            'default_token_type' => 'bearer',
        );
        parent::__construct($clientData);
    }
}

// end