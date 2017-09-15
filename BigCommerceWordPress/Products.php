<?php

namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;

class Products extends Request {


	public function  __construct()
	{

	}

	public function getProducts ()
    {
        $products = Bigcommerce::getProducts();
        return $products;
    }

    public function getFeaturedProducts(array $filter)
    {
        if (!is_null($filter)) {
            $products  = Bigcommerce::getProducts($filter);
        }

        $filter = [];
        $products  = Bigcommerce::getProducts($filter);
        return $products;
    }
}

