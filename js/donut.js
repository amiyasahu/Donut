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

	$('[title]').not('[class|="qa-vote"]').tooltip({
		placement : 'bottom'
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

	var offset = 300,offset_opacity = 1200,scroll_top_duration = 700,$back_to_top = $('.donut-top');

	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('is-visible') : $back_to_top.removeClass('is-visible fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('fade-out');
		}
	});

	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
				scrollTop: 0 ,
			}, scroll_top_duration
		);
	});
});
