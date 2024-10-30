<?php
/**
 * Enqueue admin scripts
 */
if ( ! function_exists( 'ssbp_enqueue_admin_scripts' ) ) {
	function ssbp_enqueue_admin_scripts( $hook ) {
		if ( false !== strpos( $hook, 'ssbp-block-pattern' ) ) {
			wp_enqueue_style( 'ssbp-admin-style', SSBP_PLUGIN_URL . 'assets/css/style.css', array(), 'all' );

			wp_enqueue_script( 'ssbp-admin-custom-js', SSBP_PLUGIN_URL . 'assets/js/custom.js', array('jquery'), 'all', true );
		
			wp_localize_script( 'ssbp-admin-custom-js', 'ssbpApiSettings', array(
				'nonce' => wp_create_nonce( 'wp_rest' ),
				'insert_pattern' => __( 'Insert Pattern', 'block-pattern' ),
				'preview' => __( 'Preview', 'block-pattern' ),
				'empty_username' => __( 'Please enter any username to search block patterns.', 'block-pattern' ),
				'no_patterns' => __( 'No block patterns were found by this author.', 'block-pattern' ),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			) );
		}
	}
	add_action( 'admin_enqueue_scripts', 'ssbp_enqueue_admin_scripts' );
}

/**
 * Adds "Browse Patterns" button on patterns list page
 */
if ( ! function_exists( 'ssbp_add_browse_patterns_button' ) ) {
	add_action('admin_head-edit.php','ssbp_add_browse_patterns_button');

	function ssbp_add_browse_patterns_button()
	{
		$current_screen = get_current_screen();
		if ('ssbp-block-pattern' != $current_screen->post_type) {
			return;
		}
		?>
			<script type="text/javascript">
				jQuery(document).ready( function($)
				{
					jQuery("<a href='<?php echo esc_url( admin_url( 'edit.php?post_type=ssbp-block-pattern&page=ssbp-browse-patterns' ) ); ?>' id='doc_popup' class='add-new-h2'>Browse Patterns</a>").insertAfter(jQuery(".wrap h1").next('a')[0]);
				});
			</script>
		<?php
	}
}

/**
 * Adds "Browse Patterns" menu
 */
if ( ! function_exists( 'ssbp_add_browse_patterns_menu' ) ) {
	add_action( 'admin_menu', 'ssbp_add_browse_patterns_menu' );

	function ssbp_add_browse_patterns_menu()
	{
		add_submenu_page(
			'edit.php?post_type=ssbp-block-pattern',
			'Browse Patterns',
			__( 'Browse Patterns', 'block-pattern' ),
			'manage_options',
			'ssbp-browse-patterns',
			'ssbp_browse_patterns_settings_page'
		);
	}
}

/**
 * Add Browse Patterns file
 */
if ( ! function_exists( 'ssbp_browse_patterns_settings_page' ) ) {
	function ssbp_browse_patterns_settings_page()
	{
		require_once plugin_dir_path( __FILE__ ) . '/browse-patterns.php';
	}
}

/**
 * Add plugin settings page tabs
 */
if ( ! function_exists( 'ssbp_settings_page_tabs' ) ) {
	function ssbp_settings_page_tabs() {
		$tabs = array(
			'latest-patterns'   => __( 'Latest', 'block-pattern' ),
			'author-patterns'   => __( 'By Author', 'block-pattern' )
		);
	
		return $tabs;
	}
}

/**
 * Insert patterns Ajax call
 */
if ( ! function_exists( 'ssbp_insert_pattern_ajax' ) ) {
	add_action( 'wp_ajax_ssbp_insert_pattern_ajax', 'ssbp_insert_pattern_ajax' );
	add_action( 'wp_ajax_nopriv_ssbp_insert_pattern_ajax', 'ssbp_insert_pattern_ajax' );
	
	function ssbp_insert_pattern_ajax() {
		// verify nonce
		check_ajax_referer( 'ssbp_insert_pattern_nonce', 'security' );

		$pattern_id = filter_input( INPUT_POST, 'patternID', FILTER_SANITIZE_NUMBER_INT );

		$api_url = 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/?_locale=user&locale=en_US&include='.$pattern_id.'&_fields=title,pattern_content';

		$request   = wp_remote_get( $api_url );
		if ( !is_wp_error( $request ) ) {
			$all_patters = json_decode( wp_remote_retrieve_body( $request ), true );

			if( !empty( $all_patters ) && is_array( $all_patters ) ) {
				foreach( $all_patters as $pattern ) {
					$pattern_title = $pattern['title']['rendered'];
					$pattern_content = $pattern['pattern_content'];

					// var_dump($pattern_content);

					$my_pattern = array(
						'post_type'      => 'ssbp-block-pattern',
						'post_title'     => $pattern_title,
						'post_content'   => $pattern_content,
						'post_status'    => 'draft',
					);
					wp_insert_post( $my_pattern );		
				}
			}
		}

		wp_die();
	}
}