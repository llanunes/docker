<?php
/**
 * @package droitelementoraddonspro
 * @developer DroitLab Team
 *
 */
namespace DROIT_ELEMENTOR_PRO;


use \Elementor\Core\Settings\Page\Manager as PageManager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Content_Typography extends \Elementor\Group_Control_Base {

	protected static $fields;
	
	private static $_scheme_fields_keys = [ 'font_family', 'font_weight' ];

	public static function get_scheme_fields_keys() {
		return self::$_scheme_fields_keys;
	}
	public static function get_type() {
		return 'droit-content-typography';
	}

	protected function init_fields() {
		$fields = [];

		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();

		
		$kit_settings = $kit->get_meta( PageManager::META_KEY );

		$default_fonts = isset( $kit_settings['default_generic_fonts'] ) ? $kit_settings['default_generic_fonts'] : 'Sans-serif';

		if ( $default_fonts ) {
			$default_fonts = ', ' . $default_fonts;
		}

		$fields['font_family'] = [
			'label' => esc_html__( 'Family', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::FONT,
			'default' => '',
			'selector_value' => 'font-family: "{{VALUE}}"' . $default_fonts . ';',
		];

		$fields['font_color'] = [
			'label' => esc_html__( 'Color', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'responsive' => true,
			'selector_value' => 'color: {{VALUE}}',
		];
		$fields['font_size'] = [
			'label' => esc_html__( 'Size', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem', 'vw' ],
			'range' => [
				'px' => [
					'min' => 1,
					'max' => 200,
				],
				'vw' => [
					'min' => 0.1,
					'max' => 10,
					'step' => 0.1,
				],
			],
			'responsive' => true,
			'selector_value' => 'font-size: {{SIZE}}{{UNIT}}',
		];

		$typo_weight_options = [
			'' => __( 'Default', 'saasland-core' ),
		];

		foreach ( array_merge( [ 'normal', 'bold' ], range( 100, 900, 100 ) ) as $weight ) {
			$typo_weight_options[ $weight ] = ucfirst( $weight );
		}

		$fields['font_weight'] = [
			'label' => esc_html__( 'Weight', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => $typo_weight_options,
		];

		$fields['text_transform'] = [
			'label' => esc_html__( 'Transform', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => __( 'Default', 'saasland-core' ),
				'uppercase' => esc_html__( 'Uppercase', 'saasland-core' ),
				'lowercase' => esc_html__( 'Lowercase', 'saasland-core' ),
				'capitalize' => esc_html__( 'Capitalize', 'saasland-core' ),
				'none' => esc_html__( 'Normal', 'saasland-core' ),
			],
		];

		$fields['font_style'] = [
			'label' => esc_html__( 'Style', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => __( 'Default', 'saasland-core' ),
				'normal' => esc_html__( 'Normal', 'saasland-core' ),
				'italic' => esc_html__( 'Italic', 'saasland-core' ),
				'oblique' => esc_html__( 'Oblique', 'saasland-core' ),
			],
		];

		$fields['text_decoration'] = [
			'label' => esc_html__( 'Decoration', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => __( 'Default', 'saasland-core' ),
				'underline' => esc_html__( 'Underline', 'saasland-core' ),
				'overline' => esc_html__( 'Overline', 'saasland-core' ),
				'line-through' => esc_html__( 'Line Through', 'saasland-core' ),
				'none' => esc_html__( 'None', 'saasland-core' ),
			],
		];

		$fields['line_height'] = [
			'label' => esc_html__( 'Line-Height', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'desktop_default' => [
				'unit' => 'em',
			],
			'tablet_default' => [
				'unit' => 'em',
			],
			'mobile_default' => [
				'unit' => 'em',
			],
			'range' => [
				'px' => [
					'min' => 1,
				],
			],
			'responsive' => true,
			'size_units' => [ 'px', 'em' ],
			'selector_value' => 'line-height: {{SIZE}}{{UNIT}}',
		];

		$fields['letter_spacing'] = [
			'label' => esc_html__( 'Letter Spacing', 'saasland-core' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => -5,
					'max' => 10,
					'step' => 0.1,
				],
			],
			'responsive' => true,
			'selector_value' => 'letter-spacing: {{SIZE}}{{UNIT}}',
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
		$field_args['groupType'] = 'typography';

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
				'starter_name' => 'typography',
				'starter_title' => esc_html__( 'Typography', 'saasland-core' ),
				'settings' => [
					'render_type' => 'ui',
					'groupType' => 'typography',
					'global' => [
						'active' => true,
					],
				],
			],
		];
	}
}
