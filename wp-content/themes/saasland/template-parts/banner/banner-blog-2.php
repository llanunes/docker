<?php
$opt = get_option( 'saasland_opt' );
$is_blog_title_bar = isset($opt['is_blog_title_bar']) ? $opt['is_blog_title_bar'] : '1';
$banner_bg_shape = !empty($opt['blog_banner_shape_img']['url']) ? $opt['blog_banner_shape_img']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
$blog_banner_section_img = !empty($opt['blog_banner_section_img']['url']) ? $opt['blog_banner_section_img']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';


$is_bubbles = isset($opt['is_bubbles']) ? $opt['is_bubbles'] : '1';
$breadcrumb = isset( $opt['is_breadcrumb'] ) ? $opt['is_breadcrumb'] : '1';
$text_align = !empty(saasland_get_options('blog_titlebar_align')) ? 'text-'.saasland_get_options('blog_titlebar_align') : 'text-center';

if ( $is_blog_title_bar == '1' ) {
    ?>
    <section class="breadcrumb_area_two blog_title_bar" <?php if(!empty($blog_banner_section_img)){ ?> style="background-image: url('<?php echo esc_url($blog_banner_section_img); ?>')" <?php } ?>>
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
        <img class="breadcrumb_shap" src="<?php echo esc_url($banner_bg_shape) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
        <div class="container">
            <div class="breadcrumb_content_two <?php echo esc_attr($text_align); ?>">
                <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20"> <?php saasland_banner_title(); ?> </h1>
                <?php if ( $breadcrumb == '1' ) : ?>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo esc_url(home_url( '/')) ?>"> <?php esc_html_e( 'Home', 'saasland' ) ?> </a></li>
                        <li class="active"> <?php saasland_banner_subtitle2() ?> </li>
                    </ol>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
}