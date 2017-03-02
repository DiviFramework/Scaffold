<?php

namespace {{namespace}};

/**
 * Admin related functionality.
 */
class Admin
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }


    /**
     * Admin init hook. Register your hooks here.
     */
    public function init()
    {
        $this->container['menu']->adminMenu();
    }
}
