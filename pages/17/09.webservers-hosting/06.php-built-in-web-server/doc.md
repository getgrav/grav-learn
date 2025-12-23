# Test Hosting with the PHP Built-in Web Server

The PHP command line (CLI SAPI) has a built-in Web server that is useful for quick Grav site testing or demos. It is *not* a full-featured Web server and should not be used on a public network.

## Using the CLI Web Server

1. On the command line, navigate to the [GRAV_ROOT] folder.
2. Run `php -S localhost:8080 system/router.php` to start the server. You should see a response like the one below. 

		php -S localhost:8080 system/router.php
		PHP 7.3.27 Development Server started at Thu Jun 17 09:24:46 2021
		Listening on http://localhost:8080
		Document root is /Users/somerandom/Desktop/quick-grav-test
		Press Ctrl-C to quit.

3. Browse to the URL specified, e.g., `http://localhost:8080/`. 
4. To stop the Web server, press Ctrl-C.

### Address Already in Use Error

If you get an "Address already in use" error when executing the `php -S` command, there is already a Web server running on your machine at the specified port number (e.g., `:8080`). You can resolve this by changing the port number in your command (e.g., `:8181`) and trying again.

## Real-Time Log Display

The CLI Web server displays its log in real-time as you browse the site, which can be helpful for quick testing.

````
PHP 7.3.27 Development Server started at Thu Jun 17 09:24:46 2021
Listening on http://localhost:8080
Document root is /Users/somerandom/Desktop/quick-grav-test
Press Ctrl-C to quit.
[Thu Jun 17 09:26:15 2021] 127.0.0.1:63965 [200]: /
[Thu Jun 17 09:26:15 2021] 127.0.0.1:64007 [200]: /assets/fd2c5827e1f18bb54d20265f4fc56b59.css?g-74e4c5a3
[Thu Jun 17 09:26:15 2021] 127.0.0.1:64008 [200]: /assets/d87a2d24fae663a8c55e144c963a1915.js?g-74e4c5a3
[Thu Jun 17 09:26:15 2021] 127.0.0.1:64014 [200]: /assets/1d8c5ea92966046d4649472f1630a253.js?g-74e4c5a3
[Thu Jun 17 09:26:16 2021] 127.0.0.1:64024 [200]: /user/images/navigation/logo_small.png
[Thu Jun 17 09:26:16 2021] 127.0.0.1:64028 [200]: /user/images/navigation/bgdark.svg
[Thu Jun 17 09:26:16 2021] 127.0.0.1:64030 [200]: /user/images/navigation/bglight_50.png
[Thu Jun 17 09:26:16 2021] 127.0.0.1:64032 [200]: /user/images/navigation/brand.svg
````

## Learn More

Visit the PHP Web site to learn more about the [CLI Web server](https://www.php.net/manual/en/features.commandline.webserver.php?target=_blank).
