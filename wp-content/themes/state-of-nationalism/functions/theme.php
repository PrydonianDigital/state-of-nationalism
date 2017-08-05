<?php

	// Set content width value based on the theme's design
	if ( ! isset( $content_width ) )
		$content_width = 870;

	// Register Theme Features
	function son_theme()  {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 870, 250, array( 'center', 'top') );
		add_image_size( 'top', 1130, 500, array( 'center', 'center') );
		add_image_size( 'tiny', 100, 100);
		add_image_size( 'media', 60, 60, array( 'center', 'center'));
		add_image_size( 'related', 265, 199, array( 'center', 'center') );
		add_image_size( 'squared', 265, 265, array( 'center', 'top') );
		add_image_size( 'shop', 355, 355 );
		add_image_size( 'tiny', 5, 5 );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'title-tag' );
		show_admin_bar(false);
		add_filter( 'jetpack_development_mode', '__return_true' );
		load_theme_textdomain( 'son', get_template_directory() . '/language' );
		add_theme_support( 'custom-logo', array(
			'height'      => 150,
			'width'       => 500,
			'flex-width' => true,
		) );
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	}
	add_action( 'after_setup_theme', 'son_theme' );

	// Register Style
	function son_css() {
		wp_register_style( 'grid', get_template_directory_uri() . '/icons/foundation-icons.css', false, '3.0' );
		wp_register_style( 'fi', get_template_directory_uri() . '/css/grid.css', false, '6.3.1' );
		wp_enqueue_style( 'grid' );
		wp_enqueue_style( 'fi' );
	}
	add_action( 'wp_enqueue_scripts', 'son_css' );

	// Register JS
	function son_js() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'what', get_template_directory_uri() . '/js/vendor/what-input.js', false, '6.3.1', true );
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/vendor/foundation.min.js', false, '6.3.1', true );
		wp_enqueue_script( 'son', get_template_directory_uri() . '/js/son.js', false, '1', true );
		wp_enqueue_script( 'what' );
		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'son' );
	}
	add_action( 'wp_enqueue_scripts', 'son_js' );

	// Register Navigation Menus
	function son_menus() {
		$locations = array(
			'header' => __( 'Header Menu Left', 'son' ),
			'footer' => __( 'Footer Menu', 'son' ),
		);
		register_nav_menus( $locations );
	}
	add_action( 'init', 'son_menus' );

	function wpdocs_custom_taxonomies_terms_links() {
	    // Get post by post ID.
	    $post = get_post( $post->ID );

	    // Get post type by post.
	    $post_type = $post->post_type;

	    // Get post type taxonomies.
	    $taxonomies = get_object_taxonomies( $post_type, 'objects' );

	    $out = array();

	    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

	        // Get the terms related to post.
	        $terms = get_the_terms( $post->ID, $taxonomy_slug );

	        if ( ! empty( $terms ) ) {
	            $out[] = 'Category: ';
	            foreach ( $terms as $term ) {
	                $out[] = sprintf( '<a href="%1$s">%2$s</a>',
	                    esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
	                    esc_html( $term->name )
	                );
	            }
	            $out[] = "\n</ul>\n";
	        }
	    }
	    return implode( '', $out );
	}

	function grd_custom_archive_title( $title ) {
		return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
	}
	add_filter( 'get_the_archive_title', 'grd_custom_archive_title' );

	function son_sidebars() {
		$args = array(
			'id'			=> 'sidebar',
			'class'		 => 'menu vertical',
			'name'		  => __( 'Sidebar', 'son' ),
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		);
		register_sidebar( $args );
		$args = array(
			'id'			=> 'footer1',
			'class'		 => 'menu vertical',
			'name'		  => __( 'Footer Widgets 1', 'son' ),
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		);
		register_sidebar( $args );
		$args = array(
			'id'			=> 'footer2',
			'class'		 => 'menu vertical',
			'name'		  => __( 'Footer Widgets 2', 'son' ),
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		);
		register_sidebar( $args );
		$args = array(
			'id'			=> 'footer3',
			'class'		 => 'menu vertical',
			'name'		  => __( 'Footer Widgets 3', 'son' ),
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		);
		register_sidebar( $args );
		$args = array(
			'id'			=> 'footer4',
			'class'		 => 'menu',
			'name'		  => __( 'Footer Widgets 4', 'son' ),
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
		);
		register_sidebar( $args );
	}
	add_action( 'widgets_init', 'son_sidebars' );

	function revcon_change_post_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = 'Articles';
	    $submenu['edit.php'][5][0] = 'Articles';
	    $submenu['edit.php'][10][0] = 'Add Article';
	    $submenu['edit.php'][16][0] = 'Article Tags';
	}
	function revcon_change_post_object() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'Articles';
	    $labels->singular_name = 'Article';
	    $labels->add_new = 'Add Article';
	    $labels->add_new_item = 'Add Article';
	    $labels->edit_item = 'Edit Article';
	    $labels->new_item = 'Articles';
	    $labels->view_item = 'View Articles';
	    $labels->search_items = 'Search Articles';
	    $labels->not_found = 'No Articles found';
	    $labels->not_found_in_trash = 'No Articles found in Trash';
	    $labels->all_items = 'All Articles';
	    $labels->menu_name = 'Articles';
	    $labels->name_admin_bar = 'Articles';
	}

	add_action( 'admin_menu', 'revcon_change_post_label' );
	add_action( 'init', 'revcon_change_post_object' );

	function add_current_nav_class( $classes, $item ) {
		global $post;
		if ( empty( $post ) ) {
			return $classes;
		}
		$current_post_type      = get_post_type_object( get_post_type( $post->ID ) );
		$current_post_type_slug = $current_post_type->rewrite['slug'];
		if ( is_null( $current_post_type_slug ) ) {
			if ( $current_post_type->name === 'post' ) {
				foreach ( explode( '/', $GLOBALS['wp_rewrite']->front ) as $front_url ) {
					if ( $front_url !== '' ) {
						$current_post_type_slug = $front_url;
						break;
					}
				}
			}
		}
		$menu_slug = strtolower( trim( $item->url ) );
		if ( strpos( $menu_slug, $current_post_type_slug ) !== false ) {
			$classes[] = 'current-menu-item';
		} else {
			$classes = array_diff( $classes, [ 'current_page_parent' ] );
		}
		return $classes;
	}

	function foundation_pagination( $p = 2 ) {
		if ( is_singular() ) return;
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return;
		if ( empty( $paged ) ) $paged = 1;
		if ( $paged > $p + 1 ) p_link( 1, 'First' );
		if ( $paged > $p + 2 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // Middle pages
				if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class='current'><a href='#'>{$i}</a></li> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
		if ( $paged < $max_page - $p ) p_link( $max_page, 'Last' );
	}
	function p_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "Page {$i}";
		echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a></li> ";
	}

	add_action( 'dashboard_glance_items', 'my_add_cpt_to_dashboard' );
	function my_add_cpt_to_dashboard() {
		$showTaxonomies = 1;
		if ($showTaxonomies) {
			$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
			foreach ( $taxonomies as $taxonomy ) {
				$num_terms	= wp_count_terms( $taxonomy->name );
				$num = number_format_i18n( $num_terms );
				$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name, $num_terms );
				$associated_post_type = $taxonomy->object_type;
				if ( current_user_can( 'manage_categories' ) ) {
					$output = '<a href="edit-tags.php?taxonomy=' . $taxonomy->name . '&post_type=' . $associated_post_type[0] . '">' . $num . ' ' . $text .'</a>';
				}
				echo '<li class="taxonomy-count">' . $output . ' </li>';
			}
		}
		// Custom post types counts
		$post_types = get_post_types( array( '_builtin' => false ), 'objects' );
		foreach ( $post_types as $post_type ) {
			if($post_type->show_in_menu==false) {
				continue;
			}
			$num_posts = wp_count_posts( $post_type->name );
			$num = number_format_i18n( $num_posts->publish );
			$text = _n( $post_type->labels->singular_name, $post_type->labels->name, $num_posts->publish );
			if ( current_user_can( 'edit_posts' ) ) {
				$output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
			}
			echo '<li class="page-count ' . $post_type->name . '-count">' . $output . '</td>';
		}
	}

	function add_menu_icons_styles(){

		echo '<style>
		#dashboard_right_now .bibliography-count a:before {
			content: "\f481";
		}
		#dashboard_right_now .taxonomy-count a:before {
			content: "\f325";
		}
		#dashboard_right_now .author-count a:before {
			content: "\f337";
		}
		</style>';

	}
	add_action( 'admin_head', 'add_menu_icons_styles' );
