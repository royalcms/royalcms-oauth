<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use Guzzle\Http\Client;
use Guzzle\Plugin\CurlAuth\CurlAuthPlugin;

/**
 * Http Client Implementation using Guzzle 3.
 */
class Guzzle3Client implements HttpClientInterface
{
    /** @var Guzzle\Http\Client */
    private $client;

    /** @var array */
    private $headers;

    /** @var array */
    private $postParameters;

    public function __construct(Client $client = null)
    {
        if (null === $client) {
            $client = new Client();
        }
        $this->client = $client;
        $this->headers = array();
        $this->postParameters = array();
    }

    public function addPostFields(array $postFields)
    {
        $this->postFields = $postFields;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function setBasicAuth($user, $pass)
    {
        $this->client->addSubscriber(new CurlAuthPlugin($user, $pass));
    }

    public function post($url)
    {
        $request = $this->client->post($url);
        $request->addPostFields($this->postFields);
        foreach ($this->headers as $k => $v) {
            $request->addHeader($k, $v);
        }

        return $request->send()->json();
    }
}

// end