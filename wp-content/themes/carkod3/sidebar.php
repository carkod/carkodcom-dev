<div id="sidebar">

<h2 id="topics">Topics</h2>
<ul class="categories">
<?php wp_list_categories('orderby=count&hide_empty=0&orderby=count&title_li=&hierarchical=0&number=6&'); ?>
</ul>


<ul class="archives">
<h2 id="topics" class="greybg">Archives</h2>
<?php wp_get_archives( array(
    'limit'           => 6 ,
    'show_post_count' => false,
    'order'           => 'ASC',) ); ?>
</ul>
<div id="sidebar_bg"></div>
</div>
