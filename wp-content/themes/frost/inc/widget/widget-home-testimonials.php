<?php
// Register and load the widget
function wpb_load_widget_home_testimonials()
{
    register_widget('Frost_home_testimonials');
}

add_action('widgets_init', 'wpb_load_widget_home_testimonials');

class Frost_home_testimonials extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_home_testimonials',
            'description' => 'Frost-Home Testimonials',
        );
        parent::__construct('Frost_home_testimonials', 'Frost-Home Testimonials', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        $title = apply_filters('widget_title', $instance['title']);
        $summary = apply_filters('summary', $instance['summary']);
        $content = apply_filters('content', $instance['content']);
        $image_url = apply_filters('image_url', $instance['image_url']);

        // before and after widget arguments are defined by themes


        ?>


        <section class="index-summary-testimonial">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8">
                        <h2 class="index-testimonial-title"><?php echo $title; ?></h2>
                        <h2 class="index-testimonial-summary"><?php echo $summary; ?></h2>
                        <div class="index-testimonial-des">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 ">
                        <div class="index-testimonial-image">
                            <img src="<?php echo home_url($image_url) ?>">
                        </div>
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
    public function form($instance)
    {
        // outputs the options form on admin

        $title = isset($instance['title']) ? $instance['title'] : '';
        $summary = isset($instance['summary']) ? $instance['summary'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('summary'); ?>"><?php _e('Summary:'); ?></label>
            <input class="widefat " id="<?php echo $this->get_field_id('summary'); ?>"
                   name="<?php echo $this->get_field_name('summary'); ?>" type="text"
                   value="<?php echo esc_attr($summary); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label>
            <button class="toggle" type="button" style="display:block !important;float:right;">Html</button>
            <button class="toggle-editor" style="float:right;" type="button"><?php _e('Editor'); ?></button>
            <textarea class="widefat " rows="10" id="<?php echo $this->get_field_id('content'); ?>"
                      name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_attr($content); ?></textarea>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_url'); ?>">Image</label><br/>

            <?php
            if ($instance['image_url'] != '') :
                echo '<img class="custom_media_image" src="' . home_url($instance['image_url']) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
            endif;
            ?>

            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_url'); ?>"
                   id="<?php echo $this->get_field_id('image_url'); ?>" value="<?php echo esc_attr($image_url); ?>"
                   style="margin-top:5px;">

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button"
                   name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image"
                   style="margin-top:5px;"/>
        </p>
        <script>
			jQuery(document).ready(function ($) {
				var domain = "<?php echo home_url(); ?>";

				function media_upload(button_class) {
					var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;

					$('body').on('click', button_class, function (e) {
						var button_id = '#' + $(this).attr('id');
						var self = $(button_id);
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(button_id);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function (props, attachment) {
							if (_custom_media) {
								$('.custom_media_id').val(attachment.id);
								$('.custom_media_url').val(attachment.url.replace(domain, ''));

								$('.custom_media_image').attr('src', attachment.url).css('display', 'block');
							} else {
								return _orig_send_attachment.apply(button_id, [props, attachment]);
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
               addEditor();
                $(".toggle").on('click',function(){
                    tinymce.remove();
                });
                $(".toggle-editor").on('click',function(){
                    addEditor();
                });


			});

            function addEditor(){
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

				},500);

            }
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
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved

        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['summary'] = (!empty($new_instance['summary'])) ? strip_tags($new_instance['summary']) : '';
        $instance['content'] = (!empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';
        $instance['image_url'] = (!empty($new_instance['image_url'])) ? strip_tags($new_instance['image_url']) : '';
        return $new_instance;

    }
}
