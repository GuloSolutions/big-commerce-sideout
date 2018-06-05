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
    const CACHE_EXPIRE = 86400;

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
            try {
                $data = $this->item->get();
            } catch (Exception $e) {
                error_log(print_r($e), true);
            }

            if ($data === false) {
                try {
                    $data = Bigcommerce::getProducts();
                    if (!$data) {
                        $this->checkForError();
                    }
                } catch (Exception $e) {
                    error_log(print_r($e), true);
                }
                $this->pool->save($this->item->set($data));
                $this->setExpiration();
                return $data;
            }
        } else {
            try {
                $data = Bigcommerce::getProducts();
                if (!$data) {
                    $this->checkForError();
                }
            } catch (Exception $e) {
                error_log(print_r($e), true);
            }

            return $data;
        }
    }

    public function getFeaturedProducts()
    {
        if ($this->returnCache() === true) {
            $this->item = $this->pool->getItem('featured_results');

            $data = $this->item->get();

            if ($data === false) {
                try {
                    $data = Bigcommerce::getProducts(["is_featured" => true]);
                    if (!$data) {
                        $this->checkForError();
                    }
                } catch (Exception $e) {
                    error_log(print_r($e), true);
                }
                $this->pool->save($this->item->set($data));
                $this->setExpiration();
                return $data;
            } else {
                try {
                    $data = Bigcommerce::getProducts(["is_featured" => "true"]);
                    if (!$data) {
                        $this->checkForError();
                    }
                } catch (Exception $e) {
                    error_log(print_r($e), true);
                }
                return $data;
            }
        }
    }

    public function getSetNumberProducts($length)
    {
        if (!is_null($length) && is_int($length)) {
            $filter = ["limit" => $length];
        }

        try {
            $products  = Bigcommerce::getProducts($filter);
            if (!$products) {
                $this->checkForError();
            }
        } catch (Exception $e) {
            error_log(print_r($e), true);
        }

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

    public function checkForError()
    {
        $error = Bigcommerce::getLastError();
        if ($error) {
            error_log(print_r($error->code), true);
            error_log(print_r($error->message), true);
        }
    }
}
