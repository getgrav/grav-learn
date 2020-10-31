---
title: 404 Not Found
taxonomy:
    category: docs
---

There are a couple of reasons you might receive a **Not Found** error, and they are each caused by different factors.

![404 Not Found](404-not-found.png?classes=shadow)

!! The examples below are for the Apache Web Server which is the most common server software used.

### IIS use of .htaccess file
After adding URL Rewrite to the IIS server using the Web Platform Installer, restart the IIS server. Go to the management interface, IIS, double-click on URL Rewrite, under Inbound Rules, click on Import Rules, under Rules to Import, browse to the Configuration file, choosing the .htaccess file in the root, and then click on Import. Restart the IIS server. Access Grav now.

### Missing .htaccess File

The first thing to check is if you have the provided `.htaccess` file at the root of your Grav installation. Because this is a **hidden** file, you won't normally see this in your explorer or finder windows.  If you have extracted Grav then **selected** and **moved** or **copied** the files, you may well have left this very important file behind.

It is **strongly advised** to unzip Grav and move the **entire folder** into place, then simply rename the folder. This will ensure all the files retain their proper positions.

### AllowOverride All

In order for the Grav-provided `.htaccess` to be able to set the rewrite rules required for routing to work properly, Apache needs to first read the file.  When your `<Directory>` or `<VirtualHost>` directive is setup with `AllowOverride None`, the `.htaccess` file is completely ignored.  The simplest solution is to change this to `AllowOverride All`
where RewriteRule is used, **FollowSymLinks** or **SymLinksIfOwnerMatch** needs to be set in Options directive. Simply add on the same line '+FollowSymlinks' after 'Options'

More details on `AllowOverride` and all the possible configuration options can be found in the [Apache Documentation](http://httpd.apache.org/docs/2.4/mod/core.html#allowoverride).

### RewriteBase Issue

If the homepage of your Grav site loads, but **any other page** displays this very rough _Apache-style_ error, then the most likely cause is that there is a problem with your `.htaccess` file.

The default `.htaccess` that comes bundled with Grav works fine out-of-the-box in most cases.  However, there are certain setups involving virtual hosts where the file system does not match the virtual hosting setup directly.  In these cases you must configure the `RewriteBase` option in the `.htaccess` to point to the correct path.

There is a short explanation of this in the `.htaccess` file itself:

[prism classes="language-apacheconf line-numbers"]
##
# If you are getting 404 errors on subpages, you may have to uncomment the RewriteBase entry
# You should change the '/' to your appropriate subfolder. For example if you have
# your Grav install at the root of your site '/' should work, else it might be something
# along the lines of: RewriteBase /<your_sub_folder>
##

# RewriteBase /
[/prism]

Simply remove the `#` before the `RewriteBase /` directive to uncomment it, and adjust the path to match your server environment.

We've included additional information to help you locate and troubleshoot your `.htaccess` file in our [htaccess guide](../htaccess).

### Missing Rewrite Modules

Some webserver packages (I'm looking at your EasyPHP and WAMP!) do not come with the Apache **rewrite** module enabled by default. They usually can be enabled from the configuration settings for Apache, or you can do so manually via the `httpd.conf` by uncommenting this line (or something similar) so they are loaded by Apache:

[prism classes="language-apacheconf"]
#LoadModule rewrite_module modules/mod_rewrite.so
[/prism]

Then restart your Apache server.

### .htaccess Test Script

To help isolate `.htaccess` and **rewrite** issues, you can download this [htaccess_tester.php](https://gist.githubusercontent.com/rhukster/a727fb70d9341536d49980d1239bd97e/raw/a3078da16b894ba86f9d000bcfc4850e098199fc/htaccess_tester.php) file, and drop it in your Grav root directory.

Then point your browser to `http://yoursite.com/htaccess_tester.php`.  You should get a successful message and a copy of the Grav `.htaccess` file displayed.

![](htaccess_tester.png?classes=shadow)

Next you can test if rewrites are working by backing up the existing .htaccess file:

[prism classes="language-bash command-line"]
mv .htaccess .htaccess-backup
[/prism]

And then try this simple `.htaccess` file:

[prism classes="language-apacheconf line-numbers"]
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^.*$ htaccess_tester.php
</IfModule>
[/prism]

Then try this URL: `http://yoursite.com/test`.  Actually any path you use should display a success message telling you that `mod_rewrite` is working.

After you have finished testing, you should delete the test file and restore your `.htaccess` file:

[prism classes="language-bash command-line"]
rm htaccess_tester.php
mv .htaccess-backup .htaccess
[/prism]

### Grav Error 404 Page

![404 Not Found](error-404.png?classes=shadow)

If you receive a _Grav-style_ error saying **Error 404** then your `.htaccess` is functioning correctly, but you're trying to reach a page that Grav cannot find.

The most common cause of this is simply that the page has been moved or renamed. Another thing to check is if the page has a `slug` set in the page YAML headers. This overrides the explicit folder name that is used by default to construct the URL.

Another cause could be your page is **not routable**. The routable option for a page can be set in the [page headers](../../content/headers).

### 404 Page Not Found on Nginx

If your site is in a subfolder, make sure your nginx.conf location points to that subfolder. Grav's [sample nginx.conf](https://github.com/getgrav/grav/blob/master/webserver-configs/nginx.conf) has a comment in the code that explains how.

