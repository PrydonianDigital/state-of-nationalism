var $ = jQuery.noConflict();

$(document).foundation();

	var citeOrder = 'author',
		citeStyle = 'NISE',
		showRows = '10000';

$(function() {

	$('#citeStyle').on('change', function(){
		var citeStyle = $(this).find(":selected").val();
		$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&records=all&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups', function() {
		});
	});

	$('#citeOrder').on('change', function(){
		$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
		var citeOrder = $(this).find(":selected").val();
		$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&records=all&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups', function() {
		});
	});

	$('body').on('click', '.showhide a', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
		$(this).children('i').toggleClass('fa-plus fa-minus');
	});

	$('.button.plus').on('click', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
	});

	$('#biblSearch').on('submit', function(e) {
		e.preventDefault();
		searchRefs();
	});

});

function bibliography(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').removeClass('hide');
	$('.bib-back').addClass('hide');
	$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&records=all&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups');
}

function singleBibliography(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?record='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function articleBibliography() {
	var records = $('#bibliographyContent').data('records');
	$('#bibliographyContent').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliographyContent').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&records='+records+'&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups');
}

function author(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?author='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function keyword(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?keywords='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function year(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?year='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function publication(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?publication='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function abbrj(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?abbrev_journal='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

function exists(data) {
	if(!data || data==null || data=='undefined' || typeof(data)=='undefined') return false;
	else return true;
}

function searchRefs() {
	var searchWhat = $('#searchWhat').find(":selected").val(),
		search = encodeURI($('#searchRefs').val());
	$('#bibliography').html('<div class="text-center"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?'+searchWhat+'='+search+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}


function element_exists(id){
	if($(id).length > 0){
		return true;
	}
	return false;
}