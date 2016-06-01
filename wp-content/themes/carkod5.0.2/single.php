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
            
            <div id="postmetadata" class="postmetadata-single">
                            <small class="thetopic" title="This article is about <?php $category = get_the_category();echo $category[0]->cat_name;?>" ><span class="thecat"><?php $categories = get_the_category();foreach ($categories as $cat) {echo '<a href="' . get_category_link($cat->cat_ID) . '/"><span>'.$cat->cat_name.'</span></a>';}; echo "</span></small>  <small class='date' ><span class='updated' title='Updated date'>" ; the_modified_date(); if (is_admin()) { echo ' | ' ; edit_post_link('edit');}?></span>
                            </small>
             </div>
        		
			<?php endwhile; ?>
			
            
			<?php  else : ?>
			<?php _e('I tried to find what you are looking for but it does not seem to be here, place change your search criteria.'); ?>         
		
		<?php endif; ?>
		
        <div id="menu2" class="toggle">
            <ul id="menu2-list" data-snap-ignore="true">
            	 <?php if( get_post_meta($post->ID, 'reference', true) ) : ?><li><a href="#postReferences" title="References used in this article">Sources</a></li><?php endif; ?>
            	<li><a href="#related" class="menu2-link">Related posts</a></h3></li>
                <?php if ( comments_open() ) : ?><li><a href="#comments">Discussion</a></li><?php endif; ?>
               <li><a href="#respond" class="menu2-link">Leave a reply</a></li>
               <li><a href="#share" class="menu2-link">Share</a></li>
            </ul>
            
            
            
        	<?php if( function_exists('post_references') ); post_references('<h2 id="postReferences-title" >Bibliographic references</h2>', '<div id="postReferences">', '</div>'); ?>
            
            
			<div id="related">
            	
            		<ul id="related-list">
                	
						<?php $orig_post = $post; global $post;$tags = wp_get_post_tags($post->ID);if ($tags) {$tag_ids = array();foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;$related_query = new wp_query(array( 'tag__in' => $tag_ids,'post__not_in' => array($post->ID), 'posts_per_page'=>6, 'caller_get_posts'=>1 ));while( $related_query->have_posts() ) {$related_query->the_post();?>
     
                        <li><a rel="external" href="<?php the_permalink()?>"><?php the_title(); ?></a></li>
                        <?php }}$post = $orig_post;wp_reset_query();?>
					</ul>
           </div>          
           <?php // comments_template(); ?>
           
           <div id="share">
           <a href="https://twitter.com/share">Share this on Twitter</a>
           <a href="http://www.facebook.com/sharer/sharer.php?u=URL">Share this on Facebook</a>
           </div>
              
        </div> <!-- End toggle -->
		</div><!-- End content -->
	</div> <!-- End of Container2 -->  
 
<?php get_sidebar();?>         
</div> <!--End Container1 -->  

<?php get_footer(); ?>