<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
 
	if ( post_password_required() ) { ?>
		<p class="passprotected">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>
 
<!-- You can start editing here. -->

<div id="comments">
<?php if ( have_comments() ) : ?>


	<ol id="comments-list" class="commentlist">
		<?php wp_list_comments('type=comment&callback=advanced_comment'); //this is the important part that ensures we call our custom comment layout defined above 
                ?>
	</ol>
	<div class="clear"></div>
	<div class="comment-navigation">
		<div class="older"><?php previous_comments_link() ?></div>
		<div class="newer"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>
 	<p class="nocomments">There are no replies to this article, leave a reply! </p>
	<?php if ( comments_open() ) : ?>

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="closedcomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>
</div> <!-- End of comments -->

<?php if ( comments_open() ) : ?>
 
<div id="respond">
<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>
 
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
 
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
 
<?php if ( is_user_logged_in() ) : ?>
 
<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
 
<?php else : //this is where we setup the comment input forums ?>
 
<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Name <?php if ($req) echo "<span class=\"respond-star\">*</span>"; ?></small></label></p>
 
<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>E-Mail <?php if ($req) echo "<span class=\"respond-star\">*</span>"; ?></small></label></p>
 
<?php endif; ?>
 
<p class="respond-textarea">After submitted your reply, click Discussion tab to see all the replies.</p>
 
<p><textarea data-role="none" name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
 
<p><input data-role="none" name="submit" type="submit" id="submit" tabindex="5" value="SEND" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
 
</form>
</div>
<?php endif; // If registration required and not logged in ?>

 
<?php endif; // if you delete this the sky will fall on your head ?>