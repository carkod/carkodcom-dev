<div id="footer">
<p><?php _e('Design and edition by Carkod. This website has <strong>NOT</strong> been optimized for old browser (Internet Explorer 7 or earlier) neither for resolutions lower than 1024 x 768. You can freely use the content of this website for non-commercial purposes.&nbsp;') ; echo 'Carkod.com 2008-'; the_time('Y'); echo'.'; $contact = get_ID_by_slug('contact'); $contacturl = get_permalink($contact) ;  _e('&nbsp;Please <a href='.$contacturl.' >report</a> any bugs you may find.'); ?></p>
</div>
