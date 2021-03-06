<?php

namespace {{namespace}};

/**
 * Activation class.
 */
class Activation {

	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}

	/**
	 * Plugin activation.
	 */
	public function install() {
		$this->container['license']->init(); //License init while activating.

		//Custom Post Types
		$this->container['custom_posts']->register();
		flush_rewrite_rules();
	}
}
