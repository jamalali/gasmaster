jQuery(function ($) {
		
	var $bundleSelector = $('#bundle-selector');

	if ($bundleSelector.length) {

		var $parent			= $('.summary.entry-summary');
		
		var $topHeader		= $('#top-header');
		var $mainHeader		= $('#main-header');
		
		var headerHeight	= $topHeader.height() + $mainHeader.height();

		// Reset Page
		$parent.addClass('show-main');
		$parent.removeClass('show-bundle');
		$bundleSelector.val('');

		// Change Events
		$bundleSelector.change(function() {

			var value		= $(this).val();
			var winWidth	= $(window).innerWidth();
			
			var scrollTop	= $parent.offset().top - 20; // 20 is for a bit of space at the top
			
			if (winWidth > 980) {
				scrollTop = scrollTop - headerHeight;
			}
			
			$('.bundle_product').hide();

			if (value == '') {

				// Reset Page
				$parent.addClass('show-main');
				$parent.removeClass('show-bundle');
				$bundleSelector.val('');

			} else {

				$parent.removeClass('show-main');
				$parent.addClass('show-bundle');

				$('.bundle_product#product-' + value).show();
			}
			
			$('html, body').animate({
				scrollTop: scrollTop
			}, 1000);
		});
	}
});