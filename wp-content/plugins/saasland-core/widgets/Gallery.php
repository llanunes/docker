<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * WPML_get_app_download
 */
class Gallery extends Widget_Base {

    public function get_name() {
        return 'saasland_gallery';
    }

    public function get_title() {
        return __( 'Gallery (Saasland)', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_style_depends() {
        return ['saasland-images'];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /**
     * Name: register_controls
     * Desc: Register controls for these widgets
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    protected function register_controls() {
        $this-> saasland_elementor_content_control();
        $this-> saasland_elementor_style_control();
    }

    /**
     * Name: saasland_elementor_content_control
     * Desc: Register content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_content_control() {

        // ------------------------------ Gallery ------------------------------ //
        $this->start_controls_section(
            'gallery_sec', [
                'label' => __( 'Gallery', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'galleries', [
                'label' => __( 'Add Image', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'separator'=> 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(), [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'page_link', [
                'label' => __( 'Page Link', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::URL,
                'separator'=> 'before',
                'condition' => [
                    'style' => '5'
                ]
            ]
        );

        $this->end_controls_section();//End Gallery

    }


    /**
     * Name: saasland_elementor_style_control
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    public function saasland_elementor_style_control() {


    }


    /**
     * Name: render
     * Desc: Widgets Render
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @saasland
     * Author: DroitThemes
     * Developer: Droitlab Team
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); //Array to variable conversation

        ?>
        <div class="pho_instragram_gallery">
            <?php
            if ( !empty($galleries) ) {
                foreach ( $galleries as $gallery ) {
                    ?>
                    <div class="instragram_gallery_col">
                        <a href="<?php echo esc_url($gallery['url']) ?>" class="item">
                            <?php echo wp_get_attachment_image($gallery['id'], $settings['thumbnail_size']) ?>
                            <i class="icon-instagram"></i>
                        </a href="<?php echo esc_url($gallery['url']) ?>">
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}