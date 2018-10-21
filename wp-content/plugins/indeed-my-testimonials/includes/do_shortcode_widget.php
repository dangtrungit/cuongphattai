<?php 
////////WIDGET
class IndeedDoShortcodeWidget extends WP_Widget {
	function IndeedDoShortcodeWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'Indeed Do Shortcode' );
	}
	function widget( $args, $instance ) {
		if (isset($instance['shortcode']) && $instance['shortcode']){
			echo do_shortcode($instance['shortcode']);
		}
	}
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		$instance['shortcode'] = $new_instance['shortcode'];
		return $instance;
	}
	function form( $instance ) {
		?>
			<div>
				<b>Shortcode:</b>
			</div>
			<div>
				<textarea style="width: 250px;height: 100px;" name="<?php echo $this->get_field_name( 'shortcode' );?>" ><?php echo $instance['shortcode'];?></</textarea>
			</div>
		<?php 
	}
}
function register_IndeedDoShortcodeWidget() {
	register_widget( 'IndeedDoShortcodeWidget' );
}
add_action( 'widgets_init', 'register_IndeedDoShortcodeWidget' );