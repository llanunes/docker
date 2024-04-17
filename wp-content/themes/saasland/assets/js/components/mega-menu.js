(function($) {
    'use strict';

    $(document).on('mouseenter', '.has-saasland-mega-menu', function() {
        // fulid menu
        if($(this).hasClass('fluid')){
            $($(this).parents('.header_area')).addClass('megamenu_wrapper');
        }
        // Container width Menu
        if($(this).hasClass('containerwidth')){
            $($(this).parents('.container')).addClass('megamenu_wrapper');
        }
        // Content width menu
        if($(this).hasClass('contentwidth')){
            $($(this).parents('.navbar-nav')).addClass('megamenu_wrapper');
        }
    }).on('mouseleave','.has-saasland-mega-menu', function(){

        setTimeout(function(){
            if($(this).hasClass('fluid')){
                $($(this).parents('.header_area')).removeClass('megamenu_wrapper');
            }
        }.bind(this), 300);

        setTimeout(function(){
            if($(this).hasClass('containerwidth')){
                $($(this).parents('.container')).removeClass('megamenu_wrapper');
            }
        }.bind(this), 300);

        setTimeout(function(){
            if($(this).hasClass('contentwidth')){
                $($(this).parents('.navbar-nav')).removeClass('megamenu_wrapper');
            }
        }.bind(this), 300);

    });
})(jQuery);