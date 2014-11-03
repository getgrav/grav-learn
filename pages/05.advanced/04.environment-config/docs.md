---
title: Environment Configuration
taxonomy:
    category: docs
---

Grav now has the ability to extend the [powerful configuration capabilities](../../basics/grav-configuration) for different environments to support different configuration for **development**, **staging**, and **production** scenarios.

### Automatic Environment Configuration

What this means is that you can provide as little or as much configuration changes per environment as needed.  A good example of this is the [Debug Bar](../debugging).  By default the new Debug Bar is disabled in the core `system/config/system.yaml` file, and also in the user override `user/config/system.yaml` file.  If you wanted to turn it on, you can easily enable it in your `user/config/system.yaml` file, however a better solution might be to have it _enabled_ for your development environment when accessing via **localhost**, but _disabled_ on your **production** server.

This can be easily accomplished by providing an override of that setting in the file: `user/localhost/config/system.yaml` where `localhost` is the hostname of the environment:

```
debugger:
  enabled: true
```

Similarly you may want to enable CSS and Js Asset Pipelining (combining + minification) for your production site only (`user/www.mysite.com/config/system.yaml`):

```
assets:
  css_pipeline: true
  js_pipeline: true
```

If your production server was reachable via `http://www.mysite.com` then you could also provide configuration specific for that production site with a file located at `user/www.mysite.com/config.system.yaml`.

Of course, you are not limited to changes to `system.yaml`, you can actually provide overrides for **any** Grav setting in the `site.yaml` or even in any [plugin configuration](../../plugins/plugin-basics)!
