<section class="product_features_area">
    <div class="container">
        <div class="battery_mockup">
            <figure class="macbook_body">
                <?php
                if( !empty( $settings['feature_image_01']['url'] ) ){
                    echo '<img class="top wow fadeInDown" data-wow-delay="0.1s" src="'. esc_url( $settings['feature_image_01']['url'] ) .'" alt="'. esc_attr__( 'Feature image One', 'saasland-core' ) .'">';
                }
                if( !empty( $settings['feature_image_02']['url'] ) ){
                    echo '<img class="middle wow fadeInDown" data-wow-delay="0.3s" src="'. esc_url( $settings['feature_image_02']['url'] ) .'" alt="'. esc_attr__( 'Feature image two', 'saasland-core' ) .'">';
                }
                if( !empty( $settings['feature_image_03']['url'] ) ){
                    echo '<img class="bottom wow fadeInDown" data-wow-delay="0.6s" src="'. esc_url( $settings['feature_image_03']['url'] ) .'" alt="'. esc_attr__( 'Feature image Three', 'saasland-core' ) .'">';
                }
                ?>
            </figure>
            <ul class="list-unstyled battery_info">
                <?php
                if( is_array( $settings['layers_label'] ) ) {
                    $inc = 2;
                    $animation_class = count( $settings['layers_label'] ) % 2 == 0 ? 'fadeInRight' : 'fadeInLeft';
                    foreach ( $settings['layers_label'] as $layer ){

                        ?>
                        <li class="wow <?php echo esc_attr( $animation_class ) ?>" data-wow-delay="0.<?php echo esc_attr( $inc++ )?>s">
                            <span class="text"><?php echo esc_html( $layer['feature_image_layer'] ) ?></span>
                            <span class="line"></span>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</section>