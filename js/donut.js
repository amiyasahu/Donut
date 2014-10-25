jQuery(document).ready(function () {
	$('[data-toggle="offcanvas"]').click(function () {
		$this = $(this);
		$('.qa-main-wrapper').toggleClass('active');
		$this.find('i.toggle-icon').toggleClass('fa-chevron-left fa-chevron-right');
	});
	var $selected_sub_nav = $('a.qa-nav-sub-link.qa-nav-sub-selected');
	
	if (!!$selected_sub_nav.length) {
		$selected_sub_nav.parent('li.qa-nav-sub-item').addClass('active');
	};
	
	$('.qa-logo-link').removeAttr('title');

	$('[title]').tooltip({
		placement : 'bottom' 
	});
	
	/*$('body').tooltip({
	    selector: '[title]' ,
	    placement : 'bottom' ,
	});*/
	
	$('.qa-vote-buttons').tooltip({
	    selector: '[title]' ,
	    placement : 'bottom' ,
	    container:'body'
	});

	var $mainQ = $('.qa-part-q-view') ,
		$closedQ = $mainQ.children('.qa-q-closed') ,
		$solvedQ = $('#a_list').children('.qa-a-list-item-selected') ;
	if ($closedQ.length > 0) {
		$mainQ.addClass('qa-part-q-view-closed');
	}; 

	if ($solvedQ.length > 0) {
		$mainQ.addClass('qa-part-q-view-solved');
	}; 

    $('#nav').affix({
	      offset: {
	        top: $('header').height()
	      }
	}); 

    $('#nav').on('affix.bs.affix', function () {
        var navHeight = $('.navbar').outerHeight(true);
        $('#nav + .container').css('margin-top', navHeight);
	});

    $('#nav').on('affix-top.bs.affix', function () {
     	$('#nav + .container').css('margin-top', 0);
 	});
});