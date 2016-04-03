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
            
			<?php wp_link_pages(array('next_or_number'=>'number', 'before' => '<div class="pagelink">Pages', 'after' => '</div>',  )); ?>
            
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