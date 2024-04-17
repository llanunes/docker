<?php
Redux::set_section( 'saasland_opt', array(
    'title'      => esc_html__( 'Animation', 'saasland' ),
    'id'         => 'animation_settings',
    'icon'       => 'dashicons dashicons-controls-play',
    'fields'     => array(
        array(
            'title'     => esc_html__( 'Website Animation', 'saasland' ),
            'subtitle'  => esc_html__( 'This will totally turn off all animations of this website.', 'saasland' ),
            'id'        => 'is_anim',
            'type'      => 'switch',
            'default'   => '1',
        ),
    )
));