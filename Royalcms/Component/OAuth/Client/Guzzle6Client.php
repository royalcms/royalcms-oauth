<?php
namespace Royalcms\Component\OAuth\Client;
defined('IN_ROYALCMS') or exit('No permission resources.');

use GuzzleHttp\Client;

/**
 * Http Client Implementation using Guzzle 6.
 */
class Guzzle6Client implements HttpClientInterface
{
    /** @var GuzzleHttp\Client */
    private $client;

    /** @var array */
    private $headers;

    /** @var array */
    private $postParameters;

    /** @var string */
    private $basicUser;

    /** @var string */
    private $basicPass;

    public function __construct(Client $client = null)
    {
        if (null === $client) {
            $client = new Client();
        }
        $this->client = $client;
        $this->headers = array();
        $this->postParameters = array();
        $this->basicUser = null;
        $this->basicPass = null;
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
        $this->basicUser = $user;
        $this->basicPass = $pass;
    }

    public function post($url)
    {
        $response = $this->client->post(
            $url,
            array(
                'form_params' => $this->postFields,
                'auth' => array($this->basicUser, $this->basicPass),
                'headers' => $this->headers,
            )
        );
        $responseStream = $response->getBody();

        return json_decode($responseStream, true);
    }
}

// end