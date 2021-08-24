=== SEO Redirection Plugin - 301 Redirect Manager ===
Contributors: fakhris
Donate link: http://www.clogica.com/donations.htm
Tags: post, admin, seo, pages, manage, 301, 404, soft 404, redirect, permalink, redirection, redirection, https, automatic redirection, htaccess, ssl, https redirection, ssl certificate, secure page, secure, force ssl, force https, seo redirection, post redirect, 404 to 301
Requires at least: 4.1
Tested up to: 5.6
Stable tag: trunk

SEO Redirection is a powerful redirect manager to manage 301 redirects without requiring knowledge of Apache .htaccess files.

== Description ==

SEO Redirection is a powerful redirect manager to manage 301 redirects, you can build and manage redirects easily for your site,
This plugin is useful if you want to migrating pages from an old website, or are changing the directory of your WordPress website.


New features include:

* Manually add 301, 302, and 307 redirections for a WordPress post
* Supports wild card redirection.
* Fix Crawl Errors (404 & soft 404) in Google Search Console(New)
* WPML Support (WordPress Multi-language integration) (New)
* Import/Export feature (New)
* Adding the last access time & total hits to the redirects list (New)
* Automatically add a 301 redirection when a post’s URL changes
* Redirect posts and pages that published, draft or deleted from it\'s edit page directly.
* Advanced control panel to control all functions of the plugin.
* You can redirect folders and all it's content.
* Full logs for all redirected URLs
* You can use regular expressions in redirections.
* Reflect changes to all links when you move your site or change the domain name.
* All URLs can be redirected, not just ones that  don't exist
* Redirection methods - redirect based upon login status, redirect to random pages, redirect based upon the referrer!
* Friendly GUI and easy to use.
* Apache .htaccess is not required, works entirely inside WordPress
* Redirect index.php, index.html, and index.htm access
* Redirection statistics telling you how many times a redirection has occurred, when it last happened, who tried to do it, and where they found your URL
* (GDPR compliance) You can customise the level of IP information that is collected by our plugin
* You can also import from the "Redirection" Plugin (NEW)

== Screenshots ==
1. Redirection Box in edit page for posts and pages.
2. List of custom redirections.
3. Page to Page custom redirection.
4. Folders custom redirection.
5. Regular Expression custom redirection.
6. Redirected posts via the Redirection Box.
7. All redirections history.
8. Control panel options.


== Installation ==

The plugin is simple to install:

1. Download `seo-redirection.zip`
1. Unzip the file
1. Upload `seo-redirection` directory to your `/wp-content/plugins` directory
1. Go to the plugin management page and enable the plugin
1. Configure the options from the `Settings/SEO Redirection` page

You can find full details of installing a plugin on the [plugin installation page](http://goo.gl/nf3WcU).


== Frequently Asked Questions ==

= Why would I want to use this instead of .htaccess? =

Redirections are automatically created when a post URL changed. Apache .htaccess is not required

= Is there a manual or knowledge base for this plugin? =

Yes, here is the plugin full knowledge base http://www.clogica.com/kb/

== Upgrade Notice ==

= 6.3 =
* Bugs fixed
* Can delete 404 log

= 6.2 =
* bug fixing in redirection log


= 6.1 =
* adding new tab for 404 history
* adding more options in the options tab (404 options)


= 5.3 =
* Bug fixing in redirect hits and last access


= 5.2 =
* Bug fixing import redirects from Redirection Plugin


= 5.1 =
* Bug fixing in forms


= 5 =

* new features (sorting, deleting records)
* The ability to import data from the "Redirection Plugin"


= 4.17 =
* Bug fixing in http redirects

= 4.16 =
* fixing (is_plugin_active issue)

= 4.15 =
* fixing buddypress issue (redirects was not working for locked pages)
* Fixing WPML issues (the plugin was not fully compatible with the last WPML version)
* Some other enhancements

= 4.14 =
* Adding option in the general options page for IP address GDPR Compatibility

= 4.13 =
* GDPR Compatibility

= 4.12 =
* fix export redirects issue

= 4.11 =
* fix Undefined index

= 4.10 =
* fix deprecated issue in php 7

= 4.9 =
* Import/Export Feature
* New interface design 
* Show last access time & total hits


= 4.8 =
* Hot fixes

= 4.7 =
* Absolute URL's fixes

= 4.5 =
* Hot fixes


= 4.4 =
* php 7 compatibility

= 4.3 =
* Stored XSS fixes

= 4.2 =
* Hot fixes
* php 7 compatibility

= 4.1 =
* Removing "404" tab, We replaced it by a new advanced 404 management plugin. Have a look on this by following this link https://wordpress.org/plugins/404-redirection-manager/

= 4.0 =
* Please backup your data before using this version.



== Changelog ==

= 6.3 =
* Bugs fixed
* Can delete 404 log

= 6.2 =
* bug fixed in redirection log

= 6.1 =
* adding new tab for 404 history
* adding more options in the options tab (404 options)

= 5.3 =
* Bug fixed in redirect hits and last access

= 5.2 =
* Bug fixed import redirects from Redirection Plugin



= 5.1 =
* Bug fixed in forms


= 5 =

* new features (sorting, deleting records)
* The ability to import data from the "Redirection Plugin"

= 4.17 =
* Bug fixed in http redirects

= 4.16 =
* fixed (is_plugin_active issue)

= 4.15 =
* fixing buddypress issue (redirects was not working for locked pages)
* Some other enhancements


= 4.14 =
* Adding option in the general options page for IP address GDPR Compatibility

= 4.13 =
* GDPR Compatibility

= 4.12 =
* fixing export redirects issue

= 4.11 =
* fixing Undefined index error

= 4.10 =
* fix deprecated issue in php 7

= 4.9 =
* WPML support
* Import/Export Feature
* New interface design 
* Show last access time & total hits

= 4.8 =
* display total 404 count

= 4.7 =
* php 7 compatibility

= 4.3 =
* Stored XSS fixes

= 4.2 =
* Hot fixes
* php 7 compatibility

= 4.1 =
* Removing "404" tab, We replaced it by a new advanced 404 management plugin. Have a look on this by following this link https://wordpress.org/plugins/404-redirection-manager/

= 4.0 =
* Please backup your data before using this version.

= 3.9 =
* Fixing some issues.
= 3.8 =
* Added feature, the capability to disable plugin for admin users
= 3.7 =
* Hot fixes
= 3.6 =
* Fixing some issues.
= 3.5 =
* Fixing some issues.
= 3.4 =
* Fixing error appears when deleting the plugin.
= 3.3 =
* Hot fixes
= 3.2 =
* Hot fixes
= 3.1 =
* Redirect loops protection
= 3 =
* Hot fixes
= 2.9 =
* Hot fixes for redirecting woo-commerce products.
= 2.8 =
* Redirect loop prevention.
* The Ad for the premium version has become in a separate tab not in all the plugin screens as it may disturb some people.
* Some other fixes.
= 2.7 =
* Some fixes.
= 2.6 =
* Some hot fixes.
= 2.5 =
* Using relative URLs instead of absolute URL's, This will useful when changing the domain name.
