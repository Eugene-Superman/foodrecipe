<?php
/**
 * The template for displaying footer sidebar.
 *
 *
 * @since Foodrecipe 1.0
 */
if ( is_active_sidebar( 'foodrecipe-sidebar-footer' ) ) : ?>
	<ul id="foodrecipe-sidebar-footer">
		<?php dynamic_sidebar( 'foodrecipe-sidebar-footer' ); ?>
	</ul>
<?php endif; ?>
