<div id="topnav">
<ul id="topnav-menu">
<li><a href="<?php bloginfo('url');?>">Home</a></li>
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
    

</ul>

</div>
