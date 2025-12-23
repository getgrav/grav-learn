---
title: Environment Configuration
taxonomy:
     category: docs
---

Grav has the ability to extend the [powerful configuration capabilities](../../basics/grav-configuration) for different environments to support different configuration for **development**, **staging**, and **production** scenarios.

> [!CAUTION]
> Up to Grav 1.6 environments were stored in `user/` folder. Grav 1.7 moves environments to `user/env/` to make environments easier to maintain. It is highly recommended that you move all the environments into this new location on your existing sites.

### Automatic Environment Configuration

What this means is that you can provide as little or as much configuration changes per environment as needed.  A good example of this is the [Debug Bar](../debugging).  By default, the new Debug Bar is disabled in the core `system/config/system.yaml` file, and also in the user override file:

[codesh=bash]
user/config/system.yaml
[/codesh]

If you wanted to turn it on, you can easily enable it in your `user/config/system.yaml` file, however a better solution might be to have it _enabled_ for your development environment when accessing via **localhost**, but _disabled_ on your **production** server.

This can be easily accomplished by providing an override of that setting in the file:

[codesh=bash]
user/env/localhost/config/system.yaml
[/codesh]

where `localhost` is the hostname of the environment (this is what the host you enter in your browser, e.g. http://localhost/your-site) and your configuration file contains:

[codesh=yaml line-numbers="true"]
debugger:
  enabled: true
[/codesh]

Similarly, you may want to enable CSS, Link, JS and JS Module Asset Pipelining (combining + minification) for your production site only
(`user/env/www.mysite.com/config/system.yaml`):

[codesh=yaml line-numbers="true"]
assets:
  css_pipeline: true
  js_pipeline: true
  js_module_pipeline: true
[/codesh]

If your production server was reachable via `http://www.mysite.com` then you could also provide configuration specific for that production site with a file located at
`user/env/www.mysite.com/config/system.yaml`.

Of course, you are not limited to changes to `system.yaml`, you can actually provide overrides for **any** Grav setting in the `site.yaml` or even in any [plugin configuration](../../plugins/plugin-basics)!

> [!CAUTION]
> If you are using the Grav [Scheduler](/17/advanced/scheduler), be aware of it using the `localhost` environment and therefore its configuration.

#### Plugin Overrides

To override a plugin configuration YAML file is simply the same process as overriding a regular file.   If the standard configuration file is located in:

[codesh=bash]
user/config/plugins/email.yaml
[/codesh]

Then you can override this with a setting that only overrides specific options that you want to use for local testing:

[codesh=bash]
user/env/localhost/config/plugins/email.yaml
[/codesh]

With the configuration:

[codesh=yaml line-numbers="true"]
mailer:
  engine: smtp
  smtp:
    server: smtp.mailtrap.io
    port: 2525
    encryption: none
    user: '9a320798e65135'
    password: 'a13e6e27bc7205'
[/codesh]

#### Theme Overrides

You can override themes in much the same way:

[codesh=bash]
user/config/themes/antimatter.yaml
[/codesh]

Can be overridden for any environment, say some production site (`http://www.mysite.com`):

[codesh=bash]
user/env/www.mysite.com/config/themes/antimatter.yaml
[/codesh]

### Server Based Environment Configuration

Starting from Grav 1.7, it is possible to set the environment by using server configuration. In this use scenario, you set environment variables from the server or from a script that runs before Grav to select the environment to be used.

The simplest way to set environment is by using `GRAV_ENVIRONMENT`. Value of `GRAV_ENVIRONMENT` has to be a valid server name with or without domain.

The following example selects **development** environment for the localhost:

[ui-tabs]
[ui-tab title="Apache 2"]
[codesh=apache line-numbers="true"]
<VirtualHost 127.0.0.1:80>
    ...

    SetEnv GRAV_ENVIRONMENT development
</VirtualHost>
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-fpm"]
[codesh=nginx line-numbers="true"]
location / {
    ...

   fastcgi_param GRAV_ENVIRONMENT development;
}
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-cgi"]
[codesh=nginx line-numbers="true"]
location / {
   ...

    env[GRAV_ENVIRONMENT] = development
}
[/codesh]
[/ui-tab]
[ui-tab title="Docker"]
[codesh=yaml line-numbers="true"]
web:
  environment:
    - GRAV_ENVIRONMENT=development
[/codesh]
[/ui-tab]
[ui-tab title="PHP"]
[codesh=php line-numbers="true"]
// Set environment in setup.php or make sure it runs before Grav.
define('GRAV_ENVIRONMENT', 'development');
[/codesh]
[/ui-tab]
[/ui-tabs]

### Custom Environment Paths

Starting from Grav 1.7, you can also change the location of the environments. There are two possibilities: either you configure a common location for all the environments or you define them one by one.

#### Custom location for all the environments

If for some reason you are not happy with the default `user/env` location for your environments, it can be changed by using `GRAV_ENVIRONMENTS_PATH` environment variable.

Value of `GRAV_ENVIRONMENTS_PATH` has to be existing path under `GRAV_ROOT`. Do not use trailing slash.

In the next example, all the environments will be located in `user/sites/GRAV_ENVIRONMENT`, where `GRAV_ENVIRONMENT` is either automatically detected or manually set in the server configuration:

[ui-tabs]
[ui-tab title="Apache 2"]
[codesh=apache line-numbers="true"]
<VirtualHost 127.0.0.1:80>
...

    SetEnv GRAV_ENVIRONMENTS_PATH user://sites
</VirtualHost>
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-fpm"]
[codesh=nginx line-numbers="true"]
location / {
    ...

fastcgi_param GRAV_ENVIRONMENTS_PATH user://sites;
}
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-cgi"]
[codesh=nginx line-numbers="true"]
location / {
...

    env[GRAV_ENVIRONMENTS_PATH] = user://sites
}
[/codesh]
[/ui-tab]
[ui-tab title="Docker"]
[codesh=yaml line-numbers="true"]
web:
  environment:
    - GRAV_ENVIRONMENTS_PATH=user://sites
[/codesh]
[/ui-tab]
[ui-tab title="PHP"]
[codesh=php line-numbers="true"]
// Set environments path in setup.php or make sure that the following code runs before Grav.
define('GRAV_ENVIRONMENTS_PATH', 'user://sites');
[/codesh]
[/ui-tab]
[/ui-tabs]

#### Custom location for the current environment

Sometimes it may be useful to have a custom location for your environment

Value of `GRAV_ENVIRONMENT_PATH` has to be existing path under `GRAV_ROOT`. Do not use trailing slash.

In the next example, only the current environment will be located in `user/development`:

[ui-tabs]
[ui-tab title="Apache 2"]
[codesh=apache line-numbers="true"]
<VirtualHost 127.0.0.1:80>
...

    SetEnv GRAV_ENVIRONMENT_PATH user://development
</VirtualHost>
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-fpm"]
[codesh=nginx line-numbers="true"]
location / {
    ...

fastcgi_param GRAV_ENVIRONMENT_PATH user://development;
}
[/codesh]
[/ui-tab]
[ui-tab title="NGINX php-cgi"]
[codesh=nginx line-numbers="true"]
location / {
...

    env[GRAV_ENVIRONMENT_PATH] = user://development
}
[/codesh]
[/ui-tab]
[ui-tab title="Docker"]
[codesh=yaml line-numbers="true"]
web:
  environment:
    - GRAV_ENVIRONMENT_PATH=user://development
[/codesh]
[/ui-tab]
[ui-tab title="PHP"]
[codesh=php line-numbers="true"]
// Set environment path in setup.php or make sure that the following code runs before Grav.
define('GRAV_ENVIRONMENT_PATH', 'user://development');
[/codesh]
[/ui-tab]
[/ui-tabs]

Note that `GRAV_ENVIRONMENT_PATH` is separate from `GRAV_ENVIRONMENT`, so you may also want to set the environment name if you don't want it to be automatically set to match the current domain name.

### Further Customization

Environments can be customized far further than described in this page.

For more information, please continue to the next page: [Multisite Setup](/17/advanced/multisite-setup).

