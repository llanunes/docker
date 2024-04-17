<section class="product_multitask_area">
    <div class="container">
        <div class="tab_img_info">
            <?php
            if( is_array( $tabs ) ){
                $img_inc = 1;
                foreach ( $tabs as $tab_img ){
                    $active = $img_inc == 1 ? 'active' : '';
                    ?>
                    <figure id="tab_<?php echo esc_attr( $img_inc++ ) ?>" style="background: url(<?php echo esc_url( $tab_img['featured_image']['url'] ) ?>)" class="tab_img <?php echo esc_attr( $active ) ?>"></figure>
                    <?php
                }
            }
            ?>
        </div>
        <ul class="nav nav-tabs develor_tab multitask_tab" id="myTab2" role="tablist">
            <?php
            if( is_array( $tabs ) ){
                $tab_inc = 1;
                foreach ( $tabs as $tab_item ){
                    $show_active = $tab_inc == 1 ? 'show active' : '';
                    $tab_ID = str_replace( ' ', '', $tab_item['tab_title'] );
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo esc_attr( $show_active ) ?>" data-bs-tab="tab_<?php echo esc_attr( $tab_inc++ ) ?>" id="photo-tab" data-bs-toggle="tab" href="#<?php echo esc_attr( $tab_ID ) ?>" role="tab" aria-controls="photo" aria-selected="true">
                            <?php echo esc_html( $tab_item['tab_title'] ) ?>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <div class="tab-content multitask_tab_content">
            <?php
            if( is_array( $tabs ) ){
                $tab_contet_inc = 1;
                foreach ( $tabs as $tab_content ){
                    $active_show = $tab_contet_inc == 1 ? 'show active' : '';
                    $tab_contet_inc++;
                    $content_ID = str_replace( ' ', '', $tab_content['tab_title'] ); ?>
                    <div class="tab-pane fade <?php echo esc_attr( $active_show ) ?>" id="<?php echo esc_attr( $content_ID ) ?>" role="tabpanel" aria-labelledby="photo-tab">
                        <?php echo wp_kses_post( $tab_content['tab_content'] ) ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            if ($(".develor_tab li a").length > 0) {
                $(".develor_tab li a").click(function () {
                    var tab_id = $(this).attr("data-bs-tab");
                    $(".tab_img").removeClass("active");
                    $("#" + tab_id).addClass("active");
                });
            }
        })
    })(jQuery);
</script>