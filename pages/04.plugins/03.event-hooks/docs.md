---
title: Event Hooks
taxonomy:
    category: docs
---

In the previous [Plugin Tutorial][plugintutorial] chapter, you might have noticed that our plugin logic was encompassed in two methods.  Each of these methods `onPluginsInitialized` and `onPageInitialized` correspond to **event hooks** that are available throughout the Grav life cycle.

To fully harness the power of Grav plugins you need to know which event hooks are available, in what order are these hooks called, and what is available during these calls.  The **event hooks** have a direct relationship to the overall [Grav Lifecycle][lifecycle] that we cover in the [Advanced][advanced] section later on.

## Event Order

Most events within Grav fire in a specific order and it is important to understand this order if you are creating plugins:

1. [onFatalException](#onFatalException) _(no order, can occur anytime)_
1. [onPluginsInitialized](#onPluginsInitialized)
1. [onAssetsInitialized](#onAssetsInitialized)
1. [onTwigTemplatePaths](#onTwigTemplatePaths)
1. [onTwigInitialized](#onTwigInitialized)
1. [onTwigExtensions](#onTwigExtensions)
1. [onTwigPageVariables](#onTwigPageVariables) _(each page not cached yet)_
1. [onPageProcessed](#onPageProcessed) _(each page not cached yet)_
1. [onFolderProcessed](#onFolderProcessed) _(for each folder found)_
1. [onBlueprintCreated](#onBlueprintCreated)
1. [onPagesInitialized](#onPagesInitialized)
1. [onPageNotFound](#onPageNotFound)
1. [onPageInitialized](#onPageInitialized)
1. [onCollectionProcessed](#onCollectionProcessed) _(when collection is requested)_
1. [onTwigSiteVariables](#onTwigSiteVariables)
1. [onOutputGenerated](#onOutputGenerated)
1. [onOutputRendered](#onOutputRendered)
1. [onShutdown](#onShutdown)


## Core Grav Event Hooks

There are several core Grav event hooks that are triggered during the processing of a page:

<a name="onFatalException"></a>
#### onFatalException

This is an event that can be fired at any time if PHP throws a fatal exception. This is currently used by the `problems` plugin to handle displaying a list of potential reasons why Grav throws the fatal exception.

<a name="onPluginsInitialized"></a>
#### onPluginsInitialized

This is the first plugin event available. At this point the following objects have been initiated:

* Uri
* Config
* Debugger
* Cache
* Plugins

>>>> NOTE: A plugin will not be loaded at all if the `enabled: false` configuration option has been set for that particular plugin.


<a name="onAssetsInitialized"></a>
#### onAssetsInitialized

The event indicates the assets manager has been initialized and is ready for assets to be added and managed.

<a name="onPagesInitialized"></a>
#### onPagesInitialized

This event signifies that all the pages in Grav's `user/pages` folder have been loaded as objects and are available in the **Pages object**.

<a name="onPageNotFound"></a>
#### onPageNotFound

This is an event that can be fired if an expected page is not found. This is currently used by the `error` plugin to display a pretty 404 error page.

<a name="onPageInitialized"></a>
#### onPageInitialized

The current page as requested by a URL has been loaded into the **Page object**.

<a name="onOutputGenerated"></a>
#### onOutputGenerated

The output has been processed by the **Twig templating engine** and is now just a string of HTML.

<a name="onOutputRendered"></a>
#### onOutputRendered

The output has been fully processed and sent to the display.

<a name="onShutdown"></a>
#### onShutdown

A new and very powerful even that lets you perform actions after Grav has finished processing and the connection to the client has been closed.  This is particularly useful for performing actions that don't need user interaction and potentially could impact performance.  Possible uses include user tracking and jobs processing.


## Twig Event Hooks

Twig has its own set of event hooks.

<a name="onTwigTemplatePaths"></a>
#### onTwigTemplatePaths

The base locations for template paths have been set on the **Twig object**.  If you need to add other locations where Twig will search for template paths, this is the event to use.

<a name="onTwigInitialized"></a>
#### onTwigInitialized

The Twig templating engine is now initialized at this point.

<a name="onTwigExtensions"></a>
#### onTwigExtensions

The core twig extensions have been loaded, but if you need to add your own Twig extension, you can do so with this event hook.

<a name="onTwigPageVariables"></a>
#### onTwigPageVariables

Where Twig processes a page directly, i.e. when you set `process: twig: true` in a page's YAML headers. This is where you should add any variables to Twig that need to be available to twig during this process.


<a name="onTwigSiteVariables"></a>
#### onTwigSiteVariables

Where Twig processes the full site template hierarchy.  This is where you should add any variables to Twig that need to be available to twig during this process.

## Collection Event Hooks

<a name="onCollectionProcessed"></a>
#### onCollectionProcessed

If you need to manipulate a collection after it has been processed this is the time to do it.

## Page Event Hooks

<a name="onBlueprintCreated"></a>
#### onBlueprintCreated

This is used for processing and handling forms.

<a name="onPageProcessed"></a>
#### onPageProcessed

After a page is parsed and processed.  This is fired for **every page** in the Grav system.  With caching performance is not a problem because this even will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.

<a name="onFolderProcessed"></a>
#### onFolderProcessed

After a folder is parsed and processed.  This is fired for **every folder** in the Grav system.  Caching performance is not a problem because this even will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.

[plugintutorial]: plugin-tutorial
[lifecycle]: ../advanced/grav-lifecycle
[advanced]: ../advanced
