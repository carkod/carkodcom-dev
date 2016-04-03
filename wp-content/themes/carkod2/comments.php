<div id="comments">

<!-- Comments data part  -->

<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>  
<?php die('You cannot access this page directly!'); ?>
<?php endif; ?> 

<!-- This prevents user from viewing comments.php by accident -->

<?php if(!empty($post->post_password)) : ?>
<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<?php endif; ?>
<?php endif; ?>

<!-- End of comments data part -->


<!-- The comments display -->
<?php if($comments): /* if there are comments */ ?>
<h2 class="comment-list_title"><?php comments_number('No comments', 'Just one comment', '% Comments'); ?></h2>
	<ol class="comment_list">
	<?php foreach($comments as $comment) : ?> 
    	<li>
        <?php if($comment->comment_approved == '0') : /* if comments are not directly approved */?>
		<p class="text">Your comment is awaiting approval</p>
    	<?php endif; ?>
        <div class="comment_title">
        <p><?php comment_author_link(); ?> said: </p>
        </div>
		<p class="commenttext-display"><?php comment_text() ;?></p>
        <p>In <?php comment_date(); ?> </p>
        </li>
    <?php endforeach; ?>
    </ol>
<?php else : ?>
	<h2 class="comment-list_title"><?php _e('There are no comments.'); ?></h2>
<?php endif ;?>

<!-- End  of comments display -->

<!-- Comments form -->
<?php if(comments_open()) /* If comments are open */ :?>
<div class="comment-top"> </div>
<div id="comment_form">
<h2 class="comment-form_title"><?php _e('I will appreciate your feedback'); ?></h2>
	<?php if(get_option('comment_registration') && !$user_ID)/* if needs to be registered*/ : ?>
    <p class="logged-in-as">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to comment.</p>
	<?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"> 	
    	<?php if($user_ID) /* Whether already logged in or not*/ : ?>
        <p class="logged-in-as">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
        <?php else /* The following must be filled for non-logged in users */:?>
      
        <p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="30" tabindex="1" /><label for="author"><?php  _e('Name');if($req) echo " (required)"; ?></label>
           </p>  
        <p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="30" tabindex="2" /><label for="email"><?php _e('E-Mail'); if($req) echo " (required, not published)"; ?></label>
           </p>  
        <p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="30" tabindex="3" /> <label for="url"><?php _e('Your Website'); ?></label>          </p>
        <?php endif /* The text of the comment */;?>
        
        <p><label><?php _e('Here goes your comment'); ?></label><br /><textarea name="comment" class="commenttext" cols="60%" rows="15" tabindex="4"></textarea></p>  
        <input name="submit" type="submit" id="submitcomment" tabindex="5" value="Add Comment" size="10" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /><br />
         <?php do_action('comment_form', $post->ID); ?>
        
     </form> 
     </div>
     <div class="comment-bottom"></div>  
    <?php endif ;?>
    
    
<?php else :?>
<p><?php _e('Comments disabled'); ?></p>
<?php endif ;?>
</div>

                