<?php

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
    private $http;
    private $base_url;

    public function setUp()
    {
        $this->http = new GuzzleHttp\Client;
        $this->base_url = 'api.bigcommerce.com/stores/{{store_id}}/v3/catalog/products';
    }

    public function tearDown() {
        $this->http = null;
    }

    public function testConnection()
    {
        Bigcommerce::configure(array(
            'client_id' => 'creds',
            'auth_token' => 'creds',
            'store_hash' => 'creds'
        ));
        //test the connection and make sure we are getting back the right kind of object
        $connection = BigCommerce::getTime();
        $this->assertInstanceof('DateTime', $connection);
    }
    public function testGet()
    {
        //test resoponse code given the correct header information
        $response = $this->http->request('GET', $this->base_url, ['headers' => [
            'User-Agent' => 'testing/1.0',
            'X-Auth-Client' => 'creds',
            'X-Auth-Token' => 'creds']]);
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    public function testData()
    {
        $results = Bigcommerce::getProducts();
        $this->assertInstanceof('Bigcommerce\Api\Connection', $results);
    }

    public function testArrayFilters()
    {
        $results = Bigcommerce::getProducts();
        //array keys are protected so we can only get a numeric key
        $this->assertArrayHasKey('3', $results);

    }
}

