<?php
Redux::set_section('saasland_opt', array(
    'title'     => esc_html__( 'Get Updated', 'saasland' ),
    'id'        => 'subscription_us',
    'icon'      => 'dashicons dashicons-update-alt',
    'fields'    => array(

        array(
            'id'    => 'subscript',
            'type'  => 'custom_fields',
        ),

    ),
));