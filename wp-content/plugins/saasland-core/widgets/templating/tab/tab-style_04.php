<ul class="nav nav-tabs se_tab_nav" role="tablist">
    <?php
        foreach ( $tab_list as $index => $v ) : 
            $tab_count = $index + 1;
            $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', '$v', $index );
            $active = $tab_count == 1 ? 'active' : '';
            $this->add_render_attribute( $tab_title_setting_key, [
                'class' => [ 'nav-link', $active],
                'id' => 'saas'.'-tab-'.$id_int . $tab_count,
                'data-bs-toggle' => 'tab',
                'href' => '#se-tab-content-' . $id_int . $tab_count,
            ]); 
    ?>
    <li class="nav-item" id="<?php echo $v['_id'] ?>">
        <a <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>>
            <?php \Elementor\Icons_Manager::render_icon( $v['tab_selected_icon'] ); ?>
            <?php if(!empty($v['tab_title'])){?>
                    <h5><?php echo esc_html__($v['tab_title']); ?></h5>
                <?php }
            ?>
        </a>
    </li>
    <?php endforeach?>
</ul>
<div class="tab-content se_tab_inner" id="myTabContent">
    <?php
        foreach ($tab_list as $index=> $v):
            $tab_count = $index + 1;
            $active = $tab_count == 1 ? 'show active' : '';
            $tab_content_setting_key= $this->get_repeater_setting_key('image1', '$v', $index);
            $this->add_render_attribute($tab_content_setting_key, [
                'class' =>  [ 'tab-pane fade', $active ],
                'id' => 'se-tab-content-' . $id_int . $tab_count,
            ]);
        ?>
        <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="se_tab_img_box text-center">
                        <?php if(!empty ($v['se_tab_image_one']['id'])){?>
                            <?php echo wp_get_attachment_image( $v['se_tab_image_one']['id'], 'full', '', array( 'class' => 'se_tab_img') ); ?>
                        <?php } ?>
                        <?php if(!empty ($v['se_tab_image_two']['id'])){?>
                            <?php echo wp_get_attachment_image( $v['se_tab_image_two']['id'], 'full', '', array( 'class' => 'se_shap_img') ); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="se_tab_content">
                        <?php if(!empty($v['se_description_title'])){?>
                            <h2><?php echo esc_html($v['se_description_title']) ?></h2>
                        <?php }?>
                        <?php if(!empty($v['se_description_title'])){?>
                            <?php echo Saasland_Core_Helper()->kses_post($v['se_description']) ?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>