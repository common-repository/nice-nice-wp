<?php
/**
 * Nice Nice WP widget.
 *
 * @package Fat_NiceNice_WP
 *
 * @since 2.0
 */

/** Add fat_nicenice_widget */
add_action( 'widgets_init', 'fat_nicenice_widget' );

function fat_nicenice_widget() {
	register_widget( 'Fat_NiceNice_Widget' );
}

/** Add Fat_NiceNice_Widget */
class Fat_NiceNice_Widget extends WP_Widget {

	/** Register widget with WordPress */
	public function __construct() {
		parent::__construct(
	 		'fat_nicenice_widget', // Base ID
			'NiceNice WP', // Name
			array( 'description' => __( 'Display a picture of Vanilla Ice', 'nicenicewp' ), ) // Args
		);
	}

	/** Font-end display of the widget */
	public function widget( $args, $instance ) {
		extract( $args );

		// Include variables from the widget settings
		$width = $instance['width'];
		$height = $instance['height'];
		$fiveo = isset( $instance['fiveo'] ) ? $instance['fiveo'] : false;

		// Check for mustang awesomeness
		if ( $fiveo ) {
			$fiveo = '5.0';
		}

		// Sanitize before display
		$niceurl = esc_url( 'http://nicenicejpg.com' );
		$fiveo = esc_html( $fiveo );
		$width = esc_attr( $width );
		$height = esc_attr( $height );

		// Prep the embed
		$embed = '<img src="'. $niceurl .'/'. $fiveo .'/'. $width .'/'. $height .'" height="'. $height .'" width="'. $width .'" alt="'. __('Nice Nice Baby', 'nicenicewp') .'" />';

		// Display everything
		echo $before_widget;
		echo $embed;
		echo $after_widget;
	}

	/** Sanitize widget form values as they are saved. */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		// Strip all non-numeric characters from width and height fields
		$instance['width'] = preg_replace( "/[^0-9,.]/", "", $new_instance['width'] );
		$instance['height'] = preg_replace( "/[^0-9,.]/", "", $new_instance['height'] );
		$instance['fiveo'] = isset($new_instance['fiveo']);

		return $instance;
	}

	/**  Back-end widget form */
	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array( 'width' => 500, 'height' => 500, 'fiveo' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Image Width:', 'nicenicewp'); ?></label>
			<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Image Height:', 'nicenicewp'); ?></label>
			<input type="number" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('fiveo'); ?>" name="<?php echo $this->get_field_name('fiveo'); ?>" type="checkbox" <?php checked(isset($instance['fiveo']) ? $instance['fiveo'] : 0); ?> />
			<label for="<?php echo $this->get_field_id('fiveo'); ?>"><?php _e('Enable 5.0 Mode', 'nicenicewp'); ?></label></p>
		</p>

		<?php
	}

} // class Fat_NiceNice_Widget