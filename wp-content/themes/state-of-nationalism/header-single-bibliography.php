<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<div class="off-canvas-wrapper">

	<div class="off-canvas position-left dark" id="offCanvas" data-off-canvas>
		<?php wp_nav_menu(array('theme_location' => 'header', 'menu_class' => 'vertical menu')); ?>
	</div>

	<div class="off-canvas-content" data-off-canvas-content>
		<?php
			$page = get_page_by_title( 'Home' );
			$image =  $page->ID;
			$thumb = get_the_post_thumbnail_url( $image, 'full' );
		?>
		<?php get_template_part('parts/top', 'nav'); ?>
		<div class="hero-section" style="background: url(<?php echo $thumb; ?>)">
			<div class="hero-section-text">
				<h1>Annotated Bibliography</h1>
			</div>
		</div>
