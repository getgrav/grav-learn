---
title: 403 Forbidden
taxonomy:
    category: docs
---

![](forbidden-403.png?classes=border,shadow)

There is an obscure but persistent issue with **Apache** on **Windows** causing a 403 forbidden error.

Basically, Apache won't allow the `:` in the URL that works on other systems due to a security concern based on the fact that windows paths can have colons in them: `C:\some\path`.

We have addressed this by providing a configurable option for the parameter separator that is defaulting to `:`

Simply edit your `user/config/system.yaml` and add this at the top:

[prism classes="language-yaml"]
param_sep: ';'
[/prism]

This will configure Grav to use a semicolon, rather than a colon for parameters such as `http://yoursite.com/blog/tag:something` will now be: `http://yoursite.com/blog/tag;something`.

## 403 issue in Admin

If you have `mod_security` installed, we had reports of rule 350147 (http://wiki.atomicorp.com/wiki/index.php/WAF_350147) triggering a false positive. Whitelist that rule, or ask your hosting provider support to do it.

[prism classes="language-yaml line-numbers"]
ModSecurity: [file "/etc/httpd/conf/modsecurity.d/rules/tortix/modsec/50_plesk_basic_asl_rules.conf"] [line "308"] [id "350147"] [rev "143"] [msg "Protected by Atomicorp.com Basic Non-Realtime WAF Rules: Potentially Untrusted Web Content Detected"] [data ""] [severity "CRITICAL"] Access denied with code 403 (phase 2). Match of "rx ((?:submit(?:\\+| )?(request)?(?:\\+| )?>+|<<(?:\\+| )remove|(?:sign ?in|log ?(?:in|out)|next|modifier|envoyer|add|continue|weiter|account|results|select)?(?:\\+| )?>+)$|^< ?\\??(?: |\\+)?xml|^<samlp|^>> ?$)" against "ARGS:notifications" required. [hostname "mydomain"] [uri "/grav/admin/notifications.json/task:processNotifications"] [unique_id "WXoYHcpkEKz0qCI66845gQAAAAo"], referer: http://mydomain/grav/admin/tools
[/prism]
