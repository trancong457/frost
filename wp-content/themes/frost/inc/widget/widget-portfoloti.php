<?php
// Register and load the widget
function wpb_load_widget_portfolio()
{
    register_widget('Frost_portfolio');
}

add_action('widgets_init', 'wpb_load_widget_portfolio');

class Frost_portfolio extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_portfolio',
            'description' => 'Frost-Portfolio',
        );
        parent::__construct('Frost_portfolio', 'Frost-Portfolio', $widget_ops);
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
        $image_url = apply_filters('image_url', $instance['image_url']);

        $position = apply_filters('position', $instance['position']);


        // before and after widget arguments are defined by themes


        ?>


        <!--start-->
        <div class="row wrap-block-image-portfolio">
            <?php if ($image_url && $position == 'left') {
                ?>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <div class="case-study">

                            <img class="object-fit-none image-porfolio-lager" src="<?php echo thumb_img_normal(home_url($image_url[0]), 584,960); ?>"/>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                            ?>
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="case-study">

                                        <img class="object-fit-none image-porfolio-small" src="<?php echo thumb_img_normal(home_url($image_url[$i]),293, 482); ?>"/>

                                    </div>
                                </div>
                            </div>

                            <?php
                        }

                        ?>
                    </div>
                </div>
                <?php
            } else {
                ?>

                <div class="col-12 col-sm-6">
                    <div class="row">
                        <?php
                        for ($i = 0; $i <= 3; $i++) {
                            ?>
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="case-study">

                                        <img class="object-fit-none image-porfolio-small" src="<?php echo thumb_img_normal(home_url($image_url[$i]),293,482); ?>"/>

                                    </div>
                                </div>
                            </div>

                            <?php
                        }

                        ?>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <div class="case-study">

                            <img class="object-fit-none image-porfolio-lager" src="<?php echo thumb_img_normal(home_url($image_url[4]),584,960); ?>"/>


                        </div>
                    </div>
                </div>
                <?php
            } ?>


        </div>
        <!--end portfolio-->

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

        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';
        $position = isset($instance['position']) ? $instance['position'] : '';


        // Widget admin form
        ?>

        <p>
            <select class="widefat" id="<?php echo $this->get_field_id('position'); ?>"
                    name="<?php echo $this->get_field_name('position'); ?>">
                <option <?php if ($position == 'left') echo "selected"; ?> value="left">Left</option>
                <option <?php if ($position == 'right') echo "selected"; ?> value="right">Right</option>
            </select>
        </p>

        <?php for ($i = 0; $i < 5; $i++) {

        ?>
        <div class="" style="margin: 20px; border: 1px solid #ccc;padding: 10px;">

            <p>
                <label for="<?php echo $this->get_field_id('image_url'); ?>">Image</label><br/>
                <?php
                if ($instance['image_url'] != '') :
                    echo '<img class="custom_media_image" src="' . home_url($instance['image_url'][$i]) . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                endif;
                ?>

                <input type="text" class="widefat custom_media_url_<?php echo $i; ?>"
                       name="<?php echo $this->get_field_name('image_url'); ?>[]"
                       id="<?php echo $this->get_field_id('image_url'); ?>"
                       value="<?php echo esc_attr($image_url[$i]); ?>" style="margin-top:5px;">

                <input type="button" class="button button-primary custom_media_button_<?php echo $i; ?>"
                       id="custom_media_button_<?php echo $i; ?>"
                       name="<?php echo $this->get_field_name('image_uri'); ?>[]" value="Upload Image"
                       style="margin-top:5px;"/>
            </p>

        </div>
        <?php
    } ?>

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
                <?php for($i = 0; $i < 5 ; $i++){

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

        // $instance = array();
        // $instance['image_url'] =  ( ! empty( $new_instance['image_url'] ) ) ? strip_tags( $new_instance['image_url'] ) : '';
        return $new_instance;

    }
}
