<?php
// create menu Link
function jc_classy_posts_options_menu_link(){
  add_options_page(
    'Classy Posts Options',
    'Classy Posts',
    'manage_options',
    'jc-classy-posts-options',
    'jc_classy_posts_options_content'
  );
}

function jc_classy_posts_options_content() {

  // use global options variable
  global $jc_classy_posts_options;

  // store html snippet in a buffer
  ob_start(); ?>
  <div class="wrap">
    <h2><?php _e('Classy Posts Settings', 'jc_classy_posts_domain'); ?></h2>
    <p><?php _e('Settings for the Classy Posts plugin', 'jc_classy_posts_domain'); ?></p>
    <form method="post" action="options.php">
      <?php settings_fields('jc_classy_posts_settings_group'); ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="jc_classy_posts_settings[background_color]"><?php _e('Background Color','jc_classy_posts_domain'); ?></label></th>
            <td>
              <input name="jc_classy_posts_settings[background_color]" type="text" id="jc_classy_posts_settings[background_color]" value="<?php echo $jc_classy_posts_options['background_color']; ?>" class="jc-classy-posts-color-field">
              <p class="description"><?php _e('Choose a color', 'jc_classy_posts_domain'); ?></p>
            </td>
          </tr>
        </tbody>
      </table>
      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'jc_classy_posts_domain'); ?>" />
      </p>
    </form>
  </div>

  <?php
  echo ob_get_clean();
}

// wrapper function to register the settings
function jc_classy_posts_register_settings(){
  register_setting('jc_classy_posts_settings_group', 'jc_classy_posts_settings');
}


// hook custom menu link into admin menu action
add_action('admin_menu', 'jc_classy_posts_options_menu_link');

// hook setting register into admin init action
add_action('admin_init', 'jc_classy_posts_register_settings');
