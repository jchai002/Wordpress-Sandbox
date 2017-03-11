<?php
/**
*
* @var String $background_color
* @var String $difficulty
* @var String $time
* @var String $cost
* @var Boolean $vegan_friendly
**/
  ob_start();
?>
<div class="classy-posts-display callout" style="background-color: <?php echo $background_color ?>;">
  <?php if($vegan_friendly) : ?>
    <div class="vegan">
      <span>Vegan Friendly</span>
    </div>
  <?php endif ?>

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
<?php $display_box = ob_get_clean(); ?>
