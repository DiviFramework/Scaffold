<?php
namespace DF\WP_CLI\Scaffold;

use WP_CLI_Command;
use WP_CLI;

/**
 * Generate code for plugins, child themes. etc using modern PHP techniques.
 *
 * ## EXAMPLES
 *
 *     # Generate a new plugin with unit tests
 *     $ wp df-scaffold plugin sample-plugin --plugin_name="Sample Plugin" --plugin_package=Sample_Plugin  --plugin_description="My Sample Plugin"  --plugin_author="Me" --plugin_author_uri="http://me.example.com"   --plugin_uri="http://plugin.example.com"   --namespace="My\SamplePlugin" --version_constant=SAMPLE_PLUGIN_VERSION --dir_constant=SAMPLE_PLUGIN_DIR --url_constant=SAMPLE_PLUGIN_URL
 *     Success: Created plugin files.
 *     Success: Created test files.
 *
 *     # Generate theme based on _s
 *     $ wp scaffold _s sample-theme --theme_name="Sample Theme" --author="John Doe"
 *     Success: Created theme 'Sample Theme'.
 *
 *     # Generate code for post type registration in given theme
 *     $ wp scaffold post-type movie --label=Movie --theme=simple-life
 *     Success: Created /var/www/example.com/public_html/wp-content/themes/simple-life/post-types/movie.php
 *
 * @package wp-cli
 */
class Scaffold_Command extends WP_CLI_Command
{


    public function plugin($args, $assoc_args)
    {
        $pluginScaffold = new Plugin_Scaffold;
        $pluginScaffold->scaffold($args, $assoc_args);
    }

    /**
     * Generate child theme based on an existing theme.
     *
     * Creates a child theme folder with `functions.php` and `style.css` files.
     *
     * ## OPTIONS
     *
     * <slug>
     * : The slug for the new child theme.
     *
     * --parent_theme=<slug>
     * : What to put in the 'Template:' header in 'style.css'.
     *
     * [--theme_name=<title>]
     * : What to put in the 'Theme Name:' header in 'style.css'.
     *
     * [--author=<full-name>]
     * : What to put in the 'Author:' header in 'style.css'.
     *
     * [--author_uri=<uri>]
     * : What to put in the 'Author URI:' header in 'style.css'.
     *
     * [--theme_uri=<uri>]
     * : What to put in the 'Theme URI:' header in 'style.css'.
     *
     * [--activate]
     * : Activate the newly created child theme.
     *
     * [--enable-network]
     * : Enable the newly created child theme for the entire network.
     *
     * [--force]
     * : Overwrite files that already exist.
     *
     * ## EXAMPLES
     *
     *     # Generate a 'sample-theme' child theme based on TwentySixteen
     *     $ wp df-scaffold child-theme acme-theme --theme_name="Acme Theme "  --author="Acme" --author_uri="http://acme.example.com"  --parent_theme=Divi --theme_uri=http://elegantthemes.com
     *     Success: Created '/var/www/example.com/public_html/wp-content/themes/sample-theme'.
     *
     * @subcommand child-theme
     */
    function child_theme($args, $assoc_args)
    {
        $childThemeScaffold = new ChildTheme_Scaffold;
        $childThemeScaffold->scaffold($args, $assoc_args);
    }
}
