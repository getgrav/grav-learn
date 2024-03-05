---
title: Grav Built-in Web Server
taxonomy:
    category: docs
---

For the fastest way to get Grav up and running, you can run Grav using a simple command from Terminal / Command Prompt using the built-in PHP server available as long as you have PHP installed.

All you need to do is navigate to the root of your Grav install using the Terminal or Command Prompt and enter `bin/grav server`.

!! While technically all you need is PHP installed, if you install the [Symfony CLI application](https://symfony.com/download) the server will provide an SSL certificate so you can use `https://` and make use of PHP-FPM for better performance.

Entering this command will present you with output similar to the following:

[prism classes="language-bash command-line" cl-output="2-100"]
➜ bin/grav server

Grav Web Server
===============

Tailing Web Server log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3.log)
Tailing PHP-FPM log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3/53fb8ec204547646acb3461995e4da5a54cc7575.log)
Tailing PHP-FPM log file (/Users/joeblow/.symfony/log/96e710135f52930318e745e901e4010d0907cec3/53fb8ec204547646acb3461995e4da5a54cc7575.log)

[OK] Web server listening
The Web server is using PHP FPM 8.0.8
https://127.0.0.1:8000


[Web Server ] Jul 30 14:54:53 |DEBUG  | PHP    Reloading PHP versions
[Web Server ] Jul 30 14:54:54 |DEBUG  | PHP    Using PHP version 8.0.8 (from default version in $PATH)
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    fpm is running, pid 64992
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    ready to handle connections
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    fpm is running, pid 64992
[PHP-FPM    ] Jul  6 14:40:17 |NOTICE | FPM    ready to handle connections
[Web Server ] Jul 30 14:54:54 |INFO   | PHP    listening path="/usr/local/Cellar/php/8.0.8_2/sbin/php-fpm" php="8.0.8" port=65140
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    fpm is running, pid 73709
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    ready to handle connections
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    fpm is running, pid 73709
[PHP-FPM    ] Jul 30 14:54:54 |NOTICE | FPM    ready to handle connections
[/prism]

Your terminal will also give you real-time updates of any activity on this ad hoc-style server. You can copy the URL provided in the `[OK] Web server listening` line and paste that into your browser of choice to access your site, including the administrator.

```
https://127.0.0.1:8000
```

!!!! This is a useful tool for quick development, and should **not** be used in place of a dedicated web server such as Apache or Nginx.
