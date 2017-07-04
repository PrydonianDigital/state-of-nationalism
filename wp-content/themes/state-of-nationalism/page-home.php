<?php get_header('home'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

		<?php endif; ?>

	</div>

	<?php get_sidebar('page'); ?>

</div>

<?php get_footer(); ?>