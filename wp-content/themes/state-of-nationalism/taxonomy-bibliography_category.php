<?php get_header('archive-bibliography'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<h2><?php single_cat_title(); ?></h2>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class('row align-middle post page'); ?>>

			<div class="small-12 columns">

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<p><strong><?php global $post; $name = get_post_meta( $post->ID, '_bibliography_author', true ); echo $name; ?></strong> <?php $year = get_post_meta( $post->ID, '_bibliography_year', true ); echo $year; ?> <?php $edition = get_post_meta( $post->ID, '_bibliography_edition', true ); echo $edition; ?></p>
				<?php
					$terms = get_the_terms( get_the_ID(), 'bibliography_tag' );

					if ( $terms && ! is_wp_error( $terms ) ) :

					    $draught_links = array();

					    foreach ( $terms as $term ) {
					        $draught_links[] = $term->name;
					    }

					    $bibliography_tag = join( ', ', $draught_links );
					?>

					    <p class="beers draught">
					        <strong>Keywords:</strong> <?php echo get_the_term_list( $post->ID, 'bibliography_tag', '', ', ', '' ); ?>
					    </p>
				<?php endif; ?>
			</div>

		</div>


		<?php endwhile; ?>
		<div class="row align-middle post">
			<div class="small-12 medium-6 columns text-center"><?php previous_posts_link('&laquo; Previous') ?></div>
			<div class="small-12 medium-6 columns text-center"><?php next_posts_link('Next &raquo;','') ?></div>
		</div>
		<?php endif; ?>

	</div>

	<?php get_sidebar('bibliography'); ?>

</div>

<?php get_footer(); ?>