rm -rf templates/plugin/*;
cp -r templates/divi-framework-plugin-boilerplate/* templates/plugin;
cp -r templates/divi-framework-plugin-boilerplate/.circleci templates/plugin;
rm -rf templates/plugin/vendor;
rm -rf templates/plugin/composer.lock;

cd templates/plugin;
grep -rl 'Divi Framework Plugin Boilerplate' ./ | xargs sed -i "s/Divi Framework Plugin Boilerplate/{{plugin_name}}/g"
grep -rl 'Boilerplate for plugin' ./ | xargs sed -i "s/Boilerplate for plugin/{{plugin_description}}/g"
grep -rl 'WordPress plugin boilerplate using PHP namespaces.' ./ | xargs sed -i "s/WordPress plugin boilerplate using PHP namespaces./{{plugin_description}}/g"
grep -rl 'divi-framework-plugin-boilerplate' ./ | xargs sed -i "s/divi-framework-plugin-boilerplate/{{plugin_slug}}/g"
grep -rl 'divi-framework-boilerplate' ./ | xargs sed -i "s/divi-framework-boilerplate/{{plugin_slug}}/g"
grep -rl 'Divi_Framework_Plugin_Boilerplate' ./ | xargs sed -i "s/Divi_Framework_Plugin_Boilerplate/{{package_name}}/g"
grep -rl 'https://diviframework.com/author-uri' ./ | xargs sed -i "s,https://diviframework.com/author-uri,{{plugin_author_uri}},g"
grep -rl 'https://diviframework.com/plugin-uri' ./ | xargs sed -i "s,https://diviframework.com/plugin-uri,{{plugin_uri}},g"
grep -rl 'DF_VERSION' ./ | xargs sed -i "s/DF_VERSION/{{version_constant}}/g"
grep -rl 'DF_DIR' ./ | xargs sed -i "s/DF_DIR/{{dir_constant}}/g"
grep -rl 'DF_URL' ./ | xargs sed -i "s/DF_URL/{{url_constant}}/g"
grep -rl 'namespace\ DF' ./ | xargs sed -i 's,namespace\ DF,namespace\ {{namespace}},g'
grep -rl '\\DF\\Container;' divi-framework-plugin-boilerplate.php | xargs sed -i 's,\\DF\\Container;,\\{{namespace}}\\Container;,g'
grep -rl 'DF\\\\' composer.json | xargs sed -i 's,DF\\\\,{{composer_namespace}}\\\\,g'
grep -rl 'Divi Framework' ./ | xargs sed -i "s/Divi Framework/{{plugin_author}}/g"