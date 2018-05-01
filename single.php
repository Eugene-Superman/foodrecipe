<?php
/**
 * The template for displaying all single posts and attachments
 *
 *
 * @since Foodrecipe 1.0
 */
 get_header(); ?>
<div class="container ">
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-12 single-post-div">
			<div class="navigation row">
				<div class='previous-link col-xs-6'> <?php previous_post_link();?> </div>
				<div class='next-link col-xs-6'> <?php next_post_link(); ?> </div>
			</div><!-- .navigation row -->
			<!-- Start the Loop. -->
			<?php the_post(); ?>
			<div <?php post_class(); ?> >
				<h2 class="post-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h2>
				<div class="post-inform">
					<small> <?php esc_html_e( 'posted by', 'foodrecipe' );
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
						<div class="foodrecipe-post-image">
							<?php the_content(); ?>
						</div>
					<?php } elseif ( 'quote' == get_post_format() ) { ?>
						<div class="foodrecipe-post-quote">
							<?php the_content(); ?>
						</div>
					<?php } elseif ( 'link' == get_post_format() ) { ?>
						<div class="foodrecipe-post-link">
							<?php the_content(); ?>
						</div>
					<?php } elseif( 'video' == get_post_format() ) { ?>
						<div class="foodrecipe-post-video">
							<?php the_content(); ?>
						</div>
					<?php } else {
						the_content();
					} ?>
				</div><!-- .enrty -->
			</div>
			<?php $foodrecipe_args = array(
				'before'           => '<div class="foodrecipe-page-numbering">',
				'after'            => '</div>',
				'link_before'      => '<span class="page-numbers current">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => ' >',
				'previouspagelink' => '< ',
				'pagelink'         => '%',
				'echo'             => 1
			);
			wp_link_pages( $foodrecipe_args ); ?>
			<?php if ( comments_open() || get_comments_number() ) :
				echo "<div class='row comment-row col-md-9'>";
				comments_template();
				echo "</div>";;
			endif; ?>
		</div><!-- .col-md-9 col-sm-9 col-xs-12 single-post-div -->
		<div class="sidebar-div col-md-3 col-sm-3"> <?php get_sidebar();?> </div>
	</div><!-- .row -->
</div><!-- .col-md-6 col-sm-6 col-xs-12 posts-found -->
<?php get_footer(); ?>
