<?php
namespace Wgr\Newsletter\Infomaniak;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;

class Client extends \GuzzleHttp\Client
{

  private $base_uri = 'https://newsletter.infomaniak.com/api/v1/public/';
  private $client;

  const MAILINGLIST = "mailinglist";
  const CONTACT = "contact";
  const CAMPAIGN = "campaign";
  const TASK = "task";
  const CREDIT = "credit";

  public function __construct(array $config = [])
  {
    // check if client api and client secret are set
    if (empty($config['client_api']) || empty($config['client_secret']))
      throw new \Exception("Client API and Client Secret are required");

    // set client api and client secret
    $client_api = $config['client_api'];
    $client_secret = $config['client_secret'];
    unset($config['client_api']);
    unset($config['client_secret']);


    return parent::__construct(array_merge($config, [
      'base_uri' => $this->base_uri,
      RequestOptions::HEADERS => [
        'User-Agent' => 'PHP wrapper for API newsletter'
      ],
      RequestOptions::AUTH => [$client_api, $client_secret],
    ]));
  }
}