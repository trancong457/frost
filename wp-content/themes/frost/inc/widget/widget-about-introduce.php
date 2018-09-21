<?php
// Register and load the widget
function wpb_load_widget_about_introduce()
{
    register_widget('Frost_about_introduce');
}

add_action('widgets_init', 'wpb_load_widget_about_introduce');

class Frost_about_introduce extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_about_introduce',
            'description' => 'Frost-About Introduce',
        );
        parent::__construct('Frost_about_introduce', 'Frost-About Introduce', $widget_ops);
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
        $content = apply_filters('content', $instance['content']);
        $title_prize = apply_filters('title_prize', $instance['title_prize']);
        $image_url = apply_filters('image_url', $instance['image_url']);
        $name_quote = apply_filters('name_quote', $instance['name_quote']);
        $text_quote = apply_filters('text_quote', $instance['text_quote']);

        // before and after widget arguments are defined by themes


        ?>


        <section class="index-summary-introduce">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="">
                            <h2 class="title-introduce"><?php echo $title; ?></h2>
                        </div>

                        <?php if ($content != '') { ?>
                            <div class="">
                                <div class="introduce-content"><?php echo htmlspecialchars_decode($content); ?></div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-12 col-md-3">
                        <div class="row about-prize sm-hide"><!--Hide in mobile-->
                            <div class="about-prize">
                                <img src="<?php echo home_url($image_url[0]); ?>">
                                <p><?php echo $title_prize[0]; ?></p>
                            </div>
                        </div>
                        <?php if ($image_url[1] != '') { ?>
                            <div class="row md-hide"> <!--hide on destop-->
                                <div class="about-prize">
                                    <img src="<?php echo home_url($image_url[1]); ?>">
                                    <p>
                                        <?php echo $title_prize[1]; ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-12 col-md-3">
                        <div class="text-quote-contact"><?php echo $text_quote; ?></div>
                        <div class="name-quote-contact"><?php echo $name_quote; ?></div>
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
        $content = isset($instance['content']) ? $instance['content'] : '';
        $title_prize = isset($instance['title_prize']) ? $instance['title_prize'] : '';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';
        $text_quote = isset($instance['text_quote']) ? $instance['text_quote'] : '';
        $name_quote = isset($instance['name_quote']) ? $instance['name_quote'] : '';


        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label>
            <textarea class="widefat " rows="10" id="<?php echo $this->get_field_id('content'); ?>"
                      name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_attr($content); ?></textarea>

        </p>


        <?php for ($i = 0; $i < 2; $i++) { ?>
        <p>
            <label for="<?php echo $this->get_field_id('title_prize'); ?>"><?php _e('Title Prize:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title_prize'); ?>"
                   name="<?php echo $this->get_field_name('title_prize'); ?>[]" type="text"
                   value="<?php echo esc_attr($title_prize[$i]); ?>"/>
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

					var text_2 = $("#<?php echo $this->get_field_id( 'text_quote' ); ?>_ifr").contents().find("body").html();
					$("#<?php echo $this->get_field_id( 'text_quote' ); ?>").html(text_2);

				},500)
			});
			/* ]]> */</script>

        <p>
            <label for="<?php echo $this->get_field_id('name_quote'); ?>"><?php _e('Name Quote:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('name_quote'); ?>"
                   name="<?php echo $this->get_field_name('name_quote'); ?>" type="text"
                   value="<?php echo esc_attr($name_quote); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('text_quote'); ?>"><?php _e('Content Quote:'); ?></label>
            <textarea class="widefat " rows="10" id="<?php echo $this->get_field_id('text_quote'); ?>"
                      name="<?php echo $this->get_field_name('text_quote'); ?>"><?php echo esc_attr($text_quote); ?></textarea>

        </p>

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
