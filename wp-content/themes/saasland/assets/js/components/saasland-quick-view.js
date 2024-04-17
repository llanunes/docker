var $ = jQuery.noConflict();

jQuery( document ).ready( function($) {

    if ( typeof local_strings === 'undefined' ) {
        return false;
    }

    // Vars
    var qv_modal 		= $( '#products_quick_view_wrap' ),
        qv_content 		= $( '#quick_view_product_content' ),
        modal_body      = $( '#products_quick_view_wrap .modal-body' );

    /**
     * Open quick view.
     */
     jQuery( document ).on( 'click', '.saasland-quick-view', function( e ) {
        e.preventDefault();

        var $this 		= jQuery( this ),
            product_id  = jQuery( this ).data( 'product_id' );

        modal_body.addClass( 'loading' );

        jQuery.ajax( {
            url: local_strings.ajax_url,
            data: {
                action : 'saasland_product_quick_view',
                product_id : product_id
            },
            success: function( results ) {
                qv_content.html( results );

                // Display modal
                qv_modal.fadeIn();


            }

        } ).done( function() {
            modal_body.removeClass( 'loading' );
        } );

    } );

});