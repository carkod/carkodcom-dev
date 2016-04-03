<div id="topnav">
<ul id="topnav-menu">
<li><a href="<?php bloginfo('url');?>">Home</a></li>
<?php wp_list_pages('title_li=&');?>
<li><a href="<?php the_post_type_permalink('spanish') ;?>"><?php _e(Español); ?></a></li>
<li><a href="<?php the_post_type_permalink('chinese') ;?>"><?php _e(中文); ?></a></li>
<li><?php get_search_form(); ?> </li>
</ul>

</div>
