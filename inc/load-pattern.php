<?php
/**
 * Register Block Patterns
 *
 * @package block-pattern
 */

if ( ! function_exists( 'ssbp_register_block_patterns' ) ) {
	/**
	 * Register Default Block Patterns.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function ssbp_register_block_patterns() {
		$patterns_args = array(
			'post_type'      => 'ssbp-block-pattern',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$get_patterns = new WP_Query( $patterns_args );

		if ( $get_patterns->have_posts() ) {
			while ( $get_patterns->have_posts() ) {
				$get_patterns->the_post();
				$pattern_slug      = get_post_field( 'post_name', get_the_ID() );
				$pattern_terms     = get_the_terms( get_the_ID(), 'ssbp-categories' );
				$pattern_terms_arr = array();
				if ( ! empty( $pattern_terms ) && ! is_wp_error( $pattern_terms ) ) {
					foreach ( $pattern_terms as $pattern_term ) {
						$pattern_terms_arr[] = $pattern_term->slug;
					}
				}

				$pattern_keywords     = get_the_terms( get_the_ID(), 'ssbp-keywords' );
				$pattern_keywords_arr = array();
				if ( ! empty( $pattern_keywords ) && ! is_wp_error( $pattern_keywords ) ) {
					foreach ( $pattern_keywords as $pattern_keyword ) {
						$pattern_keywords_arr[] = $pattern_keyword->slug;
					}
				}

				register_block_pattern(
					'ssbp-block-pattern/ssbp-' . $pattern_slug,
					array(
						'title'         => get_the_title(),
						'description'   => get_the_excerpt(),
						'content'       => get_the_content(),
						'categories'    => $pattern_terms_arr,
						'keywords'      => $pattern_keywords_arr,
						'viewportWidth' => 800,
					)
				);
			}
		}

		$patterns_terms = get_terms( 'ssbp-categories', array( 'hide_empty' => false ) );

		if ( ! empty( $patterns_terms ) && ! is_wp_error( $patterns_terms ) ) {
			foreach ( $patterns_terms as $patterns_term ) {
				register_block_pattern_category(
					$patterns_term->slug,
					array( 'label' => __( $patterns_term->name, 'block-pattern' ) )
				);
			}
		}
	}

	add_action( 'init', 'ssbp_register_block_patterns' );
}
