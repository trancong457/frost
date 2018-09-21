$(document).ready(function (e) {

    /*$('.slider-banner-home').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false
    });
    */

    $('#menu-portfolio-menu ul').addClass('sub-menu-portfotio');
    $('#menu-portfolio-menu ul').removeClass('sub-menu');



    $('.icon-menu-mobile').click(function() {

          $val=$(".icon-menu-mobile").attr("val");
          if($val==0){
                      $(this).attr("val",1);
            $('body').attr("class","menu_ad_body");
          }else if($val==1){

            $(this).attr("val",0);
            $('body').removeAttr("class");
          }

    });

    if ($('.Menu-mobile .sub-menu').length > 0) {
            $('.Menu-mobile .sub-menu').parent().find('a').append('<span class="icon-arrown"><i class="fa fa-angle-down" aria-hidden="true"></i></span>');
            $('.Menu-mobile .sub-menu').find('a').removeClass('icon-arrown');
    }

    $(document).on('click','.icon-arrown',function() {
        if ( $(this).parent().parent().find('.mobile-sub-menu').length > 0) {
             $(this).parent().parent().find('ul').removeClass('mobile-sub-menu');
             $(this).parent().parent().find('ul').css('display','none');
        }
        else{
            $(this).parent().parent().find('ul').addClass('mobile-sub-menu');
             $(this).parent().parent().find('ul').css('display','block');
        }



    })

    $('.close-mobile-menu').on('click',function(){
        console.log('close');
        $(".icon-menu-mobile").attr("val",0);
        $('body').removeAttr("class");
    });

    if ($('.menu-portfolio').width() > 768) {
		var height_sub_menu_portfolio = 0;
		$('.sub-menu-portfotio .block-menu-sub-category').each(function () {
			var this_height = $(this).height();
			console.log(this_height);
			if ($(this).height() > height_sub_menu_portfolio) {
				height_sub_menu_portfolio = $(this).height() + 20;
			}
		});
		$('.menu-portfolio').css('margin-bottom', height_sub_menu_portfolio);
	}

	if ($('footer').width() > 768) {
		$('#menu-footer-menu li:nth-child(5)').addClass('absolute-right-1');
		$('#menu-footer-menu li:nth-child(6)').addClass('absolute-right-2');
		$('#menu-footer-menu li:nth-child(7)').addClass('absolute-right-3');

    }
    if($('body').width() > 768){
        var width_wrap_image_port = $('.wrap-block-image-portfolio').width();
        var img_port_width_lager = $('.image-porfolio-lager').width();
        var img_port_height_lager = $('.image-porfolio-lager').height();
        $('.image-porfolio-small').css('width',width_wrap_image_port / 4);
        $('.image-porfolio-small').css('height',width_wrap_image_port / 6.8);
        $('.image-porfolio-lager').css('height',width_wrap_image_port / 3.4);
        $('.image-porfolio-lager').css('width',width_wrap_image_port / 2);
    }

});
