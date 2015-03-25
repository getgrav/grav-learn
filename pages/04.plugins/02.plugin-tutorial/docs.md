---
title: Plugin Tutorial
taxonomy:
    category: docs
---

Plugins are usually developed because there is a task that can not be completed with Grav's core functionality.

In this tutorial, we will create a plugin that helps Grav to deliver a random page to the user.  You have probably seen similar functionality on blog sites as a way to provide a random blog-post when you click a button.

This feature is not possible **out-of-the-box**, but is **easily** provided via a plugin.  As is the case with a great many aspects of Grav, there is no _one-way_ to do this. Instead, you have many options.  We will cover just one approach...

## Random Plugin Overview

For our plugin we will take the following approach:

1. Activate the plugin if a URI matches our configured 'trigger route'. (e.g. `/random`)

2. Create a filter so that only configured taxonomies are in the pool of random pages.  (e.g. `category: blog`)

3. Find a random page from our filtered pool, and tell Grav to use it for the page content.

OK! This sounds simple enough, right? So, let us get cracking!

### Step 1 - Base plugin setup

Before we can start writing our actual plugin logic, we need to create the base setup for the plugin.

1. Follow the [Installation instruction](../../basics/installation) and ensure you have Grav properly installed.

2. Create a folder called `random` within the `user/plugins` folder of your Grav site to provide the basis of our new plugin.

3. In your new `user/plugins/random` folder you just created, we will create two files, one for the plugin code, and one for the default configuration:

	```
	random.php
	random.yaml
	```

### Step 2 - Plugin configuration

As we described in the **Plugin Overview**, we need to have a few configuration options for our plugin, so the `random.yaml` file should look something like this:

```
enabled: true
route: /random
filters:
    category: blog
```

This allows us to have multiple filters if we wish, but for now, we just want all content with the taxonomy `category: blog` to be eligible for the random selection.

>>>> The Grav default install has taxonomy defined for `category` and `tag` by default.  This configuration can be modified in your `user/config/site.yaml` file.

Of course, as with all other configurations in Grav, it is advised not to touch this default configuration for day-to-day control. Rather, you should create an override in a file called `/user/config/plugins/random.yaml` to house any custom settings.  This plugin-provided `random.yaml` is really intended to set some sensible defaults for your plugin.

### Step 3 - Base plugin structure

The base plugin class structure will need to look something like this:

```
<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Common\Taxonomy;

class RandomPlugin extends Plugin
{

}
```

We have added a bunch of `use` statements because we are going to use these classes in our plugin, and it saves space and makes the code more readable if we don't have to put the full namespace for each class in-line.

The two key parts of this class structure are:

1. Plugins need to have `namespace Grav\Plugin` at the top of of the PHP file.
2. Plugins should be named in **titlecase** based on the name of the plugin with the string `Plugin` appended to the end, and should extend `Plugin`.

### Step 4 - Subscribed events

Grav uses a sophisticated event system, and to ensure optimal performance, all plugins are inspected by Grav to determine which events the plugin is subscribed to.

```
public static function getSubscribedEvents() {
    return [
        'onPluginsInitialized' => ['onPluginsInitialized', 0],
    ];
}
```

In this plugin we are going to tell Grav we're subscribing to the `onPluginsInitialized` event.  This way we can use that event (which is the first event available to plugins) to determine if we should subscribe to other events.

### Step 5 - Determine if the plugin should run

The next step is to add a method to our `RandomPlugin` class to handle the `onPluginsInitialized` event so it only activates when a user tries to go to the route we have configured in our `random.yaml` file:

```
public function onPluginsInitialized()
{
    /** @var Uri $uri */
    $uri = $this->grav['uri'];
    $route = $this->config->get('plugins.random.route');

    if ($route && $route == $uri->path()) {
        $this->enable([
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }
}
```

First, we get the **Uri object** from the **Dependency Injection Container**.  This contains all the information about the current URI, including the route information.

The **config object** is already part of the base **Plugin**, so we can simply use it to get the configuration value for our configured `route`.

Next, we compare the configured route to the current URI path. If they are equal, we instruct the dispatcher that our plugin will also listen to a new event: `onPageInitialized`.

By using this approach, we ensure we do not run through any extra code if we do not need to.  Practices like these will ensure your site runs as fast as possible.

### Step 6 - Display the random page

The last step of our plugin is to display the random page, and we can do that with the following method:

```
public function onPageInitialized()
{
    $taxonomy_map = $this->grav['taxonomy'];

    $filters = (array) $this->config->get('plugins.random.filters');
    $operator = $this->config->get('plugins.random.filter_combinator', 'and');

    if (count($filters)) {
        $collection = new Collection();
        $collection->append($taxonomy_map->findTaxonomy($filters, $operator)->toArray());
        if (count($collection)) {
            unset($this->grav['page']);
            $this->grav['page'] = $collection->random()->current();
        }
    }
}
```

This method is a bit more complicated, so we'll go over what's going on:

1. First, we get the **Taxonomy object** from the **Grav DI Container** and assign it to a variable `$taxonomy_map`.

2. Then we retrieve the array of filters from our plugin configuration.  In our configuration this is an array with 1 item: ['category' => 'blog'].

3. Check to ensure we have filters, then create a new `Collection` in the `$collection` variable to store our pages.

4. Append all pages that match the filter to our `$collection` variable.

5. Unset the current `page` object that Grav knows about.

6. Set the current `page` to a random item in the collection.


### Step 7 - Final plugin class

And that is all there is to it! The plugin is now complete.  Your complete plugin class should look something like this:

```
<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Common\Taxonomy;

class RandomPlugin extends Plugin
{
    public static function getSubscribedEvents() {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized()
    {
        $uri = $this->grav['uri'];
        $route = $this->config->get('plugins.random.route');

        if ($route && $route == $uri->path()) {
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 0]
            ]);
        }
    }

    public function onPageInitialized()
    {
        $taxonomy_map = $this->grav['taxonomy'];

        $filters = (array) $this->config->get('plugins.random.filters');
        $operator = $this->config->get('plugins.random.filter_combinator', 'and');

        if (count($filters)) {
            $collection = new Collection();
            $collection->append($taxonomy_map->findTaxonomy($filters, $operator)->toArray());
            if (count($collection)) {
                unset($this->grav['page']);
                $this->grav['page'] = $collection->random()->current();
            }
        }
    }
}
```

If you followed along, you should have a fully functional **Random** plugin enabled for your site.  Just point your browser to the `http://yoursite.com/random`, and you should see a random page.  You can also download this plugin directly from the [Plugins Download](http://getgrav.org/downloads/plugins) section of the [getgrav.org](http://getgrav.org/downloads/plugins) site.

### Merging Plugin and Page Configuration

One popular technique that is used in a variety of plugins is the concept of merging the plugin configuration (either default or overridden user config) with page-level configuration.  This means you can set **site-wide** configuration, and then have a specific configuration for a given page as needed.  This is provides a lot of power and flexibility for your plugin.

In recent versions of Grav, a helper method was added to perform this functionality automatically rather than you having to code that logic yourself.  The **SmartyPants** plugin provides a good example of this functionality in action:

```
public function onPageContentProcessed(Event $event)
{
    $page = $event['page'];
    $config = $this->mergeConfig($page);

    if ($config->get('process_content')) {
        $page->setRawContent(\Michelf\SmartyPants::defaultTransform(
            $page->getRawContent(),
            $config->get('options')
        ));
    }
}
```
