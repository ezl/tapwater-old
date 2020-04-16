<?php
/**
 * Displays footer site info
 * @package Openness
*/
?>

<div class="site-info">

		<?php get_template_part( 'template-parts/sidebars/sidebar', 'footer' ); ?>

		<?php get_template_part( 'template-parts/navigation/navigation', 'footer' ); ?>

		<?php  esc_html_e('Copyright &copy;', 'openness'); ?> 
		<?php echo date_i18n( __( 'Y', 'openness' ) ); // WPCS: XSS OK ?>
		<?php echo esc_html(get_theme_mod( 'openness_copyright')); ?>. <?php  esc_html_e('All rights reserved.', 'openness'); ?>	
			
		
</div>