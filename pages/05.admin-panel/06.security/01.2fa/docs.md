---
title: 2-Factor Authentication
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/2fa'
process:
    twig: true
---

![Admin Profile](auth3.gif?classes=shadow)

Available with Grav 1.3.3 and Admin Panel 1.6.0, you can now activate 2-factor authentication on your Grav site.

2-factor authentication (2FA) is an excellent security measure that uses a rolling-clock style authentication method that generates six-digit codes you can use in addition to your username and password to access the Admin.

To take advantage of this feature, you'll want to download a 2FA-supporting app such as [Authy](https://authy.com/) or [Google Authenticator](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en). This app will act as a virtual key ring for authentication codes.

## How to Set it Up

![](2fa_1.jpeg?classes=shadow)

Setting 2-factor authentication up in Grav is easy. All you need to do is navigate to **Plugins > Admin Panel > Basics** in the Admin.

Here, you will find 2-Factor Authentication. You can choose to turn this feature on by selecting **Yes**. This will enable users to set up 2-factor authentication on their accounts.

![](2fa_2.jpeg?classes=shadow)

Now, you can select your avatar image to access your user profile settings. Next, you will want to set the **2FA Enabled** option to **Yes**.

A QR code will appear along with a 2FA secret key. Write the key down and put it somewhere safe.

![](2fa_4.png?width=1009&classes=shadow)

Using your authenticator app of choice, scan the QR code or enter the secret key to register your 2FA key. Save your profile page to lock in your 2FA settings.

![](2fa_5.png?width=1009&classes=shadow)

A purple 2FA badge will now appear next to your name in the sidebar. This badge lets you know that 2FA is active on the account.

You can now log out and log back in. You will be greeted with the same username and password fields, but once you enter this information, you will be asked to provide an additional six-digit code. This code is in your authenticator app. It resets every 30 seconds, so the code is only good during that short period. A new code will generate to replace it.

That's it! You now have a more secure Grav site!

Oh, and if you want to change your 2FA key, all you need to do is hit the big red **Regenerate** button.

## Frequently Asked Questions

#### What Happens if I lose access to my 2FA device?

Don't worry! All is not lost.

Your 2FA status and hashed key are stored in your site's file system on your user YAML file. For example, if your user account is `admin`, navigate to **ROOT/user/accounts/admin.yaml** and look for these two lines:

[prism classes="language-yaml line-numbers"]
twofa_enabled: true
twofa_secret: RQX46XTTBK7QMMB6VR4RAUNWOYVXXTSR
[/prism]

Simply set **twofa_enabled** to `false` and save. You should now be able to access your site using just your username and password. Alternatively, you can use the **twofa_secret** to register your account on your authenticator app of choice.

#### What if my 2FA secret is compromised?

If you believe your 2FA secret may be compromised, you can generate a new key and invalidate the old one by selecting the big red **Regenerate** button in your user profile settings from the Admin.
