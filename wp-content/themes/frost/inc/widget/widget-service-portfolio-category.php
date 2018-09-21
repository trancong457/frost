<?php 
// Register and load the widget
function wpb_load_widget_portfolio_category() {
    register_widget( 'Frost_portfolio_category' );
}
add_action( 'widgets_init', 'wpb_load_widget_portfolio_category' );

class Frost_portfolio_category extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'Frost_portfolio_category',
			'description' => 'Frost-Portfolio Category case study',
		);
		parent::__construct( 'Frost_portfolio_category', 'Frost-Portfolio Category Case Study', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        // outputs the content of the widget
       
       
        $portfolio_category_id =  apply_filters( 'portfolio_category_id', $instance['portfolio_category_id'] );
    
      
        ?>


<section class="block-list-case-study">
    <div class="container-fluid">
        <div class="row">
            <?php
            $portfolios_post = get_posts(array(
                'post_type' => 'portfolio',
                'order' => 'DESC',
                  'posts_per_page' => 5,
                  'tax_query' => array(
                                      array(
                                          'taxonomy' => 'portfolio_category', // you can change it according to your taxonomy
                                          'field' => 'term_id', // this can be 'term_id', 'slug' & 'name'
                                          'terms' => $portfolio_category_id,
                                      )
                                  )
                                                           
            ));
            if ($portfolios_post) {
                # code...
                ?>
             
                    <?php foreach ($portfolios_post as $key => $value_port) {
                         if($key == 0){
                                    ?>
                                    <div class="col-12 col-sm-6">
                                            <div class="row">
                                                <div class="case-study">
                                                    <a href="<?php echo the_permalink($value_port); ?>">
                                                        <img class="img-fluid" src="<?php echo get_featured_img($value_port->ID) ?>"/>
                                                        <div class="text"><?php echo get_the_title($value_port->ID); ?></div>
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                                    <?php
                                }
                                else{
                                    if($key == 1) {
                                        ?>
                                        <div class="col-12 col-sm-6">
                                            <div class="row">
                                                <?php
                                    }
                                    ?>
                                     <div class="col-12 col-sm-6">
                                            <div class="row">
                                                    <div class="case-study">
                                                        <a href="<?php echo get_the_permalink($value_port); ?>">
                                                            <img class="img-fluid" src="<?php echo get_featured_img($value_port->ID) ?>"/>
                                                            <div class="text"><?php echo get_the_title($value_port->ID); ?></div>
                                                        </a>
                                                    </div>
                                                </div>
                                    </div>

                                    <?php

                                    if ($key+1 == count($portfolios_post)){
                                        ?>
                                        </div>
                                        </div>
                                        <?php
                                    }
                                }
                    } ?>
                  

            

                <?php
            }

         ?>
                   
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
    
        $portfolio_category_id = isset($instance['portfolio_category_id']) ? $instance['portfolio_category_id'] : '';
        
      

            // Widget admin form
            ?>
            
        <p>
            <select class="widefat" id="<?php echo $this->get_field_id( 'portfolio_category_id' ); ?>" name="<?php echo $this->get_field_name( 'portfolio_category_id' ); ?>">
                <?php 
                $terms_service = get_terms(array(
                                        'taxonomy' => 'portfolio_category',
                                        'hide_empty' => false,
                                    )); 
                if ($terms_service) {
                    # code...
                    foreach ($terms_service as $key => $value) {
                        ?>
                            <option <?php if($portfolio_category_id == $value->term_id) echo "selected"; ?> value="<?php echo $value->term_id; ?>"><?php echo $value->name ?></option>
                        <?php
                    }
                }
                ?>
               
               
            </select>
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
	public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        
       // $instance = array();
       // $instance['image_url'] =  ( ! empty( $new_instance['image_url'] ) ) ? strip_tags( $new_instance['image_url'] ) : '';
        return $new_instance;

	}
}