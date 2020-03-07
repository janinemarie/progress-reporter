(function( $ ) {
	'use strict';

	/**
	 * All of the code for admin-facing JavaScript resides in this file.
	 */

	$(document).ready(function(){

		$('.post-details').toggle();

		$('#progress-wrapper').on('click', '.open-close-details', function() {
			$(this).toggleClass('open-icon');
			$(this).siblings('.post-details').toggle();
		});

	});

})( jQuery );
