<section class="shop_featured_gallery_area">
    <div class="container">
        <div class="row featured_gallery">
            <div class="col-md-3 grid-sizer"></div>
            <?php
            if( is_array( $settings['_categories_block'] ) ){
                foreach ( $settings['_categories_block'] as $item ) {
                    $term   = get_term_by( 'slug', $item['_cat_id'], 'product_cat' );
                    $column = !empty( $item['_cat_column'] ) ? $item['_cat_column'] : '6';
                    ?>
                    <div class="grid-item col-md-<?php echo esc_attr($column); ?> elementor-repeater-item-<?php echo esc_attr(  $item['_id'] ) ?>">
                        <div class="shop_featured_item">
                            <?php
                            if( !empty( $item['_cat_img']['id'] ) ){
                                echo wp_get_attachment_image( $item['_cat_img']['id'], 'full' );
                            }
                            ?>
                            <div class="shop_content">
                                <a href="<?php echo esc_url(get_term_link($term->term_id)) ?>">
                                    <h5 class="cat_name"><?php echo esc_html($term->name) ?></h5>
                                </a>
                                <a href="<?php echo esc_url(get_term_link($term->term_id)) ?>" class="shop_btn">
                                    <?php esc_html_e( 'Shop Now', 'saasland-core'); ?>
                                </a>
                                <?php
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>