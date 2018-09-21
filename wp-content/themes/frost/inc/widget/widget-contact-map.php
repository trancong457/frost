<?php
// Register and load the widget
function wpb_load_widget_contact_map_2()
{
    register_widget('Frost_contact_map_2');
}

add_action('widgets_init', 'wpb_load_widget_contact_map_2');

class Frost_contact_map_2 extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_contact_map_2',
            'description' => 'Frost-Contact Map new',
        );
        parent::__construct('Frost_contact_map_2', 'Frost-Contact Map new', $widget_ops);
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


        $content = apply_filters('content', $instance['content']);
        $image_url = apply_filters('image_url', $instance['image_url']);

        // before and after widget arguments are defined by themes


        ?>

        <section class="about-map-intro">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="-margin-left-15 -margin-right-15">
                            <img class="img-fluid" src="<?php echo home_url($image_url); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="-margin-left-15 -margin-right-15">
                            <div class="description"><?php echo $content; ?></div>
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

        $content = isset($instance['content']) ? $instance['content'] : '';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';

        // Widget admin form
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label>
            <textarea class="widefat " rows="10" id="<?php echo $this->get_field_id('content'); ?>"
                      name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_attr($content); ?></textarea>

        </p>
        <?php for ($i = 0; $i < 2; $i++) { ?>
        <p>
            <label for="<?php echo $this->get_field_id('image_url'); ?>">Image</label><br/>
            <?php
            if ($instance['image_url'] != '') :
                echo '<img class="custom_media_image" src="' . home_url($instance['image_url'][$i]) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
            endif;
            ?>

            <input type="text" class="widefat custom_media_url_<?php echo $i; ?>"
                   name="<?php echo $this->get_field_name('image_url'); ?>[]"
                   id="<?php echo $this->get_field_id('image_url'); ?>" value="<?php echo esc_attr($image_url[$i]); ?>"
                   style="margin-top:5px;">

            <input type="button" class="button button-primary custom_media_button_<?php echo $i; ?>"
                   id="custom_media_button_<?php echo $i; ?>" name="<?php echo $this->get_field_name('image_uri'); ?>[]"
                   value="Upload Image" style="margin-top:5px;"/>
        </p>
    <?php } ?>
        <script>
			jQuery(document).ready(function ($) {
				var domain = "<?php echo home_url(); ?>";

				function media_upload(button_class, customedia_url, custom_media_id, custom_media_image) {
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
								$(custom_media_id).val(attachment.id);
								$(customedia_url).val(attachment.url.replace(domain, ''));

								$(custom_media_image).attr('src', attachment.url).css('display', 'block');
							} else {
								return _orig_send_attachment.apply(button_id, [props, attachment]);
							}
						}
						wp.media.editor.open(button);
						return false;
					});
				}
                <?php for($i = 0; $i < 2 ; $i++){

                ?>
				media_upload('.custom_media_button_<?php echo $i; ?>.button', '.custom_media_url_<?php echo $i; ?>', '.custom_media_id_<?php echo $i; ?>', '.custom_media_image_<?php echo $i; ?>');
                <?php
                } ?>


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
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved


        return $new_instance;

    }
}
