<?php
	get_header('search');
?>

<div class="row">

	<div class="small-12 medium-9 columns">
		<?php if (have_posts()) : ?>
		<h2><?php echo $wp_query->found_posts; ?> result<?php if($wp_query->found_posts >1 ){ ?>s<?php } else {} ?></h2>
		<?php
			p2p_type( 'author_article' )->each_connected( $wp_query );
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div <?php post_class('row align-top post page'); ?>>

			<div class="small-12 columns">

				<div class="callout small">
					<div class="showhide">
						<h2>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<small>
							<?php
							$entries = get_post_meta( $post->ID, '_author_author', true );
							$out = array();
							foreach ( (array) $entries as $key => $entry ) {
								$author = '';
								if ( isset( $entry['author'] ) )
									$author = esc_html( $entry['author'] );
								array_push($out, "$author");
							}
							echo '<span>' . implode(', ', $out) . '</span>';
						?> <?php the_time('Y'); ?>
							</small>
						</h2>
						<a href="#" class="hollow button openclose" data-div="moreinfo<?php the_ID(); ?>"><i class="fi-plus"></i> <span>Read review</span> </a>
					</div>
					<div id="moreinfo<?php the_ID(); ?>" class="moreinfo">
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>" class="button">Read full review &amp; annotated bibliography</a></p>
					</div>
				</div>

			</div>

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

	<?php get_sidebar('sidebar'); ?>

</div>

<?php get_footer(); ?>