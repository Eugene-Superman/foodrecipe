<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @since Foodrecipe 1.0
 */

if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php esc_html_e( 'COMMENTS', 'foodrecipe' );
			echo ' (' . get_comments_number() . ')'; ?>
		</h2>
		<ul class="commentlist">
			<?php wp_list_comments( 'avatar_size=90&callback=foodrecipe_comment' ); ?>
		</ul>
	<?php endif; ?>
	<?php $commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$username = esc_attr_x( 'Username', 'placeholder', 'foodrecipe' );
	$your_email = esc_attr_x( 'Your email*', 'placeholder', 'foodrecipe' );
	$your_website = esc_attr_x( 'Your website', 'placeholder', 'foodrecipe' );
	$your_message = esc_attr_x( 'Your message', 'placeholder', 'foodrecipe' );
	$foodrecipe_fields =  array(
		'author' =>
		'<div class="row comment-form-head">'.
		'<p class="comment-form-author col-md-4 col-sm-4">'.
		'<input id="author" name="author" type="text" value="" placeholder="' . $username . '"' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' /></p>',

		'email'  =>
		'<p class="comment-form-email col-md-4 col-sm-4">'.
		'<input id="email" name="email" type="text" value="" placeholder="' . $your_email . '"' . esc_attr(  $commenter['comment_author_email'] ) .
		'" size="30"' . $aria_req . ' /></p>',

		'url'    =>
		'<p class="comment-form-url col-md-4 col-sm-4">'.
		'<input id="url" name="url" type="text" value="" placeholder="' . $your_website . '"' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" /></p>'.
		'</div>'
	);
	$foodrecipe_args = array(
		'id_form'              => 'commentform',
		'class_form'           => 'comment-form',
		'id_submit'            => 'submit',
		'class_submit'         => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a comment', 'foodrecipe' ),
		'title_reply_to'       => __( 'Leave a reply to', 'foodrecipe' ).' %s',
		'cancel_reply_link'    => __( 'Cancel reply', 'foodrecipe' ),
		'label_submit'         => __( 'LEAVE A COMMENT', 'foodrecipe' ),
		'format'               => 'xhtml',

		'comment_field'        =>  '<p class="comment-form-comment">'.
		'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . $your_message . '">' .
		'</textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' .
		sprintf(
		__( 'You must be', 'foodrecipe' ).'<a href="%s"> '.__( 'logged in', 'foodrecipe' ).'</a> '.__( 'to post a comment.', 'foodrecipe' ),
		wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' .
		sprintf(
		__( 'Logged in as', 'foodrecipe' ).' <a href="%1$s">%2$s</a>'.'<a href="%3$s" title="Log out of this account"> '.__( 'Log out?', 'foodrecipe' ).'</a>',
		admin_url( 'profile.php' ),
		$user_identity,
		wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		).'</p>',
		'comment_notes_before' => '<p class="comment-notes">'.
		'</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' .
		'</p>',
		'fields'               => apply_filters( 'comment_form_default_fields', $foodrecipe_fields ),
	); ?>
	<div class='comment-pagination foodrecipe-page-numbering'>
		<?php paginate_comments_links(); ?>
	</div>
	<?php comment_form( $foodrecipe_args ); ?>
</div><!-- #comments -->
