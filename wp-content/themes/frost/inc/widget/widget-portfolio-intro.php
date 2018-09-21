<?php
// Register and load the widget
function wpb_load_widget_portfolio_introduce()
{
    register_widget('Frost_portfolio_introduce');
}

add_action('widgets_init', 'wpb_load_widget_portfolio_introduce');

class Frost_portfolio_introduce extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'Frost_portfolio_introduce',
            'description' => 'Frost-Portfolio Introduce',
        );
        parent::__construct('Frost_portfolio_introduce', 'Frost-Portfolio Introduce', $widget_ops);
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
        $caption_image = apply_filters('caption_image', $instance['caption_image']);
        $content = apply_filters('content', $instance['content']);
        $image_url = apply_filters('image_url', $instance['image_url']);
        $link_image = apply_filters('link_image', $instance['link_image']);

        // before and after widget arguments are defined by themes
        global $post;

        $text_title = $title;
        if (is_single()){
            $text_title = get_the_title();
        }
        else{
            if (is_page()){
                $page_id = $post->ID;
                $page_slug = get_page_template_slug($page_id);
                $text_title = 'Page';
                $query = new WP_Query(array('post_type'=>'portfolio','posts_per_page'=>1,'portfolio_category'=>'architectural-builds'));
                while($query->have_posts()) : $query->the_post();
                    $text_title = get_the_title();
                endwhile;
            }
        }
        ?>
        <section class="index-summary-introduce">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-6">
                        <div class="row">
                            <h2 class="title-introduce"><?php echo $text_title; ?></h2>
                        </div>

                        <?php if ($content != '') { ?>
                            <div class="row">
                                <div class="introduce-content max-width-500 introduce-content-portfolio"><?php echo htmlspecialchars_decode(trim($content)); ?></div>
                            </div>
                        <?php } ?>

                        <?php if ($image_url[1] != '') { ?>
                            <div class="row">
                                <div class="image-award-portfolio">
                                    <img src="<?php echo home_url($image_url[1]); ?>"/>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-6">
                        <?php if ($image_url[0] != '') { ?>
                            <div class="row portfolio-introduce-image-wrapper">
                                <div class="portfolio-introduce-image">
                                    <a href="<?php echo $link_image; ?>">
                                        <img class="width-100-percent" src="<?php echo home_url($image_url[0]); ?>"/>
                                        <div class="portfolio-introduce-image-opacity"></div>
                                        <div class="portfolio-introduce-image-title">
                                            <?php echo $caption_image; ?>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        <?php } ?>
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

        $title = isset($instance['title']) ? $instance['title'] : '44  Gleneagles Tce';
        $content = isset($instance['content']) ? $instance['content'] : 'From modern executive homes to lovingly restored historic villas, each project we undertake is complete with the utmost attention to detail and commitment to quality. We enjoy the challenges of complex, difficult, or avant-garde designs, and have significant experience with unusual architectural features and tricky sections.';
        $image_url = isset($instance['image_url']) ? $instance['image_url'] : '';
        $caption_image = isset($instance['caption_image']) ? $instance['caption_image'] : 'Read about it adobe.co.nz';
        $link_image = isset($instance['link_image']) ? $instance['link_image'] : '#';

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

        <p>
            <label for="<?php echo $this->get_field_id('caption_image'); ?>"><?php _e('Caption Image:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('caption_image'); ?>"
                   name="<?php echo $this->get_field_name('caption_image'); ?>" type="text"
                   value="<?php echo esc_attr($caption_image); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_image'); ?>"><?php _e('Link Image:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_image'); ?>"
                   name="<?php echo $this->get_field_name('link_image'); ?>" type="text"
                   value="<?php echo esc_attr($link_image); ?>"/>
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
                   id="<?php echo $this->get_field_id('image_url'); ?>"
                   value="<?php echo ($i == 1 && $image_url[$i] == '') ? '/wp-content/themes/frost/images/TSFRH27A.png' : esc_attr($image_url[$i]); ?>"
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
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved

        return $new_instance;

    }
}
