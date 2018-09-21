<?php
// Register and load the widget
function wpb_load_widget_home_introduce() {
    register_widget( 'Frost_home_introduce' );
}
add_action( 'widgets_init', 'wpb_load_widget_home_introduce' );

class Frost_home_introduce extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'Frost_home_introduce',
			'description' => 'Frost-Home Introduce',
		);
		parent::__construct( 'Frost_home_introduce', 'Frost-Home Introduce', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // outputs the content of the widget
        $title = apply_filters( 'widget_title', $instance['title'] );
        $summary =  apply_filters( 'summary', $instance['summary'] );
        $content =  apply_filters( 'content', $instance['content'] );
        $image_url =  apply_filters( 'image_url', $instance['image_url'] );

        // before and after widget arguments are defined by themes


        ?>


        <section class="index-summary-introduce">
            <div class="container">
                <div class="col-12 col-sm-12 col-lg-7">
                    <div class="row">
                        <h2 class="title-introduce"><?php echo $title; ?></h2>
                    </div>
                    <?php if($summary != '') {?>
                    <div class="row">
                        <div class="introduce-summary"><?php echo htmlspecialchars_decode(trim($summary)); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($content != '') {?>
                    <div class="row">
                        <div class="introduce-content"><?php echo htmlspecialchars_decode(trim($content)); ?></div>
                    </div>
                    <?php } ?>
                    <?php if($image_url != '') {?>
                    <div class="row">
                        <div class="introduce-sigle">
                            <img src="<?php echo home_url($image_url); ?>"/>
                        </div>
                    </div>
                    <?php } ?>
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

        $title = isset($instance['title']) ? $instance['title'] : '';
        $summary = isset($instance['summary']) ? $instance['summary'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';

            // Widget admin form
            ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'summary' ); ?>"><?php _e( 'Summary:' ); ?></label>
            <input class="widefat " id="<?php echo $this->get_field_id( 'summary' ); ?>" name="<?php echo $this->get_field_name( 'summary' ); ?>" type="text" value="<?php echo esc_attr( $summary ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
            <textarea class="widefat " rows="10" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" ><?php echo esc_attr( $content ); ?></textarea>

        </p>
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
        <script>
            jQuery(document).ready( function($) {
                var domain = "<?php echo home_url(); ?>";
                function media_upload(button_class) {
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
                                $('.custom_media_id').val(attachment.id);
                                $('.custom_media_url').val(attachment.url.replace(domain,''));

                                $('.custom_media_image').attr('src',attachment.url).css('display','block');
                            } else {
                                return _orig_send_attachment.apply( button_id, [props, attachment] );
                            }
                        }
                        wp.media.editor.open(button);
                            return false;
                    });
                }
                media_upload('.custom_media_button.button');
            });
        </script>
        <script type="text/javascript">/* <![CDATA[ */
			jQuery(function($)
			{
				var id = '';
				$('textarea').each(function(e)
				{

					id = $(this).attr('id');
					console.log(id);
					tinyMCE.execCommand("mceAddEditor", false, id);
					tinyMCE.execCommand('mceAddControl', false, id);

				});
				setInterval(function () {

					var text = $("#<?php echo $this->get_field_id( 'content' ); ?>_ifr").contents().find("body").html();
					$("#<?php echo $this->get_field_id( 'content' ); ?>").html(text);

				},500)
			});
			/* ]]> */</script>

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
