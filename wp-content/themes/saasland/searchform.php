<?php

add_filter( 'get_search_form', function($form) {
    $value = get_search_query() ? get_search_query() : '';
    $form = '<form action="'.esc_url(home_url("/")).'" class="search-form input-group">
                <input type="search" name="s" class="form-control" placeholder="'.esc_attr__( 'Search', 'saasland' ).'" value="'.esc_attr($value).'">
                <span class="input-group-addon"><button type="submit">'.saasland_get_icon_svg('saasland-svg-icon', 'ti-search', '14').'</button></span>
             </form>';
    return $form;
});