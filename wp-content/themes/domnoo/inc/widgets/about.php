<?php

class Domnoo_Widget_About extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_about',
            esc_html__('Apus About Widget', 'domnoo'),
            array( 'description' => esc_html__( 'Show About Info', 'domnoo' ), )
        );
        $this->widgetName = 'about';
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
    
    public function scripts() {
        wp_enqueue_script( 'apus-upload-image', APUS_FRAMEWORK_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), APUS_FRAMEWORK_VERSION, true );
    }

    public function getTemplate() {
        $this->template = 'about.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'About',
            'image' => '',
            'heading' => 'Heading',
            'description' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'domnoo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        
        <label for="<?php echo esc_attr($this->get_field_id( 'image' )); ?>"><?php esc_html_e( 'Image:', 'domnoo' ); ?></label>
        <div class="screenshot">
            <?php if ( $instance['image'] ) { ?>
                <img src="<?php echo esc_url($instance['image']); ?>" alt=""/>
            <?php } ?>
        </div>
        <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" type="hidden" value="<?php echo esc_attr($instance['image']); ?>" />
        <div class="upload_image_action">
            <input type="button" class="button add-image" value="Add">
            <input type="button" class="button remove-image" value="Remove">
        </div>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'heading' )); ?>"><?php esc_html_e( 'Heading:', 'domnoo' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'heading' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'heading' )); ?>" type="text" value="<?php echo esc_attr( $instance['heading'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e( 'Description:', 'domnoo' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" rows="3" cols="30"><?php echo esc_attr($instance['description']); ?></textarea>
        </p>

<?php
    }

     public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['heading'] = ( ! empty( $new_instance['heading'] ) ) ? strip_tags( $new_instance['heading'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
        return $instance;

    }
}

register_widget( 'Domnoo_Widget_About' );