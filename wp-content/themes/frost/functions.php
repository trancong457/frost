<?php
if( !class_exists( 'ReduxFramewrk' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxCore/framework.php' );
    }
    if( !isset( $redux_demo ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxCore/theme-option.php');
    }

    if ( STYLESHEETPATH == TEMPLATEPATH ) {
        define('OF_FILEPATH', TEMPLATEPATH);
        define('OF_DIRECTORY', get_template_directory_uri());
    } else {
        define('OF_FILEPATH', STYLESHEETPATH);
        define('OF_DIRECTORY', get_stylesheet_directory_uri());
    }
include 'bfi_thumb/BFI_Thumb.php';

include 'inc/widget/widget-home-introduce.php';
include 'inc/widget/widget-home-about.php';
include 'inc/widget/widget-home-testimonials.php';
include 'inc/widget/widget-home-consistent.php';
include 'inc/widget/widget-service-banner.php';
include 'inc/widget/widget-service-case-study.php';
include 'inc/widget/widget-about-introduce.php';
include 'inc/widget/widget-about-map.php';
include 'inc/widget/widget-contact-map.php';
include 'inc/widget/widget-contact.php';
include 'inc/widget/widget-portfoloti.php';
include 'inc/widget/widget-service-portfolio-category.php';
include 'inc/widget/widget-portfolio-intro.php';
include 'inc/portfolio.php';
include 'inc/service.php';
include 'inc/duplicate_post.php';
include 'inc/widget/widget-list-porfolio-of-serivce.php';
/*Menu*/
if (function_exists('register_nav_menus')) {
    register_nav_menus (
        array(

            'main-nav' => 'The Main Menu',   // menu
            'mobile-nav' => 'The Mobile Menu',   // menu
            'portfolio-nav' => 'Portfolio Menu',

            'footer-nav' => 'Footer Menu',
        )
    );
}

 // create post thumbnail
if(function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');

}
function get_featured_img($post_id){
        $img_id = get_post_thumbnail_id($post_id);
        $images=wp_get_attachment_image_src( $img_id, false, false );
        return $images[0]; // 0: link  ; 1: width ; 2: height
}
function thumb_img($post_id,$h,$w,$q){ //lấy ảnh dùng id

    // echo bloginfo('template_url');
    // echo '/timthumb.php?src='.get_featured_img($post_id).'&amp;h='.$h.'&amp;w='.$w.'&amp;q='.$q;
    $params = array( 'width' => $w, 'height' => $h ,'crop' => false,'opacity' =>$q);
    echo bfi_thumb( get_featured_img($post_id), $params );
}

function thumb_img_normal($src,$h,$w){ //lấy ảnh dùng link

    $params = array( 'width' => $w, 'height' => $h ,'crop' => false,'opacity' =>100);
    echo bfi_thumb($src, $params );

}
/*function widget_script(){

    global $pagenow;

    //if ( 'widgets.php' === $pagenow )
        wp_enqueue_script( 'widget-script', '/wp-content/themes/frost/js/admin_widget_js.js' , array( 'jquery' ), false, true );

}

add_action( 'admin_init', 'widget_script' );*/

//add_action( 'admin_print_footer_scripts', array( __CLASS__, 'editor_js'), 50 );
//add_action( 'admin_footer', array( __CLASS__, 'enqueue_scripts'), 1 );
