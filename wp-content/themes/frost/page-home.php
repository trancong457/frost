<?php /* Template Name: Page Home */ ?>
<?php get_header();
global $tp_options;
?>

<section class="section-wrap-home">
<div class="container-fluid">
        <div class="row">
            <div class="banner-home-background" style="background-image : url('')">
                <img class="img-fluid" src="<?php echo $tp_options['home-banner-image']['url'] ?>">
            </div>
            <div class="banner-home-background-mobile-index" style="background-image : url('')">
                <img class="img-fluid" src="<?php echo $tp_options['home-banner-image-mobile']['url'] ?>">
            </div>
        </div>

            <div class="slider-banner-home ">
            <div class="row">
                <?php
                $list_service = $tp_options['home-slider-service'];
                if($list_service){
                    foreach($list_service as $key=>$service){

                        ?>
                        <div class="col-12 col-sm-4 col-md-4">
                            <div class="row item-slide ">
                                <a href="<?php echo home_url($service['url']); ?>">
                                    <img class="object-fit-none" src="<?php echo thumb_img_normal($service['image'],260,700); ?>">
                                    <?php if($key == 1 ){ echo '<div class="over-study-case"></div>'; } else{ echo ' <div class="portfolio-introduce-image-opacity"></div>'; } ?>
                                   
                                    <div class="item-slide-text"><?php echo $service['title']; ?></div>
                                </a>
                            </div>
                        </div>

                        <?php
                    }
                }

                ?>


            </div>
        </div>
    </div>
    <?php
    while(have_posts()) : the_post();
        the_content();
    endwhile;
    ?>

</section>





<?php include 'footer.php'; ?>
