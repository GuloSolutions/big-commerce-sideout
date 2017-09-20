<?php
namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use Stash;

class Products
{
    public $driver;
    public $pool;

    public function __construct()
    {
        $this->driver = new Stash\Driver\FileSystem(array());
        $this->pool = new Stash\Pool($this->driver);
    }

    public function getProducts()
    {
        $item = $this->pool->getItem('results');

        $data = $item->get();

        if($item->isMiss()){
            $data = Bigcommerce::getProducts();
            $this->pool->save($item->set($data));
        }

        return $data;
    }

    public function getFeaturedProducts()
    {
        $item = $this->pool->getItem('featured_results');

        $data = $item->get();

         if($item->isMiss()){
            $data = Bigcommerce::getProducts(["is_featured" => "true"]);
            $this->pool->save($item->set($data));
        }

        return $data;
    }

    public function getSetNumberProducts(integer $length)
    {
        $filter = [];
        if (!is_null($length)) {
            $filter = ["limit" => $length];
        }

        $products  = Bigcommerce::getProducts($filter);
        return $products;
    }
}
