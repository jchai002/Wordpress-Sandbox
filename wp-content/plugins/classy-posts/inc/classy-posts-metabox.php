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
	$meta_data = get_post_meta($post->ID);
	?>
	<div class="wrap classy-posts-metabox">
		<div class="form-group">
			<label for="difficulty"><?php esc_html_e('Difficulty', 'jc_classy_posts_domain'); ?></label>
			<select name="difficulty" id="difficulty">
				<option value="">Choose A Difficulty</option>
				<?php
				$ratings = array('Easy Peasy', 'Relatively Doable', 'Kinda Hard', 'Really #$*%ing Hard', 'No Seriously, Just Give Up Now');
				foreach($ratings as $rating){
					if($rating == $meta_data['difficulty'][0]){
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
			<input class="regular-text" type="text" name="time" id="time" value="<?php if(!empty($meta_data['time'])) echo esc_attr($meta_data['time'][0]); ?>">
		</div>

		<div class="form-group">
			<label for="cost"><?php esc_html_e('Cost', 'jc_classy_posts_domain'); ?></label>
			<input class="regular-text" type="text" name="cost" id="cost" value="<?php if(!empty($meta_data['cost'])) echo esc_attr($meta_data['cost'][0]); ?>">
		</div>
	</div>
	<?php
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
}

// add plugin functions to action hooks
add_action( 'load-post.php', 'jc_classy_posts_metabox_setup' );
add_action( 'load-post-new.php', 'jc_classy_posts_metabox_setup' );
add_action('save_post', 'jc_classy_posts_save');
