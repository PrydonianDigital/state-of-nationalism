	<footer class="footer secondary" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

		<div class="row">

			<div class="small-12 medium-4 columns">
				<ul class="sidebar menu vertical text-left">
					<?php if ( ! dynamic_sidebar('footer1') ) : ?>
						<li>{static sidebar item 1}</li>
					<?php endif; ?>
				</ul>			</div>
			<div class="small-12 medium-4 columns">
				<ul class="sidebar menu vertical text-left">
					<?php if ( ! dynamic_sidebar('footer2') ) : ?>
						<li>{static sidebar item 1}</li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="small-12 medium-4 columns">
				<ul class="sidebar menu vertical text-left">
					<?php if ( ! dynamic_sidebar('footer3') ) : ?>
						<li>{static sidebar item 1}</li>
					<?php endif; ?>
				</ul>
			</div>

		</div>

		<div class="row">

			<div class="small-12 columns text-left">
					<?php if ( ! dynamic_sidebar('footer4') ) : ?>
						{static sidebar item 1}
					<?php endif; ?>
			</div>

		</div>

		<div class="row">

			<div class="small-12 columns text-left">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('title'); ?>
			</div>

		</div>

	</footer>

	</div>

</div>

<a href="#0" class="cd-top"><i class="fi-arrow-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>