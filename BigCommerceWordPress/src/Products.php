<?php
namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use Stash;

class Products extends Request
{
    public $driver;
    public $pool;
    public $cache;
    public $expiration;
    //const CACHE_EXPIRE = 86400;
    const  CACHE_EXPIRE = 3600;

    public function __construct()
    {
        $this->driver = new Stash\Driver\FileSystem(array());
        $this->pool = new Stash\Pool($this->driver);
        $this->expiration = self::CACHE_EXPIRE;
        $this->cache = true;
    }

    public function getProducts()
    {
        if ($this->returnCache() === true) {
            $this->item = $this->pool->getItem('results');

            $data = $this->item->get();

            if ($data === false) {
                $data = Bigcommerce::getProducts();
                $this->pool->save($this->item->set($data));
                $this->setExpiration();
                return $data;
            }
        } else {
            $data = Bigcommerce::getProducts();
            return $data;
        }
    }

    public function getFeaturedProducts()
    {
        if ($this->returnCache() === true) {
            $this->item = $this->pool->getItem('featured_results');

            $data = $this->item->get();

            if ($data === false) {
                $data = Bigcommerce::getProducts(["is_featured" => true]);
                $this->pool->save($this->item->set($data));
                $this->setExpiration();
                return $data;
            } else {
                $data = Bigcommerce::getProducts(["is_featured" => "true"]);
                return $data;
            }
        }
    }

    public function getSetNumberProducts(integer $length)
    {
        if (!is_null($length)) {
            $filter = ["limit" => $length];
        }

        $products  = Bigcommerce::getProducts($filter);
        return $products;
    }

    public function setExpiration()
    {
        $this->item->expiresAfter($this->expiration);
    }

    public function enableCache()
    {
        $this->cache = true;
    }

    public function disableCache()
    {
        $this->cache = false;
    }

    public function returnCache()
    {
        return $this->cache;
    }

    /*
     * delete entire cache
     * @return void
     */

    public function deleteAllCache()
    {
        $this->pool->clear();
    }
}
