---
title: Event Hooks
taxonomy:
    category: docs
---

In the previous [Plugin Tutorial](plugin-tutorial) chapter, you might of noticed that our plugin logic was encompassed in two methods.  Each of these methods `onAfterInitPlugins` and `onAfterGetPage` correspond to **event hooks** that are available throughout the Grav life cycle.

To fully harness the power of Grav plugins you need to know which event hooks are available, in what order are these hooks called, and what is available during these calls.  The **event hooks** have a direct relationship to the overall [Grav Lifecycle](../advanced/grav-lifecycle) that we cover in the [Advanced](../advanced) section later on.

## Core Grav Event Hooks

There are several core Grav hooks that are triggered during the processing of a page:

#### onFatalException

This is an event that can be fired at any time if PHP throws a fatal exception. This is currently used by the `problems` plugin to handle displaying a list of potential reasons why Grav throw the fatal exception.

#### onAfterInitPlugins

This is the first plugin event available. At this point the following objects have been initiated:

* Uri object
* Config object
* Tracy Debugger 
* Cache object
* Plugins are loaded

>>>> NOTE: A plugin will not be loaded at all if the `enabled: false` configuration option has been set for that particular plugin

#### onAfterGetPages

This event signifies that all the pages in Grav's `user/pages` folder have been loaded as objects and are available in the **Pages object**.

#### onAfterGetPage 

The current page as requested by a URL has been loaded into the **Page object**.

#### onAfterGetOutput

The output has been processed by the **Twig templating engine** and is now just a string of HTML.  


## Twig Event Hooks

Twig has it's own set of event hooks.

#### onAfterTwigTemplatesPaths

The base locations for template paths have been set on the **Twig object**.  If you need to add other locations where Twig will search for template paths, this is the event to use.

#### onAfterTwigInit

The Twig templating engine is now initialized at this point.

#### onAfterTwigExtensions

The core twig extensions have been loaded, but if you need to add your own Twig extension, you can do so with this event hook.

#### onAfterTwigPageVars

When Twig processes a page directly, i.e. when you set 

#### onAfterTwigStringVars

#### onAfterTwigSiteVars

## Collection Event Hooks

#### onAfterCollectionProcessed

## Page Event Hooks

#### onCreateBlueprint

#### onAfterPageProcessed

#### onAfterFolderProcessed
