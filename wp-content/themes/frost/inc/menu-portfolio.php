<ul id="menu-portfolio-menu" class="aaaa">
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
                    $portfolios_post = get_posts(array(
                        'post_type' => 'portfolio',
                          'posts_per_page' =>3,
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
                            <?php foreach ($portfolios_post as $key => $value_port) {
                                # code...
                                ?>
                                    <li id="menu-item-<?php echo $value_port->ID; ?>" class="menu-item menu-item-type-post_type menu-item-object-portfolio ">
                                        <a href="<?php echo get_the_permalink($value_port); ?>"><?php echo get_the_title($value_port->ID); ?></a></li>
                                <?php
                            } ?>
                          
        
                        </ul>

                        <?php
                    }

                 ?>
                
                </li>

            <?php
        }
    }
    ?>
   
       
</ul>