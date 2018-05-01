<?php
/**
 * The sidebar containing the main widget area.
 *
 *
 * @since Foodrecipe 1.0
 */
if ( is_active_sidebar( 'foodrecipe-sidebar' ) ) : ?>
	<ul id="foodrecipe-sidebar">
		<?php dynamic_sidebar( 'foodrecipe-sidebar' ); ?>
	</ul>
<?php endif; ?>
