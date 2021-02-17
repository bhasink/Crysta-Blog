jQuery(document).ready(function($){

    /*
     * Switch On/Off Control
    */
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val('off').trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val('on').trigger('change')
        }
    });


    /**
     * Select Multiple Category
    */
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return $( this ).val();
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        
        }
    );


    /**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );


    /**
      * Function for repeater field
     */
    function craft_blog_refresh_repeater_values(){
        $(".craft-blog-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".craft-blog-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.craft-blog-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.craft-blog-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.craft-blog-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.craft-blog-repeater-field-close', function(){
        $(this).closest('.craft-blog-repeater-fields').slideUp();;
        $(this).closest('.craft-blog-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.craft-blog-repeater-add-control-field', function(){

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".craft-blog-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                
                field.find(".craft-blog-repeater-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.craft-blog-repeater-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find('.craft-blog-repeater-fields').show();

                $this.find('.craft-blog-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.craft-blog-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                craft_blog_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".craft-blog-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.craft-blog-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                craft_blog_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
        craft_blog_refresh_repeater_values();
        return false;
    });

    /*Drag and drop to change order*/
    $(".craft-blog-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            craft_blog_refresh_repeater_values();
        }
    });

    $('body').on('click', '.craft-blog-repeater-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.craft-blog-repeater-icon-list').prev('.craft-blog-repeater-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.craft-blog-repeater-icon-list').next('input').val(icon_class).trigger('change');
        craft_blog_refresh_repeater_values();
    });

    $('body').on('click', '.craft-blog-repeater-selected-icon', function(){
        $(this).next().slideToggle();
    });

});
