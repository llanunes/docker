<?php 

function overload_path () {
    return __DIR__.'/custom_field/field_custom_field.php';
}

$content = add_filter( "redux/saasland_opt/field/class/custom_fields", "overload_path" ); // Adds the local field asdf
