<?php
namespace {{namespace}};

use DiviFramework\UpdateChecker\PluginLicense;
use Pimple\Container as PimpleContainer;

/**
 * DI Container.
 */
class Container extends PimpleContainer {
	public static $instance;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->initObjects();
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new Container;
		}

		return self::$instance;
	}

	/**
	 * Define dependancies.
	 */
	public function initObjects() {
		$this['custom_posts'] = function ($container) {
			return new CustomPosts($container);
		};

		$this['activation'] = function ($container) {
			return new Activation($container);
		};

		$this['shortcodes'] = function ($container) {
			return new Shortcodes($container);
		};

		$this['shortcake'] = function ($container) {
			return new Shortcake($container);
		};

		$this['api'] = function ($container) {
			return new API($container);
		};

		$this['admin'] = function ($container) {
			return new Admin($container);
		};

		$this['menu'] = function ($container) {
			return new Menu($container);
		};

		$this['divi_modules'] = function ($container) {
			return new DiviModules($container);
		};

		$this['plugins'] = function ($container) {
			return new Plugins($container);
		};

		$this['themes'] = function ($container) {
			return new Themes($container);
		};

		$this['license'] = function ($container) {
			return new PluginLicense($container, 'https://www.diviframework.com');
		};
	}

	/**
	 * Start the plugin
	 */
	public function run() {
		include_once $this['plugin_dir'] . '/libraries/TGM-Plugin-Activation-2.6.1/class-tgm-plugin-activation.php';
		add_action('tgmpa_register', array($this['plugins'], 'register_required_plugins'));
		// register custom posts
		$this['custom_posts']->register();

		add_action('register_shortcode_ui', array($this['shortcake'], 'register_shortcode_ui'));

		// divi module register.
		add_action('et_builder_ready', array($this['divi_modules'], 'register'), 1);

		// register your shortcodes.
		add_action('init', array($this['shortcodes'], 'register'));

		add_action('plugins_loaded', array($this['themes'], 'checkDependancies'));

		$this['license']->init();
	}

}
