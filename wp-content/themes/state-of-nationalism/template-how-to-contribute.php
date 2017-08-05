<?php
	/**
	* Template Name: How To Contribute
	*/
	get_header('page'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

			<?php
				$entries = get_post_meta( $post->ID, '_faq_faq', true );
				foreach ( (array) $entries as $key => $entry ) {
					$faqt = $faqc = '';
					if ( isset( $entry['faqt'] ) )
						$faqt = esc_html( $entry['faqt'] );
					if ( isset( $entry['faqc'] ) )
						$faqc = wpautop( $entry['faqc'] );
			?>
			<div class="callout small faqContainer">
				<h3 class="faq"><a href="#faq<?php echo $key; ?>" data-div="faq<?php echo $key; ?>"><?php echo $faqt; ?> <i class="fi-plus"></i></a></h3>
				<div class="faqshow" id="faq<?php echo $key; ?>"><?php echo $faqc; ?></div>
			</div>
			<?php
				}
			?>

		<?php endwhile; ?>

		<?php endif; ?>

	</div>

	<?php get_sidebar('sidebar'); ?>

</div>

<?php get_footer(); ?>