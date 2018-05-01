<?php
/**
 * The template for displaying 404 page
 *
 *
 * @since Foodrecipe 1.0
 */

 get_header(); ?>
	<div class="container error-404 not-found">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12 div-404">
				<div class="row top-items">
					<div class="col-md-6 col-sm-6 col-xs-12 posts-found">
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'foodrecipe' ); ?>
					</div>
				</div><!-- .row top-items -->
				<p> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'foodrecipe' ); ?> </p>
				<?php get_search_form(); ?>
			</div><!-- .col-md-9 col-sm-9 col-xs-12 div-404 -->
			<div class="sidebar-div col-md-3 col-sm-3 hidden-xs"> <?php get_sidebar(); ?> </div>
		</div><!-- .row -->
	</div><!-- .container error-404 not-found -->
<?php get_footer();
