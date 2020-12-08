---
title: 500 Internal Server Error
taxonomy:
    category: docs
---

> The server encountered an internal error or misconfiguration and was unable to complete your request.
>
> Please contact the server administrator at webmaster@localhost to inform them of the time this error occurred, and the actions you performed just before this error.
>
> More information about this error may be available in the server error log.
> <cite>Apache/2.4.7 Server at localhost Port 80</cite>

This error can be triggered by the following:

- server misconfiguration (httpd.conf)
- .htaccess issues
- mod_security or similar

### Test PHP is Working

The first thing you should do is ensure PHP is working properly on your server, and Grav is not the direct cause of the issue.  To test this simply create a temporary file (remove it afterwards for security!) in the root of your Grav folder called `info.php`.  This file should have the following PHP code:

[prism classes="language-php line-numbers"]
<?php phpinfo();
[/prism]

Then point your browser at this file: `http://yoursite.com/your_grav_directory/info.php`.  You should get a report page listing all the information related to the PHP configuration including version and extensions loaded.

### Check permissions

A 500 error can be triggered by having the wrong permissions. Check [the permissions guide](/troubleshooting/permissions)

### Register Globals Issue

Some people who have recently upgraded to PHP 5.5 from version 5.4 or 5.3, may still have some out of date settings in their `php.ini` file.  One item that can cause a **500 Internal Server Error** is the `register_globals` setting.  Simply remove or comment out the line:

[prism classes="language-apacheconf line-numbers"]
register_global = On
[/prism]

Then restart your Apache server.

### ThreadStackSize on Windows

If your server is running on Windows, you could be getting a 500 Internal Server Error due to the fact that the **ThreadStackSize** is much too small.  Simply append this code to the bottom of your `httpd.conf` file:

[prism classes="language-apacheconf line-numbers"]
<IfModule mpm_winnt_module>
  ThreadStackSize 8388608
</IfModule>
[/prism]

Then restart your Apache server.

### Options -Indexes

Grav uses a `-Indexes` option to force no directory listings of folders. Some hosts do not like Apache `.htaccess` manipulating the `Options` setting.

We have seen reports that simply commenting out this line in Grav's `.htaccess` file can fix the Internal Server error problems for users in this situation:

[prism classes="language-apacheconf line-numbers"]
# Prevent file browsing
#Options -Indexes
[/prism]

### RewriteBase problems

Have had some reports of 500 Internal Server Errors without setting the RewriteBase, on 1&1 hosting (but can apply to others too). Try changing

[prism classes="language-apacheconf line-numbers"]
# RewriteBase /
[/prism]

to

[prism classes="language-apacheconf line-numbers"]
RewriteBase /
[/prism]

(Credit: [http://ahcox.com/webdev/1and1-internal-server-error-grav/](http://ahcox.com/webdev/1and1-internal-server-error-grav/))

### Admin Panel Navigation

When navigating through Grav's admin panel, **Internal Server Error** message appears in the top left.  This is due to incorrect permissions on your /cache folder.

 ![Internal Server Error](http://i.imgur.com/vyPfoZ7.png)

If this error is popping up the chances are you haven't set the correct permission on the /cache folder, rather than just making the folder writable you need to make it recursively writable.  Running the below command from within your Grav directory should sort out the problem.

[prism classes="language-bash command-line"]
sudo chmod 755 cache/ -R
[/prism]

