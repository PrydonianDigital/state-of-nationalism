<?php
	get_header();
	global $post;
?>
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "BlogPosting",
		"mainEntityOfPage": "<?php the_permalink(); ?>",
		"headline": "<?php the_title(); ?>",
		"alternativeHeadline": "<?php the_title(); ?>",
		"image": {
			"@type": "ImageObject",
			"height": "<?php echo $image_height; ?>",
			"width": "<?php echo $image_width; ?>",
			"url": "<?php the_post_thumbnail_url(); ?>"
		},
		"keywords": "<?php if (is_array(get_the_tags())) { $tags = get_the_tags(); foreach($tags as $tag) { echo "$tag->name" . " "; } } ?>",
		"url": "<?php the_permalink(); ?>",
		"datePublished": "<?php echo get_the_date(); ?>",
		"dateCreated": "<?php echo get_the_date(); ?>",
		"dateModified": "<?php the_modified_date(); ?>",
		"description": "<?php the_excerpt(); ?>",
		"articleBody": "<?php the_excerpt(); ?>",
		"publisher": {
		    "@type": "Organization",
			"logo": {
				"@type": "ImageObject",
				"url": "<?php echo get_site_icon_url(); ?>"
			},
		    "name": "<?php bloginfo('name'); ?>"
		},
		"author": {
			"@type": "Person",
			"name": "<?php the_author_meta('display_name');?>"
		}
	}
	</script>
	<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php bloginfo('url'); ?>">
				<span itemprop="name"><?php bloginfo('name'); ?></span>
			</a>
			<meta itemprop="position" content="1" />
		</li> ›
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php bloginfo('url'); ?>/articles/">
				<span itemprop="name">Articles</span>
			</a>
			<meta itemprop="position" content="2" />
		</li> ›
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php the_permalink(); ?>">
				<span itemprop="name"><?php the_title(); ?></span>
			</a>
			<meta itemprop="position" content="3" />
		</li>
	</ol>
<div class="row">

	<div class="small-12 medium-9 columns text-justify">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<ul class="tabs" data-tabs id="article-tabs" data-deep-link="true">
			<li class="tabs-title is-active"><a href="#article" aria-selected="true">Article</a></li>
			<li class="tabs-title"><a href="#bibliography">Annotated Bibliography</a></li>
		</ul>
		<div class="tabs-content" data-tabs-content="article-tabs">
			<div class="tabs-panel is-active" id="article">
				<h4><?php
					$entries = get_post_meta( $post->ID, '_author_author', true );
					$out = array();
					foreach ( (array) $entries as $key => $entry ) {
						$author = '';
						if ( isset( $entry['author'] ) )
							$author = '<span itemprop="author" itemscope itemtype="https://schema.org/Person"><span itemprop="name">' . get_the_title($entry['author']) . '</span></span>';
						array_push($out, "$author");
					}
					echo '<span>' . implode(', ', $out) . '</span>';
				?> <?php the_time('Y'); ?></h4>

				<div class="logoImg" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
					<meta itemprop="url" content="<?php echo get_the_post_thumbnail_url(); ?>">
					<meta itemprop="width" content="870">
					<meta itemprop="height" content="250">
				</div>
				<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
					<div class="logoImg" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<?php
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						?>
						<img src="<?php echo $image[0]; ?>" />
						<meta itemprop="url" content="<?php echo $image[0]; ?>">
						<meta itemprop="width" content="350">
						<meta itemprop="height" content="82">
					</div>
					<meta itemprop="name" content="<?php bloginfo('title'); ?>">
				</div>
				<meta itemprop="datePublished" content="<?php echo get_the_date(); ?>"/>
				<meta itemprop="dateModified" content="<?php echo get_the_modified_date(); ?>"/>

				<?php the_content(); ?>

				<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<div class="tabs-panel" id="bibliography">
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

	<?php get_sidebar('sidebar'); ?>

</div>
<div class="large reveal" id="bibliographyPopup" data-reveal></div>
<?php get_footer(); ?>

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