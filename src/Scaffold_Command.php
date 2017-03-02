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
}
