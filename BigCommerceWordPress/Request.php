<?php

namespace BigCommerceWordPress;

require dirname(__FILE__) . 'Configs.php';

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;

class BigCommerceWordpress
{
    protected $store_id;
    protected $token;
    protected $id;

    public function __construct()
    {
        $this->token = Configs::getToken();
        $this->store_id = Configs::getStoreId();
        $this->id = Configs::getClientId();
    }

    public function sendRequest()
    {
        Bigcommerce::configure(array(
            'client_id' => $this->id,
            'auth_token' => $this->token,
            'store_hash' => $this->store_id
        ));

        $products  = Bigcommerce::getProducts();

        return $products;
    }
}



