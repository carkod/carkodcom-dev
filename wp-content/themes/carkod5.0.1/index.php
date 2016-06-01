<?php get_header(); ?>

<div class="container1">
  
	<div id="snap" class="container2-mobile container2">
    
    	<?php get_template_part('logo'); // header ?>
        
        <!-- End of Header -->         
        <div id="content">
        
        	<div class="title">
        
        		<?php if ( have_posts() )  : ?> 
				<h2 id="title-results">
				 <?php if (is_category() ): // displays the following header if category archive is loaded ?> 
                <?php _e('Articles about '); ?><span class="underline"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>
           <?php endif; ?>
        
           <?php if (is_tag()) :// displays the following header if tag archive is loaded ?>
               <?php _e('Posts tagged as '); ?><span class="underline"><?php single_tag_title ();?></span>
           <?php endif; ?>
           
           <?php if (is_date()):  ?>
                <?php _e('Articles written in '); ?><span class="underline"><?php the_time('Y'); ?></span>
            <?php endif; ?>
            
             <?php if (is_search()):  ?>
                <?php _e('You searched for '); echo '"'; the_search_query('F Y'); echo '"'; ?>
            <?php endif; ?>
            
             <?php if (is_404() ):  ?>
                <?php _e('Error! Cannot find the page.');?>
            <?php endif; ?>
            </h2>
            
			</div>	
				
				<?php while ( have_posts() ) : the_post(); ?>
    			<div class="entry">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
                        
                        <h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
                        <?php the_excerpt (); ?>
                        <div id="postmetadata">
                            <small class="thetopic" title="This article is about <?php $category = get_the_category();echo $category[0]->cat_name;?>" ><span class="thecat"><?php $categories = get_the_category();foreach ($categories as $cat) {echo '<a href="' . get_category_link($cat->cat_ID) . '/"><span>'.$cat->cat_name.'</span></a>';}; echo "</span></small>  <small class='date' ><span class='updated' title='Updated date'>" ; the_modified_date(); ?></span>
                            </small>
                        </div>
                        
                  </div>
                    <?php endwhile; ?> 
                    <div class="pagination" style="text-align:center;">
						<?php posts_nav_link( ' &#183; ', 'previous page', 'next page' ); ?>
					</div>
                     <?php else: ?>
                    <p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
        
				<?php endif; ?>
		</div> <!-- End content -->
	</div> <!-- End of Container2 -->       
<?php get_sidebar();?>         
</div> <!--End Container1 -->
<?php get_footer(); ?>