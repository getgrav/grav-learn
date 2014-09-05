---
title: Debugging & Logging
process:
	twig: true
taxonomy:
    category: docs
---

When developing themes and plugins, there is often a need to display **debugging** information.

## PHP Debugging

Luckily, Grav comes with a great tool to make this easier called [Tracy Debugger][tracy]. The most obvious part of the debugger is the visible bar you see when the page loads.  This provides **total processing time** within Grav, as well as **memory usage**.

{{ media['debugger-bar.png'].html }}

This **debugger bar** is enabled by default but you can disable it along with other debugging options in the `user/config/system.yaml` file:

```
debugger:
  enabled: false                       # Enable Grav debugger and following settings
  mode: detect                         # Mode tracy Debugger should be set to when enabled: detect|development|production
  strict: false                        # Throw fatal error also on PHP warnings and notices
  max_depth: 10                        # How many nested levels to display for objects or arrays
  log:
    enabled: true                      # Enable logging
    timing: false                      # Enable timing logging
```

>>> The Debugger **always** runs in Grav because we use it for logging and exception handling.  However the **debugger bar** is controlled by the `enabled` option combined with the `mode` option.  You must `enable` the debugger in the configuration for it to show at all, however, you can set the mode to `detect` to **enabled** on local hosts, and be **disabled** on production environments.

Another great feature that Tracy provides, is the ability to use its `dump()` method. This provides a very easy to read way to display objects and variables.

For example, in a plugin you might have something like:

```
\Tracy\Debugger::dump($my_object);
```

and this would display the following output:

{{ media['debugger-dump.png'].html }}

You can of course click the grey arrows to open or close the nested structure of objects. This is quite an improvement over `print_r` or even `var_dump`.

## Exception Display

The other useful feature that Tracy provides for Grav is the detailed **Exception Display**. If your code throws an exception, Tracy handles this by providing relevant information to help track down what caused the problem.  This includes a snippet of the source file, with the line in question highlighted in red.  Also you can dig into the call stack and see the context of the calling methods.

Tracy even provides the ability to examine the **Environment** as well as the **HTTP Request** and **HTTP Response**.  This kind of information can be invaluable in quickly identifying and resolving coding issues.

{{ media['debugger-exception.png'].cropResize(800,1200).html }}

## Logging

The ability to log information is often useful, and once again, Tracy provides us with a simple logging feature.  Simply use the following syntax:

```
\Tracy\Debugger::log('my message to log');
```

Your message will be appended to the log in the log directory `/logs`.

## Timing

One last functionality that is available in Grav is the ability to log timing data.  In the `/user/config/system.yaml` file there is an option to **enable timing**, this will log out the timing on each [PluginEvent Hook][hook].  This is useful for determining which portion of the life cycle is using resources.

You can add your own timers in your plugins if you need to.  For more information on this please refer to the [Tracy documentation][tracydocs].

## Twig Debugging

One last type of debugging available is the ability to dump twig variables from a Twig template.  For this to function, you **must** have the `debug` option in the twig system settings set to `true`:

```
twig:
  cache: false                          # Set to true to enable twig caching
  debug: true                           # Enable Twig debug
```

This allows you to use the [Twig Dump][dump] function to dump the value of a variable or object:

{% verbatim %}
```
{{ dump(header.site) }}
```
{% endverbatim %}

It is advisable to wrap the `dump()` method in an HTML `<pre />` tag to enhance readability:

{% verbatim %}
```
<pre>{{ dump(header.site) }}</pre>
```
{% endverbatim %}

[tracy]: https://github.com/nette/tracy
[hook]: ../plugins/event-hooks
[tracydocs]: https://github.com/nette/tracy
[dump]: http://twig.sensiolabs.org/doc/functions/dump.html
