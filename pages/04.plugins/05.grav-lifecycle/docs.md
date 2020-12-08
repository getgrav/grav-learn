---
title: Grav Lifecycle
body_classes: lifecycle
taxonomy:
    category: docs
markdown:
    extra: true
---

It is often useful to know how Grav processes in order to fully understand how best to extend Grav via plugins. This is the Grav lifecycle:

<div class="level level-1" markdown=1>
### index.php
1. Check PHP version to ensure we're running at least version **5.5.9**
1. Class loader initialization
1. Obtain Grav instances
    <div class="level level-2" markdown=1>
    ### Grav.php
    1. No instance exists, so call `load()`
    1. Add `grav`
    1. Initialize the debugger and add it to `debugger`
    1. Register the `log` handler
    1. Register the `error` handler
    1. Add `uri`
    1. Add `task`
    1. Add `events`
    1. Add `cache`
    1. Add `session`
    1. Add `plugins`
    1. Add `themes`
    1. Add `twig`
    1. Add `taxonomy`
    1. Add `language`
    1. Add `pages`
    1. Add `assets`
    1. Add `page`
    1. Add `output`
    1. Add `browser`
    1. Add `base_url_absolute`
    1. Add `base_url_relative`
    1. Add `base_url`
    1. Register the `stream` handler
    1. Register the `config` handler
    </div>
1. call `Grav::process()`
    <div class="level level-2" markdown=1>
    ### Grav.php
    1. Initialize the configuration
    1. Initialize the Session
    1. Initialize the Uri object
    1. Initialize the error handler
    1. Initialize the debugger
    1. Start output buffering
    1. Initialize the timezone
    1. Initialize the `plugins`
    1. Fire **onPluginsInitialized** event
    1. Initialize the theme
    1. Fire **onThemeInitialized** event
    1. Fire **onTask[TASK]** event
    1. Initialize `assets`
    1. Fire **onAssetsInitialized** event
    1. Initialize `twig`
        <div class="level level-3" markdown=1>
        ### Twig.php
        1. Set Twig template paths based on configuration
        1. Handle language templates if available
        1. Fire **onTwigTemplatePaths** event
        1. Load Twig configuration and loader chain
        1. Fire **onTwigInitialized** event
        1. Load Twig extensions
        1. Fire **onTwigExtensions** event
        1. Set standard Twig variables (config, uri, taxonomy, assets, browser, etc)
        </div>
    1. Initialize `pages`
        <div class="level level-3" markdown=1>
        ### Pages.php
        1. Call `buildPages()`
        1. Check if cache is good
        1. If **cache is good** load pages date from cache
        1. If **cache is not good** call `recurse()`
        1. Fire **onBuildPagesInitialized** event in `recurse()`
        1. If a `.md` file is found:
            <div class="level level-4" markdown=1>
            ### Page.php
            1. Call `init()` to load the file details
            1. Set the `filePath`, `modified`, `id`
            1. Call `header()` to initialize the header variables
            1. Call `slug()` to set the URL slug
            1. Call `visible()` to set visible state
            1. Set `modularTwig()` status based on if folder starts with `_`
            </div>
        1. Fire **onPageProcessed** event
        1. If a `folder` found `recurse()` the children
        1. Fire **onFolderProcessed** event
        1. Call `buildRoutes()`
        1. Initialize `taxonomy` for all pages
        1. Build `route` table for fast lookup
        </div>
    1. Fire **onPagesInitialized** event
    1. Fire **onPageInitialized** event
    1. Add the debugger CSS/JS to the assets
    1. Get Output with Twig's `processSite()` method
        <div class="level level-3" markdown=1>
        ### Twig.php
        1. Fire **onTwigSiteVariables** event
        1. Get the page output
        1. Fire **onTwigPageVariables**, also called for each modular subpage
        1. If a page is not found or not routable, first fire the **onPageFallBackUrl** event to see if we have a fallback for a media asset and then fire **onPageNotFound** if not
        1. Set all Twig variables on the Twig object
        1. Set the template name based on file/header/extension information
        1. Call `render()` method
        1. Return resulting HTML
        </div>
    1. Fire **onOutputGenerated** event
    1. Set the HTTP headers
    1. Echo the output
    1. Flush the output buffers to the page
    1. Fire **onOutputRendered** event
    1. Connection to client is closed
    1. Fire **onShutdown** event
    </div>
</div>

Whenever a page has its `content()` method called, the following lifecycle occurs:

<div class="level level-1" markdown="1">
### Page.php
1. If content is **NOT** cached:
    1. Fire **onPageContentRaw** event
    1. Process the page according to Markdown and Twig settings. Fire **onMarkdownInitialized** event
    1. Fire **onPageContentProcessed** event
1. Fire **onPageContent** event
</div>
