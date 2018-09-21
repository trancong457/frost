<?php include 'header.php'; ?>
<style type="text/css">
    #menu-item-80 a {
        color: #A9B61E;
    }

    #menu-item-<?php echo $post->ID ?> a {
        color: #000;
    }
</style>
<script type="text/javascript">
	var $ = jQuery;
	$(document).ready(function (e) {
		// body...
		var post_id = '<?php echo $post->ID; ?>';
		if ($('#menu-item-' + post_id).length > 0) {
			console.log('aaaaaaa');
		}

		$('#menu-item-' + post_id).closest('.menu-item-object-portfolio_category').find('.title-taxonomy').addClass('color_000');
	});
</script>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="menu-portfolio">
                <div class="container">
                    <div class="row">
                        <ul id="menu-portfolio-menu" class="taxonomy-portfolio-list-menu">
                            <?php

                            $terms_service_of_current_post = get_terms(array(
                                'taxonomy' => 'portfolio_category',
                                'hide_empty' => false,
                                'object_ids' => [$post->ID]
                            ));

                            $terms_service = get_terms(array(
                                'taxonomy' => 'portfolio_category',
                                'hide_empty' => false,
                                // 'object_ids' => [$post->ID]
                            ));
                            if ($terms_service) {
                                # code...
                                foreach ($terms_service as $key => $value) {
                                    ?>
                                    <li class="menu-item menu-item-type-taxonomy menu-item-object-portfolio_category menu-item-has-children menu-item-<?php echo $value->term_id; ?>">
                                        <a href="<?php echo get_term_link($value); ?>"
                                           class="title-taxonomy"><?php echo $value->name; ?></a>
                                        <?php
                                        //print_r($terms_service_of_current_post[0]);
                                        if ($terms_service_of_current_post && $terms_service_of_current_post[0]->term_id == $value->term_id) {
                                            # code...

                                            $portfolios_post = get_posts(array(
                                                'post_type' => 'portfolio',
                                                'posts_per_page' => 9,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'portfolio_category', // you can change it according to your taxonomy
                                                        'field' => 'term_id', // this can be 'term_id', 'slug' & 'name'
                                                        'terms' => $value->term_id,
                                                    )
                                                )

                                            ));
                                            if ($portfolios_post) {
                                                # code...
                                                ?>
                                                <ul class="sub-menu-portfotio">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4 block-menu-sub-category">
                                                            <?php foreach ($portfolios_post

                                                            as $key => $value_port) {
                                                            # code...
                                                            ?>
                                                            <li id="menu-item-<?php echo $value_port->ID; ?>"
                                                                class="menu-item menu-item-type-post_type menu-item-object-portfolio ">
                                                                <a href="<?php echo get_the_permalink($value_port); ?>"><?php echo get_the_title($value_port->ID); ?></a>
                                                            </li>
                                                            <?php
                                                            if (($key + 1) % 3 == 0) {
                                                            ?>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <?php
                                                            }

                                                            ?>

                                                            <?php
                                                            } ?>
                                                        </div>
                                                    </div>


                                                </ul>

                                                <?php
                                            }
                                        }

                                        ?>

                                    </li>

                                    <?php
                                }
                            }
                            ?>


                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="container-fluid">


        <?php
        wp_reset_query();
        while (have_posts()) : the_post();
        the_content();
           // $content = get_the_content($post->ID);
         //   echo $content;
        endwhile;
        wp_reset_query();

        ?>

</section>

<?php include 'footer.php'; ?>
