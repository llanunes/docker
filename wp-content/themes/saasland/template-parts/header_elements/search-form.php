<?php
$opt = get_option( 'saasland_opt' );

$is_search = !empty($opt['is_search']) ? $opt['is_search'] : '';
if ( $is_search == '1' ) :
    ?>
    <form action="<?php echo esc_url(home_url( '/')) ?>" class="search_boxs" role="search">
        <div class="search_box_inner">
            <div class="close_icon">
                <i class="icon_close"></i>
            </div>
            <div class="input-group">
                <input type="text" name="s" class="form_control search-input" placeholder="<?php esc_attr_e( 'Search here', 'saasland' ) ?>" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="icon_search"></i></button>
                </div>
            </div>
        </div>
    </form>
<?php
endif;