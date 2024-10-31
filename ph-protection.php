<?php
/*
 * Plugin Name: Proxy Hacking Protection
 * Plugin URI: http://psn.hatenablog.jp/entry/proxy-hacking-protection
 * Description: Proxy Hacking Protection (WordPress Plugin)
 * Version: 0.0.1
 * Author: Pocket Systems
 * Author URI: http://psn.hatenablog.jp/entry/proxy-hacking-protection
 */
//define( 'PHPROT_DEBUG', true );

define( 'PHPROT_MENU_SLUG', 'phprot_setting_menu' );

define( 'PHPROT_PLUGIN', __FILE__ );

if ( defined( 'PHPROT_DEBUG' ) && PHPROT_DEBUG ) {
	define( 'PHPROT_DEBUG_HOMEURL', 'http://example.com/' );
	define( 'PHPROT_PLUGIN_BASENAME', 'ph-protection/ph-protection.php' );
} else {
	define( 'PHPROT_PLUGIN_BASENAME', plugin_basename( PHPROT_PLUGIN ) );
}

define( 'PHPROT_PLUGIN_NAME', trim( dirname( PHPROT_PLUGIN_BASENAME ), '/' ) );
define( 'PHPROT_PLUGIN_DIR', untrailingslashit( dirname( PHPROT_PLUGIN ) ) );

if ( is_admin() ) {
	include_once ( 'admin-settings.php' );
	/* Add settings link on plugin page */
	$prefix = is_network_admin() ? 'network_admin_' : '';
	add_filter( "{$prefix}plugin_action_links_" . PHPROT_PLUGIN_BASENAME, 'add_action_links' );
	function add_action_links( $links ) {
		$mylinks = array(
				'<a href="' . admin_url( 'options-general.php?page=' . PHPROT_MENU_SLUG ) . '">Settings</a>'
		);
		return array_merge( $mylinks, $links );
	}
}

// スクリプト埋め込み
/*
 * function my_scripts() {
 * wp_enqueue_script( '', plugins_url( '/src.js', __FILE__ ), array(), false, true );
 * }
 * add_action( 'wp_enqueue_scripts', 'my_scripts');
 */
function ph_prot_inject() {
	include ( 'ph-prot-main.php' );
}
add_action( 'wp_footer', 'ph_prot_inject' );
