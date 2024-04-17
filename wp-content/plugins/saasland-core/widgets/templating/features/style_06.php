<div class="row">
    <?php
    if ( !empty($features5 ) ) {
        foreach ( $features5 as $feature ) {
            ?>
            <div class="col-lg-<?php echo esc_attr($column); ?> col-md-6">
                <div class="chat_features_item wow fadeInUp">
                    <div class="round">
                        <div class="round_circle elementor-repeater-item-<?php echo $feature['_id'] ?>"></div>
                        <?php
                        if ( !empty( $feature['rotate_img']['id'] ) ) {
                            echo wp_get_attachment_image( $feature['rotate_img']['id'], 'full', false, array( 'class' => 'top_img p_absoulte' ) );
                        }
                        if ( !empty( $feature['fimage']['id'] ) ) {
                            echo wp_get_attachment_image( $feature['fimage']['id'], 'full' );
                        }
                        ?>
                    </div>
                    <?php
                    if ( !empty( $feature['title'] ) ) {
                        echo "<a href='#'> <$feature_item_title_tag> {$feature['title']} </$feature_item_title_tag> </a>";
                    }
                    if ( !empty( $feature['subtitle'] ) ) {
                        echo wp_kses_post ( wpautop($feature['subtitle'] ) ) ;
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>