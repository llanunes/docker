<?php
$banner_id = 0;
if ( class_exists('\DroitHead\Includes\Supports\Support') ) {
	$get_banner_data = new saasland_banner();
	$banner_id = $get_banner_data->get_builder_banner();
}

if ( $banner_id ) {
	echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display($banner_id) );

} else {
	$opt = get_option('saasland_opt');
    $is_blog_title_bar = isset($opt['is_blog_title_bar']) ? $opt['is_blog_title_bar'] : '1';
	$banner_bg_shape = !empty($opt['blog_banner_shape_img']['url']) ? $opt['blog_banner_shape_img']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
    $blog_banner_section_img = !empty($opt['blog_banner_section_img']['url']) ? $opt['blog_banner_section_img']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
    $text_align = !empty(saasland_get_options('blog_titlebar_align')) ? 'text-'.saasland_get_options('blog_titlebar_align') : 'text-center';

    if ( $is_blog_title_bar == '1' ) {
        ?>
        <section class="breadcrumb_area blog_title_bar" <?php if(class_exists( 'Redux' ) ) : ?> style="background-image: url('<?php echo esc_url($blog_banner_section_img); ?>')" <?php endif; ?> >
            <img class="breadcrumb_shap" src="<?php  echo esc_url($banner_bg_shape) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
            <div class="container">
                <div class="breadcrumb_content <?php echo esc_attr($text_align) ?>">
				    <?php
				    if ( is_archive() ) {
					    the_archive_title( '<h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">', '</h1>' );
				    } else { ?>
                        <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20"><?php saasland_banner_title(); ?></h1>
					    <?php
				    }
				    saasland_banner_subtitle();
				    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
?>