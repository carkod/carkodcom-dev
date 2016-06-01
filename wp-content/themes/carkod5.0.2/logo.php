<script type="text/javascript" >
jQuery(document).ready(function(){
    var dialLines = document.getElementsByClassName('diallines');

for (var i = 1; i < 60; i++) {
   dialLines[i] = $(dialLines[i-1]).clone()
                                   .insertAfter($(dialLines[i-1]));
   $(dialLines[i]).css('transform', 'rotate(' + 6 * i + 'deg)');
}

function tick() {
   var date = new Date();
   var seconds = date.getSeconds();
   var minutes = date.getMinutes();
   var hours = date.getHours();
   var day = date.getDate();
   
   var secAngle = seconds * 6;
   var minAngle = minutes * 6 + seconds * (360/3600);
   var hourAngle = hours * 30 + minutes * (360/720);
   
   $('.sec-hand').css('transform', 'rotate(' + secAngle + 'deg)');
   $('.min-hand').css('transform', 'rotate(' + minAngle + 'deg)');
   $('.hour-hand').css('transform', 'rotate(' + hourAngle + 'deg)');
   $('.date').text(day);
}

setInterval(tick, 100);
});
</script>
<div id="header">
    <div id="dial">
      <div class="dot"></div>
      <div class="sec-hand"></div>
      <div class="sec-hand shadow"></div>
      <div class="min-hand"></div>
      <div class="min-hand shadow"></div>
      <div class="hour-hand"></div>
      <div class="hour-hand shadow"></div>
      <span class="twelve">12</span>
      <span class="three">3</span>
      <span class="six">6</span>
      <span class="nine">9</span>
      <span class="diallines"></span>
      <div class="date"></div>
   </div>

    <h1 id="site-title" class="title-home"><a href="<?php bloginfo('url') ?>" title="Go to Homepage"><?php bloginfo('name') ?></a></h1>
    <h2 id="site-description" class="title-home"><?php bloginfo('description') ?></h2>

</div>
