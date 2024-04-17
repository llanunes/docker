<?php
$opt = get_option( 'saasland_opt' );
$preloader_image = isset($opt['preloader_image']['url'] ) ? $opt['preloader_image']['url'] : SAASLAND_DIR_IMG.'/status.gif';
?>

<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="txt-loading">
            <img src="<?php echo esc_url($preloader_image); ?>" alt="Italian Trulli">
            </div>
        </div>
    </div>
</div>