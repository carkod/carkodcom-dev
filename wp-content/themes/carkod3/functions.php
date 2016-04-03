<?php

// widgetized sidebar

if ( function_exists('register_sidebar') )
register_sidebar(array(
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

//search function



// Post types

  
  add_action( 'init', 'create_post_type' );
function create_post_type() {
  
  
  
  
}


  
register_taxonomy_for_object_type('category', 'chinese');
register_taxonomy_for_object_type('post_tag', 'chinese');

// End Post types



if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 85, 85, true );
}

// Get page by slug function

function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function my_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'my_excerpt_length');


    $lang = TEMPLATE_PATH . '/lang';
    load_theme_textdomain('carkod', $lang);



// Popular posts function, use echo popularPosts(10);

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// hook the translation filters, changes the names
add_filter(  'gettext',  'change_post_to_article'  );
add_filter(  'ngettext',  'change_post_to_article'  );

function change_post_to_article( $translated ) {
     $translated = str_ireplace(  'Post',  'Article',  $translated );  // ireplace is PHP5 only
     return $translated;
}


?>