<?php
// Register and load the widget
function wpb_load_widget_portfolio_of_service()
{
    register_widget('Frost_portfolio_of_service');
}

add_action('widgets_init', 'wpb_load_widget_portfolio_of_service');

class Frost_portfolio_of_service extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_portfolio_of_service',
            'description' => 'Frost-Portfolio of Service',
        );
        parent::__construct('Frost_portfolio_of_service', 'Frost-Portfolio of Service', $widget_ops);
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
        $title = apply_filters('title', $instance['title']);
        $link = apply_filters('link', $instance['link']);


        // before and after widget arguments are defined by themes


        ?>


        <!--start-->
      
        <div class="container-fluid">
        <div class="row block-list-case-study wrap-block-image-portfolio">
            <?php if ($image_url && $position == 'left') {
                ?>
                <div class="col-12 col-sm-6">
                    <div class="row">
                    <?php if($link[$i] != ''){ ?>
                        <div class="case-study">
                            <a href="<?php echo $link[0]; ?>">
                            <img class="object-fit-none image-porfolio-lager" src="<?php echo thumb_img_normal(home_url($image_url[0]), 584,960); ?>"/>
                            <div class="text"><span><?php echo $title[0]; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></div>
                            </a>

                        </div>
                        <?php } else{
                                    ?>
                                      <div class="case-study">
                           
                            <img class="object-fit-none image-porfolio-lager" src="<?php echo thumb_img_normal(home_url($image_url[0]), 584,960); ?>"/>
                         

                        </div>
                                     <?php
                                } ?>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                            ?>
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                <?php if($link[$i] != ''){ ?>
                                    <div class="case-study">
                                    <a href="<?php echo $link[$i]; ?>">
                                        <img class="object-fit-none image-porfolio-small" src="<?php echo thumb_img_normal(home_url($image_url[$i]),293, 482); ?>"/>
                                        <?php if($i == 2 || $i == 3){ echo '<div class="over-study-case"> </div>'; } ?>
                                        <div class="text"><span><?php echo $title[$i]; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span> </div>
                                        </a>
                                    </div>
                                <?php } else{
                                    ?>
                                    <div class="case-study">
                                   
                                        <img class="object-fit-none image-porfolio-small" src="<?php echo thumb_img_normal(home_url($image_url[$i]),293, 482); ?>"/>
                                        <?php if($i == 2 || $i == 3){ echo '<div class="over-study-case"></div>'; } ?>
                                       
                                       
                                    </div>
                                    <?php
                                } ?>
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
                                    <a href="<?php echo $link[$i]; ?>">
                                        <img class="object-fit-none image-porfolio-small" src="<?php echo thumb_img_normal(home_url($image_url[$i]),293,482); ?>"/>
                                        <div class="text"><?php echo $title[$i]; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>
                                        </a>
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
                        <a href="<?php echo $link[4]; ?>">
                            <img class="object-fit-none image-porfolio-lager" src="<?php echo thumb_img_normal(home_url($image_url[4]),584,960); ?>"/>
                            <div class="text"><?php echo $title[4]; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>
                            </a>

                        </div>
                    </div>
                </div>
                <?php
            } ?>


        </div>
        <!--end portfolio-->
</div>
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
        $title = isset($instance['title']) ? $instance['title'] : '';
        $link = isset($instance['link']) ? $instance['link'] : '';

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
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>[]" type="text"
                   value="<?php echo esc_attr($title[$i]); ?>"/>
        </p>
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
            <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
                   name="<?php echo $this->get_field_name('link'); ?>[]" type="text"
                   value="<?php echo esc_attr($link[$i]); ?>"/>
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
