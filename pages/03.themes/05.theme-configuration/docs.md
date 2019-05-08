---
title: Theme Configuration
taxonomy:
    category: docs
---

As of Grav 1.1, you can easily access theme configuration and blueprint information from your Twig and PHP files.

## Accessing Theme Blueprint Information

Information from the currently active theme's `blueprints.yaml` file can be had from the `theme` object. Let's use the following `blueprints.yaml` file as an example:

[prism classes="language-yaml line-numbers"]
name: Antimatter
version: 1.7.0
description: "Antimatter is the default theme included with **Grav**"
icon: empire
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-theme-antimatter
demo: http://demo.getgrav.org/blog-skeleton
keywords: antimatter, theme, core, modern, fast, responsive, html5, css3
bugs: https://github.com/getgrav/grav-theme-antimatter/issues
license: MIT
[/prism]

You can reach any of these items via `theme` by using the standard **dot-syntax**:

[prism classes="language-twig line-numbers"]
Author Email: {{ theme.author.email }}
Theme License: {{ theme.license }}
[/prism]

You can also reach these same values from a Grav plugin with PHP syntax:

[prism classes="language-php line-numbers"]
$theme_author_email = $this->grav['theme']['author']['email'];
$theme_license = $this->grav['theme']['license'];
[/prism]

## Accessing Theme Configuration

Theme's have configuration files, too. A theme's configuration file is named `<themename>.yaml`. The default file lives in the theme's root folder (`user/themes/<themename>`). 

It is **strongly** recommended not to actually change the theme's default YAML file but to override the settings in the `user/config` folder. This will ensure that the theme's original settings remain intact, allowing you to quickly access the changes and/or revert back whenever necessary.

For example, let us consider the Antimatter theme.  By default, there is a file called `antimatter.yaml` in the theme's root folder. The contents of this configuration file look like this:

[prism classes="language-yaml line-numbers"]
enabled: true
color: blue
[/prism]

This is a simple file, but it provides you an idea of what you can do with theme configuration settings. Let us override these settings and add a new one.

So, create a file in the following location: `user/config/themes/antimatter.yaml`.  In this file put the following contents:

> *I note that `enabled` is not repeated here. If the config files are merged and not simply replaced, then that should be explicitly stated.*

[prism classes="language-yaml line-numbers"]
color: red
info: Grav is awesome!
[/prism]

Then in your theme templates you can access these variables using the `grav.theme.config` object:

```
<h1 style="color:{{ grav.theme.config.color }}">{{ grav.theme.config.info }}</h1>
```

This should render out as:

<h1 style="color:red">Grav is awesome!</h1>

In PHP you can access the current theme's configuration with:

[prism classes="language-php line-numbers"]
$color = $this->grav['theme']->config()['color'];
[/prism]

Simple! The sky is the limit regarding the configuration of your themes.  You can use them for whatever you like! :)

### Alternative Notation

The following aliases also work:

[prism classes="language-twig line-numbers"]
Theme Color Option: {{ config.theme.color_option }}
   or
Theme Color Option: {{ theme_var(color_option) }}
   or
Theme Color Option: {{ grav.themes.antimatter.color_option }} [AVOID!]
[/prism]

**Even though `grav.themes.<themename>` is supported, it should be avoided because it makes it impossible to inherit the theme properly.**
