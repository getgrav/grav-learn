---
title: Common Problems
page-toc:
  active: true
  depth: 1
taxonomy:
    category: docs
---

Here you can find information on problems and issues raised on [Grav forum](https://getgrav.org/forum) and in the [Discord Chat server](https://chat.getgrav.org) that occur frequently enough that we thought we would save time and list the problem and the relevant solution in one easy to find location.

## Cannot connect to the GPM

**Problem:** The GPM cannot be reached, and you get this error in the Admin panel

**Solution:**

First, make sure PHP has cURL and OpenSSL installed. You can check this in the Admin panel, in Configuration -> Info. You should see a "OpenSSL" section with `OpenSSL support: enabled`. Same for cURL, a section with `cURL support: enabled`.

If this is ok, make sure you're not behind a proxy. If so, [configure it](/basics/grav-configuration#system-configuration) in the Grav System configuration and [make sure there are no issues with the connection](/troubleshooting/proxy).

Then, [check your permissions](/troubleshooting/permissions).

If after all the above you are still getting issues connecting with GPM, we have noticed that on some servers (mostly local machines running Windows), there are issues verifying the SSL certificate of getgrav.org, even though it is [A Rating](https://www.ssllabs.com/ssltest/analyze.html?d=getgrav.org&hideResults=on).
To work around this problem, we have added a new system config `system.gpm.verify_peer` that is enabled by default. Set it to false and try again.

If at this point it's still not working, get in touch, or report back if you were pointed here via chat/forum.

Also, check the CLI command is working, by opening a SSH connection to the server and running `bin/gpm index` and check if it's just inside Admin that you get this error, or in the command line too.

## Admin Interface won't scroll

**Problem:** When accessing the Admin-plugin's interface, the page will not scroll

**Solution:** There are several reported causes of this, but the most common solutions are the following.

- Hard-reload the page by clearing your browser's cache and then refreshing.
- Make sure you are using the newest version of Grav, and switch to the default language - English. If this solves the scrolling issue, please report the faulty language [as an issue](https://github.com/getgrav/grav-plugin-admin/issues/).
- If you are using CloudFlare for HTTPS or as a CDN, their JS-optimization - which is enabled by default - can block scripts from rendering. To disable this, log in to CloudFlare and select the relevant domain, then do one of the following:
    1. To disable this optimization entirely, navigate to "Speed" and scroll down to "Rocket Loader".
        - Set this to "Off" and CloudFlare will not block the script, but you will also not benefit from their optimization.
    2. To only disable the optimization for Grav's Admin interface, navigate to "Page Rules" and click the "Create Page Rule"-button.
        - For "If the URL matches" field, fill in your domain name, followed by `/admin`, for example: `example.com/admin`.
        - Click "Add a Setting", and in the dropdown find "Rocket Loader". When selected, change the value in "Select Value" to **off**.
        - Leave the "Order"-field as is, by default it is set to **First**.
        - Finally, click the "Save and Deploy"-button

If none of the above work, please check your browser's console for any reported JavaScript errors; In Chrome or Firefox either press F12 or Ctrl+Shift+I, then click the "Console"-tab. Report the errors [as an issue](https://github.com/getgrav/grav-plugin-admin/issues/).

## Fetch failed

Inside Admin sometimes a "Fetch Failed" red popup might appear. If it happens once in a while, do not worry as it might simply mean a connection issue.

But if it shows up every time, an issue some users run into is `mod_security` blocking Grav's network requests.

This can be solved by finding and disabling the rules that are raised, which depending on the configuration of mod_security, might be different from case to case.

If you are running your own server, a guide on how to do this can be found in [http://www.inmotionhosting.com/support/website/modsecurity/find-and-disable-specific-modsecurity-rules](http://www.inmotionhosting.com/support/website/modsecurity/find-and-disable-specific-modsecurity-rules), otherwise just contact your hosting provider and illustrate the problem.

Related issue: [admin#951](https://github.com/getgrav/grav-plugin-admin/issues/951)

## Zend OPcache API is restricted

If you are running PHP with Zend OPache and you receive this error, then your current OPCache configuration is [limiting access to OPcache API function to scripts only from a specified string](https://php.net/manual/en/opcache.configuration.php). The simplest solution to this is to find the location of this directive either in your `php.ini` file or in a specialized `opcache.ini` file that is being pulled in to your overall `php.ini` file and set this value to nothing:

[prism classes="language-apacheconf line-numbers"]
opcache.restrict_api=
[/prism]

This is an issue with any [ServerPilot](https://serverpilot.io) managed hosting with PHP 7.2 enabled.  A ticket has been submitted to resolve this on their end.

## LinkedIn Sharing and Wayback Machine Indexing Not Working

**Problem:** Sharing pages with LinkedIn and having the page's data propagate is not working. The Wayback Machine is not properly indexing my website's pages.

**Solution:** Enable WebServer Gzip or Gzip compression. Both may be used, but at least one needs to be active for these particular functions to work on some server cases.

This [issue](https://github.com/getgrav/grav/issues/1639) has popped up for users on specific server environments. In particular, with AWS cloud-based servers, users were experiencing issues sharing web pages from their Grav sites on LinkedIn or having them properly indexed by the Wayback Machine. This problem was resolved by turning on either WebServer Gzip or Gzip compression.

## Cannot Scroll in Admin on CloudFlare

For CloudFlare users, the ability to scroll in the Admin can be interrupted. There are solutions to this, as follows:

In CloudFlare's interface, go to **Speed** and disable **Rocket Loader** (or through a page-rule).

It can also be disabled in the (default) 'automatic' mode with a **data-attribute** on scripts: `<script data-cfasync="false" src="/javascript.js"></script>`.

An example of a page-rule would be the URL match `example.com/staging/*/admin`, where the `*` is a wildcard indicating any folder-name. For settings, add `Rocket Loader` and select **Off**.
