---
title: Plugin Tutorial
page-toc:
  active: true
taxonomy:
    category: docs
---

Plugins are usually developed because there is a task that can not be completed with Grav's core functionality.

In this tutorial, we will create a plugin that helps Grav to deliver a random page to the user.  You have probably seen similar functionality on blog sites as a way to provide a random blog-post when you click a button.

! Because there is already a plugin that performs this job named `Random`, we'll call this test plugin `Randomizer`.

This feature is not possible **out-of-the-box**, but is **easily** provided via a plugin.  As is the case with a great many aspects of Grav, there is no _one-way_ to do this. Instead, you have many options.  We will cover just one approach...

## Randomizer Plugin Overview

For our plugin we will take the following approach:

1. Activate the plugin if a URI matches our configured 'trigger route'. (e.g. `/random`)

2. Create a filter so that only configured taxonomies are in the pool of random pages.  (e.g. `category: blog`)

3. Find a random page from our filtered pool, and tell Grav to use it for the page content.

OK! This sounds simple enough, right? So, let us get cracking!


## Step 1 - Install DevTools plugin

!! Previous versions of this tutorial required creating a plugin manually.  This whole process can be skipped thanks to our new **DevTools Plugin**

The first step in creating a new plugin is to **install the DevTools Plugin**.  This can be done in two ways.

#### Install via CLI GPM

* Navigate in the command line to the root of your Grav installation

[prism classes="language-bash command-line"]
bin/gpm install devtools
[/prism]

#### Install via Admin plugin

* After logging in, simply navigate to the **Plugins** section from the sidebar.
* Click the <i class="fa fa-plus"></i> **Add** button in the top right.
* Find **DevTools** in the list and click the <i class="fa fa-plus"></i> **Install** button.

## Step 2 - Create Randomizer plugin

For this next step you really do need to be in the [command line](/cli-console/command-line-intro) as the DevTools provide a couple of CLI commands to make the process of creating a new plugin much easier!

From the root of your Grav installation enter the following command:

[prism classes="language-bash command-line"]
bin/plugin devtools new-plugin
[/prism]

This process will ask you a few questions that are required to create the new plugin:

[prism classes="language-bash command-line" cl-output="2-9"]
bin/plugin devtools new-plugin
Enter Plugin Name: Randomizer
Enter Plugin Description: Sends the user to a random page
Enter Developer Name: Acme Corp
Enter Developer Email: contact@acme.co

SUCCESS plugin Randomizer -> Created Successfully

Path: /www/user/plugins/randomizer
[/prism]

The DevTools command tells you where this new plugin was created. This created plugin is fully functional but will not automatically have the logic to perform the function we wish.  We will have to modify it to suite our needs.

## Step 3 - Plugin basics

Now we've created a new plugin that can be modified and developed. Let's break it down and have a look at what makes up a plugin.  If you look in the `user/plugins/randomizer` folder you will see:

[prism classes="language-text"]
.
├── CHANGELOG.md
├── LICENSE
├── README.md
├── blueprints.yaml
├── randomizer.php
└── randomizer.yaml
[/prism]

This is a sample structure but some things are required:

### Required items to function

These items are critical and your plugin will not function reliably unless you include these in your plugin.

* **`blueprints.yaml`** - The configuration file used by Grav to get information on your plugin. It can also define a form that the admin can display when viewing the plugin details.  This form will let you save settings for the plugin. [This file is documented in the Forms chapter](/forms/blueprints).
* **`randomizer.php`** - This file will be named according to your plugin, but can be used to house any logic your plugin needs.  You can use any [plugin event hook](/plugins/event-hooks) to perform logic at pretty much any point in [Grav's lifecycle](/plugins/grav-lifecycle).
* **`randomizer.yaml`** - This is the configuration used by the plugin to set options the plugin might use. This should be named in the same way as the `.php` file.

### Required items for release

This items are required if you wish to release your plugin via GPM.

* **`CHANGELOG.md`** - A file that follows the [Grav Changelog Format](/advanced/grav-development#changelog-format) to show changes in releases.
* **`LICENSE`** - a license file, should probably be MIT unless you have a specific need for something else.
* **`README.md`** - A 'Readme' that should contain any documentation for the plugin.  How to install it, configure it, and use it.

## Step 4 - Plugin configuration

As we described in the **Plugin Overview**, we need to have a few configuration options for our plugin, so the `randomizer.yaml` file should look something like this:

[prism classes="language-yaml line-numbers"]
enabled: true
active: true
route: /random
filters:
    category: blog
[/prism]

This allows us to have multiple filters if we wish, but for now, we just want all content with the taxonomy `category: blog` to be eligible for the random selection.

All plugins must have the `enabled` option. If this is `false` in the site-wide configuration, your plugin 
will never be initialized by Grav. All plugins also have the `active` option. If this is `false` in the site-wide 
configuration, each page will need to activate your plugin. Note that multiple plugins also support `enabled`/`active` in
page frontmatter by using `mergeConfig`, detailed below. 

!!!! The Grav default install has taxonomy defined for `category` and `tag` by default.  This configuration can be modified in your `user/config/site.yaml` file.

Of course, as with all other configurations in Grav, it is advised not to touch this default configuration for day-to-day control. Rather, you should create an override in a file called `/user/config/plugins/randomizer.yaml` to house any custom settings.  This plugin-provided `randomizer.yaml` is really intended to set some sensible defaults for your plugin.

## Step 5 - Base plugin structure

The base plugin class structure will already look something like this:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class RandomizerPlugin
 * @package Grav\Plugin
 */
class RandomizerPlugin extends Plugin
{
 ...
}
[/prism]

We need to add a few `use` statements because we are going to use these classes in our plugin, and it saves space and makes the code more readable if we don't have to put the full namespace for each class inline.

Modify the `use` statements to look like this:

[prism classes="language-php line-numbers"]
use Grav\Common\Plugin;
use Grav\Common\Page\Collection;
use Grav\Common\Uri;
use Grav\Common\Taxonomy;
[/prism]

The two key parts of this class structure are:

1. Plugins need to have `namespace Grav\Plugin` at the top of the PHP file.
2. Plugins should be named in **titlecase** based on the name of the plugin with the string `Plugin` appended to the end, and should extend `Plugin`, hence the class name `RandomizerPlugin`.

## Step 6 - Subscribed events

Grav uses a sophisticated event system, and to ensure optimal performance, all plugins are inspected by Grav to determine which events the plugin is subscribed to.

[prism classes="language-php line-numbers"]
public static function getSubscribedEvents()
{
    return [
        'onPluginsInitialized' => ['onPluginsInitialized', 0]
    ];
}
[/prism]

In this plugin we are going to tell Grav we're subscribing to the `onPluginsInitialized` event.  This way we can use that event (which is the first event available to plugins) to determine if we should subscribe to other events.

## Step 7 - Determine if the plugin should run

The next step is to add a method to our `RandomizerPlugin` class to handle the `onPluginsInitialized` event so it only activates when a user tries to go to the route we have configured in our `randomizer.yaml` file.  Replace the current 'sample' plugin logic with the following:


[prism classes="language-php line-numbers"]
public function onPluginsInitialized()
{
    // Don't proceed if we are in the admin plugin
    if ($this->isAdmin()) {
        return;
    }

    $uri = $this->grav['uri'];
    $route = $this->config->get('plugins.randomizer.route');

    if ($route && $route == $uri->path()) {
        $this->enable([
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }
}
[/prism]

First, we get the **Uri object** from the **Dependency Injection Container**.  This contains all the information about the current URI, including the route information.

The **config object** is already part of the base **Plugin**, so we can simply use it to get the configuration value for our configured `route`.

Next, we compare the configured route to the current URI path. If they are equal, we instruct the dispatcher that our plugin will also listen to a new event: `onPageInitialized`.

By using this approach, we ensure we do not run through any extra code if we do not need to.  Practices like these will ensure your site runs as fast as possible.

## Step 8 - Display the random page

The last step of our plugin is to display the random page, and we can do that by adding the following method:

[prism classes="language-php line-numbers"]
/**
 * Send user to a random page
 */
public function onPageInitialized()
{
    $taxonomy_map = $this->grav['taxonomy'];

    $filters = (array) $this->config->get('plugins.randomizer.filters');
    $operator = $this->config->get('plugins.randomizer.filter_combinator', 'and');

    if (count($filters)) {
        $collection = new Collection();
        $collection->append($taxonomy_map->findTaxonomy($filters, $operator)->toArray());
        if (count($collection)) {
            unset($this->grav['page']);
            $this->grav['page'] = $collection->random()->current();
        }
    }
}
[/prism]

This method is a bit more complicated, so we'll go over what's going on:

1. First, we get the **Taxonomy object** from the **Grav DI Container** and assign it to a variable `$taxonomy_map`.

2. Then we retrieve the array of filters from our plugin configuration.  In our configuration this is an array with 1 item: ['category' => 'blog'].

3. Check to ensure we have filters, then create a new `Collection` in the `$collection` variable to store our pages.

4. Append all pages that match the filter to our `$collection` variable.

5. Unset the current `page` object that Grav knows about.

6. Set the current `page` to a random item in the collection.


## Step 9 - Cleanup

The example plugin that was created with the **DevTools** plugin, used an event called `onPageContentRaw()`. This event is not used in our new plugin, so we can safely remove the entire function.

## Step 10 - Final plugin class

And that is all there is to it! The plugin is now complete.  Your complete plugin class should look something like this:

[prism classes="language-php line-numbers"]
<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Collection;
use Grav\Common\Uri;
use Grav\Common\Taxonomy;

/**
 * Class RandomizerPlugin
 * @package Grav\Plugin
 */
class RandomizerPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $uri = $this->grav['uri'];
        $route = $this->config->get('plugins.randomizer.route');

        if ($route && $route == $uri->path()) {
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 0]
            ]);
        }
    }

    /**
     * Send user to a random page
     */
    public function onPageInitialized()
    {
        $taxonomy_map = $this->grav['taxonomy'];

        $filters = (array) $this->config->get('plugins.randomizer.filters');
        $operator = $this->config->get('plugins.randomizer.filter_combinator', 'and');

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
[/prism]

If you followed along, you should have a fully functional **Randomizer** plugin enabled for your site.  Just point your browser to the `http://yoursite.com/random`, and you should see a random page.  You can also download the original **Random**  plugin directly from the [Plugins Download](https://getgrav.org/downloads/plugins) section of the [getgrav.org](https://getgrav.org/downloads/plugins) site.

## Merging Plugin and Page Configuration

One popular technique that is used in a variety of plugins is the concept of merging the plugin configuration (either default or overridden user config) with page-level configuration.  This means you can set **site-wide** configuration, and then have a specific configuration for a given page as needed.  This provides a lot of power and flexibility for your plugin.

In recent versions of Grav, a helper method was added to perform this functionality automatically rather than you having to code that logic yourself.  The **SmartyPants** plugin provides a good example of this functionality in action:

[prism classes="language-php line-numbers"]
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
[/prism]

## Implementing CLI in your Plugin

Plugins have also the capability of integrating with the `bin/plugin` command line to execute tasks. You can follow the [advanced tutorial](/advanced/grav-cli-plugin) if you desire to implement such functionality.
