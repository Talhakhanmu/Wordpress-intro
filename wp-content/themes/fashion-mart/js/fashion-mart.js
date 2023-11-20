;(function($) {
'use strict'
// Dom Ready
	$(function() {
		
		$( "#cat-block-menu > button.btn-mega" ).focus(function() {
			$('#cat-block-menu > ul').addClass('show');
		});

		$( "#navbar > ul > li > a,a.site-title" ).focus(function() {
			$('#cat-block-menu > ul').removeClass('show'); 
		});
	
	});
})(jQuery);