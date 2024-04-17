<?php
$opt = get_option( 'saasland_opt' );
if ( isset($opt['is_header_sticky']) ) {
    $is_header_sticky = $opt['is_header_sticky'] == '1' ? ' header_stick' : '';
} else {
    $is_header_sticky = ' header_stick';
}
if ( is_page_template( 'page-agency-colorful.php' ) ) {
    $is_header_sticky = '';
}

$header_bg_page = function_exists( 'get_field' ) ? get_field('is_header_bg') : 'default';
if ( $header_bg_page != 'default' ) {
    $has_bg_color = ($header_bg_page == 'show') ? ' has_header_bg' : '';
} else {
    $has_bg_color = !empty( $opt['is_header_bg'] ) ? ' has_header_bg' : '';
}

/**
 * Header Nav-bar Layout
 */
$page_header_layout = function_exists( 'get_field' ) ? get_field( 'header_layout' ) : '';

if ( !empty($page_header_layout) && $page_header_layout != 'default' ) {
    $nav_layout = $page_header_layout;
} elseif ( !empty($_GET['menu']) ) {
    $nav_layout = $_GET['menu'];
} else {
    $nav_layout = !empty($opt['nav_layout']) ? $opt['nav_layout'] : '';
}

$nav_layout_header = '';
$nav_layout_start = '<div class="container">';
$nav_layout_end = '</div>';

switch ( $nav_layout ) {
    case 'boxed':
        $nav_layout_start = '<div class="container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'wide':
        $nav_layout_start = '<div class="container custom_container">';
        $nav_layout_end = '</div>';
        $nav_layout_header = '';
        break;
    case 'full_width':
        $nav_layout_start = '';
        $nav_layout_header = 'header_area_five nav_full_width';
        $nav_layout_end = '';
        break;
}
?>
<header class="header_area <?php echo esc_attr($nav_layout_header.$is_header_sticky.$has_bg_color); ?>">
    <?php
    if ( !is_page_template('page-split.php') ) {
        $is_header_top = !empty($opt['is_header_top']) ? $opt['is_header_top'] : '';
        if ($is_header_top == '1') :
            get_template_part('template-parts/header_elements/header-top');
        endif;
    }
    ?>
    <nav class="navbar navbar-expand-lg pl-0 pr-0">
        <?php
        echo wp_kses_post($nav_layout_start);
        saasland_helper()->logo();

        get_template_part( 'template-parts/header_elements/navbar' );
        get_template_part( 'template-parts/header_elements/mini-cart' );
        get_template_part('template-parts/header_elements/buttons');
        echo wp_kses_post($nav_layout_end);
        ?>
    </nav>
</header>