<form action="" method="post" name="dl_subscribe_addons" class="dl_pro_subscribe_form_action <?php echo esc_attr($_dl_pro_subscriber_skin);?>" data-settings='<?php echo json_encode($dl_sub_type, true);?>'>
    <span class="dl_subs_message"></span>
    <div class="dl_pro_subscribe_form">
        <?php
         foreach($_dl_pro_subscriber_fields as $v){
            if( $v['_dl_field_enable'] != 'yes'){
                continue;
            }
            $type = 'text';
            $name = isset($v['_dl_field_id']) ? $v['_dl_field_id'] : '';
            $title = isset($v['_dl_field_title']) ? $v['_dl_field_title'] : '';
            $placeholder = isset($v['_dl_field_place']) ? $v['_dl_field_place'] : '';
            if( $name == 'email'){
                $type = 'email';
            }
            ?>
        <div class="dl_form_control_wrap dl-field-<?php echo esc_attr($name);?>">
            <?php if( !empty($title) ){?><label><?php esc_html__( esc_attr($title), 'saasland-core' );?></label><?php }?>
            <input type="<?php echo esc_attr($type);?>" class="dl_form_control" <?php ?> name="<?php echo esc_attr($name) ;?>" placeholder="<?php _e( esc_attr($placeholder), 'saasland-core' );?>">
        </div>
        <?php
        }
        if ( !empty($_dl_sub_button_text) ) {
            ?>
            <button type="submit" class="dl_cu_btn dl_btn_hover_style_one">
                <?php echo esc_html__($_dl_sub_button_text, 'saasland-core');?>
                <?php \Elementor\Icons_Manager::render_icon( $_dl_sub_button_icon ); ?>
            </button>
            <?php
        }
        ?>
    </div>
</form>


