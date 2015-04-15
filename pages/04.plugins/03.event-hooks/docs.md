---
title: Event Hooks
taxonomy:
    category: docs
---

In the previous [Plugin Tutorial](../plugin-tutorial) chapter, you might have noticed that our plugin logic was encompassed in two methods.  Each of these methods `onPluginsInitialized` and `onPageInitialized` correspond to **event hooks** that are available throughout the Grav life cycle.

To fully harness the power of Grav plugins you need to know which event hooks are available, in what order are these hooks called, and what is available during these calls.  The **event hooks** have a direct relationship to the overall [Grav Lifecycle](../../advanced/grav-lifecycle) that we cover in the [Advanced](../../advanced) section later on.

## Event Order

Most events within Grav fire in a specific order and it is important to understand this order if you are creating plugins:

1. [onFatalException](../event-hooks#onfatalexception) _(no order, can occur anytime)_
1. [onPluginsInitialized](../event-hooks#onpluginsinitialized)
1. [onAssetsInitialized](../event-hooks#onassetsinitialized)
1. [onTwigTemplatePaths](../event-hooks#ontwigtemplatepaths)
1. [onTwigInitialized](../event-hooks#ontwiginitialized)
1. [onTwigExtensions](../event-hooks#ontwigextensions)
1. [onTwigPageVariables](../event-hooks#ontwigpagevariables) _(each page not cached yet)_
1. [onPageContentRaw](../event-hooks#onpagecontentraw) _(each page not cached yet)_
1. [onPageProcessed](../event-hooks#onpageprocessed) _(each page not cached yet)_
1. [onPageContentProcessed](../event-hooks#onpagecontentprocessed) _(each page not cached yet)_
1. [onFolderProcessed](../event-hooks#onfolderprocessed) _(for each folder found)_
1. [onBlueprintCreated](../event-hooks#onblueprintcreated)
1. [onPagesInitialized](../event-hooks#onpagesinitialized)
1. [onPageNotFound](../event-hooks#onpagenotfound)
1. [onPageInitialized](../event-hooks#onpageinitialized)
1. [onCollectionProcessed](../event-hooks#oncollectionprocessed) _(when collection is requested)_
1. [onTwigSiteVariables](../event-hooks#ontwigsitevariables)
1. [onOutputGenerated](../event-hooks#onoutputgenerated)
1. [onOutputRendered](../event-hooks#onoutputrendered)
1. [onShutdown](../event-hooks#onshutdown)
1. [onBeforeDownload](../event-hooks#onbeforedownload)


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

>>>> A plugin will not be loaded at all if the `enabled: false` configuration option has been set for that particular plugin.


#### onAssetsInitialized

The event indicates the assets manager has been initialized and is ready for assets to be added and managed.

#### onPagesInitialized

This event signifies that all the pages in Grav's `user/pages` folder have been loaded as objects and are available in the **Pages object**.

#### onPageNotFound

This is an event that can be fired if an expected page is not found. This is currently used by the `error` plugin to display a pretty 404 error page.

#### onPageInitialized

The current page as requested by a URL has been loaded into the **Page object**.

#### onOutputGenerated

The output has been processed by the **Twig templating engine** and is now just a string of HTML.

#### onOutputRendered

The output has been fully processed and sent to the display.

#### onShutdown

A new and very powerful even that lets you perform actions after Grav has finished processing and the connection to the client has been closed.  This is particularly useful for performing actions that don't need user interaction and potentially could impact performance.  Possible uses include user tracking and jobs processing.

#### onBeforeDownload

This new event passes in an event object that contains a `file`.  This event can be used to perform logging, or grant/deny access to download said file.


## Twig Event Hooks

Twig has its own set of event hooks.

#### onTwigTemplatePaths

The base locations for template paths have been set on the **Twig object**.  If you need to add other locations where Twig will search for template paths, this is the event to use.

#### onTwigInitialized

The Twig templating engine is now initialized at this point.

#### onTwigExtensions

The core twig extensions have been loaded, but if you need to add your own Twig extension, you can do so with this event hook.

#### onTwigPageVariables

Where Twig processes a page directly, i.e. when you set `process: twig: true` in a page's YAML headers. This is where you should add any variables to Twig that need to be available to twig during this process.

#### onTwigSiteVariables

Where Twig processes the full site template hierarchy.  This is where you should add any variables to Twig that need to be available to twig during this process.

## Collection Event Hooks

#### onCollectionProcessed

If you need to manipulate a collection after it has been processed this is the time to do it.

## Page Event Hooks

#### onBlueprintCreated

This is used for processing and handling forms.

#### onPageContentRaw

After a page has been found, header processed, but content **not** processed.  This is fired for **every page** in the Grav system.  Performance is not a problem because this event will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.

#### onPageProcessed

After a page is parsed and processed.  This is fired for **every page** in the Grav system.  Performance is not a problem because this event will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.

#### onPageContentProcessed

This even is fired after the page's `content()` method has processed the page content.  This is particularly useful if you want to perform actions on the post-processed content but ensure the results are cached.  Performance is not a problem because this event will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.

#### onFolderProcessed

After a folder is parsed and processed.  This is fired for **every folder** in the Grav system.  Performance is not a problem because this event will not run on a cached page, only when the cache is cleared or a cache-clearing event occurs.
