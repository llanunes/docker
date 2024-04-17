<section class="gadget_slider_area">
    <?php
    if( is_array( $settings['slider_2_items'] ) ){
        foreach ( $settings['slider_2_items'] as $slider_2_item ){
            $style = '';
            if( $slider_2_item['slider_2_item_bg'] == 'gradient' ){
                $style = !empty( $slider_2_item['slide_background_gradient'] ) ? 'style="background-image:linear-gradient('.$slider_2_item['gradient_angle']['size'].'deg, '.$slider_2_item['slide_bg_gradient_1st'].' 0%, '.$slider_2_item['slide_background_gradient'].' 100%)"' : '';
            }
            ?>
            <div class="slider_item elementor-repeater-item-<?php echo esc_attr(  $slider_2_item['_id'] ) ?>" <?php echo wp_kses_post( $style ) ?>>
                <div class="container">
                    <div class="row height">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="shop_slider_content">
                                <?php
                                if( !empty( $slider_2_item['slider_2_subtitle'] ) ){ ?>
                                    <h6><span class="line" data-animation="fadeInLeft" data-delay="0.2s"></span><span data-splitting><?php echo esc_html( $slider_2_item['slider_2_subtitle'] ) ?></span></h6>
                                    <?php
                                }
                                if( !empty( $slider_2_item['slider_2_title'] ) ){ ?>
                                    <h3 data-animation="fadeInUp" data-delay="0.5s"><?php echo esc_html( $slider_2_item['slider_2_title'] ) ?></h3>
                                    <?php
                                }
                                if( !empty( $slider_2_item['slider_2_btn_label'] ) ){
                                    echo '<a href="'. esc_url( $slider_2_item['slider_2_btn_url']['url'] ) .'" data-animation="fadeInUp" data-delay="0.7s" class="gadget_btn border_radius_none">'. esc_html( $slider_2_item['slider_2_btn_label'] ) .'</a>';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="gadget_slider_img shop_slider_img" data-animation="fadeInRight" data-delay="0.5s">
                                <div class="round" data-animation="zoomIn" data-delay="0.7s"></div>
                                <?php
                                if( !empty( $slider_2_item['slider_2_feature_img']['id'] ) ){
                                    echo wp_get_attachment_image( $slider_2_item['slider_2_feature_img']['id'], 'full' );
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
</section>
