<?php /* Template Name: Contact*/
  //response generation function
  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }
  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $message = $_POST['message_text'];
  $human = $_POST['message_human'];

  //php mailer variables
  $to = get_option('admin_email');
  $subject = "Someone sent a message from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
    }
  }
  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);

?>
<?php get_header(); ?>

<div class="container1">
  
	<div id="snap" class="container2-mobile container2">
        	<?php get_template_part('logo');?>
		<div id="content">
        
        <div class="title">
			<h2 id="title-single"><?php if ( have_posts() ) : the_title(); ?></h2>
		</div>
        
        
		<?php  while ( have_posts() ) : the_post(); ?>
			           
            <div id="single-entry">    
			<?php the_content (); ?>
            
			<div id="respond">
                <?php echo $response; ?>
                <form action="<?php the_permalink(); ?>" method="post">
                  <p><input id="author" type="text" name="message_name" value="<?php echo esc_attr($_POST['message_name']); ?>" size="22"><label for="name">Name <span>*</span></label></p>
                  <p><input id="email" type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>" size="22"><label for="message_email">Email <span>*</span></label></p>
                  <p><label id="message" for="message_text">Message <span>*</span><br><textarea cols="100%" rows="10" tabindex="4" type="text" name="message_text"><?php echo esc_textarea($_POST['message_text']); ?></textarea></label></p>
                  <p><label id="human" for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
                  <input type="hidden" name="submitted" value="1">
                  <p><input id="submit" type="submit" value="SEND"></p>
                </form>
              </div>
            </div> <!-- End single -->

			<?php endwhile; ?>
			
            
			<?php  else : ?>
			<?php _e('I tried to find what you are looking for but it does not seem to be here, place change your search criteria.'); ?>         
		
		<?php endif; ?>
		
		</div><!-- End content -->
	</div> <!-- End of Container2 -->  
 
<?php get_sidebar();?>         
</div> <!--End Container1 -->  

<?php get_footer(); ?>