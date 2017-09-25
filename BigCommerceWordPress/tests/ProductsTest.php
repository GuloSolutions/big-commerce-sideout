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

class ProductsTest extends TestCase
{
	public function testCount()
	{
		$request = new Request;
        $products = new Products;
        $response = $products->getSetNumberofProducts(7);
        $responseCount = count($response);
        $thisAssertEquals(7, $responseCount);
	}
}
