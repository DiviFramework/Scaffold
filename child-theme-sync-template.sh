rm -rf templates/child-theme/*;
cp -r templates/divi-child-theme-init/* templates/child-theme;

cd templates/child-theme;
grep -rl 'Theme Name:\ \ \ Divi Child Theme' ./ | xargs sed -i "s/Theme Name:\ \ \ Divi Child Theme/Theme Name:\ \ \ {{theme_name}}/g"
grep -rl 'Theme URI:\ \ \ \ http://elegantthemes.com/' ./ | xargs sed -i "s,Theme URI:\ \ \ \ http://elegantthemes.com/,Theme URI:\ \ \ \ {{theme_uri}},g"
grep -rl 'Description:\ \ Divi Child Theme' ./ | xargs sed -i "s,Description:\ \ Divi Child Theme,Description:\ \ {{description}},g"
grep -rl 'Author:\ \ \ \ \ \ \ ElegantThemes' ./ | xargs sed -i "s,Author:\ \ \ \ \ \ \ ElegantThemes,Author:\ \ \ \ \ \ \ {{author}},g"
grep -rl 'Author URI:\ \ \ http://elegantthemes.com' ./ | xargs sed -i "s,Author URI:\ \ \ http://elegantthemes.com,Author URI:\ \ \ {{author_uri}},g"
grep -rl 'Template:\ \ \ \ \ Divi' ./ | xargs sed -i "s,Template:\ \ \ \ \ Divi,Template:\ \ \ \ \ {{parent_theme}},g"
grep -rl 'divi-child-theme-init' ./ | xargs sed -i "s,divi-child-theme-init,{{theme_slug}},g"
grep -rl 'divi-child-theme' ./ | xargs sed -i "s,divi-child-theme,{{theme_slug}},g"
