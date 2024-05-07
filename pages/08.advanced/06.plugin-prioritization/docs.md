---
title: Plugin Prioritization
taxonomy:
    category: docs
---

When multiple plugins listen to the same event hooks (see the [Plugins > Event Hooks page for details](../../plugins/event-hooks)), the various handlers are executed in order of "priority." Priority is simply a number. The higher the number, the earlier the handler will execute.

In rare cases, users may need to tweak the priorities of certain handlers. This can be done without touching the original plugin code.

First determine precisely which handlers need to be tweaked and how. This is an advanced task that requires that you be able to read the plugin's `.php` file. Normally the event hooks, handler functions, and default priorities can be found in a plugin's `onPluginsInitialized()` function.

Then create the file `user/config/priorities.yaml`. The data should be structured as follows:

```yaml
pluginName:
    eventName:
        handlerName: [integer]
```

So for example, let's say you have a plugin called `essential` that listens to the `onPageInitialized` event, triggering the function `handlePage` with a priority of 0. Let's then say you discover that you need that priority to be `100` to make sure it executes *before* some other plugin. You would add the following to your `user/config/priorities.yaml` file:

```yaml
essential:
    onPageInitialized:
        handlePage: 100
```
