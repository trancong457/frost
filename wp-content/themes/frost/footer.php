<?php global $tp_options; ?>
<section class="index-summary-contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                        <h2 class="index-summary-contact-title">Contact Us</h2>
                    </div>
                    <div class="row">
                        <div class="index-summary-contact-des">
                        <?php if(is_front_page()) { echo $tp_options['footer-contact-us']; } else { echo $tp_options['footer-contact-us-sub']; } ?>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo do_shortcode('[caldera_form id="CF5b8c4d811e555"]'); ?>
                   <!-- <form class="form-send-message-footer">
                            <div class="col-12">
                        <div class="form-group">
                            <div class="row">

                                            <input class="form-control" placeholder="Name *">

                            </div>

                        </div>
                        <div class="form-group">

                                            <div class="row">
                                                <input class="form-control" placeholder="Email * ">
                                            </div>

                        </div>
                        <div class="form-group">

                                            <div class="row">
                                                <input class="form-control" placeholder="Phone * ">
                                            </div>

                        </div>
                        <div class="form-group">

                                            <div class="row">
                                                <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="wrapper-submit-footer">
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div>

                            </div>
                        </div>


                        </div>

                    </form>
-->
                </div>
            </div>
        </div>
</section>
<footer>
    <div class="container">
        <div class="d-flex flex-nowrap">
        <div class="row" style="width: 100%;">

                    <div class="col-6 col-md-4 order-0 order-md-0">
                        <img class="img-logo-footer" src="<?php echo $tp_options['logo-image-footer']['url']; ?>"/>
                    </div>

                    <div class="col-12 col-md-4 order-2 order-md-1">
                        <div class="footer-link">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-nav',
                                'container' => 'nav',
                                'menu_class' => 'footer-main-menu'
                            )); ?>
                        </div>


                    </div>
                  <!--  <div class="col-12 col-md-3 order-3 order-md-2">


                    </div>-->
                    <div class="col-6 col-md-4 text-right order-1 order-md-3 social-footer">
                        <div class="">
                            <a href="<?php echo $tp_options['face-text']; ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/gI50Y_yw.png"/>
                            </a>
                            <a href="<?php echo $tp_options['instagram-text']; ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/CDBm7a3A.png"/>
                            </a>
                        </div>

                    </div>
            </div>

        </div>

    </div>
</footer>

<a class="mobile-phone" href="tel:<?php echo $tp_options['hotline-text']; ?>"></a>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"
        integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>

<script src="<?php echo get_template_directory_uri(); ?>/slick/slick.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
<?php wp_footer(); ?>
</body>
</html>
