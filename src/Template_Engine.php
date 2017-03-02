<?php
namespace DF\WP_CLI\Scaffold;

class Template_Engine
{
    protected $engine;

    public function __construct()
    {
        $this->engine = new \Mustache_Engine(array(
                    'escape' => function ($val) {
                        return $val;
                    }
                ));
    }
    /**
     * Set data to the file.
     */
    function setData($file, $data = array())
    {
        $content = file_get_contents($file);
        file_put_contents($file, $this->engine->render($content, $data));
    }

    /**
     * Transform the folder.
     */
    public function transform($folder, $data)
    {
        $iterator = new \RecursiveDirectoryIterator($folder);
        // skip dot files while iterating
        $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($files as $file) {
            $file = realpath($file);
            if (is_file($file)) {
                $this->setData($file, $data);
            }
        }
    }
}
