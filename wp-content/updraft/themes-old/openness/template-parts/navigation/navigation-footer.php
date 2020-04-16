<?php
/**
 * Displays footer navigation
 * @package Openness
 */

?>

 <nav id="footer-nav">
	<?php wp_nav_menu( array( 
			'theme_location' => 'footer', 
			'fallback_cb' => false, 
			'depth' => 1,
			'container' => false, 
			'menu_id' => 'footer-menu', 
		) ); 
	?>
</nav>