<?php

require_once('../../vendor/autoload.php');
// require_once('src/Configs.php');
// require_once('src/Products.php');

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
	public function testCount()
	{
		$request = new BigCommerceWordPress\Request;
        $products = new BigCommerceWordPress\Products;
         $this->assertInstanceof('Products', $product);

        $response = $products->getSetNumberOfProducts(7);
        $responseCount = count($response);
        $this->AssertEquals(7, $responseCount);
	}

	public function testFeaturedProducts()
    {
        $request = new BigCommerceWordPress\Request;
        $products = new BigCommerceWordPress\Products;
        $featured = $products->getFeaturedProducts();
        $this->assertContains('is_featured', $featured);

    }
}
