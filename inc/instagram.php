<?php
/**
 * Instragram Basic Display API
 *
 * Note: This only works with an already valid (not expired) access token.
 *
 * Requirements:
 * Requires that instagram-cache.json exists in the theme root directory.
 * Requires valid access_token in the json ({"access_token":"..."})
 *
 * The job is set to renew the token if now renew date is given.
 * When the token is renewed, the the renew date will be half of the renew time
 * returned by instagram.
 *
 * If a renewal fails, the same cache will remain and FAD will be notified.
 *
 * @link https://developers.facebook.com/docs/instagram-basic-display-api/getting-started
 */

// To ensure WP Cron is running with cache and cdn. SSH into server and run:
// crontab -e
// 0 * * * * /usr/local/bin/wp --path='/var/www/website.root/public_html' cron event run fad_instagram_cron_get_posts_hook

if ( ! wp_next_scheduled( 'fad_instagram_cron_get_posts_hook' ) ) {
    wp_schedule_event( time(), 'hourly', 'fad_instagram_cron_get_posts_hook' );
}

// Remove Cron on theme switch
add_action( 'switch_theme', 'fad_instagram_remove_cron' );
function fad_instagram_remove_cron () {
    $timestamp = wp_next_scheduled( 'fad_instagram_cron_get_posts_hook' );
    wp_unschedule_event( $timestamp, 'fad_instagram_cron_get_posts_hook' );
}

function fad_instagram_cron_log($message) {
    if (defined('FAD_CRON_DEBUG') && false === FAD_CRON_DEBUG) {
        return;
    }

    if(is_array($message)) {
        $message = json_encode($message);
    }
    // Use .txt log extension to avoid debug flags.
    $file = fopen( get_template_directory() . '/instagram-cache-log.txt', 'a' );
    echo fwrite( $file, "\n" . date('Y-m-d h:i:s') . " :: " . $message);
    fclose($file);
}

/**
 * Get posts from instagram using credentials in the json.
 *
 * Main function.
 */
add_action( 'fad_instagram_cron_get_posts_hook', 'fad_instagram_cron_get_posts' );
function fad_instagram_cron_get_posts() {
    fad_instagram_cron_log( "Getting posts" );
    $cache = file_get_contents( get_template_directory() . '/instagram-cache.json' );
    $cache_json = json_decode( $cache, true );

    // Check if the access token has expired. Renew if necessary.
    if ( !isset($cache_json['access_token_renew']) || time() >= $cache_json['access_token_renew'] ) {
        $new_creds = fad_instagram_renew_access_token( $cache_json );

        // If there was a failure, stop the process and keep the same cache as a fallback.
        if ( empty($new_creds['access_token']) ) return;

        $cache_json['access_token'] = $new_creds['access_token'];
        $cache_json['access_token_renew'] = $new_creds['access_token_renew'];
    }

    // Setup endpoint
    $access_token = $cache_json['access_token'];
    $fields = 'id,caption,media_type,media_url,username,timestamp,permalink';
    $insta_endpoint = 'https://graph.instagram.com/me/media/?fields='.$fields.'&access_token='.$access_token;

    // Make request Instagram API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $insta_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json') );

    $response = curl_exec($ch);
    curl_close($ch);

    // Parse the response.
    $response_json = json_decode( $response, true );
    fad_instagram_cron_log( "Response" . $response_json );
    $cache_json['data'] = $response_json['data'];
    $cache_json['paging'] = $response_json['paging'];
    $cache_json['last_pull'] = time();

    // Write the results to back json file.
    $fp = fopen( get_template_directory() . '/instagram-cache.json', 'w' );
    fwrite( $fp, json_encode( $cache_json ) );
    fclose( $fp );
    fad_instagram_cron_log( "Updated cache file" );
}


// Renew Instagram access tokens.
function fad_instagram_renew_access_token( $cache_json ) {
    fad_instagram_cron_log( "Renewing access token..." );

    // Setup the return structure
    $result = array(
        'access_token' => '',
        'access_token_renew' => ''
    );

    // Setup endpoint
    $access_token = $cache_json['access_token'];
    $endpoint = 'https://graph.instagram.com/refresh_access_token';
    $grant_type = 'ig_refresh_token';
    $request = $endpoint.'?grant_type='.$grant_type.'&access_token='.$access_token;

    // Make request Instagram API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json') );

    $response = curl_exec($ch);
    curl_close($ch);

    // Parse the response.
    $response_json = json_decode( $response, true );
    if ( !empty( $response_json['access_token'] ) ) {
        fad_instagram_cron_log( "Renewal successful" );

        // Log response - only for debugging.
        // fad_instagram_cron_log( "Response: " . $response_json );

        $result['access_token'] = $response_json['access_token'];

        $expires_in = (int) $response_json['expires_in'];
        $result['access_token_renew'] = time() + ($expires_in / 2);
    } else {
        fad_instagram_cron_log( "Renewal failed" );
        $to = 'dev-team@firstascentdesign.com';
        $subject = 'Instagram renewal failed for ' . get_bloginfo( 'name' );
        $message = "The Instagram auto-renewal has failed. Please check the logs for more information. " . get_home_url();
        try {
            wp_mail($to, $subject, $message );
        } catch (\Exception $e) {
            fad_instagram_cron_log( "Notification email failed to send" );
        }
    }

    return $result;
}
