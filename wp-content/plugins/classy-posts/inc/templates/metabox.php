<?php
/**
*
* @var String $difficulty
* @var String $time
* @var String $cost
* @var String $vegan_friendly
**/
  ob_start();
?>
<div class="wrap classy-posts-metabox">
  <div class="form-group">
    <label for="difficulty"><?php esc_html_e('Difficulty', 'jc_classy_posts_domain'); ?></label>
    <select name="difficulty" id="difficulty">
      <option value="">Choose A Difficulty</option>
      <?php
      $ratings = array('Easy Peasy', 'Relatively Doable', 'Kinda Hard', 'Really #$*%ing Hard', 'No Seriously, Just Give Up Now');
      foreach($ratings as $rating){
        if($rating == $difficulty){
          ?>
          <option selected><?php echo $rating; ?></option>
          <?php
        } else {
          ?>
          <option><?php echo $rating; ?></option>
          <?php
        }
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="time"><?php esc_html_e('Time', 'jc_classy_posts_domain'); ?></label>
    <input class="regular-text" type="text" name="time" id="time" value="<?php if(!empty($time)) echo esc_attr($time); ?>">
  </div>

  <div class="form-group">
    <label for="cost"><?php esc_html_e('Cost', 'jc_classy_posts_domain'); ?></label>
    <input class="regular-text" type="text" name="cost" id="cost" value="<?php if(!empty($cost)) echo esc_attr($cost); ?>">
  </div>

  <div class="form-group">
    <label for="cost"><?php esc_html_e('Vegan Friendly', 'jc_classy_posts_domain'); ?></label>
    <input type="checkbox" name="vegan_friendly" id="vegan_friendly" <?php checked('on', $vegan_friendly); ?> >
  </div>
</div>

<?php $metabox = ob_get_clean(); ?>
