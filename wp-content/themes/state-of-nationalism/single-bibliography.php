<?php get_header('single-bibliography'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php
				$authorid = get_post_meta( $post->ID, '_bibliography_authorid', true );
				$author = get_post_meta( $post->ID, '_bibliography_author', true );
				$cite = get_post_meta( $post->ID, '_bibliography_cite', true );
				$year = get_post_meta( $post->ID, '_bibliography_year', true );
				$type = get_post_meta( $post->ID, '_bibliography_type', true );
				$pubtitle = get_post_meta( $post->ID, '_bibliography_pubtitle', true );
				$abbrtitle = get_post_meta( $post->ID, '_bibliography_abbrtitle', true );
				$volume = get_post_meta( $post->ID, '_bibliography_volume', true );
				$issue = get_post_meta( $post->ID, '_bibliography_issue', true );
				$pages = get_post_meta( $post->ID, '_bibliography_pages', true );
				$annotation = get_post_meta( $post->ID, '_bibliography_annotation', true );
				$address = get_post_meta( $post->ID, '_bibliography_address', true );
				$corpauthor = get_post_meta( $post->ID, '_bibliography_corpauthor', true );
				$publisher = get_post_meta( $post->ID, '_bibliography_publisher', true );
				$place = get_post_meta( $post->ID, '_bibliography_place', true );
				$editor = get_post_meta( $post->ID, '_bibliography_editor', true );
				$language = get_post_meta( $post->ID, '_bibliography_language', true );
				$sumaddress = get_post_meta( $post->ID, '_bibliography_sumaddress', true );
				$origtitle = get_post_meta( $post->ID, '_bibliography_origtitle', true );
				$seditor = get_post_meta( $post->ID, '_bibliography_seditor', true );
				$stitle = get_post_meta( $post->ID, '_bibliography_stitle', true );
				$astitle = get_post_meta( $post->ID, '_bibliography_astitle', true );
				$svolume = get_post_meta( $post->ID, '_bibliography_svolume', true );
				$sissue = get_post_meta( $post->ID, '_bibliography_sissue', true );
				$edition = get_post_meta( $post->ID, '_bibliography_edition', true );
				$issn = get_post_meta( $post->ID, '_bibliography_issn', true );
				$isbn = get_post_meta( $post->ID, '_bibliography_isbn', true );
				$medium = get_post_meta( $post->ID, '_bibliography_medium', true );
				$area = get_post_meta( $post->ID, '_bibliography_area', true );
				$expedition = get_post_meta( $post->ID, '_bibliography_expedition', true );
				$conference = get_post_meta( $post->ID, '_bibliography_conference', true );
				$notes = get_post_meta( $post->ID, '_bibliography_notes', true );
				$approved = get_post_meta( $post->ID, '_bibliography_approved', true );
				$cnumber = get_post_meta( $post->ID, '_bibliography_cnumber', true );
				$refid = get_post_meta( $post->ID, '_bibliography_refid', true );
				$doi = get_post_meta( $post->ID, '_bibliography_doi', true );
				$open = get_post_meta( $post->ID, '_bibliography_open', true );
			?>

			<h2><strong><?php the_title(); ?></strong></h2>

			<?php if($doi != ''){ ?>
				<a target="_blank" class="button secondary" href="<?php echo $doi; ?>" title="Go to web page (via DOI)"><i class="fa fa-external-link" aria-hidden="true"></i> DOI</a>
			<?php } ?>

			<?php if($open != ''){ ?>
				<a target="_blank" class="button secondary" href="<?php echo $open; ?>" title="Find record details (via OpenURL)"><i class="fa fa-external-link" aria-hidden="true"></i> OpenURL</a>
			<?php } ?>

			<?php if($cite != ''){ ?>
				<a target="_blank" class="button secondary" href="https://scholar.google.co.uk/scholar?oi=bibs&hl=en&cites=<?php echo $cite; ?>" title="View citations on Google Scholar"><i class="fa fa-external-link" aria-hidden="true"></i> Google Scholar</a>
			<?php } ?>

			<p><strong>Author:</strong>
				<?php if($authorid != ''){ ?>
				<a href="https://scholar.google.co.uk/citations?user=<?php echo $authorid; ?>&hl=en&oi=sra" target="_blank">
				<?php } ?>
				<?php echo $author; ?>
				<?php if($authorid != ''){ ?>
				</a>
				<?php } ?>
			</p>

			<?php if($year != ''){ ?>
			<p><strong>Year:</strong> <?php echo $year; ?></p>
			<?php } ?>
			<?php if($type != ''){ ?>
			<p><strong>Type:</strong> <?php echo $type; ?></p>
			<?php } ?>
			<?php if($pubtitle != ''){ ?>
			<p><strong>Publication title:</strong> <?php echo $pubtitle; ?></p>
			<?php } ?>
			<?php if($abbrtitle != ''){ ?>
			<p><strong>Abbreviated title:</strong> <?php echo $abbrtitle; ?></p>
			<?php } ?>
			<?php if($volume != ''){ ?>
			<p><strong>Volume:</strong> <?php echo $volume; ?></p>
			<?php } ?>
			<?php if($issue != ''){ ?>
			<p><strong>Issue:</strong> <?php echo $issue; ?></p>
			<?php } ?>
			<?php if($pages != ''){ ?>
			<p><strong>Pages:</strong> <?php echo $pages; ?></p>
			<?php } ?>
			<?php if($annotation != ''){ ?>
			<p><strong>Annotation(s):</strong> <?php echo nl2br($annotation); ?>
			<?php } ?>

			<?php
				$terms = get_the_terms( get_the_ID(), 'bibliography_tag' );
				if ( $terms && ! is_wp_error( $terms ) ) {
				    $draught_links = array();
				    foreach ( $terms as $term ) {
				        $draught_links[] = $term->name;
				    }
				    $bibliography_tag = join( ', ', $draught_links );
			?>
			<p>
				<strong>Keywords:</strong> <?php echo get_the_term_list( $post->ID, 'bibliography_tag', '', ', ', '' ); ?>
			</p>
			<?php } ?>

			<?php if($address != ''){ ?>
			<p><strong>Address:</strong> <?php echo $address; ?></p>
			<?php } ?>
			<?php if($corpauthor != ''){ ?>
			<p><strong>Corporate author:</strong> <?php echo $corpauthor; ?></p>
			<?php } ?>
			<?php if($publisher != ''){ ?>
			<p><strong>Publisher:</strong> <?php echo $publisher; ?></p>
			<?php } ?>
			<?php if($place != ''){ ?>
			<p><strong>Place of publication:</strong> <?php echo $place; ?></p>
			<?php } ?>
			<?php if($editor != ''){ ?>
			<p><strong>Editor:</strong> <?php echo $editor; ?></p>
			<?php } ?>
			<?php if($language != ''){ ?>
			<p><strong>Language:</strong> <?php echo $language; ?></p>
			<?php } ?>
			<?php if($sumaddressdoi != ''){ ?>
			<p><strong>Summary language:</strong> <?php echo $sumaddress; ?></p>
			<?php } ?>
			<?php if($origtitle != ''){ ?>
			<p><strong>Original title:</strong> <?php echo $origtitle; ?></p>
			<?php } ?>
			<?php if($seditor != ''){ ?>
			<p><strong>Editor:</strong> <?php echo $seditor; ?></p>
			<?php } ?>
			<?php if($stitle != ''){ ?>
			<p><strong>Series title:</strong> <?php echo $stitle; ?></p>
			<?php } ?>
			<?php if($astitle != ''){ ?>
			<p><strong>Abbreviated series title:</strong> <?php echo $astitle; ?></p>
			<?php } ?>
			<?php if($svolume != ''){ ?>
			<p><strong>Series volume:</strong> <?php echo $svolume; ?></p>
			<?php } ?>
			<?php if($sissue != ''){ ?>
			<p><strong>Series issue:</strong> <?php echo $sissue; ?></p>
			<?php } ?>
			<?php if($edition != ''){ ?>
			<p><strong>Edition:</strong> <?php echo $edition; ?></p>
			<?php } ?>
			<?php if($issn != ''){ ?>
			<p><strong>ISSn:</strong> <?php echo $issn; ?></p>
			<?php } ?>
			<?php if($isbn != ''){ ?>
			<p><strong>ISNB:</strong> <?php echo $isbn; ?></p>
			<?php } ?>
			<?php if($medium != ''){ ?>
			<p><strong>Medium:</strong> <?php echo $medium; ?></p>
			<?php } ?>
			<?php if($area != ''){ ?>
			<p><strong>Area:</strong> <?php echo $area; ?></p>
			<?php } ?>
			<?php if($expedition != ''){ ?>
			<p><strong>Expedition:</strong> <?php echo $expedition; ?></p>
			<?php } ?>
			<?php if($conference != ''){ ?>
			<p><strong>Conference:</strong> <?php echo $conference; ?></p>
			<?php } ?>
			<?php if($notes != ''){ ?>
			<p><strong>Notes:</strong> <?php echo $notes; ?></p>
			<?php } ?>
			<?php if($approved != ''){ ?>
			<p><strong>Approved:</strong> <?php echo $approved; ?></p>
			<?php } ?>
			<?php if($cnumber != ''){ ?>
			<p><strong>Call number:</strong> <?php echo $cnumber; ?></p>
			<?php } ?>
			<?php if($refid != ''){ ?>
			<p><strong>Reference ID:</strong> <?php echo $refid; ?></p>
			<?php } ?>

		<?php endwhile; endif; ?>
	</div>

	<?php get_sidebar('singlebibliography'); ?>

</div>

<?php get_footer(); ?>