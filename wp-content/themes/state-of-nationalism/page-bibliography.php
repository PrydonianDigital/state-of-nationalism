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
							<div class="small-12 medium-4 columns">
								<h5><strong>Cite Style</strong>:</h5>
								<select id="citeStyle" name="citeStyle" title="choose your preferred citation style">
									<option value="NISE" selected="selected">NISE</option>
									<option value="SNM">SNM</option>
									<option value="Harvard%201">Harvard 1</option>
								</select>
							</div>
							<div class="small-12 medium-4 columns">
								<h5><strong>Sort By</strong>:</h5>
								<select name="citeOrder" id="citeOrder">
									<option value="author" selected="selected">Author</option>
									<option value="year">Year</option>
									<option value="type">Type</option>
									<option value="title">Title</option>
								</select>
							</div>
							<div class="small-12 medium-4 columns">
								<h5><strong>Per Page</strong>:</h5>
								<div class="input-group">
									<input id="perPage" type="text" class="input-group-field" value="50">
									<div class="input-group-button">
										<input class="button" value="Change" type="submit" id="changePerPage">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="bib-back row">
			<div class="small-12 columns">
				<h4><a href="javascript: history.go(-1)" class="backMeUp"><i class="fi-arrow-left"></i> Back</a></h4>
			</div>
		</div>

		<ul class="pagination toppag text-center" role="navigation" aria-label="Pagination"></ul>

		<div id="bibliography"></div>

		<ul class="pagination bottompag text-center" role="navigation" aria-label="Pagination"></ul>

		<div class="bib-back row">
			<div class="small-12 columns">
				<h4><a href="javascript: history.go(-1)" class="backMeUp"><i class="fi-arrow-left"></i> Back</a></h4>
			</div>
		</div>

	</div>

	<?php get_sidebar('sidebar'); ?>

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
	$abbrj = htmlspecialchars($_GET['abbrev_journal']);
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
		abbrj($.urlParam('abbrev_journal'));
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
			var showRows = '50';
		bibliography(showRows);
		</script>
<?php
	}
?>