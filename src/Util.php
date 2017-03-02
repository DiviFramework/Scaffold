<?php
namespace DF\WP_CLI\Scaffold;

use WP_CLI;

class Util
{

    /**
     * Create the themes directory if it doesn't already exist
     */
    public function maybe_create_themes_dir()
    {

        $themes_dir = WP_CONTENT_DIR . '/themes';
        if (! is_dir($themes_dir)) {
            wp_mkdir_p($themes_dir);
        }
    }

    /**
     * Create the plugins directory if it doesn't already exist
     */
    public function maybe_create_plugins_dir()
    {

        if (! is_dir(WP_PLUGIN_DIR)) {
            wp_mkdir_p(WP_PLUGIN_DIR);
        }
    }

    /**
     * Initialize WP Filesystem
     */
    public function init_wp_filesystem()
    {
        global $wp_filesystem;
        WP_Filesystem();

        return $wp_filesystem;
    }


    public function check_target_directory($type, $target_dir)
    {
        if (realpath($target_dir)) {
            $target_dir = realpath($target_dir);
        }

        $parent_dir = dirname($target_dir);

        if ("theme" === $type) {
            if (WP_CONTENT_DIR . '/themes' === $parent_dir) {
                return true;
            }
        } elseif ("plugin" === $type) {
            if (WP_PLUGIN_DIR === $parent_dir) {
                return true;
            }
        }

        return false;
    }

    /**
     * Clone folder.
     */
    public function clone_folder($source, $dest)
    {
        if (!is_dir($dest)) {
            mkdir($dest, 0755);
        }
        
        foreach ($iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        ) as $item) {
            if ($item->isDir()) {
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }
}
