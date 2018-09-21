<?php include 'header.php'; ?>
<?php  $queried_object = $wp_query->get_queried_object();  ?>
<style type="text/css">
    #menu-item-350 a{
             color: #A9B61E;
    }
    #menu-portfolio-menu .menu-item-<?php echo $queried_object->term_id; ?> .title-taxonomy{
        color: #000;
    }

</style>
<section>
    <div class="container-fluid">
            <div class="row">
                <div class="menu-portfolio">
                    <div class="container">
                            <div class="row">

                                <ul id="menu-portfolio-menu" class="taxonomy-portfolio-list-menu">
                                    <?php $terms_service = get_terms(array(
                                        'taxonomy' => 'portfolio_category',
                                        'hide_empty' => false,
                                    ));
                                    if ($terms_service) {
                                        # code...
                                        foreach ($terms_service as $key => $value) {
                                            ?>
                                             <li class="menu-item menu-item-type-taxonomy menu-item-object-portfolio_category menu-item-has-children menu-item-<?php echo $value->term_id; ?>">
                                                <a href="<?php echo get_term_link($value); ?>" class="title-taxonomy"><?php echo $value->name; ?></a>
                                                <?php
                                                if ($value->term_id == $queried_object->term_id) {
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
                                                            <?php foreach ($portfolios_post as $key => $value_port) {
                                                                # code...
                                                                ?>

                                                                    <li id="menu-item-<?php echo $value_port->ID; ?>" class="menu-item menu-item-type-post_type menu-item-object-portfolio ">
                                                                        <a style="<?php echo $key == 0 ? 'color: #000' : ''; ?>"  href="<?php echo get_the_permalink($value_port); ?>"><?php echo get_the_title($value_port->ID); ?></a></li>
                                                                <?php
                                                                if (($key + 1) % 3  == 0 ) {
                                                                   ?>
                                                               </div>
                                                               <div class="col-12 col-md-4 block-menu-sub-category">
                                                                   <?php
                                                                }

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
<section class="block-list-case-study block-post-taxomony-first-block">
            <?php
            wp_reset_query();
            $query = new WP_Query(array('post_type'=>'portfolio','posts_per_page'=>1,'portfolio_category'=>$queried_object->slug));
            while($query->have_posts()) : $query->the_post();
            ?>

              
                    <!-- get data -->
                    <?php
                        the_content();
                        ?>
                    <!-- End get data -->
                   


            <?php
            endwhile;
            wp_reset_query();
            ?>

</section>

<?php include 'footer.php'; ?>
