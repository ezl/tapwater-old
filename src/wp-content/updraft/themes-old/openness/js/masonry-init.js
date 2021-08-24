//Masonry init

jQuery(function($) {
	"use strict";
	
	
	
	$(document).ready(function() {
			
		if ( $( '#blog-masonry' ).length ) {
			var $container = $('#blog-masonry').masonry();
			$container.imagesLoaded(function(){
				$container.masonry({
				  columnWidth: '.grid-sizer',
				  itemSelector: '.masonry-hentry',
				  transitionDuration: '0.3s',
				  animationOptions: {
					duration: 500,
					easing: 'linear',
				}
				});
			});
		}
	});
	
});




