---
title: Flood Protection
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/rate-limiting'
---

![](login.gif?classes=shadow)

Brute force attacks are a popular choice for website intruders. It could come in the form of someone you know trying to guess your password over and over until they are finally successful or a bot flooding your site with login attempts until eventually the password has been discovered.

Grav's flood protection (also known as rate limiting) feature makes these kinds of attacks exceptionally difficult. It allows you to set a number of failed login attempts within a specific amount of time before the account gets temporarily locked out. Additionally, you can restrict the amount of password reset requests applied to accounts before locking this feature out.

## What You'll Need

This feature is managed through the [**Login** plugin](https://github.com/getgrav/grav-plugin-login). You'll want to have **Login version 2.4** or above, in addition to **Grav 1.3.3** or above and **Admin Panel 1.6.0** or above.

## How to Set it Up

![](2fa_3.jpeg?classes=shadow)

The settings for Grav's flood protection are found in the Login plugin. Simply navigate to **Admin > Plugins > Login** and select the **Security** tab.

Here, you can set the following:

* Maximum number of password resets before lockout
* Password reset maximum interval
* Maximum failed logins before lockout
* Maximum failed logins interval

This will enable you to determine how many failed password resets or logins are allowed in a set amount of time before lockout occurs. This log out is temporary and lasts as long as your set interval.

