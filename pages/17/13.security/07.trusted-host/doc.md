---
title: Trusted Host for Email Links
taxonomy:
    category: docs
description: Why Grav warns that no trusted host is configured for password reset and activation emails, and how to fix it on any web server.
---
# Trusted Host for Email Links

If you have seen a warning in the admin that reads something like:

> Email links are not yet pinned to a trusted host.

this page explains what it means, why it matters, and the one small setting you need to change to clear it. It is a hardening recommendation, not a sign that your site has been broken into.

## What the warning means

When Grav sends a **password reset**, **account activation**, or **magic-login** email, it has to put a full web address in the link, for example `https://www.example.com/reset/...`. To build that address, Grav needs to know your site's host name (`www.example.com`).

If you have not told Grav what your host name is, it falls back to reading the `Host` header from the incoming web request. That header is sent by the visitor's browser, and a malicious visitor can change it to anything they like.

So if an attacker requests a password reset for one of your users and sends a forged `Host` header, the reset link in the email could be built to point at a look-alike phishing site instead of yours. If your user clicks it and the attacker captures the one-time token, the attacker can take over the account. This is tracked as [GHSA-46jp-rc59-w2gc](https://github.com/getgrav/grav-plugin-login/security/advisories).

The warning simply means: **you have not yet pinned these email links to a host you trust, so Grav is using the request host as a fallback.**

## The fix

Tell Grav which host to use. You only need **one** of the two options below. Setting either one pins every security email link to that host and clears the warning.

### Option 1: Custom Base URL (recommended)

This is the broadest fix. It sets a trusted base address for the whole site, not just for emails, so it also makes other absolute links consistent.

In the admin, go to **Configuration → System → Advanced → Custom Base URL** and enter your full site address, for example:

```
https://www.example.com
```

Or set it directly in `user/config/system.yaml`:

```yaml
custom_base_url: 'https://www.example.com'
```

### Option 2: Site Host in the Login plugin

If you only want to pin the email links and leave everything else alone, use the Login plugin's own setting instead.

In the admin, go to **Plugins → Login → Site Host** and enter your full site address, for example:

```
https://www.example.com
```

Or set it directly in `user/config/plugins/login.yaml`:

```yaml
site_host: 'https://www.example.com'
```

> [!NOTE]
> If you run the same site under more than one address (for example a staging and a production domain, or multiple languages on separate domains), pick the canonical public address your users should always see in their email.

## Refusing to send when no host is set

For sites where account security is critical, the Login plugin can go a step further and **refuse to send** password reset emails at all unless a trusted host is configured, rather than falling back to the request host.

Enable **Plugins → Login → Require Trusted Host**, or in `user/config/plugins/login.yaml`:

```yaml
require_trusted_host: true
```

With this on, a misconfigured site fails safe (no email is sent) instead of sending a potentially spoofable link.

## Defense in depth: validate the host at the web server

Setting a Custom Base URL fixes the email links, but it is good practice to also reject forged `Host` headers at the web server before they ever reach Grav. That way every part of your stack agrees on which host names are legitimate.

The examples below reject any request whose `Host` header is not one you expect.

### Apache

In your virtual host or `.htaccess`, allow only your known hosts:

```apache
RewriteEngine On
RewriteCond %{HTTP_HOST} !^(www\.example\.com|example\.com)$ [NC]
RewriteRule ^ - [F]
```

Better still, define an explicit `ServerName` and `ServerAlias` in the virtual host and let Apache serve unknown hosts from a separate default virtual host that returns an error.

### Nginx

Give your real `server` block an exact `server_name`, then add a catch-all default that rejects everything else:

```nginx
server {
    listen 80 default_server;
    server_name _;
    return 444;            # close the connection on an unknown host
}

server {
    listen 80;
    server_name www.example.com example.com;
    # ... your normal Grav configuration ...
}
```

### Caddy

Caddy only answers for the host names listed in a site block, so an exact address already rejects forged hosts:

```caddy
www.example.com, example.com {
    root * /var/www/grav
    php_fastcgi unix//run/php/php-fpm.sock
    file_server
}
```

### Behind a proxy or CDN

If Grav runs behind a load balancer, reverse proxy, or CDN (such as Cloudflare), make sure the proxy forwards the real, validated host and that Grav is configured to trust it. See the `reverse_proxy_setup` and `http_x_forwarded` options in [Grav Configuration](/basics/grav-configuration) for the related settings.

## Confirming it is resolved

After you save a Custom Base URL or Site Host, the admin warning disappears on the next page load. You can also send yourself a password reset and confirm the link in the email points at your real domain.
