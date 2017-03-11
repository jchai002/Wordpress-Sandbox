<?php
// create the frontend display
function jc_classy_posts_display($content) {

  // Init Options Global
  global $jc_classy_posts_options;
  global $post;
  $background_color = $jc_classy_posts_options['background_color'];
  $difficulty = get_post_meta($post->ID)['difficulty'][0];
  $time = get_post_meta($post->ID)['time'][0];
  $cost = get_post_meta($post->ID)['cost'][0];
  $vegan_friendly = get_post_meta($post->ID)['vegan_friendly'][0] ? true : false;

  // if any of the custom meta info exist
  if($difficulty || $time || $cost || $vegan_friendly) {
    // this file saves html into the $display_box variable
    require_once(plugin_dir_path(__FILE__) . 'templates/display-box.php');
    return $display_box . $content;
   } else {
     return $content;
   }
}

// hook modified content into post content
add_filter('the_content', 'jc_classy_posts_display');
