<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Icon_SVG extends \Elementor\Group_Control_Base {
	
	protected static $fields;
	
	private static $_scheme_fields_keys = [ 'font_family', 'font_weight' ];

	public static function get_scheme_fields_keys() {
		return self::$_scheme_fields_keys;
	}
	public static function get_type() {
		return 'droit-svg';
	}

	protected function init_fields() {
		$fields = [];
		
		$fields['background'] = [
			'label'       => esc_html__( 'Background Type', 'saasland-core' ),
			'type'        => \Elementor\Controls_Manager::CHOOSE,
			'options'     => [
				'classic' => [
					'title' => esc_html__( 'Classic', 'saasland-core' ),
					'icon' => 'eicon-paint-brush',
				],
				'gradient' => [
					'title' => esc_html__( 'Gradient', 'saasland-core' ),
					'icon' => 'eicon-barcode',
				],
			],
			'label_block' => false,
			'render_type' => 'ui',
			'of_type' => 'background',
		];

		$fields['color'] = [
			'label' => esc_html__( 'Color', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'title' => esc_html__( 'Background Color', 'saasland-core' ),
			'selector_value' => 'background-color: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic', 'gradient' ],
			],
		];

		$fields['color_stop'] = [
			'label' => esc_html__( 'Location', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['color_b'] = [
			'label' => esc_html__( 'Second Color', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '#f2295b',
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['color_b_stop'] = [
			'label' => esc_html__( 'Location', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 100,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_type'] = [
			'label' => esc_html__( 'Type', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'linear' => esc_html__( 'Linear', 'saasland-core' ),
				'radial' => esc_html__( 'Radial', 'saasland-core' ),
			],
			'default' => 'linear',
			'render_type' => 'ui',
			'condition' => [
				'background' => [ 'gradient' ],
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_angle'] = [
			'label' => esc_html__( 'Angle', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'default' => [
				'unit' => 'deg',
				'size' => 180,
			],
			'range' => [
				'deg' => [
					'step' => 10,
				],
			],
			'selector_value' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			'condition' => [
				'background' => [ 'gradient' ],
				'gradient_type' => 'linear',
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_position'] = [
			'label' => esc_html__( 'Position', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				'center center' => esc_html__( 'Center Center', 'saasland-core' ),
				'center left' => esc_html__( 'Center Left', 'saasland-core' ),
				'center right' => esc_html__( 'Center Right', 'saasland-core' ),
				'top center' => esc_html__( 'Top Center', 'saasland-core' ),
				'top left' => esc_html__( 'Top Left', 'saasland-core' ),
				'top right' => esc_html__( 'Top Right', 'saasland-core' ),
				'bottom center' => esc_html__( 'Bottom Center', 'saasland-core' ),
				'bottom left' => esc_html__( 'Bottom Left', 'saasland-core' ),
				'bottom right' => esc_html__( 'Bottom Right', 'saasland-core' ),
			],
			'default' => 'center center',
			'selector_value' =>'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			'condition' => [
				'background' => [ 'gradient' ],
				'gradient_type' => 'radial',
			],
			'of_type' => 'gradient',
		];

		$fields['image'] = [
			'label' => esc_html__( 'Image', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'responsive' => true,
			'title' => esc_html__( 'Background Image', 'saasland-core' ),
			'selector_value' =>'background-image: url("{{URL}}");',
			'render_type' => 'template',
			'condition' => [
				'background' => [ 'classic' ],
			],
		];

		$fields['position'] = [
			'label' => esc_html__( 'Position', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => esc_html__( 'Default', 'saasland-core' ),
				'center center' => esc_html__( 'Center Center', 'saasland-core' ),
				'center left' => esc_html__( 'Center Left', 'saasland-core' ),
				'center right' => esc_html__( 'Center Right', 'saasland-core' ),
				'top center' => esc_html__( 'Top Center', 'saasland-core' ),
				'top left' => esc_html__( 'Top Left', 'saasland-core' ),
				'top right' => esc_html__( 'Top Right', 'saasland-core' ),
				'bottom center' => esc_html__( 'Bottom Center', 'saasland-core' ),
				'bottom left' => esc_html__( 'Bottom Left', 'saasland-core' ),
				'bottom right' => esc_html__( 'Bottom Right', 'saasland-core' ),
				'initial' => esc_html__( 'Custom', 'saasland-core' ),

			],
			'selector_value' => 'background-position: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['xpos'] = [
			'label' => esc_html__( 'X Position', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vw' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
			'condition' => [
				'background' => [ 'classic' ],
				'position' => [ 'initial' ],
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_TABLET => [
					'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_tablet.SIZE}}{{ypos_tablet.UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_MOBILE => [
					'selector_value' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_mobile.SIZE}}{{ypos_mobile.UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		];

		$fields['ypos'] = [
			'label' => esc_html__( 'Y Position', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vh' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vh' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selector_value' => 'background-position: {{xpos.SIZE}}{{xpos.UNIT}} {{SIZE}}{{UNIT}}',
			'condition' => [
				'background' => [ 'classic' ],
				'position' => [ 'initial' ],
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_TABLET => [
					'selector_value' => 'background-position: {{xpos_tablet.SIZE}}{{xpos_tablet.UNIT}} {{SIZE}}{{UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_MOBILE => [
					'selector_value' => 'background-position: {{xpos_mobile.SIZE}}{{xpos_mobile.UNIT}} {{SIZE}}{{UNIT}}',
					'condition' => [
						'background' => [ 'classic' ],
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		];

		$fields['attachment'] = [
			'label' => esc_html__( 'Attachment', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Default', 'saasland-core' ),
				'scroll' => esc_html__( 'Scroll', 'saasland-core' ),
				'fixed' => esc_html__( 'Fixed', 'saasland-core' ),
			],
			'selector_value' => [
				'(desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
			],
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['attachment_alert'] = [
			'type' => \Elementor\Controls_Manager::RAW_HTML,
			'content_classes' => 'elementor-control-field-description',
			'raw' => __( 'Note: Attachment Fixed works only on desktop.', 'saasland-core' ),
			'separator' => 'none',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
				'attachment' => 'fixed',
			],
		];

		$fields['repeat'] = [
			'label' => esc_html__( 'Repeat', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => esc_html__( 'Default', 'saasland-core' ),
				'no-repeat' => esc_html__( 'No-repeat', 'saasland-core' ),
				'repeat' => esc_html__( 'Repeat', 'saasland-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'saasland-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'saasland-core' ),
			],
			'selector_value' => 'background-repeat: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['size'] = [
			'label' => esc_html__( 'Size', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'responsive' => true,
			'default' => '',
			'options' => [
				'' => esc_html__( 'Default', 'saasland-core' ),
				'auto' => esc_html__( 'Auto', 'saasland-core' ),
				'cover' => esc_html__( 'Cover', 'saasland-core' ),
				'contain' => esc_html__( 'Contain', 'saasland-core' ),
				'initial' => esc_html__( 'Custom', 'saasland-core' ),
			],
			'selector_value' => 'background-size: {{VALUE}};',
			'condition' => [
				'background' => [ 'classic' ],
				'image[url]!' => '',
			],
		];

		$fields['bg_width'] = [
			'label' => esc_html__( 'Width', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
				'vw' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'size' => 100,
				'unit' => '%',
			],
			'required' => true,
			'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
			'condition' => [
				'background' => [ 'classic' ],
				'size' => [ 'initial' ],
				'image[url]!' => '',
			],
			'device_args' => [
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_TABLET => [
					'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
					'condition' => [
						'background' => [ 'classic' ],
						'size_tablet' => [ 'initial' ],
					],
				],
				\Elementor\Core\Breakpoints\Manager::BREAKPOINT_KEY_MOBILE => [
					'selector_value' => 'background-size: {{SIZE}}{{UNIT}} auto',
					'condition' => [
						'background' => [ 'classic' ],
						'size_mobile' => [ 'initial' ],
					],
				],
			],
		];
		$fields['svg_width'] = [
			'label'      => esc_html__( 'Width', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
				'em' => [
					'min' => 1,
					'max' => 1000,
				],
				'%' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'responsive' => true,
			'size_units' => [ 'px', '%','em' ],
			'selector_value' => 'width: {{SIZE}}{{UNIT}}',
		];
		$fields['svg_height'] = [
			'label'      => esc_html__( 'Height', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 1000,
				],
				'em' => [
					'min' => 1,
					'max' => 1000,
				],
				'%' => [
					'min' => 1,
					'max' => 1000,
				],
			],
			'responsive' => true,
			'size_units' => [ 'px', '%','em' ],
			'selector_value' => 'height: {{SIZE}}{{UNIT}}',
		];
		$fields['icon_horizontal'] = [
			'label' => esc_html__( 'Horizontal', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => ['px', '%', 'em', 'rem'],
			'range' => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
				'%' => [
					'min' => -1000,
					'max' => 1000,
				],
				'em' => [
					'min' => -1000,
					'max' => 1000,
				],
				'rem' => [
					'min' => -1000,
					'max' => 1000,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => '',
			],
			'responsive' => true,
			'render_type' => 'ui',
			'seperator' => 'before',
			//'selector_value' => 'transform: translateY({{SIZE}}{{UNIT}});',
		];
		$fields['icon_vertical'] = [
			'label' => esc_html__( 'Vertical', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => ['px', '%', 'em', 'rem'],
			'range' => [
				'px' => [
					'min' => -1000,
					'max' => 1000,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => '',
			],
			'responsive' => true,
			'render_type' => 'ui',
			'selector_value' => 'transform: translate({{SIZE}}{{UNIT}}, {{icon_horizontal.SIZE}}{{icon_horizontal.UNIT}});',
		];
		$fields['allow_box_shadow'] = [
			'label' => esc_html__( 'Icon Shadow', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Yes', 'saasland-core' ),
			'label_off' => esc_html__( 'No', 'saasland-core' ),
			'return_value' => 'yes',
			'separator' => 'before',
			'render_type' => 'ui',
		];
		
		$fields['icon_shadow'] = [
			'label'     => esc_html__( 'Icon Shadow', 'saasland-core' ),
			'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'selector_value' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{icon_shadow_position.VALUE}};',
		];

		$fields['icon_shadow_position'] = [
			'label' => esc_html__( 'Position', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'options' => [
				' '     => esc_html__( 'Outline', 'saasland-core' ),
				'inset' => esc_html__( 'Inset', 'saasland-core' ),
			],
			'condition' => [
				'allow_box_shadow!' => '',
			],
			'default' => ' ',
			'render_type' => 'ui',
		];
		return $fields;
	}

	protected function prepare_fields( $fields ) {
		array_walk(
			$fields, function( &$field, $field_name ) {

				if ( in_array( $field_name, [ 'typography', 'popover_toggle' ] ) ) {
					return;
				}

				$selector_value = ! empty( $field['selector_value'] ) ? $field['selector_value'] : str_replace( '_', '-', $field_name ) . ': {{VALUE}};';

				$field['selectors'] = [
					'{{SELECTOR}}' => $selector_value,
				];
			}
		);

		return parent::prepare_fields( $fields );
	}

	protected function add_group_args_to_field( $control_id, $field_args ) {
		$field_args = parent::add_group_args_to_field( $control_id, $field_args );

		$field_args['groupPrefix'] = $this->get_controls_prefix();
		$field_args['groupType'] = 'icon_setting';

		$args = $this->get_args();

		if ( in_array( $control_id, self::get_scheme_fields_keys() ) && ! empty( $args['scheme'] ) ) {
			$field_args['scheme'] = [
				'type' => self::get_type(),
				'value' => $args['scheme'],
				'key' => $control_id,
			];
		}

		return $field_args;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_name' => 'icon_setting',
				'starter_title' => esc_html__( 'Icon Setting', 'saasland-core' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'icon_setting',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
