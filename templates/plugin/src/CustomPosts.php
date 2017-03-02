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


    public function register()
    {
        // register your custom post and taxonomy here.
    }
}
