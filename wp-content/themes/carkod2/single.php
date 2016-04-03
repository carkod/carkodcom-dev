<?php get_header(); ?>
<?php get_sidebar(); ?>

<?php setPostViews(get_the_ID());?>
	<?php if (have_posts() ) :?> 
    <?php while (have_posts() ): the_post (); ?>
		<h2 class="single-title"><?php the_title (); ?></h2>
<div id="container3">
        <div id="postmetadata"><img src="<?php bloginfo('template_url'); ?>/images/infoicon.png" alt="Article information" title="Article Info" class="infoicon"><?php _e('This article about '); the_category(', '); the_tags(' talks about '); _e('. Updated on '); the_modified_date('F j, Y'); echo'.';  edit_post_link(' | edit');?></div>
   <div id="content">
        
		

    	<?php the_content (); ?>
        <?php  wp_link_pages(array('next_or_number'=>'number', 'before' => '<div class="pagelink">Pages', 'after' => '</div>',  )); ?>
       
        </div>
        <?php if( function_exists('post_references') ) ?>

			<script type="text/javascript">
	jQuery(document).ready(function(){
	
		$('#postReferences h2').click(function() {
			
		$('#postReferences > ol').toggle('fast');	
		});
		$('#postReferences h2').toggle(
  function () {
    $(this).addClass("selected");
  },
  function () {
    $(this).removeClass("selected");
  }
);
	
		});
</script>
		 <?php post_references('<h2  title="Click to collapse">References</h2>', '<div id="postReferences">', '</div>'); ?>
         <div id="related">
      <?php related_posts (); ?>
	<?php endwhile;  else : ?>
		<?php _e('I tried to find what you are looking for but it does not seem to be here, place change your search criteria.'); ?>
	<?php endif; ?>
    
    <?php wp_reset_query() ?>
    </div>
    <?php comments_template(); ?>
    
   
    
</div>



<?php get_footer(); ?>