<?php

namespace {{namespace}};

/**
 * Class defines custom post types.
 */
class CustomPosts
{
    
    protected $container;

    private $label, $args;

    public function __construct($container)
    {
        $this->container = $container;
    }


    // register your custom post and taxonomy here.
    public function register()
    {
        $postsDir = {{dir_constant}} . '/post-types';
        $taxonomiesDir = {{dir_constant}} . '/taxonomies';

        $this->includeFiles($postsDir);
        $this->includeFiles($taxonomiesDir);
    }

    /**
     * Include files from the directory.
     */
    public function includeFiles($dir)
    {
        if (is_dir($dir)) {
            foreach (glob($dir . "/*.php") as $file) {
                include $file;
            }
        }
    }
}
