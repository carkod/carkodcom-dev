<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="container2">
	<?php if (have_posts() ) : while (have_posts() ): the_post (); ?>
		<h2 class="single-title"><?php the_title (); ?></h2>
			<div id="content">
             <div id="single" class="entry"> 
    		<?php the_content (); ?>
       			</div>
       		</div>
	<?php endwhile;  else : ?>
		<?php _e('I tried to find what you are looking for but it does not seem to be here, place change your search criteria.'); ?>
	<?php endif; ?>
    <?php wp_reset_query() ?>
    
</div>

<!-- End content -->

</div>

<!-- End container2 -->

</div> 


<?php //end of container1 ?> </div>
<?php get_footer(); ?>
