<?php
namespace DF\WP_CLI\Scaffold;

use WP_CLI;

class ChildTheme_Scaffold
{
    /**
     * Scaffold child theme
     */
    function scaffold($args, $assoc_args)
    {
        $util = new Util;
        $theme_slug = $args[0];

        if (in_array($theme_slug, array( '.', '..' ))) {
            WP_CLI::error("Invalid theme slug specified.");
        }

        $data = \wp_parse_args($assoc_args, array(
            'theme_name' => ucfirst($theme_slug),
            'author'     => "Me",
            'author_uri' => "",
            'theme_uri'  => "",
            'theme_slug' => $theme_slug,
        ));
        $data['slug'] = $theme_slug;
        $data['parent_theme_function_safe'] = str_replace('-', '_', $data['parent_theme']);

        $data['description'] = ucfirst($data['parent_theme']) . " child theme.";

        $theme_dir = WP_CONTENT_DIR . "/themes" . "/$theme_slug";

        if (! $util->check_target_directory("theme", $theme_dir)) {
            WP_CLI::error("Invalid theme slug specified.");
        }

        $util->maybe_create_themes_dir();

        // copy template files to child theme folder.
        $util->clone_folder(DF_SCAFFOLD_DIR . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'child-theme', $theme_dir);

        $template_engine = new Template_Engine;
        $template_engine->transform($theme_dir, $data);

        WP_CLI::success("Created '$theme_dir'");

        if (\WP_CLI\Utils\get_flag_value($assoc_args, 'activate')) {
            WP_CLI::run_command(array( 'theme', 'activate', $theme_slug ));
        } else if (\WP_CLI\Utils\get_flag_value($assoc_args, 'enable-network')) {
            WP_CLI::run_command(array( 'theme', 'enable', $theme_slug ), array( 'network' => true ));
        }
    }
}
