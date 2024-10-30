<?php
/**
 * Register Post Types
 *
 * @package ssbp-block-pattern
 */

if ( ! function_exists( 'ssbp_register_post_type' ) ) {
	/**
	 * Register Custom Post Type Block Pattern.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function ssbp_register_post_type() {
		$labels = array(
			'name'                  => _x( 'Block Patterns', 'Post Type General Name', 'block-pattern' ),
			'singular_name'         => _x( 'Block Pattern', 'Post Type Singular Name', 'block-pattern' ),
			'menu_name'             => _x( 'Block Patterns', 'Admin Menu text', 'block-pattern' ),
			'name_admin_bar'        => _x( 'Block Pattern', 'Add New on Toolbar', 'block-pattern' ),
			'archives'              => __( 'Block Pattern Archives', 'block-pattern' ),
			'attributes'            => __( 'Block Pattern Attributes', 'block-pattern' ),
			'parent_item_colon'     => __( 'Parent Block Pattern:', 'block-pattern' ),
			'all_items'             => __( 'All Block Patterns', 'block-pattern' ),
			'add_new_item'          => __( 'Add New Block Pattern', 'block-pattern' ),
			'add_new'               => __( 'Add New', 'block-pattern' ),
			'new_item'              => __( 'New Block Pattern', 'block-pattern' ),
			'edit_item'             => __( 'Edit Block Pattern', 'block-pattern' ),
			'update_item'           => __( 'Update Block Pattern', 'block-pattern' ),
			'view_item'             => __( 'View Block Pattern', 'block-pattern' ),
			'view_items'            => __( 'View Block Patterns', 'block-pattern' ),
			'search_items'          => __( 'Search Block Pattern', 'block-pattern' ),
			'not_found'             => __( 'Not found', 'block-pattern' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'block-pattern' ),
			'featured_image'        => __( 'Featured Image', 'block-pattern' ),
			'set_featured_image'    => __( 'Set featured image', 'block-pattern' ),
			'remove_featured_image' => __( 'Remove featured image', 'block-pattern' ),
			'use_featured_image'    => __( 'Use as featured image', 'block-pattern' ),
			'insert_into_item'      => __( 'Insert into Block Pattern', 'block-pattern' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Block Pattern', 'block-pattern' ),
			'items_list'            => __( 'Block Patterns list', 'block-pattern' ),
			'items_list_navigation' => __( 'Block Patterns list navigation', 'block-pattern' ),
			'filter_items_list'     => __( 'Filter Block Patterns list', 'block-pattern' ),
		);
		$args   = array(
			'label'               => __( 'Block Pattern', 'block-pattern' ),
			'description'         => __( 'The Block Patterns', 'block-pattern' ),
			'labels'              => $labels,
			'menu_icon'           => 'dashicons-art',
			'supports'            => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
				'author',
				'comments',
				'trackbacks',
				'page-attributes',
				'custom-fields',
			),
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);

		register_post_type( 'ssbp-block-pattern', $args );

		// Register Taxonomy.
		$cat_labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'block-pattern' ),
			'singular_name'     => _x( 'Categories', 'taxonomy singular name', 'block-pattern' ),
			'search_items'      => __( 'Search Category', 'block-pattern' ),
			'all_items'         => __( 'All Categories', 'block-pattern' ),
			'parent_item'       => __( 'Parent Category', 'block-pattern' ),
			'parent_item_colon' => __( 'Parent Category:', 'block-pattern' ),
			'edit_item'         => __( 'Edit Category', 'block-pattern' ),
			'update_item'       => __( 'Update Category', 'block-pattern' ),
			'add_new_item'      => __( 'Add New Category', 'block-pattern' ),
			'new_item_name'     => __( 'New Category Name', 'block-pattern' ),
			'menu_name'         => __( 'Categories', 'block-pattern' ),
		);

		$cat_args = array(
			'hierarchical'      => true,
			'labels'            => $cat_labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'ssbp-categories', array( 'ssbp-block-pattern' ), $cat_args );

		// Register Taxonomy.
		$cat_labels = array(
			'name'              => _x( 'Keywords', 'taxonomy general name', 'block-pattern' ),
			'singular_name'     => _x( 'Keywords', 'taxonomy singular name', 'block-pattern' ),
			'search_items'      => __( 'Search Keyword', 'block-pattern' ),
			'all_items'         => __( 'All Keywords', 'block-pattern' ),
			'parent_item'       => __( 'Parent Keyword', 'block-pattern' ),
			'parent_item_colon' => __( 'Parent Keyword:', 'block-pattern' ),
			'edit_item'         => __( 'Edit Keyword', 'block-pattern' ),
			'update_item'       => __( 'Update Keyword', 'block-pattern' ),
			'add_new_item'      => __( 'Add New Keyword', 'block-pattern' ),
			'new_item_name'     => __( 'New Keyword Name', 'block-pattern' ),
			'menu_name'         => __( 'Keywords', 'block-pattern' ),
		);

		$cat_args = array(
			'hierarchical'      => true,
			'labels'            => $cat_labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		register_taxonomy( 'ssbp-keywords', array( 'ssbp-block-pattern' ), $cat_args );
	}

	add_action( 'init', 'ssbp_register_post_type' );
}
