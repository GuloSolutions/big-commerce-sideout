<?php

namespace App;

require 'vendor/autoload.php';
require 'Configs.php';

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;

class BigCommerceSideout {

    protected $store_id;
    protected $token;
    protected $id;

    public function __construct($client_id, $token, $store_id){

            $this->token = $token;
            $this->store_id = $store_id;
            $this->id = $client_id;
    }

    public function sendRequest() {

        Bigcommerce::configure(array(
            'client_id' => $this->id,
            'auth_token' => $this->token,
            'store_hash' => $this->store_id
        ));

        $products  = Bigcommerce::getProducts();

        return $products;

    }
}




