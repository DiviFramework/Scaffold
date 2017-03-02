<?php
namespace DF\WP_CLI\Scaffold;

use WP_CLI;

class Plugin_Scaffold
{

    /**
     * Scaffold the plugin.
     */
    function scaffold($args, $assoc_args)
    {
        $util = new Util;

        $plugin_slug    = $args[0];
        $plugin_name    = ucwords(str_replace('-', ' ', $plugin_slug));
        $plugin_package = str_replace(' ', '_', $plugin_name);

        if (in_array($plugin_slug, array( '.', '..' ))) {
            WP_CLI::error("Invalid plugin slug specified.");
        }

        $data = wp_parse_args($assoc_args, array(
            'plugin_slug'         => $plugin_slug,
            'plugin_name'         => $plugin_name,
            'plugin_package'      => $plugin_package,
            'plugin_description'  => 'PLUGIN DESCRIPTION HERE',
            'plugin_author'       => 'YOUR NAME HERE',
            'plugin_author_uri'   => 'YOUR SITE HERE',
            'plugin_uri'          => 'PLUGIN SITE HERE',
            'namespace' => 'YOUR\PLUGIN_NAMESPACE',
            'plugin_tested_up_to' => get_bloginfo('version'),
            'version_constant' => 'PLUGIN_VERSION',
            'dir_constant' => 'PLUGIN_DIR',
            'url_constant' => 'PLUGIN_URL',
        ));

        $data['composer_namespace'] = str_replace('\\', '\\\\', $data['namespace']);



        $data['textdomain'] = $plugin_slug;

        if (! empty($assoc_args['dir'])) {
            if (! is_dir($assoc_args['dir'])) {
                WP_CLI::error("Cannot create plugin in directory that doesn't exist.");
            }
            $plugin_dir = $assoc_args['dir'] . "/$plugin_slug";
        } else {
            $plugin_dir = WP_PLUGIN_DIR . "/$plugin_slug";
            $util->maybe_create_plugins_dir();

            if (! $util->check_target_directory("plugin", $plugin_dir)) {
                WP_CLI::error("Invalid plugin slug specified.");
            }
        }

        $plugin_path = "$plugin_dir/$plugin_slug.php";
        $plugin_readme_path = "$plugin_dir/readme.txt";

        // copy template files to plugin folder.
        $util->clone_folder(DF_SCAFFOLD_DIR . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'plugin', $plugin_dir);

        rename($plugin_dir . DIRECTORY_SEPARATOR . 'divi-framework-plugin-boilerplate.php', $plugin_dir . DIRECTORY_SEPARATOR . $plugin_slug . '.php');

        $template_engine = new Template_Engine;
        $template_engine->transform($plugin_dir, $data);

        WP_CLI::line('');
        WP_CLI::success('Plugin files created. Running composer install.');
        WP_CLI::line('');
        
        exec("cd $plugin_dir; composer install");

        if (\WP_CLI\Utils\get_flag_value($assoc_args, 'activate')) {
            WP_CLI::run_command(array( 'plugin', 'activate', $plugin_slug ));
        } else if (\WP_CLI\Utils\get_flag_value($assoc_args, 'activate-network')) {
            WP_CLI::run_command(array( 'plugin', 'activate', $plugin_slug), array( 'network' => true ));
        }
    }
}
