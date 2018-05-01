<?php
/**
 * Foodrecipe functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @since Foodrecipe 1.0
 */

function foodrecipe_setup() {
	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'foodrecipe', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'foodrecipe' ),
	) );

	$defaults = array(
		'default-image' => '',
		'default-preset' => 'default',
		'default-position-x' => 'left',
		'default-position-y' => 'top',
		'default-size' => 'auto',
		'default-repeat' => 'repeat',
		'default-attachment' => 'scroll',
		'default-color' => 'fff',
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $defaults );

	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 40,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title' ),
	) );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'title-tag' );

	add_image_size( 'foodrecipe-post-image', 840, 400, array( 'center', 'center' ) );
	add_image_size( 'foodrecipe-gallery-image', 415, 415, array( 'center', 'center' ) );
}

function foodrecipe_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'foodrecipe' ),
		'id' => 'foodrecipe-sidebar',
		'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'foodrecipe' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'foodrecipe' ),
		'id' => 'foodrecipe-sidebar-footer',
		'description' => __( 'Sidebar which is located at the footer of the page.', 'foodrecipe' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s col-md-3 col-sm-6 col-xs-12">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}

function foodrecipe_init(){
	if ( ! session_id() ){
		session_start();
	}
}

function foodrecipe_enqueue_style() {
	wp_enqueue_style( 'foodrecipe-bootstrap-style', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap.min.css', false );
	wp_enqueue_style( 'foodrecipe-bootstrap-theme-style', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap-theme.min.css', false );
	wp_enqueue_style( 'foodrecipe-bootstrap-theme-select', trailingslashit( get_template_directory_uri() ) . 'css/bootstrap-select.css', false );

	wp_enqueue_style( 'foodrecipe-style', get_stylesheet_uri(), false );

	wp_enqueue_script( 'foodrecipe-bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'foodrecipe-bootstrap-script-collapse', get_template_directory_uri() . '/js/collapse.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'foodrecipe-bootstrap-script-transition', get_template_directory_uri() . '/js/transition.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'foodrecipe-bootstrap-script-select', get_template_directory_uri() . '/js/bootstrap-select.js', array(), '3.3.7', true );

	wp_enqueue_script( 'foodrecipe-script', get_template_directory_uri() . '/js/script.js', array(), '1.0', true );

	wp_localize_script( 'foodrecipe-script', 'foodrecipe_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'pagination/pagination.php' ) ) {
		$custom_css = '
			.foodrecipe-page-numbering{
			display: none;
			}' ;
	wp_add_inline_style( 'foodrecipe-style', $custom_css );
	$pagination_options = get_option( 'pgntn_options' );
	if ( 0 == $pagination_options['add_appearance'] ) {
		$custom_css = '
		.foodrecipe-page-numbering .current:before,
		.pgntn-page-pagination .current:before,
		.page-link .current:before {
		border-radius: 50%;
		position: absolute;
		content: "";
		border: 1px solid #e94672;
		height: 50px;
		width: 50px;
		left: 0;
		top: -5px;
		}';
	wp_add_inline_style( 'foodrecipe-style', $custom_css );
	}
	} else {
	$custom_css = '
		.foodrecipe-page-numbering .current:before,
		.pgntn-page-pagination .current:before,
		.page-link .current:before {
		border-radius: 50%;
		position: absolute;
		content: "";
		border: 1px solid #e94672;
		height: 50px;
		width: 50px;
		left: 0;
		top: -7px;
		}';
	wp_add_inline_style( 'foodrecipe-style', $custom_css );
	}
	if( get_bloginfo( 'language') != 'en-US') {
		$language_css = '
		#commentform input#submit {
			width: auto;
		}';
	wp_add_inline_style( 'foodrecipe-style', $language_css );
	}
}

function foodrecipe_pre_get_posts( $query ){
	if( isset( $_SESSION['foodrecipe_post_count'] ) ){
		$query->set( 'posts_per_page', $_SESSION['foodrecipe_post_count'] );
	}
}

function foodrecipe_pre_get_order( $query ){
	if( isset( $_SESSION['foodrecipe_post_order'] ) ){
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', $_SESSION['foodrecipe_post_order'] );
	}
}

function foodrecipe_count_display() {
	if(isset( $_POST['count'] ) ){
		$_SESSION['foodrecipe_post_count'] = $_POST['count'];
		echo '1';
	}
	if(isset( $_POST['order'] ) ){
		$_SESSION['foodrecipe_post_order'] = $_POST['order'];
		echo '1';
	}
	// this is required to terminate immediately and return a proper response
	wp_die();

}

function foodrecipe_comment( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}?>
	<<?php echo $tag; comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php } ?>
	<div class="comment-author vcard row">
		<?php if ( $args['avatar_size'] != 0 ) {
			echo "<div class='avatar-div col-md-2'>".get_avatar( $comment, $args['avatar_size'] )."</div>";
			echo "<div class='comment-head col-md-10'>";
		}
		printf( '<cite class="fn col-xs-6">%s</cite>' , get_comment_author_link() ); ?>
		<div class="reply col-xs-6 ">
			<?php	comment_reply_link(
				array_merge(
					$args,
					array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth']
					)
				)
			); ?>
		</div>
		<?php echo "</div>"; ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) { ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'foodrecipe' ); ?></em><br/>
	<?php } ?>
	<div class='comment-content'>
	<?php if ( $comment->comment_type == '' ) {
		comment_text();
	}?>
	</div>
	<div class="comment-meta commentmetadata">
		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php printf( get_comment_date() ); ?>
		</a>
	</div>
	<?php if ( 'div' != $args['style'] ) { ?>
		</div>
	<?php }
}

function wpb_move_comment_field_to_bottom( $foodrecipe_fields ) {
	$comment_field = $foodrecipe_fields['comment'];
	unset( $foodrecipe_fields['comment'] );
	$foodrecipe_fields['comment'] = $comment_field;
	return $foodrecipe_fields;
}

function foodrecipe_add_custom_box() {
	add_meta_box(
		'foodrecipe_box_id',           // Unique ID
		'Display in slider',           // Box title
		'foodrecipe_custom_box_html',  // Content callback, must be of type callable
		'post'                         // Post type
	);
}

load_theme_textdomain('foodrecipe');

function foodrecipe_custom_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_foodrecipe_display_in_slider', true ); ?>
	<input type="checkbox" name="foodrecipe_display_in_slider" id="foodrecipe_display_in_slider" class="postbox" value="1" <?php checked( $value, 1, true ); ?> />
	<label for="foodrecipe_display_in_slider"><?php esc_html_e( 'Add post to slider', 'foodrecipe' ); ?></label>
<?php }

function foodrecipe_save_postdata( $post_id ) {
	if ( wp_is_post_revision( $post_id ) )
		return;
	if ( isset( $_POST['foodrecipe_display_in_slider'] ) ) {
		update_post_meta(
			$post_id,
			'_foodrecipe_display_in_slider',
			1
		);
	} else {
		$value = get_post_meta( $post_id, '_foodrecipe_display_in_slider', true );
		if( $value ){
			delete_post_meta( $post_id, '_foodrecipe_display_in_slider' );
		}
	}
}

function wpdocs_custom_excerpt_length( $length ) {
	return 26;
}

function wpdocs_excerpt_more( $more ) {
	return '';
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
add_action( 'after_setup_theme', 'foodrecipe_setup' );
add_action( 'widgets_init', 'foodrecipe_widgets_init' );
add_action( 'init', 'foodrecipe_init' );
add_action( 'wp_enqueue_scripts', 'foodrecipe_enqueue_style' );
add_action( 'pre_get_posts', 'foodrecipe_pre_get_posts' );
add_action( 'pre_get_posts', 'foodrecipe_pre_get_order');
add_action( 'wp_ajax_foodrecipe_display', 'foodrecipe_count_display' );
add_action( 'wp_ajax_nopriv_foodrecipe_display', 'foodrecipe_count_display' );
add_action( 'add_meta_boxes', 'foodrecipe_add_custom_box' );
add_action( 'save_post', 'foodrecipe_save_postdata' );
add_editor_style( 'custom-editor-style.css' );
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length' );
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
