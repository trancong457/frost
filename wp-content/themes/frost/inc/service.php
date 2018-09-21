<?php 
function custom_post_type_service() {

	$labels = array(
		'name'                => _x( 'Service', 'Post Type General Name', 'sanpham' ),
		'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'sanpham' ),
		'menu_name'           => __( 'Service', 'text_domain' ),
		'all_items'           => __( 'All Service', 'sanpham' ),
		'view_item'           => __( 'View Service', 'sanpham' ),
		'add_new_item'        => __( 'Add Service', 'sanpham' ),
		'add_new'             => __( 'Add Service', 'sanpham' ),
		'edit_item'           => __( 'Edit Service', 'sanpham' ),
		'update_item'         => __( 'Update Service', 'sanpham' ),
		'search_items'        => __( 'Search Service', 'sanpham' ),
		'not_found'           => __( 'Not Found', 'sanpham' ),
		'not_found_in_trash'  => __( 'Not Found', 'sanpham' ),
	);
	$args = array(
		'label'               => __( 'Service', 'sanpham' ),
		'description'         => __( 'Page Service ', 'sanpham' ),
		'labels'              => $labels,
		'taxonomies' 		  => array('post_tag'),
		'hierarchical'        => false,
		'rewrite' 			  => true,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'			  => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'rewrite' => array("slug" => "service", 'hierarchical' => true),
		'has_archive'         => true,
		'exclude_from_search' => false,
		'capability_type'     => 'page',
		'supports' => array(
	      'title',
	      'editor',
	      
	     
	      'excerpt',
	     
	      'thumbnail',
	     
	      'custom-fields'
	    )
	);
	register_post_type( 'service', $args );
	//flush_rewrite_rules();
}
// Hook into the 'init' action
add_action( 'init', 'custom_post_type_service');