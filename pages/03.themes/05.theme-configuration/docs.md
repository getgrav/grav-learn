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
