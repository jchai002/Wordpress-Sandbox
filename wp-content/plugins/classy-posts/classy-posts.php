<?php
/**
* Plugin Name: Classy Posts
* Description: post classification plugin
* Version: 1.0
* Author: Jerry Chai
*
**/

// exit if accessed directly
if(!defined('ABSPATH')){
	exit;
}
// global options variable
$jc_classy_posts_options = get_option('jc_classy_posts_settings');

// load plugin scripts and styles
require_once(plugin_dir_path(__FILE__) . 'inc/classy-posts-scripts.php');

// load display box
require_once(plugin_dir_path(__FILE__) . 'inc/classy-posts-frontend-display.php');

// check if admin backend is loaded
if(is_admin()){
	// load settings setup
	require_once(plugin_dir_path(__FILE__) . 'inc/classy-posts-settings.php');

	// load custom fields metabox
	require_once(plugin_dir_path(__FILE__) . 'inc/classy-posts-metabox.php');
}
