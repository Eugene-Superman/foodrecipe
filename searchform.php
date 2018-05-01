<?php
/**
 * The template for displaying search form.
 *
 *
 * @since Foodrecipe 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<input type="search" class="search-field"
		placeholder="<?php echo esc_attr_x( 'Search in Blog', 'placeholder', 'foodrecipe' ) ?>"
		value="<?php echo get_search_query() ?>" name="s"
		title="<?php echo esc_attr_x( 'Search in Blog', 'label', 'foodrecipe' ) ?>" />
		<input type="submit" class="search-submit" value="" />
	</label>
</form><!-- .search-form -->
