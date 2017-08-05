<?php
global $wp_query;
$modifications = array();
if( !empty( $_GET['catname'] ) ) {
	$modifications['category_name'] = $_GET['catname'];
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
			<div class="small-12 columns">
				<h5>Filter Articles</h5>
				<div class="input-group">
					<select name="orderby" class="input-group-field">
						<?php
							$orderby_options = array(
								'post_date' => 'Order By Date',
								'post_title' => 'Order By Title',
							);
							foreach( $orderby_options as $value => $label ) {
								echo "<option ".selected( $_GET['orderby'], $value )." value='$value'>$label</option>";
							}
						?>
					</select>
					<select name="order" class="input-group-field">
						<?php
							$order_options = array(
								'DESC' => 'Descending',
								'ASC' => 'Ascending',
							);
							foreach( $order_options as $value => $label ) {
								echo "<option ".selected( $_GET['order'], $value )." value='$value'>$label</option>";
							}
						?>
					</select>
					<div class="input-group-button">
						<input class="button input-group-field" type="submit" value="Filter">
					</div>
				</div>
			</div>
		</form>
		<?php
			if (have_posts()) : while (have_posts()) : the_post(); ?>

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
						<a href="#" data-div="moreinfo<?php the_ID(); ?>"><i class="fi-plus"></i> <span>Show details</span> </a>
					</div>
					<div id="moreinfo<?php the_ID(); ?>" class="moreinfo">
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>" class="button">Read full article...</a></p>
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
		<?php endif; ?>

	</div>

	<?php get_sidebar('sidebar'); ?>

</div>

<?php get_footer(); ?>