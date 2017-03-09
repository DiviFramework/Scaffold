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
     * Init hook.
     */
    public function actionInit()
    {
        $this['api']->register();
    }

    /**
     * Start the plugin
     */
    public function run()
    {
        // register custom posts
        $this['custom_posts']->register();

        add_action('init', array($this, 'actionInit'));
        add_action('admin_init', array($this['admin'], 'init'));

        // divi module register.
        add_action('et_builder_ready', array($this['divi_modules'], 'register'), 1);

        // register your shortcodes.
        $this['shortcodes']->add();

        // check for plugin dependancies.
        add_action('plugins_loaded', array($this['plugins'], 'checkDependancies'));
        add_action('plugins_loaded', array($this['themes'], 'checkDependancies'));
    }
}
