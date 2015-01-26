---
title: Grav Lifecycle
body_classes: lifecycle
taxonomy:
    category: docs
markdown_extra: true

---

It is often useful to know how Grav processes in order to fully understand how best to extend Grav via plugins.  This is the Grav lifecycle:

* ### index.php {.level-1}
  1. Check PHP version to ensure we're running at least version **5.4.0**
  1. Class loader initialization
  1. Obtain Grav instances
  	  ### Grav.php {.level-2}
  	  1. No instance exists, so call `load()`
  	  1. Add `config_path`
  	  1. Add `grav`
  	  1. Add `events`
  	  1. Add `uri`
  	  1. Add `config`
  	  1. Add `cache`
  	  1. Add `plugins`
  	  1. Add `themes`
  	  1. Add `twig`
  	  1. Add `taxonomy`
  	  1. Add `pages`
  	  1. Add `assetes`
  	  1. Add `page`
  	  1. Add `output`
  	  1. Add `browser`
  	  1. Register `streams`
  1. Initializer debugger
  1. call `$grav->process()`
  	  ### Grav.php {.level-2}
  	  1. Start output buffering
  	  1. Initialize the stream `locator`
  	  1. Initialize `plugins`
  	  1. Fire **onPluginsInitalized** event
  	  1. Initalize `assets`
  	  1. Fire **onAssetsInitalized** event
  	  1. Initialize `twig`
  	      ### Twig.php {.level-3}
  	      1. Set Twig template paths based on configuration
  	      1. Fire **onTwigTemplatePaths** event
  	      1. Load Twig configuration and loader chain
  	      1. Fire **onTwigInitialized** event
  	      1. Load Twig extensions
  	      1. Fire **onTwigExtensions** event
  	      1. Set standard Twig variables (config, uri, taxonomy, assets, browser, etc)
  	  1. Initialize `pages`
  	      ### Pages.php {.level-3}
  	      1. Call `buildPages()`
  	      1. Check if cache is good
  	      1. If **cache is good** load pages date from cache
  	      1. If **cache is not good** call `recurse()`
  	      1. If a `.md` file is found:
  	          ### Page.php {.level-4}
  	          1. Call `init()` to load the file details
  	          1. Set the `filePath`, `modified`, `id`
  	          1. Call `header()` to initialize the header variables
  	          1. Call `slug()` to set the URL slug
  	          1. Call `visible()` to set visible state
  	          1. Set `modularTwig()` status based on if folder starts with `_`
  	       1. Fire **onPageProcessed** event
  	       1. If a `folder` found `recurse()` the children
  	       1. Fire **onFolderProcessed** event
  	       1. Call `buildRoutes()`
  	       1. Initialize `taxonomoy` for all pages
  	       1. Build `route` table for fast lookup
  	  1. Fire **onPagesInitialized** event
  	  1. Get current `page` via `dispatch()`
  	  1. If page not found, fire **onPageNotFound** event
  	  1. Fire **onPageInitialized** event
  	  1. Get Output with Twig's `processSite()` method
  	      ### Twig.php {.level-3}
  	      1. Fire **onTwigSiteVariables** event
  	      1. Set all Twig variables on the Twig object
  	      1. Set the template name based on file/header/extension information
  	      1. Call `render()` method
  	      1. Return resulting HTML
  	  1. Fire **onOutputGenerated** event
  	  1. Set the HTTP headers
  	  1. Echo the the output
  	  1. Flush the output buffers to the page
  	  1. Fire **onOutputRendered** event
      1. Connection to client is closed
      1. Fire **onShutdown** event

Whenever a page has its `content()` method called, the following lifecycle occurs:

* ### Page.php {.level-1}
    1. Fire **onPageContentRaw** event
    1. Process the page according to Markdown and Twig settings
    1. Fire **onPageContentProcessed** event

