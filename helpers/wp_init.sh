# WP CLI Run Script
# wp_init.sh
# Author: 	John Himics
# URL:		JohnHimics.com

#cd to the site root
cd /var/www/public/{projectfolder}

#create database
mysql -uroot -proot  -e "CREATE DATABASE {projectfolder};"
mysql -uroot -proot {projectfolder} -e "GRANT ALL PRIVILEGES ON {projectfolder}.* TO \"{projectfolder}\"@\"localhost\" IDENTIFIED BY \"{projectfolder}\";"
mysql -uroot -proot {projectfolder} -e "FLUSH PRIVILEGES;"

##copy the wp-config file
cp wp-content/themes/{projectfolder}/helpers/wp-config-local.php wp-config-local.php
cp wp-config-local.php wp-config.php

##install
#wp core install --url="http://fad.local/{projectfolder}" --title="Site Title" --admin_user="fad-admin" --admin_password="D4d843B9ZsVoAsgy" --admin_email="info@firstascentdesign.com"

#Copy over the database from Staging Boilerplate instead.
mkdir tmp/
scp poof@165.227.116.120:/var/www/firstascentstaging.com/public_html/fadboilerplate/tmp/stagingboilerplate.sql tmp/stagingboilerplate.sql
wp db import tmp/stagingboilerplate.sql

## Replace the mentions of the boilerplate site url in the db
wp search-replace "firstascentstaging.com/fadboilerplate" "fad.local/{projectfolder}" --skip-columns=guid

## Update URL from the imported database
wp option update url "http://fad.local/{projectfolder}"

## Update Site Title from the imported database
wp option update title "Site Title"

## remove tagline by default
wp option update blogdescription ""

## Update the core
wp core update

## set rewrite structure
wp rewrite structure '/%postname%/'

## activate the theme
wp theme activate {projectfolder}

## set options
#   Usage
#   wp option add my_option foobar
#   wp option update my_option foobar
#   Common Options
#     siteurl
#     home
#     blogname
#     blogdescription
#     mailserver_url		mail.example.com
#     mailserver_login		login@example.com
#     mailserver_pass		password
#     mailserver_port		110
#     posts_per_page		10
#     current_theme
#     thumbnail_size_w		150
#     thumbnail_size_h		150
#     thumbnail_crop		1
#     medium_size_w			300
#     medium_size_h			300
#     avatar_default		mystery
#     large_size_w			1024
#     large_size_h			1024
#     medium_large_size_w	768
#     medium_large_size_h	0
#     page_for_posts		16
#     page_on_front			14

## Set the Front page and Blog Page
wp option update page_on_front $(wp post list --post_title="Front Page" --fields=ID --format=ids)
wp option update page_for_posts $(wp post list --post_title="Blog" --fields=ID --format=ids)

## Install Plugins from WordPress.org via WP CLI
wp plugin install aryo-activity-log
wp plugin install backwpup
wp plugin isntall block-options
wp plugin install bulk-block-converter
wp plugin install duplicate-post
wp plugin install easy-wp-smtp
wp plugin install kadence-blocks
wp plugin install ninja-forms
wp plugin install redirection
wp plugin install regenerate-thumbnails
wp plugin install simply-show-hooks
wp plugin install show-current-template
wp plugin install tiny-compress-images
wp plugin install tinymce-advanced
wp plugin install w3-total-cache
wp plugin install white-label-cms
wp plugin install wordfence
wp plugin install wp-admin-ui-customize
wp plugin install wp-rollback
wp plugin install wps-hide-login
wp plugin install wordpress-seo
wp plugin install acf-content-analysis-for-yoast-seo

## Plugins we don't use that often anymore. Not on by default.
# wp plugin install jetpack
# wp plugin install wp-example-content
# wp plugin install wp-help

## Install Plugins from FA Repository
# How to download from Google Drive
# https://medium.com/@acpanjan/download-google-drive-files-using-wget-3c2c025a8b99
# wget --load-cookies /tmp/cookies.txt "https://docs.google.com/uc?export=download&confirm=$(wget --quiet --save-cookies /tmp/cookies.txt --keep-session-cookies --no-check-certificate 'https://docs.google.com/uc?export=download&id=[FILEID]' -O- | sed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')&id=[FILEID]" -O [FILENAME] && rm -rf /tmp/cookies.txt
cd /var/www/public/{projectfolder}/wp-content/plugins/
wget --load-cookies /tmp/cookies.txt "https://docs.google.com/uc?export=download&confirm=$(wget --quiet --save-cookies /tmp/cookies.txt --keep-session-cookies --no-check-certificate 'https://docs.google.com/uc?export=download&id=1xBy-tOHbzQc468en9Zedm5htgt-ITMHI' -O- | sed -rn 's/.*confirm=([0-9A-Za-z_]+).*/\1\n/p')&id=1xBy-tOHbzQc468en9Zedm5htgt-ITMHI" -O payload.zip && rm -rf /tmp/cookies.txt
unzip payload.zip
rm payload.zip
cd /var/www/public/{projectfolder}

## Activate Plugins
# These are the development plugin to activate
# wp plugin activate aryo-activity-log
wp plugin activate backwpup
wp plugin activate block-options
wp plugin activate bulk-block-converter
wp plugin activate duplicate-post
# wp plugin activate easy-wp-smtp
# wp plugin activate kadence-blocks
wp plugin activate ninja-forms
# wp plugin activate redirection
wp plugin activate regenerate-thumbnails
wp plugin activate simply-show-hooks
wp plugin activate show-current-template
wp plugin activate tiny-compress-images
wp plugin activate tinymce-advanced
# wp plugin activate w3-total-cache
# wp plugin activate white-label-cms
# wp plugin activate wordfence
# wp plugin activate wp-admin-ui-customize
wp plugin activate wp-rollback
# wp plugin activate wps-hide-login
wp plugin install wordpress-seo
wp plugin install acf-content-analysis-for-yoast-seo
# From the payload
wp plugin activate admin-columns-pro
wp plugin activate ac-addon-buddypress
wp plugin activate ac-addon-events-calendar
wp plugin activate ac-addon-ninjaforms
wp plugin activate ac-addon-pods
wp plugin activate ac-addon-types
wp plugin activate advanced-custom-fields-pro
wp plugin activate cac-addon-acf
wp plugin activate cac-addon-woocommerce
wp plugin activate google-analytics-premium
wp plugin activate ninja-forms-addon-manager
wp plugin activate ninja-forms-conditionals
wp plugin activate ninja-forms-multi-part
wp plugin activate ninja-forms-save-progress
wp plugin activate ninja-forms-style
wp plugin activate ninja-forms-uploads
wp plugin activate ninja-forms-white-label
wp plugin activate wp-media-folder
wp plugin activate wp-media-folder-addon

## update plugins
wp plugin update --all

## Create Custom Post Types
#   Usage
#   wp scaffold post-type <cpt_name> <--theme OR --plugin=pluginname>
# wp scaffold post-type our_stories --theme
# wp scaffold post-type press --theme

##Create Test Posts for the Post Types
#


## Launch Stuff
#

## Search/replace to a SQL file without transforming the database
# wp search-replace foo bar --export=database.sql
