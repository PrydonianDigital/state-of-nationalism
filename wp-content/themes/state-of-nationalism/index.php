<?php
global $wp_query;
$modifications = array();
if( !empty( $_GET['catname'] ) && $_GET['thumbail'] == 'only_thumbnailed' ) {
	$modifications['meta_query'][] = array(
		'key' => '_thumbnail_id',
		'value' => '',
		'compare' => '!='
	);
}

$args = array_merge(
	$wp_query->query_vars,
	$modifications
);

query_posts( $args );
	get_header('blog');
?>

<div class="row">

	<div class="small-12 medium-9 columns">
		<form class="post-filters row">
			<div class="small-12 medium-5 columns">
				<select name="orderby">
					<?php
						$orderby_options = array(
							'post_title' => 'Order By Title',
							'post_date' => 'Order By Date',
						);
						foreach( $orderby_options as $value => $label ) {
							echo "<option ".selected( $_GET['orderby'], $value )." value='$value'>$label</option>";
						}
					?>
				</select>
			</div>
			<div class="small-12 medium-5 columns">
				<select name="order">
					<?php
						$order_options = array(
							'ASC' => 'Ascending',
							'DESC' => 'Descending',
						);
						foreach( $order_options as $value => $label ) {
							echo "<option ".selected( $_GET['order'], $value )." value='$value'>$label</option>";
						}
					?>
				</select>
			</div>
			<div class="small-12 medium-2 columns">
				<input class="button expanded" type="submit" value="Filter">
			</div>
		</form>
		<?php
			if (have_posts()) :
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
				<p><a href="<?php the_permalink(); ?>" class="button">Read article...</a></p>
				Posted in: <?php the_category(', ') ?>

			</div>

		</div>


		<?php endwhile; ?>
		<div class="row align-middle post">
			<div class="small-12 columns text-center">
				<ul class="pagination text-center" role="navigation" aria-label="Pagination"><?php foundation_pagination(); ?></ul>
			</div>
		</div>
		<?php endif; ?>

	</div>

	<?php get_sidebar('articles'); ?>

</div>

<?php get_footer(); ?>