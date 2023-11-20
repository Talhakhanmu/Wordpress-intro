<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consted
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="clearfix"></div>
<div id="comments" class="comments-area blog-comment">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$consted_comment_count = get_comments_number();
			if ( '1' === $consted_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'consted' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $consted_comment_count, 'comments title', 'consted' ) ),
					number_format_i18n( $consted_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->

		

		
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'callback' => 'consted_shop_walker_comment',
			) );
			?>
		<!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'consted' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	
	?>
</div>   
<?php 
		$commenter = wp_get_current_commenter();
		$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

	$args = array(
	'fields' => apply_filters(
		'comment_form_default_fields', array(
			'author' =>'<div class="col-xl-6 col-lg-6 col-sm-6 col-12">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'consted'  ) . '" name="author" type="text" value="' .
				esc_attr( $commenter['comment_author'] ) . '" size="30" />'.
				( $req ? '<span class="required">*</span>' : '' )  .
				'</div>'
				,
			'email'  => '<div class="col-xl-6 col-lg-6 col-sm-6 col-12">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'consted'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" />'  .
				( $req ? '<span class="required">*</span>' : '' ) 
				 .
				'</div>',
			'url'    => '<div class="col-xl-12 col-lg-12 col-sm-12 col-12">' .
			 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'consted' ) . '" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" class="text" /> ' .
			
	           '</div>',
			'cookies'    =>  '<p class="comment-form-cookies-consent col-12"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="fas fa-check" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">'.esc_html__( 'Save my name, email, and website in this browser for the next time I comment.','consted' ) .'</label></p>',
			   
			   
		)
	),
		'comment_field' =>  '<div class="col-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'consted' ) . '">' .
		'</textarea></div>',
		
		
		'class_form'      => 'row',
		'submit_button' => '<button type="submit" class="def-btn" id="submit-new">'. esc_html__( 'Post Comment', 'consted' ) .'<span><i class="icofont-double-right"></i></span></button>',
		'title_reply_before'   => ' <h3>',
		'title_reply_after'    => '</h3>',
		'comment_notes_before' => '<p class="comment-notes col-12">' . esc_html__( 'Your email address will not be published. Required fields are marked *.','consted' ) . '</p>',
		
		'submit_field' =>'<div class="form-submit col-12">%1$s %2$s</div>'
);
	?>
    <div class="post-a-comment comment-form" >
    
    <?php comment_form( $args );?>
    </div>

