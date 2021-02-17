jQuery(document).ready(function($) {    
    /**
     * Full Banner Slider
    */
    $('.ol-fullslider').lightSlider({
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
            $('.ol-fullslider').removeClass('cS-hidden');
        },
    });


    /**
     * Header Search Popup
    */
    $('.main-nav-search').click(function() {
        $('.search-pop-up').toggleClass('active');
    });

    /**
     * Sidebar Alt
    */
    $('.main-nav-sidebar').on('click', function () {
        $('.sidebar-popup').css( 'left','0' );
        $('.sidebar-popup-close').fadeIn( 500 );
    });

    // Sidebar Alt Close
    function bardAltSidebarClose() {
        var leftPosition = parseInt( $( ".sidebar-popup" ).outerWidth(), 10 ) + 30;
        $('.sidebar-popup').css( 'left','-'+ leftPosition +'px' );
        $('.sidebar-popup-close').fadeOut( 500 );
    }
    
    $('.sidebar-popup-close, .sidebar-popup-close-btn').on('click', function () {
        bardAltSidebarClose();
    });
    

    $("#page-footer").on('click', '.goToTop', function(e){
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0,
        },'slow');
    });
    // Show/Hide Button on Window Scroll event.
    $(window).on('scroll', function(){
        var fromTop = $(this).scrollTop();
        var display = 'none';
        if(fromTop > 650){
            display = 'block';
        }
        $('#scrollTop').css({'display': display});
    });
    
});