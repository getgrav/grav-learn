---
title: Common Problems
taxonomy:
    category: docs
---

Here you can find information on problems and issues raised on [Grav forum](http://getgrav.org/forum) and in the [Slack Chat room](https://chat.getgrav.org) that occur frequently enough that we thought we would save time and list the problem and the relevant solution in one easy to find location.

1. [Cannot connect to the GPM](#cannot-connect-to-the-gpm)
2. [Invalid Security Token](#invalid-security-token)
3. [Admin Interface won't scroll](#admin-interface-wont-scroll)
4. [Fetch failed](#fetch-failed)

### Cannot connect to the GPM

**Problem:** The GPM cannot be reached, and you get this error in the Admin panel

**Solution:**

First, make sure PHP has cURL and OpenSSL installed. You can check this in the Admin panel, in Configuration -> Info. You should see a "OpenSSL" section with `OpenSSL support: enabled`. Same for cURL, a section with `cURL support: enabled`.

If this is ok, make sure you're not behind a proxy. If so, [configure it](/basics/grav-configuration#system-configuration) in the Grav System configuration and [make sure there are no issues with the connection](/troubleshooting/proxy).

Then, [check your permissions](/troubleshooting/permissions).

If after all the above you are still getting issues connecting with GPM, we have noticed that on some servers (mostly local machines running Windows), there are issues verifying the SSL certificate of getgrav.org, even though it is [A Rating](https://www.ssllabs.com/ssltest/analyze.html?d=getgrav.org&hideResults=on).
To work around this problem, we have added a new system config `system.gpm.verify_peer` that is enabled by default. Set it to false and try again.

If at this point it's still not working, get in touch, or report back if you were pointed here via chat/forum.

Also, check the CLI command is working, by opening a SSH connection to the server and running `bin/gpm index` and check if it's just inside Admin that you get this error, or in the command line too.

### "Invalid security token"

**Problem:** You get this error in the Admin panel

**Solution:**

There are a few possible causes of the problem, all linked to the Session.

- Try clearing your browser cookies, that's the easiest way and clears a possible cause of the problem.
- Check that PHP has the correct tmp path set up. This can be set in PHP directly, or by setting Grav's `system.yaml` `session.path` setting (it can be also set via Admin, in the System Configuration) [Reported issue](https://github.com/getgrav/grav-plugin-admin/issues/958)
- Make sure your web server config is right and includes the query string [Reported issue](https://github.com/getgrav/grav-plugin-admin/issues/893)

### Admin Interface won't scroll

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

### Fetch failed

Inside Admin sometimes a "Fetch Failed" red popup might appear. If it happens once in a while, do not worry as it might simply mean a connection issue.

But if it shows up every time, an issue some users run into is `mod_security` blocking Grav's network requests.

This can be solved by finding and disabling the rules that are raised, which depending on the configuration of mod_security, might be different from case to case.

If you are running your own server, a guide on how to do this can be found in [http://www.inmotionhosting.com/support/website/modsecurity/find-and-disable-specific-modsecurity-rules](http://www.inmotionhosting.com/support/website/modsecurity/find-and-disable-specific-modsecurity-rules), otherwise just contact your hosting provider and illustrate the problem.

Related issue: [admin#951](https://github.com/getgrav/grav-plugin-admin/issues/951)