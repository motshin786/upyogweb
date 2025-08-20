=== Elegant Visitor Counter ===
* Contributors: [@regolithsjk](https://profiles.wordpress.org/regolithsjk)
* Description: This plugin is for counting visitors of a website.
* Author: [Sujan Karki](http://sujankarki.info.np)
* Author URI: [http://sujankarki.info.np/](http://sujankarki.info.np/)
* Requires up to: 4
* Tested up to: 6.2.2
* Stable tag: 3.1.1
* Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FQDCNX4B8TR8S&source=url
* License: GNU General Public License v2.0
* License URI: [http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html)

== Description ==

This plugin gets visitors ip address and records the visited address and counts the visitor on daily, day before, week, month and total. It also gets visitors ip and set post view count.

Major features in Elegant Visitor Counter include:
* Use widget area to display visitor counters.
* Display raw visitors number using shortcode, eg. `[visitor-counter visitor="all"]`. Arguments: `all`, `visitors_today`, `visitors_yesterday`, `visitors_this_week`, `visitors_this_month`, `total`.
* Display post view count, use shortcode `[post-counter]` inside post loop.

== Installation ==

1. Upload `elegant-visitor-counter` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit Appreance -> Widgets in  the admin panel and place the widget where you want.

== Screenshots ==

1. Frontend display of visitor counter.
2. Widget showing visitor counter with what to display in frontend.

Visit [WordPress.org for a comprehensive guide](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) on in how to install WordPress plugins.

== Changelog ==

= 2.0.0 =
* Added shortcode support `[visitor-counter visitor="visitors_this_week"]`, returns visitors number depending on arguments. Arguments to be used `visitors_today`, `visitors_yesterday`, `visitors_this_week`, `visitors_this_month`, `total`.

= 3.0.0 = 
* Added post views count. Use shortcode `[post-counter]` inside post loop to get the post count.

= 3.0.1 = 
* Added display of total post view count in backend listing of posts and post types.

= 3.1 = 
* Added settings page where background color and text color of total count can be changed with alignment.

= 3.1.1 = 
* Setting page redesign.