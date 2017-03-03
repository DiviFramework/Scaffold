#Divi Framework Scaffolding Tool using WP CLI.


##Installation
**wp package install diviframework/scaffold** (package is gone for approval so I am not sure what the final slug will be)


##Plugin Scaffold
**wp df-scaffold plugin sample-plugin --plugin_name="Sample Plugin" --plugin_package=Sample_Plugin  --plugin_description="My Sample Plugin"  --plugin_author="Me" --plugin_author_uri="http://me.example.com"   --plugin_uri="http://plugin.example.com"   --namespace="My\SamplePlugin" --version_constant=SAMPLE_PLUGIN_VERSION --dir_constant=SAMPLE_PLUGIN_DIR --url_constant=SAMPLE_PLUGIN_URL**

The above command will created plugin from the boilerplate and do a composer install.


##Custom post type within the plugin.
**wp scaffold post-type movies --label=Movie --textdomain=sample-plugin --plugin=sample-plugin**

Here we use the standard wp scaffold command to scaffold post type. Make sure the plugin slug argument is included (--plugin=)


##Custom taxonomy within the plugin.
**wp scaffold taxonomy movie_taxonomy --post_types=movies --plugin=sample-plugin**

Here we use the standard wp scaffold command to scaffold taxonomy. Make sure the plugin slug argument is included (--plugin=)


##Child Theme
**wp df-scaffold child-theme acme-theme --theme_name="Acme Theme "  --author="Acme" --author_uri="http://acme.example.com"  --parent_theme=Divi --theme_uri=http://elegantthemes.com**

This command will created a child theme based off https://github.com/elegantthemes/divi-child-theme-init/