<?php

class BigCommerceActivate {
/*
Plugin Name: BigCommerceWordPress
Description: BigCommerce API helper
Version: 1.0.0
License: GPL-2.0+
*/


require_once( plugin_dir_path( __FILE__ ) . 'BigCommerceWordPress/BigCommerceWordPress/Products.php' );
Products::get_instance();

public statuc $instance = null;

public function __construct()
{
}

public function getInstance() {

	if ( null == self::$instance ) {
        	self::$instance = new self;
			return self::$instance;
		}
	}
}

register_activation_hook( __FILE__, array( 'BigCommerceActivate', 'install' ) );
