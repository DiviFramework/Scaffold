<?php

if (! class_exists('WP_CLI')) {
    return;
}

define('DF_SCAFFOLD_DIR', __DIR__);

WP_CLI::add_command('df-scaffold', '\\DF\\WP_CLI\\Scaffold\\Scaffold_Command');
