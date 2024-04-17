<?php
$banner_id = 0;

if(class_exists('\DroitHead\Includes\Supports\Support')){
	$get_banner_data = new saasland_banner();
	$banner_id = $get_banner_data->get_builder_banner();
}

if($banner_id){
	echo drdt_kses_html(\Elementor\Plugin::instance()->frontend->get_builder_content_for_display(  $banner_id ) );

}else{

	$opt = get_option('saasland_opt');

	$page_banner_bg_image = !empty($opt['page_banner_bg_image']['url']) ? $opt['page_banner_bg_image']['url'] : '';
	// for Shop
	$shop_header_bg = !empty($opt['shop_header_bg']['url']) ? $opt['shop_header_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$shop_background_image = "style='background: url($shop_header_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";


	// for Case Study
	$case_study_title_bg = !empty($opt['case_study_title_bg']['url']) ? $opt['case_study_title_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$casestudy_background_image = "style='background: url($case_study_title_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";

	

	// for Team
	$team_titlebar_bg = !empty($opt['team_titlebar_bg']['url']) ? $opt['team_titlebar_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$teamPage_background_image = "style='background: url($team_titlebar_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";


	// for services
	$service_titlebar_bg = !empty($opt['service_titlebar_bg']['url']) ? $opt['service_titlebar_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$service_banner_bg = "style='background: url($service_titlebar_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";

    // For Jobs Page  
	$jobs_titlebar_bg = !empty($opt['jobs_titlebar_bg']['url']) ? $opt['jobs_titlebar_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$jobs_banner_bg = "style='background: url($jobs_titlebar_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";


	// For Portfolio Page  
	$portfolio_titlebar_bg = !empty($opt['portfolio_titlebar_bg']['url']) ? $opt['portfolio_titlebar_bg']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
	$portfolio_banner_bg = "style='background: url($portfolio_titlebar_bg); background-size: cover; background-position: center center; background-repeat: no-repeat;'";


	$theme_background_image = "style='background: url($page_banner_bg_image); background-size: cover; background-position: center center; background-repeat: no-repeat;'";

	$background_type = function_exists('get_field') ? get_field('banner_background_type') : '';
	$background_image = '';
	if ( $background_type == 'image' ) {
		$background_image = function_exists('get_field') ? get_field('banner_background_image') : '';
		$background_image = !empty($background_image) ? "style='background: url($background_image); background-size: cover; background-position: center center; background-repeat: no-repeat;'" : '';
		$banner_shape_image = '';
	} elseif ( $background_type == 'color' ) {
		$banner_shape_image = function_exists('get_field') ? get_field('banner_shape_image') : '';
		$background_image = '';
	}
	$portfolio_page_subtitle = isset( $opt['is_portfolio_page_subtitle'] ) ? $opt['is_portfolio_page_subtitle'] : '1';
	$services_page_subtitle = isset( $opt['is_service_page_subtitle'] ) ? $opt['is_service_page_subtitle'] : '1';
	$team_page_subtitle = isset( $opt['team_archive_subtitle'] ) ? $opt['team_archive_subtitle'] : '1';
	$text_align = !empty(saasland_get_options('titlebar_align')) ? 'text-'.saasland_get_options('titlebar_align') : 'text-center';
	?>
    <?php 
		if( is_page('shop')){ 
	?>
	<section class="breadcrumb_area" <?php echo wp_kses_post($shop_background_image); ?>>
	<?php 
	}
		elseif(is_post_type_archive( 'case_study' ) OR is_singular('case_study'))
	{
	?>
	<section class="breadcrumb_area case_study" <?php if(!empty($background_image)){ echo wp_kses_post($background_image);  } else{ echo wp_kses_post($casestudy_background_image); } ?>>
	<?php 
	}
		elseif( is_singular('portfolio'))
	{ 
	?>
	<section class="breadcrumb_area portfolio" <?php if(!empty($background_image)){ echo wp_kses_post($background_image);  } else{ echo wp_kses_post($portfolio_banner_bg); } ?>>

	<?php
	}
		elseif(is_post_type_archive( 'team' ))
	{
	?>
		<section class="breadcrumb_area team" <?php echo wp_kses_post($teamPage_background_image); ?>>
	<?php 
	}
		elseif(is_post_type_archive( 'product' ))
	{
	?>
	<section class="breadcrumb_area Shop" <?php echo wp_kses_post($shop_background_image); ?>>
	<?php 
	}
		elseif(is_post_type_archive( 'service' ))
	{
	?>

		<section class="breadcrumb_area service" <?php echo wp_kses_post($service_banner_bg); ?>>	
	<?php
	 }else{ 
	?>
	<section class="breadcrumb_area Page" <?php if(!empty($background_image) && class_exists( 'Redux' )){ echo wp_kses_post($background_image);  } elseif( !empty($theme_background_image) && class_exists( 'Redux' ) ){ echo wp_kses_post($theme_background_image); }else{ } ?>>
	<?php } ?>
		
		<?php
		if ( !empty($banner_shape_image) ) {
			echo wp_get_attachment_image( $banner_shape_image, 'full', false, array('class'=>'breadcrumb_shap') );
		}
		else {
			$default_shape_image = !empty($opt['banner_shape_image']['url']) ? $opt['banner_shape_image']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
			echo "<img src='".esc_url($default_shape_image)."' class='breadcrumb_shap' alt='".get_the_title()."'>";
		}
		?>
        <div class="container">
            <div class="breadcrumb_content <?php echo esc_attr($text_align) ?>">
                <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20"><?php saasland_banner_title(); ?></h1>
				<?php
				if ( is_singular( 'portfolio' ) ){
					if( $portfolio_page_subtitle == '1' ){
						saasland_banner_subtitle();
					}
				}
                elseif ( is_singular( 'service' ) ){
					if( $services_page_subtitle == '1' ){
						saasland_banner_subtitle();
					}
				}
                elseif ( is_singular( 'case_study' ) ){
	                saasland_banner_subtitle();
				}
                elseif ( is_singular( 'team' ) ){
					if( $team_page_subtitle == '1' ){
						saasland_banner_subtitle();
					}
				}
				else{
					saasland_banner_subtitle();
				} ?>
            </div>
        </div>
    </section>
<?php } ?>