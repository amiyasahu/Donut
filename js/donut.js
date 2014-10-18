jQuery(document).ready(function () {
  $('[data-toggle="offcanvas"]').click(function () {
	$this = $(this);
    $('.qa-main-wrapper').toggleClass('active');
	$this.find('i.toggle-icon').toggleClass('fa-chevron-left fa-chevron-right');
  });
});

jQuery(document).ready(function($) {
	$selected_sub_nav = $('a.qa-nav-sub-link.qa-nav-sub-selected');
	if (!!$selected_sub_nav.length) {
		$selected_sub_nav.parent('li.qa-nav-sub-item').addClass('active');
	};
});

/*For hover dropdown of the navbar items */
/*jQuery(document).ready(function($) {
	$('.navbar .dropdown').not('.login-dropdown,.user-dropdown').hover(function() {
	  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200).end().end().addClass('open');
	}, function() {
	  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(150).end().end().removeClass('open');
	});
});*/

jQuery(document).ready(function($) {
	var selector = '.qa-form-tall-button-ask,.qa-form-tall-button-answer, '+
	  '.qa-form-tall-button-save, .qa-form-tall-button-comment ,'+
	  '.qa-form-wide-button-save,.qa-form-tall-button-login,.qa-form-tall-button-0,'+
	  '.qa-form-tall-button-register'+
	  '.qa-form-tall-button-post,.qa-form-wide-button-block,.qa-form-wide-button-edit'+
	  '.qa-form-wide-button-hideall,.qa-form-wide-button-delete,.qa-form-wide-button-unblock' +
	  '.qa-form-wide-button-setbonus,.qa-form-wide-button-delete,.qa-form-wide-button-unblock' ;
	
	$('body').on('click' , selector , function(event) {
		$(this).not('name="docancel"').addClass("loading");
	});
	
	var loadAndStopSelector = '.qa-form-tall-button-post,.qa-form-tall-button-send' ;

	$('body').on('click' , loadAndStopSelector , function(event) {
		$(this).not('name="docancel"').addClass("loading").delay(100000).removeClass('loading');
	});

});

jQuery(document).ready(function($) {
	
	$('[title]').tooltip({
		placement : 'bottom' 
	});
	
});

/*jQuery(document).ready(function($) {
	var qa_oldonload=window.onload;
	window.onload=function() {
		if (typeof qa_oldonload=='function')
			qa_oldonload();
			if (!$('#a_list').children('.qa-a-item-content').length) {
				$('#q_doanswer').trigger('click');
			};
	};
});*/

jQuery(document).ready(function($) {
	var $mainQ = $('.qa-part-q-view') ,
		$closedQ = $mainQ.children('.qa-q-closed') ,
		$solvedQ = $('#a_list').children('.qa-a-list-item-selected') ;
	if ($closedQ.length > 0) {
		$mainQ.addClass('qa-part-q-view-closed');
	}; 
	if ($solvedQ.length > 0) {
		$mainQ.addClass('qa-part-q-view-solved');
	}; 
});
