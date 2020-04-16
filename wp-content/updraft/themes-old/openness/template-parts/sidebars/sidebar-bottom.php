<?php
/**
 * Displays the bottom sidebar group
 * @package Openness
*/

if (   ! is_active_sidebar( 'bottom1'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
   
<div id="bottom-sidebars">   
<aside class="widget-area container-fluid">

		<div class="row">		   
			<?php if ( is_active_sidebar( 'bottom1' ) ) : ?>
				<div id="bottom1" <?php openness_bottom(); ?>>
					<?php dynamic_sidebar( 'bottom1' ); ?>
				</div>
			<?php endif; ?>
		</div>

</aside>         
</div>