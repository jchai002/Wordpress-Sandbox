<?php
// Check if admin
if(is_admin()){
	// Add Scripts
	function jc_classy_posts_add_admin_styles(){
		wp_enqueue_style('classy-posts-admin-style', plugins_url().'/classy-posts/css/admin-styles.css');
	}

	// add the fancy wp color picker scripts
	function jc_classy_posts_add_color_picker() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'classy-posts-admin-js', plugins_url().'/classy-posts/js/admin-scripts.js', array( 'wp-color-picker' ), false, true );
	}

	// hook custom styles into admin script load
	add_action('admin_enqueue_scripts', 'jc_classy_posts_add_admin_styles');
	add_action( 'admin_enqueue_scripts', 'jc_classy_posts_add_color_picker' );
}

// add custom and zurb foundation front end styles
function jc_classy_posts_add_frontend_styles(){
	wp_enqueue_style('zurb-foundation-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.min.css');
	wp_enqueue_style('classy-posts-frontend-style', plugins_url().'/classy-posts/css/frontend-styles.css');
}

// hook styles into script load
add_action('wp_enqueue_scripts','jc_classy_posts_add_frontend_styles');
