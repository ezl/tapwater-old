<?php
/**
 * Displays the breadcrumbs sidebar
 * @package Openness
*/

if ( ! is_active_sidebar( 'breadcrumbs' ) ) {
	return;
}
?>


<div id="breadcrumbs" class="widget-area">
	<?php dynamic_sidebar( 'breadcrumbs' ); ?>
</div> 
