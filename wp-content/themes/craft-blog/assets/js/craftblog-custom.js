jQuery(document).ready(function($) {    

    /**
     * Gallery Post Slider Carousel
    */
    $('.postgallery-carousel').lightSlider({
        item:1,
        loop:true,
        trl:true,
        pause:3000,
        enableDrag:false,
        speed:500,
        pager:false,
        prevHtml:'<i class="fa fa-angle-left"></i>',
        nextHtml:'<i class="fa fa-angle-right"></i>',
        onSliderLoad: function() {
            $('.postgallery-carousel').removeClass('cS-hidden');
        },
    });

    /**
     * Popurlar/Comments/tags Tabs
    */
    if ( jQuery.isFunction(jQuery.fn.tabs) ) {
        jQuery( ".craftblog-tabs-wdt" ).tabs();
    }

    /**
     * Widget Sticky sidebar
    */
    try{
        $('.content-area').theiaStickySidebar({
            additionalMarginTop: 30
        });

        $('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    }
    catch(e){
        //console.log( e );
    }

    /**
     * Header Sticky Menu
    */
    var headersticky = craft_blog_ajax_script.headersticky;

    if( headersticky == 'on' ){
        try{
            $(".navbar").sticky({ topSpacing:0, responsiveWidth:false });
        }
        catch(e){
            //console.log( e );
        }
    }

    /**
     * Masonry Posts Layout
    */
    var grid = document.querySelector(
            '.craftblog-masonry'
        ),
        masonry;

    if (
        grid &&
        typeof Masonry !== undefined &&
        typeof imagesLoaded !== undefined
    ) {
        imagesLoaded( grid, function( instance ) {
            masonry = new Masonry( grid, {
                itemSelector: '.hentry',
                gutter: 15
            } );
        } );
    }


    /**
     * Sub Menu
    */
    $('.navbar .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-plus"></i> </span>');
    $('.navbar .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fa fa-plus"></i> </span>');

    $('.navbar .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    $('.navbar .sub-toggle-children').click(function() {
        $(this).parent('.page_item_has_children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    /**
     * Main Banner Slider Carousel
    */
    $('.ol-slider').owlCarousel({
        items: 1,
        margin: 30,
        stagePadding: 210,
        center: true,
        autoplay: true,
        autoplayHoverPause: true,
        autoplaySpeed: 600,
        smartSpeed: 600,
        loop: true,
        nav: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        dots: false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                stagePadding:0,
                margin: 10,
            },
            600:{
                items:1,
                stagePadding:100,
                margin: 20,
            }
        }
    });

    /*
    ** Scroll Top Button
    */
    $('.scrolltop').on( 'click', function() {
        $('html, body').animate( { scrollTop : 0 }, 800 );
        return false;
    });
    
});