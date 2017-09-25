<?php

namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use BigCommerceWordPress\Configs;

class Request
{
    protected $token;
    protected $store_id;
    protected $id;

    public function __construct()
    {

        $configs = new Configs;
        $this->store_id = $configs->load()['parameters'][0];
        $this->token = $configs->load()['parameters'][1];
        $this->id = $configs->load()['parameters'][2];
        $this->configure();
    }

    private function configure()
    {
        Bigcommerce::configure(array(
            'client_id' => $this->id,
            'auth_token' => $this->token,
            'store_hash' => $this->store_id
        ));
    }
}
