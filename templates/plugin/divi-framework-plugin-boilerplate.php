<?php
/**
 * Plugin Name:     {{plugin_name}}
 * Plugin URI:      {{plugin_uri}}
 * Description:     {{plugin_description}}
 * Author:          {{plugin_author}}
 * Author URI:      {{plugin_author_uri}}
 * Text Domain:     {{plugin_slug}}
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         {{package_name}}
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('{{version_constant}}', '0.1.0');
define('{{dir_constant}}', __DIR__);
define('{{url_constant}}', plugins_url('/'.basename(__DIR__)));

require_once {{dir_constant}} . '/vendor/autoload.php';

$container = \DF\Container::getInstance();
$container['plugin_name'] = '{{plugin_name}}';
$container['plugin_version'] = {{version_constant}};
$container['plugin_file'] = __FILE__;
$container['plugin_dir'] = {{dir_constant}};
$container['plugin_url'] = {{url_constant}};
$container['plugin_slug'] = '{{plugin_slug}}';

//register API license checks.
$container->registerLicense();

// activation hook.
register_activation_hook(__FILE__, array($container['activation'], 'install'));

$container->run();
