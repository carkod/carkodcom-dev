<?php get_header(); ?>
<?php get_sidebar(); ?> 

<div id="container2">
<script>
	$(function () {
    var tabContainers = $('#content > div');
    
    $('#toggle ul.menu1 li a').click(function () {
        tabContainers.hide().filter(this.hash).show();
        
        $('#toggle ul.menu1 li a').removeClass('selected');
        $(this).addClass('selected');
        
        return false;
    }).filter(':first').click();
});

</script>
<div id="toggle">
	<ul class="mainmenu menu1">
		<li><a id="latest" href="#tab1" title="<?php _e('Those I have written recently'); ?>"><?php _e('Latest articles'); ?></a></li>
        <li><a id="recommended" href="#tab2" title="<?php _e('High quality articles from my own research'); ?>"><?php _e('Recommended articles'); ?></a></li>
        <li><a id="popular" href="#tab3" title="<?php _e('Most read articles according to statistics'); ?>"><?php _e('Most popular'); ?></a></li>
	</ul>
    
</div>

<div id="content">



<div id="tab1" class="tabs">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div class="entry">
    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
    		
			<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    		<?php the_excerpt (); ?>
            <div id="postmetadata">
            	<small class="thetopic"><?php  echo "Topic: ";the_category(', ');echo ('</small>  <small class="thetags">') ; the_tags ();?>
                </small>
            </div>
            <div style="clear:both;"></div>
           	</div>
		<?php endwhile; ?>  
        <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ($total_pages > 1){ $current_page = max(1, get_query_var('paged')); echo '<div class="page_nav">'; echo paginate_links(array('base' => get_pagenum_link(1) . '%_%','format' => '/page/%#%','current' => $current_page,'total' => $total_pages,'prev_text' => '&lArr;','next_text' => '&rArr;','mid_size' => 8 ,)); echo '</div>';}; ?>	
    <?php else: ?>
		<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
        
	<?php endif; ?>

</div>

<div id="tab2" class="tabs">
	<?php $qualityquery = array('meta_key'=>'reference','post_status'=>'publish','post_type'=>'post','orderby'=>'date', 'order'=>'DESC','posts_per_page'=>'6' ) ; $the_query = new WP_Query( $qualityquery ); while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    	<div class="entry">
        	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
			<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    		<?php the_excerpt (); ?>
            	<div id="postmetadata">
            	<small class="thetopic"><?php  echo "Topic: ";the_category(', ');echo ('</small>  <small class="thetags">') ; the_tags ();?>
                </small>
            </div>
        	<div style="clear:both;"></div>
        </div>
	<?php endwhile; ?>
    <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ($total_pages > 1){ $current_page = max(1, get_query_var('paged')); echo '<div class="page_nav">'; echo paginate_links(array('base' => get_pagenum_link(1) . '%_%','format' => '/page/%#%','current' => $current_page,'total' => $total_pages,'prev_text' => '&lArr;','next_text' => '&rArr;','mid_size' => 8 ,)); echo '</div>';}; ?>
	<?php wp_reset_postdata(); ?>

</div>


<div id="tab3" class="tabs">

	<?php query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC'); if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<div class="entry">
    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
	<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    <?php the_excerpt (); ?>
    <div id="postmetadata">
            	<small class="thetopic"><?php  echo "Topic: ";the_category(', ');echo ('</small>  <small class="thetags">') ; the_tags ();?>
                </small>
            </div>
    <div style="clear:both;"></div>
        </div>
	<?php endwhile; ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ($total_pages > 1){ $current_page = max(1, get_query_var('paged')); echo '<div class="page_nav">'; echo paginate_links(array('base' => get_pagenum_link(1) . '%_%','format' => '/page/%#%','current' => $current_page,'total' => $total_pages,'prev_text' => '&lArr;','next_text' => '&rArr;','mid_size' => 8 ,)); echo '</div>';}; ?>
	<?php else: ?>
	<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
	<?php endif; ?>
	<?php wp_reset_query() ?>
</div>

<!-- End content -->

</div>

<!-- End container2 -->

</div> 


<?php //end of container1 ?> </div>



<?php get_footer(); ?>