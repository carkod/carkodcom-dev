=== References ===
Contributors: shra
Tags: reference, node reference, post connections 
Requires at least: 3.0
Tested up to: 4.5
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Enables post references (for any type of publications) to connect articles to each other.

== Description ==

This plugin will let you manage the post references. It is like "node reference" in Drupal CMS module functionality. 

Use Reference Settings page to configure publications connections. 

After configuring step you will see additional metabox(s) on post editor page. Now you can choose articles of referenced post types to attach it to article you edit.

Plugin stores connected article list to post metas. For template you can use, for example, get_post_meta($post->ID, '_ref_ID', true) to receive that list. As 'ref_ID' you should use a meta key configured on Referenced settings page earlier.

Plugin allow you to configure widgets to view the list(s) of attached articles. 

== Installation ==

Best is to install directly from WordPress. If manual installation is required, please make sure that the plugin files are in a folder named "references", usually "wp-content/plugins".

== Changelog ==

= 1.0 =
Includes an admin page with plugin setting and Widgets.

== Screenshots ==

1. Install References plugin.
2. The References settings page.
3. Build article connections.
4. Configure widget(s).
5. Created widget view.
