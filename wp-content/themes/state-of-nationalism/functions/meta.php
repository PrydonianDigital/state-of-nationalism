<?php

	add_action( 'cmb2_init', 'home_page' );
	function home_page() {
		$prefix = '_bibliography_';
		$cmb_bibliography = new_cmb2_box( array(
			'id'			=> 'bibliography',
			'title'			=> 'Bibliography',
			'object_types'  => array( 'post' ),
			'show_in_rest'	=> true,
		) );
		$cmb_bibliography_id = $cmb_bibliography->add_field( array(
			'id'          => $prefix . 'bibliography',
			'type'        => 'group',
			'description' => 'Add Bibliography records here',
			'options'     => array(
				'group_title'   => 'Record {#}',
				'add_button'    => 'Add Another Record',
				'remove_button' => 'Remove Record',
				'sortable'      => true,
			),
		) );
		$cmb_bibliography->add_group_field($cmb_bibliography_id, array(
			'name'			=> 'Record #',
			'id'			=> 'record',
			'type'			=> 'text_small',
		) );
	}

	add_action( 'cmb2_init', 'faq' );
	function faq() {
		$prefix = '_faq_';
		$cmb_faq = new_cmb2_box( array(
			'id'			=> 'faq',
			'title'			=> 'FAQ',
			'object_types'  => array( 'page' ),
			'show_on'	  => array( 'key' => 'page-template', 'value' => 'template-how-to-contribute.php' ),
			'show_in_rest'	=> true,
		) );
		$cmb_faq_id = $cmb_faq->add_field( array(
			'id'          => $prefix . 'faq',
			'type'        => 'group',
			'description' => 'Add faq records here',
			'options'     => array(
				'group_title'   => 'FAQ {#}',
				'add_button'    => 'Add Another FAQ',
				'remove_button' => 'Remove FAQ',
				'sortable'      => true,
			),
		) );
		$cmb_faq->add_group_field($cmb_faq_id, array(
			'name'			=> 'FAQ Title',
			'id'			=> 'faqt',
			'type'			=> 'text',
		) );
		$cmb_faq->add_group_field($cmb_faq_id, array(
			'name'			=> 'FAQ Content',
			'id'			=> 'faqc',
			'type'			=> 'wysiwyg',
		) );
	}

	add_action( 'cmb2_init', 'authors_page' );
	function authors_page() {
		$prefix = '_author_';
		$cmb_author = new_cmb2_box( array(
			'id'			=> 'author',
			'title'			=> 'Author',
			'object_types'  => array( 'post' ),
			'show_in_rest'	=> true,
		) );
		$cmb_author_id = $cmb_author->add_field( array(
			'id'          => $prefix . 'author',
			'type'        => 'group',
			'description' => 'Add Author',
			'options'     => array(
				'group_title'   => 'Author {#}',
				'add_button'    => 'Add Another Author',
				'remove_button' => 'Remove Author',
				'sortable'      => true,
			),
		) );
		$cmb_author->add_group_field($cmb_author_id, array(
			'name'			=> 'Author',
			'id'			=> 'author',
			'type'			=> 'select',
			'options_cb'	=> 'att_link',
		) );
	}

	function att_link_start( $query_args ) {
		$args = wp_parse_args( $query_args, array(
			'post_type'   => 'author',
			'numberposts' => -1,
		) );
		$posts = get_posts( $args );
		$post_options = array();
		if ( $posts ) {
			foreach ( $posts as $post ) {
			  $post_options[ $post->ID ] = $post->post_title;
			}
		}
		return $post_options;
	}
	function att_link() {
		return att_link_start( array( 'post_type' => 'author', 'numberposts' => -1 ) );
	}

add_filter( 'cmb_meta_boxes' , 'be_metaboxes' );
/**
 * Create Metaboxes
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 *
 */
function be_metaboxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'id' => 'be-cat-2',
		'title' => 'Category 2 Information',
		'pages' => array('post'),
		'show_on' => array(
			'key' => 'taxonomy',
		),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true,
		'fields' => array(
			array(
		        'name' => 'Subtitle',
		        'desc' => '',
	    	    'id' => 'be_post_subtitle',
	        	'type' => 'text'
			),
		),
	);

	return $meta_boxes;
 }

function be_taxonomy_show_on_filter( $display, $meta_box ) {
	if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
		return $display;
	}

	if ( 'taxonomy' !== $meta_box['show_on']['key'] ) {
		return $display;
	}

	$post_id = 0;

	// If we're showing it based on ID, get the current ID
	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	} elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}

	if ( ! $post_id ) {
		return $display;
	}

	foreach( (array) $meta_box['show_on']['value'] as $taxonomy => $slugs ) {
		if ( ! is_array( $slugs ) ) {
			$slugs = array( $slugs );
		}

		$display = false;
		$terms = wp_get_object_terms( $post_id, $taxonomy );
		foreach( $terms as $term ) {
			if ( in_array( $term->slug, $slugs ) ) {
				$display = true;
				break;
			}
		}

		if ( $display ) {
			break;
		}
	}

	return $display;
}
add_filter( 'cmb2_show_on', 'be_taxonomy_show_on_filter', 10, 2 );