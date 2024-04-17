<?php
$opt = get_option( 'saasland_opt' );
if ( is_home() ) {
    $banner_bg2 = !empty($opt['blog_banner_bg2']['url']) ? $opt['blog_banner_bg2']['url'] : SAASLAND_DIR_IMG . '/banners/banner_bg2.png';
} else {
    $banner_bg2 = !empty($opt['banner_bg2']['url']) ? $opt['banner_bg2']['url'] : SAASLAND_DIR_IMG . '/banners/banner_bg2.png';
}
$is_bubbles = isset($opt['is_bubbles']) ? $opt['is_bubbles'] : '1';
$breadcrumb = isset( $opt['is_breadcrumb'] ) ? $opt['is_breadcrumb'] : '1';
$text_align = !empty(saasland_get_options('titlebar_align')) ? 'text-'.saasland_get_options('titlebar_align') : 'text-center';
?>
<section class="breadcrumb_area_two" >
    <?php if ( $is_bubbles == '1' ) : ?>
        <ul class="list-unstyled bubble">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    <?php endif; ?>
    <img class="breadcrumb_shap" src="<?php echo esc_url($banner_bg2) ?>" alt="<?php the_title_attribute() ?>">
    <div class="container">
        <div class="breadcrumb_content_two <?php echo esc_attr($text_align) ?>">
            <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20"> <?php saasland_banner_title(); ?> </h1>
            <?php if ( $breadcrumb == '1' ) : ?>
            <ol class="breadcrumb">
                <li><a href="<?php echo esc_url(home_url( '/')) ?>"> <?php esc_html_e( 'Home', 'saasland' ) ?> </a></li>
                <?php
                if ( !empty( has_post_parent( get_the_ID())  )) { ?>
                    <li>
                        <a href="<?php the_permalink(get_post_parent(get_the_ID())) ?>"><?php echo get_the_title( get_post_parent( get_the_ID() ) ); ?></a>
                    </li>
                    <?php
                }
                ?>
                <li class="active"> <?php saasland_banner_subtitle2() ?> </li>
            </ol>
            <?php endif; ?>
        </div>
    </div>
</section>