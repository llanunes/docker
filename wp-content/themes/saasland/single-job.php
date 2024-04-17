<?php
get_header();
do_action( 'saaland_after_header');
$opt = get_option( 'saasland_opt' );
$apply_btn = !empty( $opt['apply_btn_title'] ) ? $opt['apply_btn_title'] : '';
$apply_url_custom = '';
$custom_apply_url = '';
global $post;

if(function_exists('get_field')) {
    $apply_url_custom = get_field('custom_link_for_job_',$post->ID);
    $custom_apply_url = get_field('sland_job_ink',$post->ID);
}
$apply_url = '';
if ( function_exists( 'saasland_get_page_template_id' ) ) {
    $apply_url = get_permalink(saasland_get_page_template_id()) . "?id=" . get_the_ID();
}
?>

<section class="job_details_area sec_pad">
    <div class="container">
        <div class="row flex-row-reverse">
            <?php if ( have_rows( 'job_attributes') ) : ?>
                <div class="col-lg-4 pl_70">
                    <div class="job_info">
                        <?php if (get_field( 'attribute_section_title')) : ?>
                            <div class="info_head">
                                <?php if (get_field( 'attribute_section_icon')) : ?>
                                    <i class="<?php echo esc_attr(get_field( 'attribute_section_icon')) ?>"></i>
                                <?php endif; ?>
                                <h6 class="f_p f_600 f_size_18 t_color3"> <?php echo esc_html(get_field( 'attribute_section_title')) ?> </h6>
                            </div>
                        <?php endif; ?>
                        <?php
                        while ( have_rows('job_attributes') ) : the_row();
                            $icon_color = get_sub_field('icon_color');
                            $icon_color = "style='color: $icon_color;'"
                            ?>
                            <div class="info_item">
                                <?php if (get_sub_field( 'attribute_icon')) : ?>
                                    <i <?php echo wp_kses_post($icon_color) ?> class="<?php echo esc_attr(get_sub_field( 'attribute_icon')) ?>"></i>
                                <?php endif; ?>
                                <h6> <?php echo esc_html(get_sub_field( 'attribute_title')) ?> </h6>
                                <p> <?php echo esc_html(get_sub_field( 'attribute_value')); ?> </p>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-8">
                <div class="details_content">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
                <?php if($apply_url_custom != '' && $apply_url_custom){
                    ?>
                    <a href="<?php esc_url($custom_apply_url); ?>" class="btn_three btn_hover"><?php echo esc_html( $apply_btn ) ?></a>
                    <?php 
                }else{ ?>
                <form action="<?php echo esc_url($apply_url) ?>" method="post">
                    <button type="submit" name="apply" class="btn_three btn_hover"> <?php echo esc_html( $apply_btn ) ?></button>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();