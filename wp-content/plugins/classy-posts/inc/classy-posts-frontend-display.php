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

  // if any of the custom meta info exist
  if($difficulty || $time || $cost) {
  // store html snippet in a buffer
  ob_start(); ?>
  <div class="classy-posts-display callout" style="background-color: <?php echo $background_color ?>;">

    <?php if($difficulty) : ?>
      <div class="difficulty">
        <span>Difficulty</span>
        <p><?php echo $difficulty ?></p>
      </div>
    <?php endif ?>

    <?php if($time) : ?>
      <div class="time">
        <span>Time</span>
        <p><?php echo $time ?></p>
      </div>
    <?php endif ?>

    <?php if($cost) : ?>
      <div class="cost">
        <span>Cost</span>
        <p><?php echo $cost ?></p>
      </div>
    <?php endif ?>
  </div>

  <?php
   $display_box = ob_get_clean();
   return $display_box . $content;
   } else {
     return $content;
   }
}

// hook modified content into post content
add_filter('the_content', 'jc_classy_posts_display');
