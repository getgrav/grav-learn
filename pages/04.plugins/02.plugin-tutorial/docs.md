---
title: Plugin Tutorial
taxonomy:
    category: docs
---

Plugins are usually developed because there is a problem that needs to be solved and that cannot be solved with the core functionality of Grav itself.  In this tutorial, we will create a plugin that helps Grav to deliver a random page to the user.  You have probably seen similar functionality on blog sites as a way to provide a random blog-post when you click a button.

This functionality is not possible **out-of-the-box**, but is **easily** provided via a plugin.  As is the case with a great many aspects of Grav, there is no _one-way_ to do this, but instead, you have many options.  

## Random Plugin Overview

For our plugin we will take the following approach:

1. Activate the plugin if a URI matches our configured 'trigger route'. e.g. `/random`

2. Create a filter so that only configured taxonomies are in the pool of random pages.  e.g. `category: blog`

3. Find a random page from our filtered pool, and tell Grav to use it for the page content.

OK, sounds simple enough, so let's get cracking!

## Step 1 - Base Plugin Setup

Before we can start writing our actual plugin logic, we need to create the base setup for the plugin.

1. Follow the [Installation instruction][../basics/installation] and ensure you have Grav properly installed.

2. Create a folder called `random` within the `user/plugins` folder of your Grav site to provide the basis of our new plugin.

3. In your new `user/plugins/random` folder you just created, we will create two files, one for the plugin code, and one for the default configuration:

	```
	random.php
	random.yaml
	```

## Step 2 - Plugin Configuration

As we described in the **Plugin Overview**, we need to have a few configuration options for our plugin, so the `random.yaml` file should look something like this:

```
enabled: true
route: /random
filters:
    category: blog
```

This allows us to have multiple filters if we wish, but for now, we just want all content with the taxonomy 'category: blog' to be eligible for the random selection.

Of course, as with all other configurations in Grav, it is advised not to touch this default configuration for day-to-day control, rather, you should create an override in a file called `/user/config/plugins/random.yaml` to house any custom settings.  This plugin-provided `random.yaml` is really intended to set some sensible defaults for your plugin.

## Step 3 - Base Plugin Structure

The base plugin class structure will need to look something like this:

```
<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Registry;
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

## Step 4 - Plugin Properties

Next we should add some class properties to house key variables that will be used by the plugin methods:

```
class RandomPlugin extends Plugin
{
    protected $active = false;
    protected $uri;
    protected $filters = array();
}
```

## Step 5 - Determine if the Plugin is Active

The next step is to add a method to our `RandomPlugin` class to activate the plugin only when a user tries to go to the route we have configured in our `random.yaml` file:

```
	public function onAfterInitPlugins()
    {
        $this->uri = Registry::get('Uri');
        $route = $this->config->get('plugins.random.route');

        if ($route && $route == $this->uri->path()) {
            $this->active = true;
        }
    }
```

First we get the **Uri object** from the **Grav Registry**.  This contains all the information about the current URI including the route information.

The **config object** is already part of the base **Plugin** so we can simple use it to get the configuration value for our configured `route`.

Next we compare the configured route to the current URI path, if they are equal, we set the `$active` property on the plugin to true.

By using this approach, we ensure we don't run through any extra code if we don't need to.  It's practices like this that will ensure your site runs as fast as possible.

## Step 6 - Display the Random Page

The last step of our plugin is to display the random page, and we can do that with the following method:

```
	public function onAfterGetPage()
    {
        if ($this->active) {
            $taxonomy_map = Registry::get('Taxonomy');

            $filters = (array) $this->config->get('plugins.random.filters');

            if (count($filters) > 0) {
                $collection = new Collection();
                foreach ($filters as $taxonomy => $items) {
                    if (isset($items)) {
                        $collection->append($taxonomy_map->findTaxonomy([$taxonomy => $items])->toArray());
                    }
                }

                $grav = Registry::get('Grav');
                $grav->page = $collection->random()->current();
            }
        }
    }
```

This method is a bit more complicated, so we'll go over what's going on:

1. If the plugin is active we will continue processing

2. Next, we get the **Taxonomy object** from the **Grav registry** and assign it to a variable `$taxonomy_map`

3. Then we retrieve the array of filters from our plugin configuration.  In our configuration this is an array with 1 item: ['category' => 'blog']

4. Check to ensure we have filters, then create a new `Collection` in the `$collection` variable to store our pages.

5. Loop over our filters and append all pages that match the filter to our `$collection` variable.

6. Get the core **Grav object** from the **Grav Registry** and assign it to the variable `$grav`

7. Set the current page to a random item in the collection.


## Step 7 - Final Plugin Class

And that's all there is to it! The plugin is now complete.  Your complete plugin class should look something like this:

```
<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Registry;
use Grav\Common\Uri;
use NexGrav\Common\Taxonomy;

class RandomPlugin extends Plugin
{
    protected $active = false;
    protected $uri;
    protected $filters = array();

    public function onAfterInitPlugins()
    {
        $this->uri = Registry::get('Uri');
        $route = $this->config->get('plugins.random.route');

        if ($route && $route == $this->uri->path()) {
            $this->active = true;
        }
    }

    public function onAfterGetPage()
    {
        if ($this->active) {
            $taxonomy_map = Registry::get('Taxonomy');

            $filters = (array) $this->config->get('plugins.random.filters');

            if (count($filters) > 0) {
                $collection = new Collection();
                foreach ($filters as $taxonomy => $items) {
                    if (isset($items)) {
                        $collection->append($taxonomy_map->findTaxonomy([$taxonomy => $items])->toArray());
                    }
                }

                $grav = Registry::get('Grav');
                $grav->page = $collection->random()->current();
            }
        }
    }
}
```

You can also download this plugin directly from the [Plugins Download](http://getgrav.org/downloads/plugins#extras) section of the [getgrav.org](http://getgrav.org/downloads/plugins#extras) site. 
