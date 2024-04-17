<?php
wp_enqueue_style( 'splitting' );
wp_enqueue_script( 'splitting' );
wp_enqueue_script( 'slick' );
?>
<div class="gadget_slider_area">
    <?php
    if( is_array( $settings['slider_2_items'] ) ){
        foreach ( $settings['slider_2_items'] as $slider_2_item ){
            $style = '';
            if( $slider_2_item['slider_2_item_bg'] == 'gradient' ){
                $style = !empty( $slider_2_item['slide_background_gradient'] ) ? 'style="background-image:linear-gradient('.$slider_2_item['gradient_angle']['size'].'deg, '.$slider_2_item['slide_bg_gradient_1st'].' 0%, '.$slider_2_item['slide_background_gradient'].' 100%)"' : '';
            }
            ?>
            <div class="slider_item elementor-repeater-item-<?php echo esc_attr(  $slider_2_item['_id'] ) ?>" <?php echo wp_kses_post( $style ) ?>>
                <div class="pattern position-absolute" data-parallax='{"x": 20, "y": 150}'>
                    <?php
                    if( !empty( $slider_2_item['slider_2_shape_img']['id'] ) ){
                        echo wp_get_attachment_image( $slider_2_item['slider_2_shape_img']['id'], 'full' );
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="gadget_slider_content">
                                <?php
                                if( !empty( $slider_2_item['slider_2_subtitle'] ) ){
                                    echo '<h6 data-animation="fadeInLeft" data-delay="0.1s">'. esc_html( $slider_2_item['slider_2_subtitle'] ) .'</h6>';
                                }
                                if( !empty( $slider_2_item['slider_2_title'] ) ){
                                    echo '<h3 data-splitting>'. wp_kses_post( $slider_2_item['slider_2_title'] ) .'</h3>';
                                }
                                if( !empty( $slider_2_item['slider_2_bg_text'] ) ){
                                    echo '<div class="text" data-animation="fadeInUp" data-delay="0.4s">'. esc_html( $slider_2_item['slider_2_bg_text'] ) .'</div>';
                                }
                                if( !empty( $slider_2_item['slider_2_btn_label'] ) ){
                                    echo '<a href="'. esc_url( $slider_2_item['slider_2_btn_url']['url'] ) .'" data-animation="fadeInUp" data-delay="0.6s" class="gadget_btn strock_btn">'. esc_html( $slider_2_item['slider_2_btn_label'] ) .'</a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gadget_slider_img" data-animation="fadeInRight" data-delay="0.5s">
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
</div>