=== Weebly Importer Lite ===
Contributors: geca
Tags: blog, bulk, convert, crawl, data, export, import, importer, migrate, move, posts, weebly, weeblyrss
Requires at least: 3.9
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later

Imports posts from a Weebly blog to your WP site.

== Description ==

This plugin lets you move your blog from Weebly to WordPress. It crawls your Weebly blog and copies your posts on Weebly to your WordPress site. If you also need to move comments and tags (categories), use my [premium plugin](http://codecanyon.net/item/weebly-to-wordpress-import-plugin/7751174 "premium Weebly to WordPress migration plugin"). In any case - make sure to install and run [Import External Images plugin](https://wordpress.org/plugins/import-external-images "Import External Images plugin") after you're done with moving your blog data to get your images from Weebly's server to your own.

If you're on a restrictive shared hosting environment (such as DreamHost or BlueHost), there is a possibility the import process gets terminated and you won't get all of your data. If this happens, try generating RSS feed for your blog using my free [Weebly blog RSS generator web app](http://weeblyrss.appspot.com "Move Weebly blog to WordPress") and importing it via 'Tools', 'Import', 'RSS' in your WP dashboard.

== Installation ==

1. Upload the `weebly-importer-lite` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= How to use =

1. Weebly Importer is available from the WordPress 'Tools'->'Import' screen.
2. Enable 'Archives' section on your Weebly blog if necessary: look under 'Blog sidebar' on Weebly's site builder and
   drag'n'drop 'Blog archives' component on your blog.
3. Press 'Import' button to start importing
4. You can monitor import progress under 'Progress report'

You can remove the importer plugin if you no longer need to use it.