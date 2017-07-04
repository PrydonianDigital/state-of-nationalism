<?php
	get_header('search');
?>

<div class="row">

	<div class="small-12 medium-9 columns">
		<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
			<div class="input-group">
				<input class="input-group-field" type="text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s">
				<div class="input-group-button">
					<input type="submit" class="button" value="Search">
				</div>
			</div>
		</form>
		<?php if (have_posts()) : ?>
		<h2><?php echo $wp_query->found_posts; ?> results for "<?php the_search_query(); ?>"</h2>
		<?php
			p2p_type( 'author_article' )->each_connected( $wp_query );
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div <?php post_class('row align-top post page'); ?>>

					<?php
						$post_type = get_post_type( $post->ID );
						switch( $post_type ) {
							case 'post':
					?>
					<div class="small-12 medium-3 columns">

						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('square'); ?></a>

					</div>

					<div class="small-12 medium-9 columns">
								<h6><i class="fa fa-quill" aria-hidden="true"></i> Article</h6>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<strong>
								<?php
								foreach ( $post->connected as $post ) : setup_postdata( $post );
								the_title();?>, <?php
								endforeach;
								wp_reset_postdata();
								?><?php the_time('Y'); ?>
								</strong>
								<?php the_excerpt(); ?>
								<p><a href="<?php the_permalink(); ?>" class="button">Read more...</a></p>
								Posted in: <?php the_category(', ') ?>
					</div>
					<?php
							break;
							case 'bibliography':
					?>
					<div class="small-12 columns">

						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<p><strong><?php global $post; $name = get_post_meta( $post->ID, '_bibliography_author', true ); echo $name; ?></strong> <?php $year = get_post_meta( $post->ID, '_bibliography_year', true ); echo $year; ?> <?php $edition = get_post_meta( $post->ID, '_bibliography_edition', true ); echo $edition; ?></p>
						<p><strong>Annotation(s):</strong> <?php $annotation = get_post_meta( $post->ID, '_bibliography_annotation', true ); echo nl2br($annotation); ?> </p>
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
					<?php
							break;
							case 'author':
					?>
					<div class="small-12 columns">
								<h6><i class="fa fa-user-circle" aria-hidden="true"></i> Author</h6>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php the_excerpt(); ?>
								<p><a href="<?php the_permalink(); ?>" class="button">Read more...</a></p>
					</div>
					<?php
							break;
							case 'page':
					?>
					<div class="small-12 medium-3 columns">

						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('square'); ?></a>

					</div>

					<div class="small-12 medium-9 columns">
								<h6><i class="fa fa-file-text2" aria-hidden="true"></i> Page</h6>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php the_excerpt(); ?>
								<p><a href="<?php the_permalink(); ?>" class="button">Read more...</a></p>
					</div>
					<?php
							break;

						}
					?>

		</div>


		<?php endwhile; ?>
		<div class="row align-middle post">
			<div class="small-12 columns text-center">
				<ul class="pagination text-center" role="navigation" aria-label="Pagination"><?php foundation_pagination(); ?></ul>
			</div>
		</div>

		<?php else : ?>

		<h2><?php echo $wp_query->found_posts; ?> results for "<?php the_search_query(); ?>"</h2>

		<?php endif; ?>

	</div>

	<?php get_sidebar('article'); ?>

</div>

<?php get_footer(); ?>