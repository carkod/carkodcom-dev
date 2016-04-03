<?php get_header(); ?>
<div class="container1">
  
	<div id="snap" class="container2-mobile container2">
    
    	<?php get_template_part('logo');?>
        
        <!-- End of Header -->
		<div id="content">
        
        
        <div id="menu" class="toggle title">
			<ul class="menu-list menu1" data-snap-ignore="true">
                <li><a id="tab1" href="#latest" title="<?php _e('Those I have written recently');?> "><?php _e('Latest creations');?></a></li>
                <li><a id="tab2" href="#research" title="<?php _e('High quality articles from my own research');?>"><?php _e('Research writings');?></a></li>
              
			</ul>
        <!-- End of Toggle (First navigation) -->

            <div id="latest" class="tabs">
            <div id="article-latest"> <!-- Double div for infinite scroll pagination purposes -->
                <?php
				
				$paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;
            	$paged2 = isset( $_GET['paged2'] ) ? (int) $_GET['paged2'] : 1;
				
				$queryrecent = new WP_Query( array('paged'=> $paged1,'posts_per_page' => 5,));
				
				 if ( $queryrecent->have_posts() ) : while ( $queryrecent->have_posts() ) : $queryrecent->the_post(); ?>
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
                    </div> <!-- End doble div for pagination -->
                    <div class="pagination" style="text-align:center;">
						<?php $pag_args1 = array('format'  => '?paged1=%#%','current' => $paged1, 'total' => $queryrecent->max_num_pages, 'end_size' => 0 , 'mid_size' => 0, 'next_text' => 'Load more articles', 'add_args' => array( 'paged2' => $paged2 ) //add all other paged# loops if there are more than 3
        ); echo paginate_links( $pag_args1 );?>

					</div>
                    
                    
                    
                     
                    <?php wp_reset_postdata(); ?>
                     <?php else: ?>
                    	<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
                     <?php endif; ?>
					
            </div> <!-- End first tab -->
            
            
            
            
            <div id="research" class="tabs">
            	<div id="article-research">
                <?php $qualityquery = new WP_Query( array('paged' => $paged2, 'meta_key'=>'reference','post_status'=>'publish','post_type'=>'post','orderby'=>'date', 'order'=>'DESC', 'posts_per_page'=>5, ) ); if ( $qualityquery->have_posts() ) : while ( $qualityquery->have_posts() ) : $qualityquery->the_post(); ?>
                    <div class="entry">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
                        <h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
                        <?php the_excerpt (); ?>
                            <div id="postmetadata">
                            <small class="thetopic" title="This article is about <?php $category = get_the_category();echo $category[0]->cat_name;?>" ><span class="thecat"><?php $categories = get_the_category();foreach ($categories as $cat) {echo '<a href="' . get_category_link($cat->cat_ID) . '/"><span>'.$cat->cat_name.'</span></a>';}; echo "</span></small>  <small class='date' ><span class='updated' title='Updated date'>" ; the_modified_date(); ?></span>
                            </small>
                        </div>
                        
                    </div>
                <?php endwhile;   ?> 
                </div><!-- End #article -->
				<div class="pagination" style="text-align:center;">
					<?php $pag_args2 = array('format'  => '?paged2=%#%','current' => $paged2, 'total' => $qualityquery->max_num_pages,'end_size' => 0 , 'mid_size' => 0, 'next_text' => 'Load more articles', 'add_args' => array( 'paged1' => $paged1 ) //add all other paged# loops if there are more than 3
        ); echo paginate_links( $pag_args2 );?>		
				</div>
                
				<?php wp_reset_postdata(); ?>
				<?php else : ?>
                	<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
                <?php endif; ?>
                 
            
            </div>

			<!-- End second tab -->

           
            
		</div><!-- End tabs -->
        </div><!-- End content -->
	</div> <!-- End of Container2 -->       
<?php get_sidebar();?>         
</div> <!--End Container1 -->
<?php get_footer(); ?>