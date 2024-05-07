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
1. Check PHP version to ensure we're running at least version **7.1.3**
1. Class loader initialization
1. Obtain Grav instance
    <div class="level level-2" markdown=1>
    ### Grav.php
    1. No instance exists, so call `load()`
    1. Add `loader`
    1. Add and initialize `debugger`
    1. Add `grav` (deprecated)
    1. Register Services
        1. Accounts Service Provider
            1. Add `accounts`
            1. Add `users` (deprecated)
        1. Assets Service Provider
            1. Add `assets`
        1. Backups Service Provider
            1. Add `backups`
        1. Config Service Provider
            1. Add `setup`
            1. Add `blueprints`
            1. Add `config`
            1. Add `languages`
            1. Add `language`
        1. Error Service Provider
            1. Add `error`
        1. Filesystem Service Provider
            1. Add `filesystem`
        1. Inflector Service Provider
            1. Add `inflector`
        1. Logger Service Provider
            1. Add `log`
        1. Output Service Provider
            1. Add `output`
        1. Pages Service Provider
            1. Add `pages`
            1. Add `page`
        1. Request Service Provider
            1. Add `request`
        1. Scheduler Service Provider
            1. Add `scheduler`
        1. Session Service Provider
            1. Add `session`
            1. Add `messages`
        1. Streams Service Provider
            1. Add `locator`
            1. Add `streams`
        1. Task Service Provider
            1. Add `task`
            1. Add `action`
        1. Other Service Providers
            1. Add `browser`
            1. Add `cache`
            1. Add `events`
            1. Add `exif`
            1. Add `plugins`
            1. Add `taxonomy`
            1. Add `themes`
            1. Add `twig`
            1. Add `uri`
    </div>
1. call `Grav::process()`
    <div class="level level-2" markdown="1">
    ### Grav.php
    1. Run Configuration Processor
        1. Initialize `$grav['config']`
        1. Load plugins and their configuration `$grav['plugins']`
    1. Run Logger Processor
        1. Initialize `$grav['log']`
    1. Run Errors Processor
        1. Initialize `$grav['errors']`
        1. Registers PHP error handlers
    1. Run Debugger Processor
        1. Initialize `$grav['debugger']`
    1. Run Initialize Processor
        1. Start output buffering
        1. Initialize the timezone
        1. Initialize `$grav['session']` if `system.session.initialize` is true
        1. Initialize `$grav['uri']`
            1. Add `$grav['base_url_absolute']`
            1. Add `$grav['base_url_relative']`
            1. Add `$grav['base_url']`
        1. Redirect if `system.pages.redirect_trailing_slash` is true and trailing slash in URL
    1. Run Plugins Processor
        1. Initialize `$grav['accounts']`
        1. Initialize `$grav['plugins']`
        1. Fire **onPluginsInitialized** event
    1. Run Themes Processor
        1. Initialize `$grav['themes']`
        1. Fire **onThemeInitialized** event
    1. Run Request Processor
        1. Initialize `$grav['request']`
        1. Fire **onRequestHandlerInit** event with [request, handler]
        1. If response is set inside the event, stop further processing and output the response
    1. Run Tasks Processor
        1. If request has attribute _controller.class_ and either _task_ or _action_:
            1. Run the controller
            1. If `NotFoundException`: continue (check task and action)
            1. If response code 418: continue (ignore task and action)
            1. Else: stop further processing and output the response
        1. If _task_:
            1. Fire **onTask** event
            1. Fire **onTask.[TASK]** event
        1. If _action_:
            1. Fire **onAction** event
            1. Fire **onAction.[ACTION]** event
    1. Run Backups Processor
        1. Initialize `$grav['backups']`
        1. Fire **onBackupsInitialized** event
    1. Run Scheduler Processor
        1. Initialize `$grav['scheduler']`
        1. Fire **onSchedulerInitialized** event
    1. Run Assets Processor
        1. Initialize `$grav['assets']`
        1. Fire **onAssetsInitialized** event
    1. Run Twig Processor
        1. Initialize `$grav['twig']`
            <div class="level level-3" markdown="1">
            ### Twig.php
            1. Set Twig template paths based on configuration
            1. Handle language templates if available
            1. Fire **onTwigTemplatePaths** event
            1. Fire **onTwigLoader** event
            1. Load Twig configuration and loader chain
            1. Fire **onTwigInitialized** event
            1. Load Twig extensions
            1. Fire **onTwigExtensions** event
            1. Set standard Twig variables (config, uri, taxonomy, assets, browser, etc)
            </div>
    1. Run Pages Processor
        1. Initialize `$grav['pages']`
            <div class="level level-3" markdown="1">
            ### Pages.php
            1. Call `buildPages()`
            1. Check if cache is good
            1. If **cache is good** load pages date from
            1. If **cache is not good** call `recurse()`
            1. Fire **onBuildPagesInitialized** event in `recurse()`
            1. If a `.md` file is found:
                <div class="level level-4" markdown="1">
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
        1. Fire **onPagesInitialized** event with [pages]
        1. Fire **onPageInitialized** event with [page]
        1. If page is not routable:
            1. Fire **onPageNotFount** event with [page]
        1. If _task_:
            1. Fire **onPageTask** event with [task, page]
            1. Fire **onPageTask.[TASK]** event with [task, page]
        1. If _action_:
            1. Fire **onPageAction** event with [action, page]
            1. Fire **onPageAction.[ACTION]** event with [action, page]
    1. Run Debugger Assets Processor
        1. Add the debugger CSS/JS to the assets
    1. Run Render Processor
        1. Initialize `$grav['output']`
        1. If `output` instanceof `ResponseInterface`:
            1. Stop further processing and output the response
        1. Else:
            1. Render page with Twig's `processSite()` method
                <div class="level level-3" markdown="1">
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
            1. Echo the output into output buffer
            1. Fire **onOutputRendered** event
            1. Build _Response_ object
            1. Stop further processing and output the response
    1. Output HTTP header and body
    1. Render debugger (if enabled)
    1. Shutdown
        1. Close session
        1. Close connection to client
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
