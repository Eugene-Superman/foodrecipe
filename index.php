<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme.
 *
 * @since Foodrecipe 1.0
 */
 get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-12 index-posts">
			<div class="row top-items">
				<div class="col-md-6 col-sm-6 col-xs-12 posts-found">
					<?php global $wp_query;
						echo $wp_query->found_posts . ' ';
						esc_html_e( 'posts found', 'foodrecipe' ); ?>
				</div><!-- .col-md-6 col-sm-6 col-xs-12 posts-found -->
				<div class="col-md-6 col-sm-6 col-xs-12 posts-dropdown">
					<select id="foodrecipe-post-display" class="selectpicker form-control">
						<option value=""> <?php esc_html_e( 'Show...', 'foodrecipe' ); ?> </option>
						<option value="5"> <?php printf( __( 'Show %s items', 'foodrecipe' ), 5); ?> </option>
						<option value="7"> <?php printf( __( 'Show %s items', 'foodrecipe' ), 7); ?> </option>
						<option value="10"> <?php printf( __( 'Show %s items', 'foodrecipe' ), 10); ?> </option>
						<option value="20"> <?php printf( __( 'Show %s items', 'foodrecipe' ), 20); ?> </option>
					</select><!-- #foodrecipe-post-display -->
					<select id="foodrecipe-post-order" class="selectpicker form-control">
						<option value=""> <?php esc_html_e( 'Sort By...', 'foodrecipe' ); ?> </option>
						<option value="title"> <?php esc_html_e( 'Sort By Title', 'foodrecipe' ); ?> </option>
						<option value="date"> <?php esc_html_e( 'Sort By Date', 'foodrecipe' ); ?> </option>
						<option value="rand"> <?php esc_html_e( 'Sort By Random', 'foodrecipe' ); ?> </option>
					</select><!-- #foodrecipe-post-order -->
				</div><!-- .col-md-6 col-sm-6 col-xs-12 posts-dropdown -->
			</div><!-- .row top-items -->
			<!-- Start the Loop. -->
			<?php if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); ?>
					<div <?php post_class(); ?>>
						<h2 class="post-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h2>
						<div class="post-inform">
							<small><?php esc_html_e( 'posted by', 'foodrecipe' );
								echo ' ';
								the_author_posts_link();
								echo ' / ' . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago';
								echo ' / 13 likes / ';
								comments_number( '0 comments', '1 comment', '% comments' ); ?>
							</small>
						</div><!-- .post-inform -->
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="foodrecipe-post-thumbnails">
								<?php the_post_thumbnail( 'foodrecipe-post-image' ); ?>
							</div>
						<?php } ?>
						<div class="entry">
							<?php if ( 'image' == get_post_format() ) { ?>
								<div class='foodrecipe-post-image'>
									<?php	if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large' ); ?>
										</a> <!-- permalink -->
									<?php } else {
										the_content();
									} ?>
								</div><!-- .foodrecipe-post-image -->
							<?php } elseif ( 'gallery' == get_post_format() ) {
								$gallery = get_post_gallery( get_the_ID(), false );
								if ( isset( $gallery[ 'ids'] ) ) {
									$gallery_array = explode( ',', $gallery['ids'] );
								} else {
									$all_images = get_attached_media( 'image' );
									$gallery_array = array_keys( $all_images );
								} ?>
								<div class="row gallery-row">
									<?php foreach ( $gallery_array as $image) {
										echo "<div class='col-sm-6 col-xs-6 gallery-col'>".
										wp_get_attachment_image ( $image, 'foodrecipe-gallery-image' ).
										"</div>";
									} ?>
								</div><!-- .row gallery-row -->
							<?php } else { ?>
								<div class="foodrecipe-post-<?php echo get_post_format();  ?> ">
									<?php the_content(); ?>
								</div>
							<?php } ?>
						</div><!-- .entry -->
						<div class="button-div">
							<?php if( ('image' == get_post_format()) || ('gallery' == get_post_format()) ){ ?>
								<a href="<?php the_permalink(); ?>">
									<button type="button" class="read-more-post"> <?php esc_html_e( 'view more', 'foodrecipe' ); ?> </button>
								</a>
							<?php } else { ?>
							 	<a href="<?php the_permalink(); ?>">
									<button type="button" class="read-more-post"> <?php esc_html_e( 'read more', 'foodrecipe' ); ?> </button>
								</a>
							<?php	} ?>
						</div><!-- .button-div -->
					</div><!-- .post class -->
				<?php }
				echo "<div class='foodrecipe-page-numbering'>";
				global $wp_query;
				$big = 999999999;
				$args = array(
					'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'             => '?paged=%#%',
					'total'              => $wp_query->max_num_pages,
					'current'            => max( 1, get_query_var('paged') ),
					'show_all'           => false,
					'end_size'           => 1,
					'mid_size'           => 2,
					'prev_next'          => true,
					'prev_text'          => '< ',
					'next_text'          => ' >',
					'type'               => 'plain',
					'add_args'           => false,
					'add_fragment'       => '',
					'before_page_number' => '',
					'after_page_number'  => ''
				);
				echo paginate_links( $args );
				echo "</div>";
			} else {  ?>
				<p> <?php esc_html_e( 'Sorry, no posts matched your criteria.', 'foodrecipe' ); ?> </p>
			<?php } ?>
		</div><!-- .col-md-9 col-sm-9 col-xs-12 index-posts -->
		<div class="sidebar-div col-md-3 col-sm-3 hidden-xs"> <?php get_sidebar(); ?> </div>
	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
