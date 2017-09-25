<?php
namespace BigCommerceWordPress;
use Spyc;

class Configs
{

    public function __construct()
    {
    }

    public function load()
    {
    	$file = ABSPATH . 'wp-content/plugins/gulo-solutions/BigCommerceWordPress/BigCommerceWordPress/parameters.yml';
    	$data = spyc_load_file($file);
    	return $data;
    }
}
