<?php
if( class_exists( 'WooCommerce' ) ) { ?>
    <div id="products_quick_view_wrap" class="modal fade product_compair_modal_wrapper product_compair_modal" tabindex="-1" aria-labelledby="product_compair_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal_close_header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <?php echo saasland_get_icon_svg('saasland-svg-icon', 'close', '12') ?>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="quick_view_product_content" class="popup_details_area">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}