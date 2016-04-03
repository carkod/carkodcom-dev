<?php get_header(); ?>
<?php get_sidebar(); ?> 
<script>
	$(function () {
    var tabContainers = $('#left_column > div');
    
    $('#toggle ul.menu1 li a').click(function () {
        tabContainers.hide().filter(this.hash).show();
        
        $('#toggle ul.menu1 li a').removeClass('selected');
        $(this).addClass('selected');
        
        return false;
    }).filter(':first').click();
});

$(function () {
    var tabContainers = $('#right_column > div');
    
    $('#toggle ul.menu2 li a').click(function () {
        tabContainers.hide().filter(this.hash).show();
        
        $('#toggle ul.menu2 li a').removeClass('selected');
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
    <ul class="mainmenu menu2">
		<li><a href="#tab4" title="<?php _e('See All Tags'); ?>"><?php _e('Tags'); ?></a></li>
        <li><a href="#tab5" title="<?php _e('See Useful Links'); ?>"><?php _e('Links'); ?></a></li>
        <li><a href="#tab6" title="<?php _e('All posts by date'); ?>"><?php _e('Archives'); ?></a></li>
     
	</ul>
</div>

<div id="container2">
<div id="left_column">


<div id="tab1">
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

<div id="tab2">
	<?php $qualityquery = array('meta_key'=>'reference','post_status'=>'publish','post_type'=>'post','orderby'=>'date', 'order'=>'DESC','posts_per_page'=>'10' ) ; $the_query = new WP_Query( $qualityquery ); while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    	<div class="entry">
        	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
			<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    		<?php the_excerpt (); ?>
        	<div style="clear:both;"></div>
        </div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>

</div>


<div id="tab3">

	<?php query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC'); if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<div class="entry">
    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail();}  ?>
	<h3><a href="<?php the_permalink (); ?>" title="<?php _e('Read Article'); ?>"><?php the_title (); ?></a></h3>
    <?php the_excerpt (); ?>
    <div style="clear:both;"></div>
        </div>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, I could not find what you are looking for.'); ?></p>
	<?php endif; ?>
	<?php wp_reset_query() ?>

</div>
</div>
<div id="right_column">


<div id="tab4">
	
	<?php wp_tag_cloud('unit=px&smallest=18&largest=18&format=list&orderby=count&title_li=Tags&number=29'); ?>
</div>

<div id="tab5">
	<ul>
	<?php wp_list_bookmarks('orderby=name&title_li=&number=29&categorize=0'); ?>
	</ul>
</div>

<div id="tab6">
	
	<ul>
	<?php wp_get_archives('&number=29'); ?>
	</ul>
</div>

</div>
</div>
<?php get_footer(); ?>