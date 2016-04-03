<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="container">
<?php if (have_posts() )  : ?>

   <?php if (is_category() ): // displays the following header if category archive is loaded ?> 
    	<h2 class="single-title"><?php _e('Articles about '); $category = get_the_category(); echo $category[0]->cat_name; ?></h2>
   <?php endif; ?>

   <?php if (is_tag()) :// displays the following header if tag archive is loaded ?>
   		<h2 class="single-title"><?php _e('Posts tagged as'); echo' "';single_tag_title();echo'"'; ?></h2>
   <?php endif; ?>
   
   <?php if (is_date()):  ?>
   		<h2 class="single-title"><?php _e('Articles written in '); the_time('F Y'); ?></h2>
	<?php endif; ?>
    
     <?php if (is_search()):  ?>
   		<h2 class="single-title"><?php _e('Your searched for '); echo '"'; the_search_query('F Y'); echo '"'; ?></h2>
	<?php endif; ?>
    
     <?php if (is_404() ):  ?>
   		<h2 class="single-title"><?php _e('Error! Cannot find the page.');?></h2>
	<?php endif; ?>
    
	<?php else : ?>
		<h2 class="single-title"><?php _e('Not found!'); ?></h2>
<?php endif; ?>

<div id="container4">

<?php if ( have_posts() ) : while ( have_posts() ) : ?> 
	
		
	
		<?php the_post(); ?>
    	<div class="entry">
    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
    		
			<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    		<?php the_excerpt (); ?>
            <div style="clear:both;"></div>
           	</div>
		<?php endwhile; ?> 
    	
        
    	
    <?php else: ?>
		<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
        
	<?php endif; ?>
</div>
<?php get_footer(); ?>

