$(document).ready(function() {


	// ===========================================================================
	//
	// Notification banner for IE lt 9
	var ieNotification = $('.browsehappy');
	$('.browsehappy__dismiss').click(function() {
		ieNotification.remove();
	});


	// ===========================================================================
	//
	// SVG Fallback for older browsers

	if (!Modernizr.svg) {
	  $('img[src$=".svg"]').each(function() {
      //Replace 'image.svg' with 'image.png'.
      $(this).attr('src', $(this).attr('src').replace('.svg', '.png'));
	  });
	}


  // ===========================================================================
  //
  // Dropdown

  $('.js-dropdown-trigger').on('click', function(e)  {
   // Show/Hide dropdown
   $('.dropdown').filter(this.hash).toggleClass('is-open');
   // Change/Remove dropdown trigger active state
   $(this).toggleClass('is-active');
   e.preventDefault();
  });

	
}); // end document ready