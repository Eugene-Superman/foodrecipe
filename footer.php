 <?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the content div and all content after.
 *
 * @since Foodrecipe 1.0
 */
 ?>
		</div><!-- .middle -->
		<div class="footer">
			<div class="container">
				<div class="row">
					<?php get_sidebar( 'footer' ); ?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .footer -->
		<div class="lower-footer">
			<div class="copyright col-md-5 col-sm-5 col-xs-12"><p> <?php esc_html_e( 'Copyright © 2015 All Rights Reserved', 'foodrecipe' ); ?> </p></div>
			<div class="up-button col-md-2 col-sm-2 col-xs-12"><a href="" class="scrollTop"></a></div>
			<div class="theme-by col-md-5 col-sm-5 col-xs-12 "><p> <?php esc_html_e( 'Theme by BestWebSoft', 'foodrecipe' ); ?> </p></div>
		</div><!-- .row .lower-footer -->
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
