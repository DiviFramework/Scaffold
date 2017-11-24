<?php
namespace {{namespace}};

use Pimple\Container as PimpleContainer;

/**
 * DI Container.
 */
class Container extends PimpleContainer
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initObjects();
    }


    /**
     * Define dependancies.
     */
    public function initObjects()
    {
        $this['custom_posts'] = function ($container) {
            return new CustomPosts($container);
        };

        $this['activation'] = function ($container) {
            return new Activation($container);
        };

        $this['shortcodes'] = function ($container) {
            return new Shortcodes($container);
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
    }


    /**
     * Start the plugin
     */
    public function run()
    {
        // register custom posts
        $this['custom_posts']->register();

        add_action('register_shortcode_ui', array( $this['shortcake'], 'register_shortcode_ui'));

        // divi module register.
        add_action('et_builder_ready', array($this['divi_modules'], 'register'), 1);

        // register your shortcodes.
        $this['shortcodes']->add();

        // check for plugin dependancies.
        add_action('plugins_loaded', array($this['plugins'], 'checkDependancies'));
        add_action('plugins_loaded', array($this['themes'], 'checkDependancies'));
    }

    public function plugin_add_settings_link($links)
    {
        $settings_link = sprintf('<a href="%s%s">', admin_url('admin.php?page='), $this['license']->ame_activation_tab_key) . __('Settings') . '</a>';
        // dump($settings_link);
        array_push($links, $settings_link);
        return $links;
    }


    /**
     * Register license.
     */
    public function registerLicense()
    {
        // License check.
        // License setup.
        // Load the API Key library if it is not already loaded. Must be placed in the root plugin file.
        if (! class_exists('AM_License_Menu')) {
            require_once($this['plugin_dir'] . '/am-license-menu.php');
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
        $license = new \AM_License_Menu($this['plugin_file'], $this['plugin_name'], $this['plugin_version'], 'plugin', 'https://www.diviframework.com/', '', '');

        $this['license'] = $license;

        return $license;
    }
}
