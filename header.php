<?php
/**
* The template for displaying the header
*
* Displays all of the head element
*
* @since Foodrecipe 1.0
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> >
		<div>
			<div class="header">
				<div class="header-top">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-sm-5 col-xs-12 logo-col">
								<?php if ( has_custom_logo() ) {
									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
									echo '<h1><a href="' . esc_url( get_home_url() ) . '"><img id="logo" src="'. esc_url( $logo[0] ) .'">' . get_bloginfo( 'name' ) .'</a></h1>';
								} else {
									echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
								} ?>
							</div><!-- .col-lg-3 col-sm-5 col-xs-12 logo-col -->
							<div class="col-lg-6 visible-lg menu" >
								<?php  	wp_nav_menu( array(
									'theme_location' => 'primary') ); ?>
							</div><!-- .col-lg-6 visible-lg menu -->
							<div class="col-lg-3 col-sm-6 col-xs-12 button-container">
								<a id='register-button' href='<?php echo wp_registration_url(); ?>'> <?php esc_html_e( 'REGISTER', 'foodrecipe' )?> </a>
								<a id='login-button' href='<?php echo wp_login_url(); ?>'> <?php esc_html_e( 'LOGIN', 'foodrecipe' )?> </a>
							</div><!-- .col-lg-3 col-sm-6 col-xs-12 button-container -->
							<nav class="navbar navbar-default col-xs-1 hidden-lg">
								<div class="container-fluid">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#foodrecipe-navbar-collapse-1" aria-expanded="false">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button><!-- .navbar-toggle collapsed -->
									</div><!-- .navbar-header -->
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="foodrecipe-navbar-collapse-1">
										<span class="glyphicon glyphicon-remove exitButton"></span>
										<?php  	wp_nav_menu( array(
											'theme_location' => 'primary') );?>
									</div><!-- .collapse navbar-collapse -->
								</div> <!-- .container-fluid -->
							</nav><!-- .navbar navbar-default col-xs-1 hidden-lg -->
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .header-top -->
				<?php global $wp_query;
				$old_query = $wp_query;
				$args = array(
					'post_type'           => 'post',
					'meta_key'            => '_foodrecipe_display_in_slider',
					'meta_value'          => '1',
					'ignore_sticky_posts' => true
				);
				$query = new WP_Query( $args );
				if( $query->have_posts() ) {
					$count = 0; ?>
					<div class="slider">
						<div class="row" >
							<div class="col-md-12">
								<div id="foodrecipeCarousel" class="carousel slide" data-ride="carousel">
									<!-- Wrapper for slides -->
									<div class="carousel-inner">
										<?php while( $query->have_posts() ) {
											if( 0 == $count ){
												$class = 'active';
											} else {
												$class = '';
											}
											$query->the_post();
												if( has_post_thumbnail() ) {
													$image = get_the_post_thumbnail_url( get_the_ID(),'full'); ?>
													<div class="item <?php echo $class; ?>">
														<div class="img1" style="background-image:url( <?php echo $image; ?> )"></div>
														<div class="carousel-caption">
															<h3 class="carousel-post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
															<p> <?php the_excerpt(); ?> </p>
															<a href="<?php the_permalink(); ?>">
																<button type="button" class="read-more-slider"> <?php esc_html_e( 'read more', 'foodrecipe' ) ?> </button>
															</a>
														</div><!-- .carousel-caption -->
													</div><!-- .item -->
													<?php $count++;
												}
												} ?>
									</div><!-- .carousel-inner -->
									<div class="carousel-nav">
										<a class="left carousel-control" href="#foodrecipeCarousel" data-slide="prev">
											<span class="glyphicon glyphicon-chevron-left"></span>
										</a>
										<a class="right carousel-control" href="#foodrecipeCarousel" data-slide="next">
											<span class="glyphicon glyphicon-chevron-right"></span>
										</a>
									</div><!-- .carousel-nav -->
								</div><!-- #foodrecipeCarousel -->
							</div><!-- .col-md-12 -->
						</div><!-- .row -->
					</div><!-- .slider-->
				</div><!-- .header -->
			</div>
					<?php wp_reset_postdata();
				}
			$wp_query = $old_query;?>
			<div class="middle">
