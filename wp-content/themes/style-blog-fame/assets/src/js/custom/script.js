(function($) {

    "use strict";

    jQuery(document).ready(function() {


        // init Featured post slider


        $('#style-blog-fame-hero-slider').owlCarousel({

            items: 3,
            loop: true,
            lazyLoad: false,
            margin: 2,
            smartSpeed: 800,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 1
                },
                550: {
                    items: 1
                },
                768: {
                    items: 2
                },
                850: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1050: {

                    items: 3
                },
                1200: {
                    items: 3
                }
            },
        });

    });

})(jQuery);