<?php

namespace WPTravelEngine\Filters;

class Template {

	public function hooks() {
		add_filter( 'template_include', array( $this, 'include_trip_template' ) );
		add_filter( 'get_the_excerpt', array( $this, 'get_the_excerpt' ), 11, 2 );
	}

	public function get_the_excerpt( $excerpt, $post ) {
		global $post;

		if ( $post && \WP_TRAVEL_ENGINE_POST_TYPE === $post->post_type && ! has_excerpt( $post ) ) {
			$trip_meta = get_post_meta( $post->ID, 'wp_travel_engine_setting', true );
			$excerpt   = $trip_meta[ 'tab_content' ][ '1_wpeditor' ] ?? $excerpt;
		}

		return $excerpt;
	}

	public function include_trip_template( $template_path ) {
		if ( get_post_type() === \WP_TRAVEL_ENGINE_POST_TYPE ) {
			if ( is_single() ) {
				$template_path = wte_locate_template( 'single-trip.php' );
			}
			if ( is_archive() ) {
				$template_path = wte_locate_template( 'archive-trip.php' );
			}
			$taxonomies = array( 'trip_types', 'destination', 'activities' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$template_path = wte_locate_template( 'taxonomy-' . $tax . '.php' );
				}
			}
		}

		return $template_path;
	}
}
