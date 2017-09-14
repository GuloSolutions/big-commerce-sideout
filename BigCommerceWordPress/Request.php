<?php

namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;

class Request
{
    protected $token;
    protected $store_id;
    protected $id;

    public function __construct()
    {
        $this->token = \Configs::BIG_COMMERCE_SO_TOKEN;
        $this->store_id = \Configs::BIG_COMMERCE_SO_STORE_ID;
        $this->id = \Configs::BIG_COMMERCE_SO_CLIENT_ID;
    }

    public function sendRequest(array $filter)
    {
        Bigcommerce::configure(array(
            'client_id' => $this->id,
            'auth_token' => $this->token,
            'store_hash' => $this->store_id
        ));

        if (!is_null($filter)) {
            $products  = Bigcommerce::getProducts($filter);
            return $products;
        }

        $products = Bigcommerce::getProducts();
        return $products;
    }
}
