var $ = jQuery.noConflict();

$(document).foundation();

	var biblURL = 'bibliography/';

	var citeOrder = 'author',
		citeStyle = 'NISE',
		showRows = '50',
		startRecord = '1';

$(function() {

	var offset = 300,
		offset_opacity = 1200,
		scroll_top_duration = 700,
		$back_to_top = $('.cd-top');
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	$('#changePerPage').on('click', function(e){
		e.preventDefault();
		var showRows = $('#perPage').val();
		bibliography(showRows);
	});

	$('body').on('click', '.select_all', function(){
		$('input:checkbox').prop('checked', 'checked');
		$('.deselect_all').show();
			if ($("#citations input:checkbox:checked").length > 0) {
				$('.hideExport').addClass('show');
			} else {
				$('.hideExport').removeClass('show');
			}
	});

	$('body').on('change', '#citations input:checkbox',function(){
		if ($("#citations input:checkbox:checked").length > 0) {
			$('.hideExport').addClass('show');
			$('.deselect_all').show();
		} else {
			$('.hideExport').removeClass('show');
			$('.deselect_all').hide();
		}
	})

	$('body').on('click', '.deselect_all', function(){
		$('input:checkbox').prop('checked', '');
		$('.deselect_all').hide();
			if ($("#citations input:checkbox:checked").length > 0) {
				$('.hideExport').addClass('show');
			} else {
				$('.hideExport').removeClass('show');
			}
	});

	$('body').on('click', '#Cite', function(){
		var citeStyle = $('#citeStyle').val(),
			citeType = $('#citeType').val(),
			exportFormat = $('#exportFormat').val(),
			submit = $(this).val();
		citeMe(citeStyle,citeType,exportFormat,submit);
	});

	$('body').on('click', '#Export', function(){
		var citeStyle = $('#citeStyle').val(),
			citeType = $('#citeType').val(),
			exportFormat = $('#exportFormat').val(),
			submit = $(this).val();
		exportMe(citeStyle,citeType,exportFormat,submit);
	});

	$('body').on('click', '.citelinks a', function(e){
		e.preventDefault();
		var citeType = $(this).data('cite'),
			record = $(this).data('record');
		window.open('/database/show.php?record='+record+'&submit=Cite&exportType=file&citeType='+citeType, '_blank');
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

	$('#citeStyle').on('change', function(){
		var citeStyle = $(this).find(":selected").val();
		$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups&viewType=Print', function() {
		});
	});

	$('#citeOrder').on('change', function(){
		$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
		var citeOrder = $(this).find(":selected").val();
		$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups&viewType=Print', function() {
		});
	});

	$('#bibliography').on('click', ' a.openclose', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
		$(this).children('i').toggleClass('fi-plus fi-minus');
		$(this).children('span').toggleText('Show details', 'Hide details');
	});

	$('.blog').on('click', ' a.openclose', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
		$(this).children('i').toggleClass('fi-plus fi-minus');
	});

	$('.search').on('click', ' a.openclose', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
		$(this).children('i').toggleClass('fi-plus fi-minus');
		$(this).children('span').toggleText('Read review', 'Hide review');
	});

	$('.button.plus').on('click', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$('#'+toggle).slideToggle();
	});

	$('h3.faq').on('click', 'a', function(e){
		e.preventDefault();
		var toggle = $(this).data('div');
		$(this).children('i').toggleClass('fi-plus fi-minus');
		$('#'+toggle).slideToggle();
	});

	$('#article').on('click', 'a.bibliographyLink', function(e){
		e.preventDefault();
		var $modal = $('#bibliographyPopup'),
		href = $(this).attr('href');
		$modal.html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
		$.ajax('/database/show.php?record='+href+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print')
			.done(function(resp){
			$modal.html(resp+'<button class="close-button" data-close aria-label="Close Accessible Modal" type="button"><span aria-hidden="true">&times;</span></button><button class="button" data-close>Close</button>').foundation('open');
			$("td.otherfieldsbg b:contains('Abstract')").html('Annotation');
			$('.reveal a').each(function(){
				this.href = this.href.replace(window.location.pathname, '/'+biblURL);
			});
		});
	});

	$('#biblSearch').on('submit', function(e) {
		e.preventDefault();
		searchRefs();
	});

	$('#bibliography').on('click', '.pagination a', function(e){
		$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
		startRecord = parseInt(startRecord) + parseInt(10);
		e.preventDefault();
		$('#bibliography').load('/database/show.php?citeStyle='+citeStyle+'&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&showLinks=1&showRows='+showRows+'&startRecord='+startRecord+'&without=dups&allow_batch_export=1', function(){

		});

	});
});

function bibliography(showRows) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').removeClass('hide');
	$('.bib-back').addClass('hide');
	$('#bibliography').load('/database/show.php?citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&showLinks=1&showRows='+showRows+'&startRecord='+startRecord+'&without=dups&viewType=Print', function(){
		$('.abstract strong').html('Annotation:');
		var totalRows = $('#rowsFound').data('rows'),
			pages = Math.round(totalRows/showRows),
			current_link = 0;
		if(totalRows > showRows) {
			var navigation_html = '';
			while (pages > current_link) {
				navigation_html += '<li><a href="#page' + (current_link + 1) + '" data-page="' + (current_link + 1) + '" data-offset="' + (current_link * showRows) + '" data-rows="' + showRows + '">' + (current_link + 1) + '</a></li>';
				current_link++;
			}
			$('.toppag').html(navigation_html);
			$('.bottompag').html(navigation_html);

			$('.toppag li:first').addClass('current');
			$('.bottompag li:first').addClass('current');
			$('.pagination').on('click', 'a', function(e){
				e.preventDefault();
				var rowOffset = $(this).data('offset'),
					showRows = $(this).data('rows'),
					page = $(this).data('page');
				paginate(rowOffset, showRows);
				$('.pagination li').removeClass('current');
				$('.pagination').find('a[data-page="'+page+'"]').parent().addClass('current')
			});
		}
	});
}

function paginate(rowOffset, showRows) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('#bibliography').load('/database/search.php?sqlQuery=SELECT%20author%2C%20title%2C%20type%2C%20year%2C%20publication%2C%20abbrev_journal%2C%20volume%2C%20issue%2C%20pages%2C%20keywords%2C%20abstract%2C%20thesis%2C%20editor%2C%20publisher%2C%20place%2C%20abbrev_series_title%2C%20series_title%2C%20series_editor%2C%20series_volume%2C%20series_issue%2C%20edition%2C%20language%2C%20author_count%2C%20online_publication%2C%20online_citation%2C%20doi%2C%20serial%2C%20area%20FROM%20refs%20WHERE%20%28orig_record%20IS%20NULL%20OR%20orig_record%20%3C%200%29%20ORDER%20BY%20first_author%2C%20author_count%2C%20author%2C%20year%2C%20title&client=&formType=sqlSearch&submit=Cite&viewType=Print&showQuery=0&showLinks=1&showRows='+showRows+'&rowOffset='+rowOffset+'&wrapResults=0&citeOrder=author&citeStyle=APA&exportFormat=RIS&exportType=html&exportStylesheet=&citeType=html&headerMsg=');
}

function singleBibliography(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?record='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$("td.otherfieldsbg b:contains('Abstract')").html('Annotation');
		$('a').each(function(){
			this.href = this.href.replace('Abbreviated%20Journal', 'abbrev_journal');
		});
		$('.hideMe').hide();
	});

}

function articleBibliography() {
	var records = $('#bibliographyContent').data('records');
	$('#bibliographyContent').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliographyContent').load('/database/show.php?&citeOrder='+citeOrder+'&submit=Cite&wrapResults=0&records='+records+'&showLinks=1&showRows='+showRows+'&startRecord=1&without=dups', function(){
	$('.abstract strong').html('Annotation:');
	$("td.otherfieldsbg b:contains('Abstract')").html('Annotation');
	$( 'a' ).each(function() {
		if( location.hostname === this.hostname || !this.hostname.length ) {
			$(this).addClass('bibliographyLink');
		} else {
			$(this).addClass('external');
		}
	});

		$('.modal').on('click',function(e){
			e.preventDefault();
			var $modal = $('#bibliographyPopup'),
			href = $(this).data('record');
			$.ajax('/database/show.php?record='+href+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print')
				.done(function(resp){
				$modal.html(resp+'<button class="close-button" data-close aria-label="Close Accessible Modal" type="button"><span aria-hidden="true">&times;</span></button><button class="button" data-close>Close</button>').foundation('open');
				$("td.otherfieldsbg b:contains('Abstract')").html('Annotation');
				$('.abstract strong').html('Annotation:');
				$('a').each(function(){
					this.href = this.href.replace(window.location.pathname, '/'+biblURL);
				});
			});
		});
		$('.modal1').on('click',function(e){
			e.preventDefault();
			var $modal = $('#bibliographyPopup'),
			href = $(this).data('keywords');
			$.ajax('/database/show.php?keywords='+href+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print'+href)
				.done(function(resp){
				$modal.html(resp+'<button class="close-button" data-close aria-label="Close Accessible Modal" type="button"><span aria-hidden="true">&times;</span></button><button class="button" data-close>Close</button>').foundation('open');
				$("td.otherfieldsbg b:contains('Abstract')").html('Annotation');
				$('a').each(function(){
					this.href = this.href.replace(window.location.pathname, '/'+biblURL);
				});
			});
		});
	});
}

function author(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?author='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$('.hideMe').hide();
	});
}

function keyword(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?keywords='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$('.hideMe').hide();
	});
}

function year(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?year='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$('.hideMe').hide();
	});
}

function publication(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?publication='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$('.hideMe').hide();
	});
}

function abbrj(hash) {
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?abbrev_journal='+hash+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print', function(){
		$('.hideMe').hide();
	});
}

function exists(data) {
	if(!data || data==null || data=='undefined' || typeof(data)=='undefined') return false;
	else return true;
}

function searchRefs() {
	var searchWhat = $('#searchWhat').find(":selected").val(),
		search = encodeURI($('#searchRefs').val());
	$('#bibliography').html('<div class="text-center"><h1><i class="fi-loop fi-spin"></i></h1></div>');
	$('.bib-filters').addClass('hide');
	$('.bib-back').removeClass('hide');
	$('#bibliography').load('/database/show.php?'+searchWhat+'='+search+'&client=inc-refbase-1.0&wrapResults=0&viewType=Print');
}

$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
});

function element_exists(id){
	if($(id).length > 0){
		return true;
	}
	return false;
}

function citeMe(citeStyle,citeType,exportFormat,submit){
	var chkArray = [];
	$(".checkbox:checked").each(function() {
		chkArray.push($(this).val());
	});
	var selected;
	selected = chkArray.join('&marked[]=');
	if(selected.length > 0){
		console.log(selected)
		window.open('/database/search.php?formType=queryResults&originalDisplayType=List&orderBy=author%2C%20year%20DESC%2C%20publication&showQuery=0&showLinks=1&showRows=100&rowOffset=200&sqlQuery=SELECT%20author%2C%20title%2C%20year%2C%20publication%2C%20volume%2C%20pages%2C%20serial%20FROM%20refs%20WHERE%20serial%20RLIKE%20%22.%2B%22%20ORDER%20BY%20author%2C%20year%20DESC%2C%20publication&marked[]=' + selected +'&recordsSelectionRadio=0&citeStyle='+citeStyle+'&citeOrder=&headerMsg=&citeType='+citeType+'&exportType=file&exportFormat='+exportFormat+'&submit='+submit, '_blank');
	} else {
		alert("Please at least one of the checkboxes");
	}
}

function exportMe(citeStyle,citeType,exportFormat,submit){
	var chkArray = [];
	$(".checkbox:checked").each(function() {
		chkArray.push($(this).val());
	});
	var selected;
	selected = chkArray.join('&marked[]=');
	if(selected.length > 1){
		window.open('/database/search.php?formType=queryResults&originalDisplayType=Cite&orderBy=author%2C%20year%20DESC%2C%20publication&showQuery=0&showLinks=1&showRows=100&rowOffset=0&sqlQuery=SELECT%20author%2C%20title%2C%20type%2C%20year%2C%20publication%2C%20abbrev_journal%2C%20volume%2C%20issue%2C%20pages%2C%20keywords%2C%20abstract%2C%20thesis%2C%20editor%2C%20publisher%2C%20place%2C%20abbrev_series_title%2C%20series_title%2C%20series_editor%2C%20series_volume%2C%20series_issue%2C%20edition%2C%20language%2C%20author_count%2C%20online_publication%2C%20online_citation%2C%20doi%2C%20serial%2C%20area%20FROM%20refs%20WHERE%20serial%20RLIKE%20%22.%2B%22%20ORDER%20BY%20first_author%2C%20author_count%2C%20author%2C%20year%2C%20title&marked[]=' + selected +'&recordsSelectionRadio=0&citeStyle='+citeStyle+'&citeOrder=&headerMsg=&citeType='+citeType+'&exportType=file&exportFormat='+exportFormat+'&submit='+submit, '_blank');
	} else {
		alert("Please at least one of the checkboxes");
	}
}

/*! js-url - v2.5.0 - 2017-04-22 */!function(){var a=function(){function a(){}function b(a){return decodeURIComponent(a.replace(/\+/g," "))}function c(a,b){var c=a.charAt(0),d=b.split(c);return c===a?d:(a=parseInt(a.substring(1),10),d[a<0?d.length+a:a-1])}function d(a,c){for(var d=a.charAt(0),e=c.split("&"),f=[],g={},h=[],i=a.substring(1),j=0,k=e.length;j<k;j++)if(f=e[j].match(/(.*?)=(.*)/),f||(f=[e[j],e[j],""]),""!==f[1].replace(/\s/g,"")){if(f[2]=b(f[2]||""),i===f[1])return f[2];h=f[1].match(/(.*)\[([0-9]+)\]/),h?(g[h[1]]=g[h[1]]||[],g[h[1]][h[2]]=f[2]):g[f[1]]=f[2]}return d===a?g:g[i]}return function(b,e){var f,g={};if("tld?"===b)return a();if(e=e||window.location.toString(),!b)return e;if(b=b.toString(),f=e.match(/^mailto:([^\/].+)/))g.protocol="mailto",g.email=f[1];else{if((f=e.match(/(.*?)\/#\!(.*)/))&&(e=f[1]+f[2]),(f=e.match(/(.*?)#(.*)/))&&(g.hash=f[2],e=f[1]),g.hash&&b.match(/^#/))return d(b,g.hash);if((f=e.match(/(.*?)\?(.*)/))&&(g.query=f[2],e=f[1]),g.query&&b.match(/^\?/))return d(b,g.query);if((f=e.match(/(.*?)\:?\/\/(.*)/))&&(g.protocol=f[1].toLowerCase(),e=f[2]),(f=e.match(/(.*?)(\/.*)/))&&(g.path=f[2],e=f[1]),g.path=(g.path||"").replace(/^([^\/])/,"/$1"),b.match(/^[\-0-9]+$/)&&(b=b.replace(/^([^\/])/,"/$1")),b.match(/^\//))return c(b,g.path.substring(1));if(f=c("/-1",g.path.substring(1)),f&&(f=f.match(/(.*?)\.(.*)/))&&(g.file=f[0],g.filename=f[1],g.fileext=f[2]),(f=e.match(/(.*)\:([0-9]+)$/))&&(g.port=f[2],e=f[1]),(f=e.match(/(.*?)@(.*)/))&&(g.auth=f[1],e=f[2]),g.auth&&(f=g.auth.match(/(.*)\:(.*)/),g.user=f?f[1]:g.auth,g.pass=f?f[2]:void 0),g.hostname=e.toLowerCase(),"."===b.charAt(0))return c(b,g.hostname);a()&&(f=g.hostname.match(a()),f&&(g.tld=f[3],g.domain=f[2]?f[2]+"."+f[3]:void 0,g.sub=f[1]||void 0)),g.port=g.port||("https"===g.protocol?"443":"80"),g.protocol=g.protocol||("443"===g.port?"https":"http")}return b in g?g[b]:"{}"===b?g:void 0}}();"function"==typeof window.define&&window.define.amd?window.define("js-url",[],function(){return a}):("undefined"!=typeof window.jQuery&&window.jQuery.extend({url:function(a,b){return window.url(a,b)}}),window.url=a)}();