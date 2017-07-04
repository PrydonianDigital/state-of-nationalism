<?php get_header('page'); ?>

<div class="row">

	<div class="small-12 medium-9 columns">

		<div class="row group">
			<div class="small-12 columns">
				<div class="callout secondary">
					<div class="showhide">
						<input type="button" data-div="moreinfoForm" class="button plus" value="Search/Display Options">
					</div>
					<div id="moreinfoForm" class="moreinfo">
						<form id="biblSearch" class="row group">
							<div class="small-12 columns">
								<h5><strong>Search</strong></h5>
								<div class="input-group">
									<select name="searchWhat" id="searchWhat" class="input-group-field">
										<option value="author" selected="selected">Author</option>
										<option value="year">Year</option>
										<option value="type">Type</option>
										<option value="title">Title</option>
										<option value="keywords">Keywords</option>
									</select>
									<input id="searchRefs" type="text" class="input-group-field" placeholder="Search Bibliographies">
									<div class="input-group-button">
										<input class="button" value="Search" type="submit" id="searchAllRefs">
									</div>
								</div>
							</div>
						</form>
						<form class="bib-filters row group">
							<div class="small-12 medium-6 columns">
								<h5><strong>Cite Style</strong>:</h5>
								<select id="citeStyle" name="citeStyle" title="choose your preferred citation style">
									<option value="NISE" selected="selected">NISE</option>
									<option value="APA">APA</option>
									<option value="AMA">AMA</option>
									<option value="MLA">MLA</option>
									<option value="Chicago">Chicago</option>
									<option value="Harvard%201">Harvard 1</option>
									<option value="Harvard%202">Harvard 2</option>
									<option value="Harvard%203">Harvard 3</option>
									<option value="Vancouver">Vancouver</option>
									<option value="Deep%20Sea%20Res">Deep Sea Res</option>
									<option value="J%20Glaciol">J Glaciol</option>
									<option value="Polar%20Biol">Polar Biol</option>
									<option value="Text%20Citation">Text Citation</option>
								</select>
							</div>
							<div class="small-12 medium-6 columns">
								<h5><strong>Sort By</strong>:</h5>
								<select name="citeOrder" id="citeOrder">
									<option value="author" selected="selected">Author</option>
									<option value="year">Year</option>
									<option value="type">Type</option>
									<option value="title">Title</option>
								</select>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="bib-back row">
			<div class="small-12 columns">
				<h4><a href="/bibliography/" class="backMeUp"><i class="fa fa-arrow-left"></i> Back</a></h4>
			</div>
		</div>

		<div id="bibliography"></div>

		<div class="bib-back row">
			<div class="small-12 columns">
				<h4><a href="/bibliography/" class="backMeUp"><i class="fa fa-arrow-left"></i> Back</a></h4>
			</div>
		</div>

	</div>

	<?php get_sidebar('page'); ?>

	<div class="large reveal" id="record" data-reveal>
		<div id="recordDetails"></div>
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
		<a class="button" data-close aria-label="Close reveal">Close</a>
	</div>

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
		bibliography();
		</script>
<?php
	}
?>