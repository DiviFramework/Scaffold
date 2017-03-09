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

// License check.
// License setup.
// Load the API Key library if it is not already loaded. Must be placed in the root plugin file.
if (! class_exists('AM_License_Menu')) {
    require_once({{dir_constant}} . '/am-license-menu.php');
}

/**
 * @param string $file             Must be __FILE__ from the root plugin file, or theme functions file.
 * @param string $software_title   Must be exactly the same as the Software Title in the product.
 * @param string $software_version This product's current software version.
 * @param string $plugin_or_theme  'plugin' or 'theme'
 * @param string $api_url          The URL to the site that is running the API Manager. Example: https://www.toddlahman.com/
 *
 * @return \AM_License_Submenu|null
 */
$license = new AM_License_Menu(__FILE__, '{{plugin_name}}', {{version_constant}}, 'plugin', 'https://www.diviframework.com/', '', '');

require_once {{dir_constant}} . '/vendor/autoload.php';

$container = new \{{namespace}}\Container;
$container['license'] = $license;
$container['plugin_name'] = '{{plugin_name}}';

// activation hook.
register_activation_hook(__FILE__, array($container['activation'], 'install'));

$container->run();
