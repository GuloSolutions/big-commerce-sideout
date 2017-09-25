<?php
namespace BigCommerceWordPress\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use BigCommerceWordPress\Configs;
use PHPUnit\Framework\TestCase;
use BigCommerceWordPress\Products;
use BigCommerceWordPress\Request;



class RequestTest extends TestCase
{
    protected $client;
    public function testConnection()
    {
        Bigcommerce::configure(array(
            'client_id' => 'client_id',
            'auth_token' => 'auth_token',
            'store_hash' => 'store_hash'
        ));
        //test the connection and make sure we are getting back the right kind of object
		$connection = BigCommerce::getTime();
        $this->assertInstanceof('DateTime', $connection);
	}

    public function testResult ()
    {
        $this->client = new Client;
        $response = $this->client->get('https://api.bigcommerce.com/stores/{{store_hash}}/v3/catalog',
            $headers => [
            'X-Auth-Client' => 'client_id',
            'X-Auth-Token' => 'client_token']);
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function testData()
    {
        $results = Bigcommerce::getProducts();
                $this->assertInstanceof('Bigcommerce\Api\Client', $results);
    }
}

