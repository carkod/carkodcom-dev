<?php if ( wp_is_mobile() ){ // Mobile friendly stuff ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/snap.min.js"></script>
<script type="text/javascript">
jQuery( document ).ready(function() {

var snapper = new Snap({
  element: document.getElementById('snap'),
  dragger: null,
disable: 'right',
addBodyClasses: true,
hyperextensible: true,
resistance: 0.5,
flickThreshold: 50,
transitionSpeed: 0.3,
easing: 'ease',
maxPosition: 266,
minPosition: -266,
tapToClose: true,
touchToDrag: true,
slideIntent: 40,
minDragDistance: 5
});

document.getElementById('open-left').addEventListener('click', function(){

    if( snapper.state().state=="left" ){
        snapper.close();
    } else {
        snapper.open('left');
    }

});
    });
</script>

<?php } else { ; ?>
<?php } // End mobile friendly stuff ?>

<div id="sidebar" class="sidebar-mobile">
	
	<ul id="sidebar-list">
    <li><?php get_search_form(); ?></li>
   
    
		<?php wp_list_pages(array(
            'depth'        => 1,
            'date_format'  => get_option('date_format'),
            'title_li'     => 0,
            'echo'         => 1,
            'authors'      => '',
            'sort_column'  => 'menu_order, post_title',
            'link_before'  => '<span>',
            'link_after'   => '</span>',
            'post_type'    => 'page',
            'post_status'  => 'publish',) ) ; ?>

		<li id="categories"><a href="" id="topics-link" class="section"><?php _e('Topics'); ?></a>
        
            <ul class="child" id="categories-list">
            <?php wp_list_categories('orderby=count&hide_empty=1&title_li=&hierarchical=0&'); ?>
            </ul><!-- End categories list -->
		</li>
        
		 <li id="archives" ><a href="" id="archives-link" class="section"><?php _e('Yearly Archives');?></a>
        
            <ul id="archives-list" class="child">
            <?php wp_get_archives( array(
                'limit'           => '' ,
                'show_post_count' => false,
                'order'           => 'DESC',
                'type'  => 'yearly' ,
                 ) ); ?>
            </ul> 
    </li><!-- End archives list -->
	        <?php get_template_part('foot'); ?>   
	
	</ul><!-- End Sidebar list -->
</div>
