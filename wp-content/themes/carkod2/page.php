<?php get_header(); ?>
<?php get_sidebar(); ?>
	<?php if (have_posts() ) :?> 
    <?php while (have_posts() ): the_post (); ?>
		<h2 class="single-title"><?php the_title (); ?></h2>
<div id="container3">
        
   <div id="content">
        
		

    	<?php the_content (); ?>
       
       
        </div>
        <?php if( function_exists('post_references') ) ?>

			
      
      
	<?php endwhile;  else : ?>
		<?php _e('I tried to find what you are looking for but it does not seem to be here, place change your search criteria.'); ?>
	<?php endif; ?>
    
    <?php wp_reset_query() ?>
  
 
    
   
    
</div>



<?php get_footer(); ?>
