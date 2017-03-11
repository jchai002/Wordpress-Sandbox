<?php
function jc_classy_posts_add_metabox(){
	add_meta_box(
		'jc_classy_posts_fields',
		__('Classification Fields'),
		'jc_classy_posts_fields_callback',
		'post',
		'normal',
		'default'
	);
}

// wrap this add_action into a function so it can be ran multiple times
function jc_classy_posts_metabox_setup() {
	add_action('add_meta_boxes', 'jc_classy_posts_add_metabox');
}

// display metabox content
function jc_classy_posts_fields_callback($post){
	wp_nonce_field(basename(__FILE__), 'jc_classy_posts_nonce');
	$difficulty = get_post_meta($post->ID)['difficulty'][0];
  $time = get_post_meta($post->ID)['time'][0];
  $cost = get_post_meta($post->ID)['cost'][0];
  $vegan_friendly = get_post_meta($post->ID)['vegan_friendly'][0];
	// this file saves html into the $metabox variable
	require_once(plugin_dir_path(__FILE__) . 'templates/metabox.php');
	echo $metabox;
}

function jc_classy_posts_save($post_id){
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = (isset($_POST['jc_classy_posts_nonce']) && wp_verify_nonce($_POST['jc_classy_posts_nonce'], basename(__FILE__)))? 'true' : 'false';

	// don't want to update posts on autosave or revision, only intentional saves
	if($is_autosave || $is_revision || !$is_valid_nonce){
		return;
	}

	if(isset($_POST['difficulty'])){
		update_post_meta($post_id, 'difficulty', sanitize_text_field($_POST['difficulty']));
	}

	if(isset($_POST['time'])){
		update_post_meta($post_id, 'time', sanitize_text_field($_POST['time']));
	}

	if(isset($_POST['cost'])){
		update_post_meta($post_id, 'cost', sanitize_text_field($_POST['cost']));
	}

	update_post_meta($post_id, 'vegan_friendly', $_POST['vegan_friendly']);

}

// add plugin functions to action hooks
add_action( 'load-post.php', 'jc_classy_posts_metabox_setup' );
add_action( 'load-post-new.php', 'jc_classy_posts_metabox_setup' );
add_action('save_post', 'jc_classy_posts_save');
