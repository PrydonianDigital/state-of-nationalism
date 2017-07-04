<?php
	get_header();
	global $post;
?>

<div class="row">

	<div class="small-12 medium-9 columns text-justify">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<ul class="tabs" data-tabs id="example-tabs">
			<li class="tabs-title is-active"><a href="#article" aria-selected="true">Article</a></li>
			<li class="tabs-title"><a href="#bibliographySingle">Annotated Bibliography</a></li>
		</ul>
		<div class="tabs-content" data-tabs-content="example-tabs">
			<div class="tabs-panel is-active" id="article">
				<h4><?php
					$connected = new WP_Query( array(
					  'connected_type' => 'author_article',
					  'connected_items' => get_queried_object(),
					  'nopaging' => true,
					) );
					if ( $connected->have_posts() ) : while ( $connected->have_posts() ) : $connected->the_post();
					?>
						<?php the_title(); ?>,
					<?php endwhile; ?>

					<?php
					wp_reset_postdata();
					endif;
					?> <?php the_time('Y'); ?></h4>
				<?php the_content(); ?>

				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="tabs-panel" id="bibliographySingle">
				<div class="bib-back row">
					<div class="small-12 columns">
						<h4><a href="#" class="backMeUp"><i class="fa fa-arrow-left"></i> Back</a></h4>
					</div>
				</div>
				<?php
					$entries = get_post_meta( $post->ID, '_bibliography_bibliography', true );
					$out = array();
					foreach ( (array) $entries as $key => $entry ) {
						$record = '';
						if ( isset( $entry['record'] ) )
							$record = esc_html( $entry['record'] );
						array_push($out, "$record");
					}
					echo '<div id="bibliographyContent" data-records="' . implode(',', $out) . '"></div>';
				?>
			</div>
		</div>

	</div>

	<?php get_sidebar('post'); ?>

</div>

<?php get_footer(); ?>

<script>
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
}
</script>
<?php
	$record = htmlspecialchars($_GET['Record']);
	$author =  htmlspecialchars($_GET['Author']);
	$keyword = htmlspecialchars($_GET['Keywords']);
	$area = htmlspecialchars($_GET['Area']);
	$abbrj = htmlspecialchars($_GET['Abbreviated Journal']);
	$pub = htmlspecialchars($_GET['Publication']);
	$year = htmlspecialchars($_GET['Year']);
	if($record != '') {
?>
		<script>
		singleBibliography($.urlParam('Record'));
		</script>
<?php
	}
	elseif($author != '') {
?>
		<script>
		author($.urlParam('Author'));
		</script>
<?php
	}
	elseif($keyword != '') {

?>
		<script>
		keyword($.urlParam('Keywords'));
		</script>
<?php
	}
	elseif($area != '') {
?>
		<script>
		area($.urlParam('Area'));
		</script>
<?php
	}
	elseif($abbrj != '') {
?>
		<script>
			alert('foo')
		abbrj($.urlParam('Abbreviated Journal'));
		</script>
<?php
	}
	elseif($pub != '') {
?>
		<script>
		publication($.urlParam('Publication'));
		</script>
<?php
	}
	elseif($year != '') {
?>
		<script>
		year($.urlParam('Year'));
		</script>
<?php
	} else {
?>
		<script>
		articleBibliography();
		</script>
<?php
	}
?>