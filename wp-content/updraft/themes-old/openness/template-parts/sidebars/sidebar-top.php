<?php
/**
 * Displays the feature top sidebar group
 * @package Openness
 * @version 1.0.0
*/

if (   ! is_active_sidebar( 'top1'  )
	&& ! is_active_sidebar( 'top2' )
	&& ! is_active_sidebar( 'top3'  )		
	&& ! is_active_sidebar( 'top4'  )	
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
   
<div id="top-sidebars">   
<aside class="widget-area container-fluid">

		<div class="row">		   
			<?php if ( is_active_sidebar( 'top1' ) ) : ?>
				<div id="top1" <?php openness_top(); ?>>
					<?php dynamic_sidebar( 'top1' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'top2' ) ) : ?>      
				<div id="top2" <?php openness_top(); ?>>
					<?php dynamic_sidebar( 'top2' ); ?>
				</div>         
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'top3' ) ) : ?>        
				<div id="top3" <?php openness_top(); ?>>
					<?php dynamic_sidebar( 'top3' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'top4' ) ) : ?>        
				<div id="top4" <?php openness_top(); ?>>
					<?php dynamic_sidebar( 'top4' ); ?>
				</div>
			<?php endif; ?>		
		</div>

</aside>         
</div>