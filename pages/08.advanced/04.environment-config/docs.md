---
title: Environment Configuration
taxonomy:
    category: docs
---

Grav now has the ability to extend the [powerful configuration capabilities](../../basics/grav-configuration) for different environments to support different configuration for **development**, **staging**, and **production** scenarios.

### Automatic Environment Configuration

What this means is that you can provide as little or as much configuration changes per environment as needed.  A good example of this is the [Debug Bar](../debugging).  By default, the new Debug Bar is disabled in the core `system/config/system.yaml` file, and also in the user override file:

[prism classes="language-bash command-line"]
user/config/system.yaml
[/prism]

If you wanted to turn it on, you can easily enable it in your `user/config/system.yaml` file, however a better solution might be to have it _enabled_ for your development environment when accessing via **localhost**, but _disabled_ on your **production** server.

This can be easily accomplished by providing an override of that setting in the file: 

[prism classes="language-bash command-line"]
user/localhost/config/system.yaml
[/prism]

where `localhost` is the hostname of the environment (this is what the host you enter in your browser, e.g. http://localhost/your-site) and your configuration file contains:

[prism classes="language-yaml line-numbers"]
debugger:
  enabled: true
[/prism]

Similarly, you may want to enable CSS and Js Asset Pipelining (combining + minification) for your production site only (`user/www.mysite.com/config/system.yaml`):

[prism classes="language-yaml line-numbers"]
assets:
  css_pipeline: true
  js_pipeline: true
[/prism]

If your production server was reachable via `http://www.mysite.com` then you could also provide configuration specific for that production site with a file located at `user/www.mysite.com/config/system.yaml`.

Of course, you are not limited to changes to `system.yaml`, you can actually provide overrides for **any** Grav setting in the `site.yaml` or even in any [plugin configuration](../../plugins/plugin-basics)!

#### Plugin Overrides

To override a plugin configuration YAML file is simply the same process as overriding a regular file.   If the standard configuration file is located in:

[prism classes="language-bash command-line"]
user/config/plugins/email.yaml
[/prism]

Then you can override this with a setting that only overrides specific options that you want to use for local testing:

[prism classes="language-bash command-line"]
user/localhost/config/plugins/email.yaml
[/prism]

With the configuration: 

[prism classes="language-yaml line-numbers"]
mailer:
  engine: smtp
  smtp:
    server: smtp.mailtrap.io
    port: 2525
    encryption: none
    user: '9a320798e65135'
    password: 'a13e6e27bc7205'
[/prism]

#### Theme Overrides

You can override themes in much the same way:

[prism classes="language-bash command-line"]
user/config/themes/antimatter.yaml
[/prism]

Can be overridden for any environment, say some production site (`http://www.mysite.com`):

[prism classes="language-bash command-line"]
user/www.mysite.com/config/themes/antimatter.yaml
[/prism]
