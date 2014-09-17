---
title: Internal Server Error
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

```
<?php phpinfo();
```

Then point your browser at this file: `http://yoursite.com/your_grav_directory/info.php`.  You should get a report page listing all the information related to the PHP configuration including version and extensions loaded.

### Register Globals Issue

Some people who have recently upgraded to PHP 5.4 from version 5.3 may still have some out of date settings in their `php.ini` file.  One item that can cause a **500 Internal Server Error** is the `register_globals` setting.  Simply remove or comment out the line:

```
register_global = On
```

Then restart your Apache server.

### ThreadStackSize on Windows

If your server is running on Windows, you could be getting a 500 Internal Server Error due to the fact that the **ThreadStackSize** is much too small.  Simply append this code to the bottom of your `httpd.conf` file:

```
<IfModule mpm_winnt_module>
  ThreadStackSize 8388608
</IfModule>
```

Then restart your Apache server.
