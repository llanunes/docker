<div class="shop_testimonial_slider_info">
        <div class="shop_testimonial_slider">
        <?php
    if ( $testimonials ) {
        foreach ( $testimonials as $testimonial ) {

            $image_html = '<img src="'.$testimonial['testimonial_image']['url'].'" alt="Placeholder Image">';
            if($testimonial['testimonial_image']['id'] != ' ') {
                $image_html = wp_get_attachment_image( $testimonial['testimonial_image']['id'], 'thumbnail');
            }

          ?>
           <div class="item">
                <div class="author_img">
                   <?php echo saasland_core_return( $image_html ); ?>
                </div>
                <?php if('' != $testimonial['name']){ ?>
                 <div class="name"><?php echo esc_html($testimonial['name']); ?></div>
                <?php }
                  if($testimonial['content'] != '') { ?>
                       <h2><?php echo esc_html($testimonial['content']); ?></h2>
                      <?php } 
                      
                       $rating  = $testimonial['rating'];
                       $rating_count = 5 - $testimonial['rating']; ?>

                    <div class="ratting-ele">
                            <?php 
                            for($x = 1;  $x <= $rating; $x++ ){
                                ?>
                                <i class="fas fa-star"></i>
                                <?php 
                            }
                            
                            if($rating_count != 0) {
                                for($x = 1;  $x <= $rating_count; $x++ ){
                                    ?>
                                    <i class="far fa-star"></i>
                                    <?php 
                                }
                            }
                            ?>
                    </div>
            </div>
          <?php   
        }}
            ?>
           
        </div>
        <div class="slider_arrow_two">
            <div class="prev"><i class="icon-arrow-left"></i></div>
            <div class="next"><i class="icon-arrow-right-3"></i></div>
        </div>
    </div>
   