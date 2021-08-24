( function( $ ) {

	// set height offset of mobile search input field
	$(document).ready(function() {
    	$(window).on('load resize', function() {
     
				var sidebarH = $('#sidebar').height();
				$('.mobile-search').css('top', sidebarH);
				
			}).resize();
   
			//onclick submenu reasign search height
			$('.dropdown-toggle').on('click', function(){
				var sidebarH = $('#sidebar').height();
				$('.mobile-search').css('top', sidebarH);
			});

	});
	
	// Set color of yes/no boolean in table
	if($('.table-bool').html() == 'yes'){
		$('.table-bool').css('color', 'green');
	}
	if($('.table-bool').html() == 'no'){
		$('.table-bool').css('color', 'red');
	}
    
    
    // Main page sub nav
    $('.subcategory-nav-item').on('click', function(){
    	if($(this).hasClass('active')){
        	
        }else{
        	$('.subcategory-nav-item').removeClass('active');
        	$(this).addClass('active');
            var region = $(this).attr("data-region");
            $(".region").removeClass('active');
            $('.region[data-region="'+region+'"]').addClass('active');
            
        }
    });
	
	
	
	

} )( jQuery );