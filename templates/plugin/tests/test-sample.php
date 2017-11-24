<?php
/**
 * Class SampleTest
 *
 * @package {{package_name}}
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase
{

    public $container;
    public $factory;

    public function __construct()
    {
        parent::__construct();
        $this->container = \{{namespace}}\Container::getInstance();
        $this->factory = new WP_UnitTest_Factory();
    }
    /**
     * A single example test.
     */
    function test_sample()
    {
        // Replace this with some actual testing code.
        $this->assertTrue(true);
    }
}
