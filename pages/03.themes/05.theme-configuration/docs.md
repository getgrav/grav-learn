---
title: Theme Configuration
taxonomy:
    category: docs
---

Theme configuration works in a similar fashion to all the other configuration settings in Grav. You can provide settings for a theme configuration file for your theme with the filename `<themename>.yaml` in the root of your theme folder. These variables can be accessed in your template files.

It is **strongly** recommended not to actually change the theme's YAML file, but to override the settings in the `user/config` folder. This will ensure that the theme's original settings remain intact, allowing you to quickly access the changes and/or revert back whenever necessary.

For example, let us consider the Antimatter theme.  By default, there is a file called `antimatter.yaml` in the theme's root folder. The contents of this configuration file look like this:

```
enabled: true
color: blue
```

This is a simple file, but it provides you an idea of what you can do with theme configuration settings. Let us provide an override for these settings plus a new one.

So, create a file in the following location: `user/config/themes/antimatter.yaml`.  In this file put the following contents:

```
color: red
info: Grav is awesome!
```

Then in your theme, you can add something like this:

```
<h1 style="color:{{ config.themes.antimatter.color }}">{{ config.themes.antimatter.info }}</h1>
```

This should render out as:

<h1 style="color:red">Grav is awesome!</h1>

The sky is the limit regarding the configuration of your themes.  You can use them for whatever you like! :)

## Accessing Theme Info

As of Grav 1.1, you can easily access theme configuration and blueprint-related information.  To access information via Twig from the `blueprints.yaml` such as theme name you can simply use:

```
{{ grav.theme.name }}
```

For a given example `blueprints.yaml` configuration of:

```
name: Antimatter
version: 1.7.0
description: "Antimatter is the default theme included with **Grav**"
icon: empire
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-theme-antimatter
demo: http://demo.getgrav.org/blog-skeleton
keywords: antimatter, theme, core, modern, fast, responsive, html5, css3
bugs: https://github.com/getgrav/grav-theme-antimatter/issues
license: MIT
```

You can reach any of these items via `grav.theme` by using the standard **dot-sytnax**:

```
Author Email: {{ grav.theme.author.email }}
Theme License: {{ grav.theme.license }}
```

You can also reach these same values from a Grav plugin with PHP syntax:

```
$theme_author_email = $this->grav['theme']['author']['email'];
$theme_license = $this->grav['theme']['license'];
```

## Accessing Theme Configuration

As well as the blueprint information, you can also easily access the current theme configuration with:

```
Theme Color Option: {{ grav.theme.config.color_option }}
```

And of course, the same thing in PHP is:

```
$color_option = $this->grav['theme']['config']['color_option'];
```

Simple!

