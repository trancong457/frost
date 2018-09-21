<?php 
// Register and load the widget
function wpb_load_widget_service_banner() {
    register_widget( 'Frost_service_banner' );
}
add_action( 'widgets_init', 'wpb_load_widget_service_banner' );

class Frost_service_banner extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'Frost_service_banner',
			'description' => 'Frost-Service Banner',
		);
		parent::__construct( 'Frost_service_banner', 'Frost-Service Banner', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // outputs the content of the widget
        $image_url =  apply_filters( 'image_url', $instance['image_url'] );
        $image_url_mobile =  apply_filters( 'image_url_mobile', $instance['image_url_mobile'] );
 
        // before and after widget arguments are defined by themes
       
      
        ?>




<section>
    <div class="container-fluid">
        <div class="row">
                <div class="banner-home-background"  >
                    <img class="img-fluid" src="<?php echo home_url($image_url); ?>" />
                </div>
                <div  class="banner-home-background-mobile"  >
                    <img class="img-fluid" src="<?php echo home_url($image_url_mobile); ?>" >
                </div>
        
          
        </div>
    </div>
</section>

        <?php
        echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        // outputs the options form on admin
    
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';
        $image_url_mobile = isset($instance['image_url']) ? $instance['image_url_mobile'] : '';

            ?>
       
        <p>
            <label for="<?php echo $this->get_field_id('image_url'); ?>">Image</label><br />

            <?php
                if ( $instance['image_url'] != '' ) :
                    echo '<img class="custom_media_image" src="' . home_url($instance['image_url']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                endif;
            ?>

            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_url'); ?>" id="<?php echo $this->get_field_id('image_url'); ?>" value="<?php echo esc_attr( $image_url ); ?>" style="margin-top:5px;">

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_url_mobile'); ?>">Image mobile</label><br />

            <?php
                if ( $instance['image_url_mobile'] != '' ) :
                    echo '<img class="custom_media_image_mobile" src="' . home_url($instance['image_url_mobile']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                endif;
            ?>

            <input type="text" class="widefat custom_media_url_mobile" name="<?php echo $this->get_field_name('image_url_mobile'); ?>" id="<?php echo $this->get_field_id('image_url_mobile'); ?>" value="<?php echo esc_attr( $image_url_mobile ); ?>" style="margin-top:5px;">

            <input type="button" class="button button-primary custom_media_button_mobile" id="custom_media_button_mobile" name="<?php echo $this->get_field_name('image_uri_mobile'); ?>" value="Upload Image" style="margin-top:5px;" />
        </p>
        <script>
            jQuery(document).ready( function($) {
                var domain = "<?php echo home_url(); ?>";
                function media_upload(button_class,customedia_url,custom_media_id,custom_media_image) {
                    var _custom_media = true,
                    _orig_send_attachment = wp.media.editor.send.attachment;

                    $('body').on('click', button_class, function(e) {
                        var button_id ='#'+$(this).attr('id');
                        var self = $(button_id);
                        var send_attachment_bkp = wp.media.editor.send.attachment;
                        var button = $(button_id);
                        var id = button.attr('id').replace('_button', '');
                        _custom_media = true;
                        wp.media.editor.send.attachment = function(props, attachment){
                            if ( _custom_media  ) {
                                $(custom_media_id).val(attachment.id);
                                $(customedia_url).val(attachment.url.replace(domain,''));

                                $(custom_media_image).attr('src',attachment.url).css('display','block');
                            } else {
                                return _orig_send_attachment.apply( button_id, [props, attachment] );
                            }
                        }
                        wp.media.editor.open(button);
                            return false;
                    });
                }
                media_upload('.custom_media_button.button','.custom_media_url','.custom_media_id','.custom_media_image');
                media_upload('.custom_media_button_mobile.button','.custom_media_url_mobile','.custom_media_id_mobile','.custom_media_image_mobile');
                
            });
        </script>
        <?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        
        return $new_instance;

	}
}