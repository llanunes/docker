<?php
$opt = get_option( 'saasland_opt' );
/**
 * Menu Alignment
 */
$menu_alignment = !empty($opt['menu_alignment']) ? $opt['menu_alignment'] : 'menu_center';

switch ( $menu_alignment ) {
    case 'menu_left':
	    $menu_container = 'justify-content-start';
	    $ul_class = ' pl_120';
        break;
    case 'menu_center':
        $menu_container = 'justify-content-center';
        $ul_class = '';
        break;
    case 'menu_right':
	    $menu_container = 'justify-content-end';
	    $ul_class = ' pr_120';
        break;
}

if ( has_nav_menu('main_menu') ) : ?>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'saasland') ?>">
        <span class="menu_toggle">
            <span class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="hamburger-cross">
                <span></span>
                <span></span>
            </span>
        </span>
    </button>

    <div class="<?php echo 'collapse navbar-collapse ' . $menu_container; ?>" id="navbarSupportedContent">
        <?php
        if ( has_nav_menu('main_menu') ) {
            wp_nav_menu(array(
                'menu' => 'main_menu',
                'theme_location' => 'main_menu',
                'container' => null,
                'menu_class' => 'navbar-nav menu ' . $ul_class,
                'walker' => new Saasland_Nav_Navwalker(),
                'depth' => 5
            ));
        }
        ?>
        <div class="mobile_menu_btn">
	        <?php
	        get_template_part('template-parts/header_elements/buttons');
	        ?>
        </div>
    </div>
    <?php
endif;