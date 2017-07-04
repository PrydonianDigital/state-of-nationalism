<?php get_header('archive'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<?php if (have_posts()) :
			p2p_type( 'author_article' )->each_connected( $wp_query );
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div <?php post_class('row align-top post page'); ?>>

			<div class="small-12 medium-3 columns">

				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('square'); ?></a>

			</div>

			<div class="small-12 medium-9 columns">

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

		</div>


		<?php endwhile; ?>
		<div class="row align-middle post">
			<div class="small-12 medium-6 columns text-center"><?php previous_posts_link('&laquo; Previous') ?></div>
			<div class="small-12 medium-6 columns text-center"><?php next_posts_link('Next &raquo;','') ?></div>
		</div>
		<?php endif; ?>

	</div>

	<?php get_sidebar('post'); ?>

</div>

<?php get_footer(); ?>