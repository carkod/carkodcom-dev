<!-- Scripts -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/infinitescroll.js"></script>
<script type="text/javascript">
// Home toggle function


jQuery( document ).ready(function($) {
var documentHeight = $(document).height();
				var windowHeight = $(window).height();
				var sidebarHeight = $("#sidebar").height();
$("#sidebar").css({
					
					'min-height': windowHeight + 'px',
					
				});
// Infinite scroll

$('#article-latest').infinitescroll({
 	
    navSelector  : "div.pagination", // selector for the paged navigation (it will be hidden)
    nextSelector : "div.pagination a.next",  // selector for the NEXT link (to page 2)
    itemSelector : "#latest .entry" , // selector for all items you'll retrieve
	debug        : true,   // enable debug messaging ( to console.log )
	behavior: 'twitter',
	loading: {
    finishedMsg: "<?php _e('No more articles to load.') ?>",
    img: '<?php bloginfo('template_url'); ?>/images/ajax-loader.gif',
    msg: null,
    msgText: "",
    selector: null,
    speed: 'slow',
	localMode    : true,
	finished: function (){
		
		$('#sidebar').hcSticky('reinit');
		}
  },
  
  
  
 });
 

//kill scroll binding
    //setTimeout("jQuery('#next').slideDown();", 1000);
     //hook up the manual click guy.

 
$("#tab2").on("click", function() {
 	
    $('#article-research').infinitescroll({
 	
    navSelector  : "div.pagination", // selector for the paged navigation (it will be hidden)
    nextSelector : "div.pagination a.next",  // selector for the NEXT link (to page 2)
    itemSelector : "#research .entry" , // selector for all items you'll retrieve
	debug        : true,   // enable debug messaging ( to console.log )
	behavior: 'twitter',
	loading: {
    finishedMsg: "<?php _e('No more articles to load.') ?>",
    img: '<?php bloginfo('template_url'); ?>/images/ajax-loader.gif',
    msg: null,
    msgText: "",
    selector: null,
    speed: 'slow',
	finished: function (){
		
		$('#sidebar').hcSticky('reinit');
		}
  },

  });

});



// Sidebar accordion
		var sidebar = $("#sidebar") ;
		$("#sidebar li ul").not("#categories-list").hide();
		$("#sidebar a#topics-link").addClass("opened");
		$("#sidebar a.section").addClass("closed"); 
		$("#sidebar a.section").on("click", function(event) {
				event.preventDefault();
				var opened = $(this).next("ul")
				opened.slideToggle();		
				$(this).toggleClass('opened', opened.is(':visible')); 
    			$(this).toggleClass('closed', opened.is(':hidden')); 
				var documentHeight = $(document).height();
				var windowHeight = $(window).height();
				var sidebarHeight = $("#sidebar").height();
				if (windowHeight > sidebarHeight) {
				$("#sidebar").css({
					
					'min-height': windowHeight + 'px',
					
				});
				}
			});

// tabs for menu		
$('ul.menu-list').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('tabs-active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    // Bind the click event handler
    $(this).on('click', 'a', function(e){
      // Make the old tab inactive.
      $active.removeClass('tabs-active');
      $content.hide();

      // Update the variables with the new link and content
      $active = $(this);
      $content = $(this.hash);

      // Make the tab active.
      $active.addClass('tabs-active');
      $content.show();

      // Prevent the anchor's default click action
      e.preventDefault();
    });
  });


// tabs for menu2	

$('ul#menu2-list').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = $(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('tabs-active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
      $(this.hash).hide();
    });

    // Bind the click event handler
    $(this).on('click', 'a', function(e){
      // Make the old tab inactive.
      $active.removeClass('tabs-active');
      $content.hide();

      // Update the variables with the new link and content
      $active = $(this);
      $content = $(this.hash);

      // Make the tab active.
      $active.addClass('tabs-active');
      $content.show();

      // Prevent the anchor's default click action
      e.preventDefault();
    });
  });


// Sticky sidebar
if ($(window).width() > 1020) {
$('#sidebar').hcSticky({
    wrapperClassName: 'sidebar-sticky',
	responsive:true,
	stickTo:document,

});

} else { 



}

    });
	
</script>


<script src="http://cufon.shoqolate.com/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/fonts/cufonts.js" type="text/javascript"></script>
<script type="text/javascript">
Cufon.replace('.franklin-gothic-book', { fontFamily: 'Franklin Gothic Book', hover: true });
Cufon.replace('.franklin-gothic-book-italic', { fontFamily: 'Franklin Gothic Book Italic', hover: true });
</script>

<!-- Google analytics (copy from carkodesign) -->

<?php wp_footer(); ?>
</body>
</html>