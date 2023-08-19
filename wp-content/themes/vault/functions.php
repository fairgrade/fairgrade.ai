<?php

/**
 * uicore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uicore-theme
 */
defined('ABSPATH') || exit;

//Global Constants
define('UICORE_THEME_VERSION', '1.1.4');
define('UICORE_THEME_NAME', 'Vault');
define('UICORE_FRAMEWORK_VERSION', '4.1.4');


$uicore_includes = array(
	'/setup.php',
	'/default.php',
	'/template-tags.php',
	'/plugin-activation.php'
);

foreach ($uicore_includes as $file) {
	require_once get_template_directory() . '/inc' . $file;
}


//Required
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}
if ( is_singular() ) {
	wp_enqueue_script( "comment-reply" );
}

add_filter('uicore_settings_default_front', 'uicore_default_front_options');
function uicore_default_front_options($default) {
	$settings = [
		'logo'						=> 'https://vault.uicore.co/software/wp-content/uploads/sites/11/2022/05/Vault-Logo.webp',
		'fav'						=> 'https://vault.uicore.co/software/wp-content/uploads/sites/11/2022/05/Vault-Favicon.png',
	];
	return wp_parse_args($settings, $default);
}

//disable element pack self update
function uicore_disable_plugin_updates( $value ) {

    $pluginsToDisable = [
        'bdthemes-element-pack/bdthemes-element-pack.php',
        'metform-pro/metform-pro.php'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($pluginsToDisable as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'uicore_disable_plugin_updates' );