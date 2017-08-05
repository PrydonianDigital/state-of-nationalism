<?php

	function SoN_Published_Widget() {
		register_widget( 'SoN_Published' );
	}
	add_action( 'widgets_init', 'SoN_Published_Widget' );
	class SoN_Published extends WP_Widget {
		function __construct() {
			$widget_ops = array( 'classname' => 'widget_draft', 'description' => __( 'SoN Published Articles', 'son' ) );
			parent::__construct( 'SoN_Published', __( 'SoN Published Articles', 'son' ), $widget_ops );
		}
		function widget( $args, $instance) {
			$title = apply_filters( 'widget_title', $instance['title']);
			echo '<li class="widget"><h5>' . $title . '</h5>';
			$args = array(
				'post_type'             => array( 'post' ),
				'order'					=> 'DESC',
				'orderby'				=> 'date'
			);
			$published = new WP_Query( $args );
			if ( $published->have_posts() ) :
				while ( $published->have_posts() ) : $published->the_post();
					echo '<div class="row">';
					echo '<div class="small-12 columns"><a href="' . get_the_permalink() . '"><div class="callout primary small"><h6>' . get_the_title() . ' <small>';
					$entries = get_post_meta( get_the_ID(), '_author_author', true );
					$out = array();
					foreach ( (array) $entries as $key => $entry ) {
						$author = '';
						if ( isset( $entry['author'] ) )
							$author = get_the_title( $entry['author'] );
						array_push($out, "$author");
					}
					echo '<br>' . implode(', ', $out);
					echo ' ' . get_the_date('Y');
					echo '</small></h6></div></a></div>';
					echo '</div>';
				endwhile;
				echo '</li>';
			endif;
			wp_reset_postdata();
		}
		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'SoN Published Articles', 'son' );
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['SoN_Published'] = $new_instance['SoN_Published'];
			return $instance;
		}
	}

	function SoN_Drafts_Widget() {
		register_widget( 'SoN_Drafts' );
	}
	add_action( 'widgets_init', 'SoN_Drafts_Widget' );
	class SoN_Drafts extends WP_Widget {
		function __construct() {
			$widget_ops = array( 'classname' => 'widget_draft', 'description' => __( 'SoN Draft Articles', 'son' ) );
			parent::__construct( 'SoN_Drafts', __( 'SoN Draft Articles', 'son' ), $widget_ops );
		}
		function widget( $args, $instance) {
			$title = apply_filters( 'widget_title', $instance['title']);
			echo '<li class="widget"><h5>' . $title . '</h5>';
			$args = array(
				'post_type'              => array( 'post' ),
				'post_status'            => array( 'draft' ),
			);
			$drafts = new WP_Query( $args );
			if ( $drafts->have_posts() ) :
				while ( $drafts->have_posts() ) :
					$drafts->the_post();
					echo '<div class="row">';
					echo '<div class="small-12 columns"><div class="callout small secondary"><h6>' . get_the_title() . '</h6>';
					echo '</div></div>';
					echo '</div>';
				endwhile;
				echo '</li>';
			endif;
			wp_reset_postdata();

		}

		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'SoN Draft Articles', 'son' );
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['SoN_Drafts'] = $new_instance['SoN_Drafts'];
			return $instance;
		}
	}

	function SoN_Authors_Widget() {
		register_widget( 'SoN_Authors' );
	}
	add_action( 'widgets_init', 'SoN_Authors_Widget' );
	class SoN_Authors extends WP_Widget {
		function __construct() {
			$widget_ops = array( 'classname' => 'widget_author', 'description' => __( 'SoN Author Bio', 'son' ) );
			parent::__construct( 'SoN_Authors', __( 'SoN Author Bio', 'son' ), $widget_ops );
		}
		function widget( $args, $instance) {
		?>
		<li class="widget author">
		<?php
			echo '<div class="row">';
			echo '<div class="small-12 columns">';
			$entries = get_post_meta( get_the_ID(), '_author_author', true );
			foreach ( (array) $entries as $key => $entry ) {
				$author = '';
				if ( isset( $entry['author'] ) )
					$author = esc_html( $entry['author'] );
		?>
			<div class="card">
				<div class="card-divider">
					<?php echo get_the_title($author); ?>
				</div>
				<?php echo get_the_post_thumbnail($author, 'squared'); ?>
				<div class="card-section">
					<?php $content = get_post($author); setup_postdata( $content, $more_link_text, $stripteaser ); the_content(); wp_reset_postdata( $content );  ?>
				</div>
			</div>
		<?php
			}
			echo '</div>';
			echo '</div>';
		?>
		</li>
		<?php
		}

		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'SoN Author Bio', 'son' );
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['SoN_Authors'] = $new_instance['SoN_Authors'];
			return $instance;
		}
	}

	function SoN_Articles_Search_Widget() {
		register_widget( 'SoN_Articles_Search' );
	}
	add_action( 'widgets_init', 'SoN_Articles_Search_Widget' );
	class SoN_Articles_Search extends WP_Widget {
		function __construct() {
			$widget_ops = array( 'classname' => 'widget_author', 'description' => __( 'SoN Articles Search', 'son' ) );
			parent::__construct( 'SoN_Articles_Search', __( 'SoN Articles Search', 'son' ), $widget_ops );
		}
		function widget( $args, $instance) {
			$title = apply_filters( 'widget_title', $instance['title']);
		?>
		<li class="widget" itemscope itemtype="http://schema.org/WebSite">
		<meta itemprop="url" content="<?php echo bloginfo('url'); ?>"/>
		<h5><?php echo $title; ?></h5>
		<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
			<meta itemprop="target" content="<?php echo bloginfo('url'); ?>?post_type=post&s={s}"/>
			<div class="input-group">
				<input itemprop="query-input" class="input-group-field" type="text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
				<input type="hidden" name="post_type" value="post" />
				<div class="input-group-button">
					<input type="submit" class="button" value="Search">
				</div>
			</div>
		</form>
		</li>
		<?php
		}

		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'SoN Articles Search', 'son' );
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['SoN_Search'] = $new_instance['SoN_Search'];
			return $instance;
		}
	}

	function SoN_Search_Widget() {
		register_widget( 'SoN_Search' );
	}
	add_action( 'widgets_init', 'SoN_Search_Widget' );
	class SoN_Search extends WP_Widget {
		function __construct() {
			$widget_ops = array( 'classname' => 'widget_author', 'description' => __( 'SoN Search', 'son' ) );
			parent::__construct( 'SoN_Search', __( 'SoN Search', 'son' ), $widget_ops );
		}
		function widget( $args, $instance) {
			$title = apply_filters( 'widget_title', $instance['title']);
		?>
		<li class="widget">
		<h5><?php echo $title; ?></h5>
		<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
			<div class="input-group">
				<input class="input-group-field" type="text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
				<div class="input-group-button">
					<input type="submit" class="button" value="Search">
				</div>
			</div>
		</form>
		</li>
		<?php
		}

		function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) {
				$title = $instance[ 'title' ];
			} else {
				$title = __( 'SoN Search', 'son' );
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['SoN_Search'] = $new_instance['SoN_Search'];
			return $instance;
		}
	}