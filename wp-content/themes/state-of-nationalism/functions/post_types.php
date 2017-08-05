<?php

	// Register Custom Post Type
	function author_post() {

		$labels = array(
			'name'                  => _x( 'Authors', 'Post Type General Name', 'tson' ),
			'singular_name'         => _x( 'Author', 'Post Type Singular Name', 'tson' ),
			'menu_name'             => __( 'Authors', 'tson' ),
			'name_admin_bar'        => __( 'Authors', 'tson' ),
			'archives'              => __( 'Author Archives', 'tson' ),
			'parent_item_colon'     => __( 'Parent Item:', 'tson' ),
			'all_items'             => __( 'All Authors', 'tson' ),
			'add_new_item'          => __( 'Add New Author', 'tson' ),
			'add_new'               => __( 'Add New', 'tson' ),
			'new_item'              => __( 'New Author', 'tson' ),
			'edit_item'             => __( 'Edit Author', 'tson' ),
			'update_item'           => __( 'Update Author', 'tson' ),
			'view_item'             => __( 'View Author', 'tson' ),
			'search_items'          => __( 'Search Authors', 'tson' ),
			'not_found'             => __( 'Not found', 'tson' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'tson' ),
			'featured_image'        => __( 'Featured Image', 'tson' ),
			'set_featured_image'    => __( 'Set featured image', 'tson' ),
			'remove_featured_image' => __( 'Remove featured image', 'tson' ),
			'use_featured_image'    => __( 'Use as featured image', 'tson' ),
			'insert_into_item'      => __( 'Insert into item', 'tson' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'tson' ),
			'items_list'            => __( 'Items list', 'tson' ),
			'items_list_navigation' => __( 'Items list navigation', 'tson' ),
			'filter_items_list'     => __( 'Filter items list', 'tson' ),
		);
		$args = array(
			'label'                 => __( 'Author', 'tson' ),
			'description'           => __( 'Author Description', 'tson' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => array(  ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'				=> 'dashicons-id-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite' 				=> array( 'slug' => 'author', 'with_front' => false ),
			'has_archive'			=> 'author',
		);
		register_post_type( 'author', $args );

	}
	add_action( 'init', 'author_post', 0 );

	function author_article() {
	    p2p_register_connection_type( array(
	        'name' => 'author_article',
	        'from' => 'author',
	        'to' => 'post'
	    ) );
	}
	add_action( 'p2p_init', 'author_article' );

//	function bibliography() {
//
//		$labels = array(
//			'name'                  => _x( 'Bibliography', 'Post Type General Name', 'tson' ),
//			'singular_name'         => _x( 'Bibliography', 'Post Type Singular Name', 'tson' ),
//			'menu_name'             => __( 'Bibliography', 'tson' ),
//			'name_admin_bar'        => __( 'Bibliography', 'tson' ),
//			'archives'              => __( 'Bibliography Archives', 'tson' ),
//			'parent_item_colon'     => __( 'Parent Item:', 'tson' ),
//			'all_items'             => __( 'All Bibliography', 'tson' ),
//			'add_new_item'          => __( 'Add New Bibliography', 'tson' ),
//			'add_new'               => __( 'Add New', 'tson' ),
//			'new_item'              => __( 'New Bibliography', 'tson' ),
//			'edit_item'             => __( 'Edit Bibliography', 'tson' ),
//			'update_item'           => __( 'Update Bibliography', 'tson' ),
//			'view_item'             => __( 'View Bibliography', 'tson' ),
//			'search_items'          => __( 'Search Bibliography', 'tson' ),
//			'not_found'             => __( 'Not found', 'tson' ),
//			'not_found_in_trash'    => __( 'Not found in Trash', 'tson' ),
//			'featured_image'        => __( 'Featured Image', 'tson' ),
//			'set_featured_image'    => __( 'Set featured image', 'tson' ),
//			'remove_featured_image' => __( 'Remove featured image', 'tson' ),
//			'use_featured_image'    => __( 'Use as featured image', 'tson' ),
//			'insert_into_item'      => __( 'Insert into item', 'tson' ),
//			'uploaded_to_this_item' => __( 'Uploaded to this item', 'tson' ),
//			'items_list'            => __( 'Items list', 'tson' ),
//			'items_list_navigation' => __( 'Items list navigation', 'tson' ),
//			'filter_items_list'     => __( 'Filter items list', 'tson' ),
//		);
//		$args = array(
//			'label'                 => __( 'Bibliography', 'tson' ),
//			'description'           => __( 'Bibliography Description', 'tson' ),
//			'labels'                => $labels,
//			'supports'              => array( 'title' ),
//			'taxonomies'            => array(  ),
//			'hierarchical'          => false,
//			'public'                => true,
//			'show_ui'               => true,
//			'show_in_menu'          => true,
//			'menu_position'         => 5,
//			'menu_icon'				=> 'dashicons-clipboard',
//			'show_in_admin_bar'     => true,
//			'show_in_nav_menus'     => true,
//			'can_export'            => true,
//			'has_archive'           => true,
//			'exclude_from_search'   => false,
//			'publicly_queryable'    => true,
//			'capability_type'       => 'page',
//			'show_in_rest'			=> true,
//			'rest_base'				=> 'bibliography',
//			'rest_controller_class' => 'WP_REST_Posts_Controller',
//			'rewrite' 				=> array( 'slug' => 'bibliography', 'with_front' => false ),
//			'has_archive'			=> 'bibliography',
//		);
//		register_post_type( 'bibliography', $args );
//
//	}
//	add_action( 'init', 'bibliography', 0 );
//
//	function post_bibliography() {
//	    p2p_register_connection_type( array(
//	        'name' => 'post_bibliography',
//	        'from' => 'post',
//	        'to' => 'bibliography'
//	    ) );
//	}
//	add_action( 'p2p_init', 'post_bibliography' );
//
//	// Register Custom Taxonomy
//	function bibliography_cat() {
//
//		$labels = array(
//			'name'                       => _x( 'Bibliography Categories', 'Taxonomy General Name', 'son' ),
//			'singular_name'              => _x( 'Bibliography Category', 'Taxonomy Singular Name', 'son' ),
//			'menu_name'                  => __( 'Bibliography Categories', 'son' ),
//			'all_items'                  => __( 'Bibliography Categories', 'son' ),
//			'parent_item'                => __( 'Bibliography Category', 'son' ),
//			'parent_item_colon'          => __( 'Parent Bibliography Category:', 'son' ),
//			'new_item_name'              => __( 'New Bibliography Category Name', 'son' ),
//			'add_new_item'               => __( 'Add New Bibliography Category', 'son' ),
//			'edit_item'                  => __( 'Edit Bibliography Category', 'son' ),
//			'update_item'                => __( 'Update Bibliography Category', 'son' ),
//			'view_item'                  => __( 'View Bibliography Category', 'son' ),
//			'separate_items_with_commas' => __( 'Separate items with commas', 'son' ),
//			'add_or_remove_items'        => __( 'Add or remove items', 'son' ),
//			'choose_from_most_used'      => __( 'Choose from the most used', 'son' ),
//			'popular_items'              => __( 'Popular Items', 'son' ),
//			'search_items'               => __( 'Search Items', 'son' ),
//			'not_found'                  => __( 'Not Found', 'son' ),
//			'no_terms'                   => __( 'No items', 'son' ),
//			'items_list'                 => __( 'Items list', 'son' ),
//			'items_list_navigation'      => __( 'Items list navigation', 'son' ),
//		);
//		$args = array(
//			'labels'                     => $labels,
//			'hierarchical'               => true,
//			'public'                     => true,
//			'show_ui'                    => true,
//			'show_admin_column'          => true,
//			'show_in_nav_menus'          => true,
//			'show_tagcloud'              => true,
//			'show_in_rest'               => true,
//			'rewrite'					 => array( 'slug' => 'bibliography_category', 'with_front' => false ),
//		);
//		register_taxonomy( 'bibliography_category', array( 'bibliography' ), $args );
//
//	}
//	add_action( 'init', 'bibliography_cat', 0 );
//
//	// Register Custom Taxonomy
//	function bibliography_tag() {
//
//		$labels = array(
//			'name'                       => _x( 'Bibliography Tags', 'Taxonomy General Name', 'son' ),
//			'singular_name'              => _x( 'Bibliography Tag', 'Taxonomy Singular Name', 'son' ),
//			'menu_name'                  => __( 'Bibliography Tags', 'son' ),
//			'all_items'                  => __( 'Bibliography Tags', 'son' ),
//			'parent_item'                => __( 'Bibliography Tag', 'son' ),
//			'parent_item_colon'          => __( 'Parent Bibliography Tag:', 'son' ),
//			'new_item_name'              => __( 'New Bibliography Tag', 'son' ),
//			'add_new_item'               => __( 'Add New Bibliography Tag', 'son' ),
//			'edit_item'                  => __( 'Edit Bibliography Tag', 'son' ),
//			'update_item'                => __( 'Update Bibliography Tag', 'son' ),
//			'view_item'                  => __( 'View Bibliography Tag', 'son' ),
//			'separate_items_with_commas' => __( 'Separate items with commas', 'son' ),
//			'add_or_remove_items'        => __( 'Add or remove items', 'son' ),
//			'choose_from_most_used'      => __( 'Choose from the most used', 'son' ),
//			'popular_items'              => __( 'Popular Items', 'son' ),
//			'search_items'               => __( 'Search Items', 'son' ),
//			'not_found'                  => __( 'Not Found', 'son' ),
//			'no_terms'                   => __( 'No items', 'son' ),
//			'items_list'                 => __( 'Items list', 'son' ),
//			'items_list_navigation'      => __( 'Items list navigation', 'son' ),
//		);
//		$args = array(
//			'labels'                     => $labels,
//			'hierarchical'               => false,
//			'public'                     => true,
//			'show_ui'                    => true,
//			'show_admin_column'          => true,
//			'show_in_nav_menus'          => true,
//			'show_tagcloud'              => true,
//			'show_in_rest'               => true,
//			'rewrite'					 => array( 'slug' => 'bibliography_tag', 'with_front' => false ),
//		);
//		register_taxonomy( 'bibliography_tag', array( 'bibliography' ), $args );
//
//	}
//	add_action( 'init', 'bibliography_tag', 0 );
//
//	function wpa_show_permalinks( $post_link, $post ){
//	    if ( is_object( $post ) && $post->post_type == 'show' ){
//	        $terms = wp_get_object_terms( $post->ID, 'bibliography_category' );
//	        if( $terms ){
//	            return str_replace( '%bibliography_category%' , $terms[0]->slug , $post_link );
//	        }
//	    }
//	    return $post_link;
//	}
//	add_filter( 'post_type_link', 'wpa_show_permalinks', 1, 2 );