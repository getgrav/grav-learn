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

- server misconfiguration
- .htaccess issues
- mod_security

You may be able to solve htaccess issues by adding `RewriteBase /` in the **.htaccess** file in the root Grav folder. Grav comes with its own preset .htaccess file included in the zip file.
