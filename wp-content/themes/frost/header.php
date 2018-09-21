<?php
require_once 'inc/Mobile_Detect.php';
$detect = new Mobile_Detect;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name = "format-detection" content = "telephone=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
    <base href="<?php echo home_url('/'); ?>">
    <!--<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">-->
    <!-- Bootstrap -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/slick/slick.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/slick/slick-theme.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet">
        <link href="<?php echo get_template_directory_uri(); ?>/fontawesome/css/font-awesome.css" rel="stylesheet">
    <?php wp_head(); ?>

</head>
<body <?php echo body_class(); ?>>
<header  <?php echo body_class(); ?>>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
            <?php 
            $slug_page = get_page_template_slug( $post->ID ); 
            $show_normal = ! $detect->isMobile() && $slug_page !== 'page-portfolio.php' ? true : false;
            ?>
                    <div class="row <?php //echo $post->ID == 74 ? 'show-logo-normal-sub': '' ?> ">
                        <div class=" col-7  col-md-5">
                        <?php if ($detect->isMobile() || $slug_page === 'page-portfolio.php' || is_singular('portfolio') || is_tax('portfolio_category')  ){
                            ?>
                            <div class="logo-small">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-small.png">
                                </a>
                            </div>

                            <?php
                        }else{
                            ?>
                            <div class="logo logo-normal">
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/m8h5LZ8g.png">
                                </a>
                            </div>
                            <?php

                        } ?>
                            <?php if((is_front_page() && ! $detect->isMobile()) ||($show_normal)){
                                ?>
                               
                                <?php
                            }else{
                                ?>
                               

                                <?php
                            } ?>

                        </div>
                        <div class=" col-5  col-md-7">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'main-nav',
                                'container' => 'nav',
                                'menu_class' => 'main-menu'
                            )); ?>

                            <div class="mobile-menu icon-menu-mobile" val="0">
                                <img src="<?php echo get_template_directory_uri().'/images/menu_mobile.png' ?>" width="48px">
                            </div>
                            <div class="close-mobile-menu" val="0">
                                <img src="<?php echo get_template_directory_uri().'/images/menu_mobile_close.png' ?>" width="48px">
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</header>
<div class="Menu-mobile">

    <?php wp_nav_menu(array(
        'theme_location' => 'mobile-nav',
        'container' => 'nav',
        'menu_class' => 'main-menu'
    )); ?>
</div>
