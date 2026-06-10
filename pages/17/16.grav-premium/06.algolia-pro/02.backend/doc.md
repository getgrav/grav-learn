---
title: Algolia Pro Backend
description: Configure and create custom indexes for your site
taxonomy:
    category: docs
---

# Algolia Pro Backend

## Backend Configuration

After you have configured your **Plugin Options** and hae entered the required `Application ID`, `Search only API key`, and the `Admin API Key`, you are ready to configure your indexes.  Everything in Algolia Pro is based on indexes, so it's critical these are configured as you need.  To review the default configuration, click on the **Algolia Indexes** top tab.  Here you can see the list of available indexes.

By default, there are two included indexes, but you are free to create more as you need.

![Algolia Indexes](algolia-indexes.png?class=shadow)

There are many configuration options available per-index. This allows you to have completely different configurations for different indexes.  You can have multiple indexes of the same type, but perhaps with different configurations.  Algolia Pro is supremely flexible in this regard.

![Grav Pages Options 1](grav-pages-options-1.png?class=shadow)

#### Index Options

* **Enabled** → Enables or disables the index.  Useful if you are developing an index and don't want to not use the index, but keep the settings.

* **Index Name** → The name for this index that should be unique and is used in combination with the **Base Index Name** to form your full index name on the Algolia end.

* **Index Type** → The `Grav Page Search` loops through all your published pages and indexes the content directly.  It can also index through page headers, taxonomy, etc.  This is the fastest approach and easiest to get started with.  It is suitable for most situations.  `Crawl Pages Search` is also available and rather than index your site's pages, it will make use of the **Sitemap** plugin to generate a list of all available pages in your site, and make HTTP requests to each page, and then crawl the page utilizing CSS selctors to isolate the parts of the page that to be indexed.

#### Grav Pages Index

![Grav Pages Options 2](grav-pages-options-2.png?class=shadow)

The first type of index uses the `algolia-grav-pages` index type.  It deals directly with the pages in your Grav site.  This is the preferred index option for 99% of your indexing needs for Grav because most content relevant for searching is contained in your page content, and this is preconfigured to work **out-of-the-box**.

* **Pages Filters** → The only option here is the Pages filter which defines the collection configuration to index.  The default option is `root@.descendants`, but you can use any valid Grav collection definition. See [Page Collections](https://learn.getgrav.org/17/content/collections#page-collections) for more information.

#### Crawl Pages Search

![Grav Pages Options 3](grav-pages-options-3.png?class=shadow)

The `algolia-crawl-pages` search type is a fallback approach to use when your content is not clearly defined in page content, or perhaps is coming from an external API source.  Another reason to use this is if your page is built with extensive use of custom page headers, but does **not** use modular pages.

> [!NOTE]
> If you use modular pages, even if your content is coming from custom page headers, regular page indexing is usually the best approach because the final page content will be rendered via the modular twig template.

* **Body Selectors** → These CSS body selectors represent the HTML elements that shoud be indexed by the crawler.  This is important to configure correctly for your site/theme because each site is different.  Also you don't want to index the entire `<body>` element as this often contains navigation or footers that would be the same for most pages on your site.  This will impact your search results in a negative fashion.  For this reason it's important to either add a new ID or class to your theme's output to **isolate the content area only**.

#### Core Options

![Grav Pages Options 4](grav-pages-options-4.png?class=shadow)

This section and all the subsequent sections are common to both types of index.

* **Search Class** → The PHP class that this index should use.  By default this should be either `Grav\Plugin\AlgoliaPro\GravPageSearch` or `Grav\Plugin\AlgoliaPro\CrawlPageSearch`.  But this is configurable if you have modified the Search Class.

* **Distinct Field** → This is the field that Algolia will use to determine the uniqueness/distinctiveness of the indexed entry. `url` is usually the best option for this.  So don't change this unless you know what you are doing.

* **Searchable Fields** → These are the fields that should be indexed by Algolia.  The order is also important as the fields at the top of the list will be scored higher by Algolia than the fields at the bottom.

> [!NOTE]
> The searchable fields is used by **Algolia only**.  If you want to index another header field in your content, you need to read the section on [Customization via Grav event](#customization-via-grav-event-basic) below.

#### Search Parameters

![Grav Pages Options 5](grav-pages-options-5.png?class=shadow)

* **Hits per Page** → The default number of hits to return for any search. With the Algolia Pro frontend, you can enable paging to get more results.  It will return another `20` pages at a time by default.

* **Distinct** → Used by Algolia to determine if a single (distinct) result should be returned for a particular page.  If you want to return multiple results for a single page, disable this option.

* **Snippet Ellipsis Text** → The characters to use to show that there is more content available.

* **Attributes to Snippet** → The fields that should be returned as a snippet. This is most useful for large fields such as `content` and the format is `<field_name>:<num_of_chars>`.

#### Content Parameters

![Grav Pages Options 6](grav-pages-options-6.png?class=shadow)

* **Valid Headers** → The HTML headers that should be indexed and treated as anchor targets. By default, this is set to `h1`, `h2`, and `h3` as these represent the most relevant headers. These serve as anchor targets (e.g. `/your-page#some-internal-section`) to link directly to if relevant content is found in the vicinity of these headers.   This is particular useful when dealing with documentation where would prefer to link directly to the relevant section in a page rather than just to the page itself.

* **Chunk Size** → Algolia has a hard limit on the size of a record.
  ```
  For Standard and Premium plans:
    100 KB for any individual record
    and 10 KB average record size across all records
  ```
  Because of this **Algolia Pro** for Grav needs to **chunk** a single page into multiple records.  This also allows for more specific results to be returned when queried. The default is `1000` characters, but if you get errors indexing because the record is too large, you can try reducing this number.  Note that the smaller the number, the more records generated, and this will cause you to reach your Algolia account limits faster.

> [!NOTE]
> headers are also indexed as part of content, but they will be treated like other text unless they are configured here.

#### User Interface Options

This section and subsequent configuration sections are covered in the [Frontend documentation](../frontend).

[![Frontend Docs](../frontend-docs.png?class=image-shadow,subdocs&cropResize=350)](../frontend)

## Basic Usage Tutorial

To test the default behavior, we have installed "algolia-pro" plugin and also installed the "page-toc" plugin that provides support for page header anchors.  Algolia Pro will make use of any header anchors it finds, and will even link directly to them if it finds a CSS `id` on a page header.  This functionality is provided by [Page TOC](https://github.com/trilbymedia/grav-plugin-page-toc?target=_blank) plugin and defaults to adding anchors to headers in the page content from H1 to H6 level. This can be fully configured by modifying the settings in the [Page TOC](https://github.com/trilbymedia/grav-plugin-page-toc?target=_blank) plugin, or even at the page level if you require unique anchor settings per-page.

For this first example, we created a simple page utilizing some content from the Grav Learn documentation.  Our page looks like this:

```markdown
---
title: Home
body_classes: title-center title-h1h2
---

# What is Grav?
## and why you will love using it...

Grav is a **Fast**, **Simple**, and **Flexible** file-based Web-platform. There is **Zero** installation required.  Just extract the ZIP archive, and you are already up and running.  Although Grav follows principles similar to other flat-file CMS platforms, it has a different design philosophy than most.

The name **Grav** is just a shortened version of the word **Gravity**. The shared namespace of our platform and a movie starring Sandra Bullock is pure coincidence! More importantly, gravity is also a fundamental physical principle that describes the forces of attraction between objects. Frankly, the name was chosen as a temporary "codename" for the project, and it just stuck.

The underlying architecture of Grav is built using well established and _best-in-class_ technologies. This is to ensure that Grav is simple to use and easy to extend. Some of these key technologies include:

* [Twig Templating](https://twig.symfony.com/): for powerful control of the user interface
* [Markdown](https://en.wikipedia.org/wiki/Markdown): for easy content creation
* [YAML](https://yaml.org): for simple configuration
* [Parsedown](https://parsedown.org/): for fast Markdown and Markdown Extra support
* [Doctrine Cache](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/caching.html): for performance
* [Pimple Dependency Injection Container](https://pimple.symfony.com/): for extensibility and maintainability
* [Symfony Event Dispatcher](https://symfony.com/doc/current/components/event_dispatcher.html): for plugin event handling
* [Symfony Console](https://symfony.com/doc/current/components/console.html): for CLI interface
* [Gregwar Image Library](https://github.com/Gregwar/Image): for dynamic image manipulation

## Grav's Place in the Universe

There are many powerful open source CMS solutions for building complex websites.  Some of the more commonly used ones are [Joomla](https://joomla.org), [WordPress](https://wordpress.org), and [Drupal](https://drupal.org). The downside of these platforms is that they have a steep learning curve associated with them. This requires a significant amount of your time - and this may be the time that you do not have.

These platforms provide a wealth of features and functionality that you can extend with a wide variety of open source and proprietary plug-ins and themes.  These extensions and themes are themselves often feature-packed, requiring more knowledge and time on the part of the developer yet.

In the end, you often find yourself creating a website that requires many plugins and extensions from many different vendors. This can make your design overly complicated and difficult to maintain over the long term.

## Grav is Different

Grav tackles the problem differently.  It focuses primarily on your content and turns your content structure into a navigable site.  The underpinnings of Grav are simple, yet via extensive **events**, you have complete control over every step in the Grav workflow.

This solution allows simple plugins to quickly and easily add powerful functionality. Using **Grav** also leads to a rapid development environment with an installation process that takes seconds, including a straightforward content creation method with a minimal learning curve. All of this contributes to making Grav friendly to the designer, the developer, and the end user.

To get a basic site up-and-running requires minimal Web development experience. If you dig a little deeper, you will discover that there is very little Grav cannot accomplish.

## Grav Logos and Press Information

You can find a summary about Grav, including **Grav logos** and **press information**, on our [media page](https://getgrav.org/media).

!!! The simplest way to navigate the documentation is to use the **Previous** and **Next** arrows (<i class="fa fa-angle-left"></i> | <i class="fa fa-angle-right"></i>) at the top of each page. You can see your progress represented by the check marks (<i class="fa fa-check-circle"></i>) in the sidebar.
```

### Indexing with the CLI

As you can see it's a simple Grav page with a `title` and a custom header for setting some `body_classes`. The content is standard markdown with a mix of headers and text. After we've entered the **Algolia API details** in the plugin configuration, we'll leave the rest of the defaults as-is.  We'll use the **Grav Page Search** type with default settings. To index this page from the CLI you can just type:

![Index Pages](index-pages.png?class=shadow)

### Querying with the CLI

Now this single page is indexed.  We can check to make sure that we get results by running a simple query from the CLI:

![Query Tackles](query-tackles.png?class=shadow)

As you can see, it found a single result which was expected.  Also you can see that it found a specific entry and actually provided the page title ("Home") as well as the closest linkable title ("Grav is Different") and the link to this title's anchor: `/#grav-is-different`. I think you'll agree this is a highly accurate and useful result, just as we would expect.

Let's try another less exact query:

![Query tack](query-tack.png?class=shadow)

This time we search for "tack" and two results were found, the first result is the same as we saw before, but this time it also found a result where the similar word "pack" was found in "feature-packed".  It's obviously not as good a match as the first result, but this is Algolia's smart AI-powered search returning a lower scoring result that might be valid to the user.

## Customization via Grav event (Basic)

There are situations where you have some custom frontmatter in your page header, that in turn is used in a Twig template to create your content.  This is often the case when you have a array of things that you want to manage in the admin with custom blueprints. A basic example of this is a page that has a list of **authors** and their associated **bios**.  You might define these in an `authors.md` page like this:

**authors.md**
```markdown
---
title: Authors

authors:
    - name: Chantal Zoe Blunder
      bio: Chantal Zoe Blunder is a ...
    - name: Mark Kevin Chen
      bio: Mark Kevin Chen is a ...
    - name: Maud Stanley Gloop
      bio: Maud Stanley Gloop is a ...
    - name: Reginald Tony DeVito
      bio: Reginald Tony DeVito is a ...
---

# Author Biographies
```

> [!IMPORTANT]
> I've removed the bios here for the sake of brevity, but you see how the `authors` is an array with just a `name` and a `bio` for each.  This might be output in a Twig template `authors.html.twig` like this:

**authors.html.twig**
```twig
{% extends 'partials/base.html.twig' %}

{% block content %}
    {{ page.content|raw }}
    {% for author in header.authors %}
        <div class="author-detail">
            <h2>{{ author.name }}</h2>
            {{ author.bio|markdown }}
            <hr />
        </div>
    {% endfor %}
{% endblock %}
```

The rest of the page content as rendered by the `authors.html.twig` template is provided by the frontmatter via the `headers.authors` and we loop over that and output some simple HTML for each author.   The result is something like this:

![Authors Screenshot](authors-screenshot.png?class=shadow)

The problem we face is that Algolia's default **Grav Page Search" will not find any of that author content in the page content, only the "Author Biographies" content from the `authors.md` file:

```markdown
# Author Biographies
```

By default, the index configuration is pre-configured to search in these fields:

**algolia-pro.yaml**
```yaml
...
searchable_fields:
    - title
    - subtitle
    - url
    - taxonomy
    - headers.h1
    - headers.h2
    - headers.h3
    - headers.h4
    - content
...    
```

These are set by the PHP code, but we can take advantage of one of Algolia-Pro's custom events to hook into the indexing logic and add our authors fields so that they are able to be queried properly.  To use this event you need to put it either in a custom plugin or in your theme's PHP file. The best option usually is to create a custom plugin for any custom logic you might need via the `devtools` plugin.  However, if you don't forsee the need for much custom functionality you can simply add the event to your theme.  

In this example, we have a custom theme that is based on the default **Quark** and we need to first tell it to listen to the event.  In the theme's PHP file and specifically, in the `getSubscribedEvents()` method add an extra entry for the `onAlgoliaProIndexData` event:

**my-theme.php**
```php
...
public static function getSubscribedEvents()
{
    return [
        'onThemeInitialized'    => ['onThemeInitialized', 0],
        'onTwigLoader'          => ['onTwigLoader', 0],
        'onTwigInitialized'     => ['onTwigInitialized', 0],
        'onAlgoliaProIndexData' => ['onAlgoliaProIndexData', -10]
    ];
}
```

> [!IMPORTANT]
> We use a priority of `-10` to ensure our event runs after the default one that Algolia Pro also uses to set standard fields.

Now we need to define a function to handle the event and use it for our custom logic:

#### Approach 1 (O.K. solution)

**my-theme.php**
```php
...
public function onAlgoliaProIndexData($e)
{
    // Get date out of the event
    $data = $e['data'];
    $page = $e['object'];

    // if this is a valid page and it's an 'authors' page with authors set do some custom stuff
    if ($page instanceof PageInterface && $page->template() == 'authors' && isset($page->header()->authors)) {
        // get current data for the page
        $content = $data->content ?? '';
        // Loop over the authors and build HTML to mimic the custom twig
        foreach ($page->header()->authors as $author) {
            $content .= "\n<h2>{$author['name']}</h2>\n".Parsedown::instance()->parse($author['bio']);
        }
        // set the processed content back on the data object
        $data->content = $content;
    }
}
```

This is not terribly complicated, but there must be a better way right? Sure, I would recommend breaking out the Twig logic that renders the authors from the `authors.html.twig` into a `partials/authors.html.twig` and using that same Twig to render the HTML in the `onAlgoliaProIndexData()` event.  For a quick example of how that might look:

#### Approach 2 (better solution)

**authors.html.twig**
```twig
{% extends 'partials/base.html.twig' %}

{% block content %}
    {% include 'partials/authors.html.twig' %}
{% endblock %}
```

**partials/authors.html.twig**
```twig
{{ page.content|raw }}

{% for author in header.authors %}
    <div class="author-detail">
        <h2>{{ author.name }}</h2>
        {{ author.bio|markdown }}
        <hr />
    </div>
{% endfor %}
```

**my-theme.php**
```php
...
public function onAlgoliaProIndexData($e)
{
    // Get date out of the event
    $data = $e['data'];
    $page = $e['object'];

    // if this is a valid page and it's an 'authors' page with authors set do some custom stuff
    if ($page instanceof PageInterface && $page->template() == 'authors' && isset($page->header()->authors)) {
        $data->content  = $this->grav['twig']->processTemplate('partials/authors.html.twig', ['page' => $page, 'header' => $page->header()]);
    }
}
```

Code re-use is a wonderful thing! Both of these solutions work similarly.  The second approach utilizes the same Twig template that the front uses to render the content so it is actually a more reliable solution.  If you add more attributes for an author, for example `location`, and modify the Twig template to display this, then the second approach will automatically just 'work' and index the new attribute without any modification.

With our current data, they both result in the same output for a simple query for `zoe`:

![Zoe Query](query-zoe.png?class=shadow)

### Page TOC plugin for better results

The [Page TOC](https://github.com/trilbymedia/grav-plugin-page-toc?target=_blank) plugin will only add page anchors to headers found in the content.  In this example, because we are using frontmatter and custom twig to render the authors, no anchors are added to these author blocks.  We can address this and improve our search results at the same time by modifying our Twig to output the content through the `add_anchors()` twig function that Page TOC provides.

**partials/authors.html.twig**
```twig
{{ page.content|raw }}

{% set authors_content %}
    {% for author in header.authors %}
        <div class="author-detail">
            <h2>{{ author.name }}</h2>
            {{ author.bio|markdown }}
            <hr />
        </div>
    {% endfor %}
{% endset %}

{{ add_anchors(authors_content) }}
```

Because we are already using this `partials/authors.html.twig` in our event, Algolia Pro indexing will also take these into account and make use of them with smarter linking. If we re-index and try the same `zoe` query from before:

![Zoe Query with anchors](query-zoe-anchors.png?class=shadow)

Now you can see how the **URL** has changed from simply `/authors` to `/authors#chantal-zoe-blunder` meaning that clicking on this result would jump you directly to the **Chantal Zoe Blunder** entry in the authors list. How cool is that?

## Crawl Page Search (Intermediate)

Although not that common a scenario, there are situations where the standard **GravPageSearch** capability is not sufficient or not able to properly index your content. This is most often the case when you are using a custom **FlexObjects-based** solution on your site where your content does not exist as actual Grav pages. One approach is to use the **CrawlPageSearch** option which uses an HTTP crawler in combination with the `sitemap` plugin to crawl your site and look for specific CSS selectors.  When it finds a matching selector, it indexes the content it finds inside that selector.  While the **CrawlPageSearch** class can work with pages, it can also index anything that is found by the sitemap plugin. 

The most common scenario you will run into where you need to use this approach, is if you have pages that are dynamically generated.  A typical example of this is if you have created a **Flex Objects** powered custom plugin.  In this example we'll use a simple **Reviews** plugin that leverages Flex Objects to define custom game reviews.  The setting up of a Flex-based implementation is outside of the scope of this documentation, but you can [download some sample code](reviews-plugin.zip) of the whole Reviews plugin.

The first step in getting the **CrawlPageSearch** to work with the reviews plugin, is to add an event listener for the `onSitemapProcessed` event so we can ensure we add our Flex-powered sub-pages to the sitemap, so the crawler in turn, can actually request and index them.

> [!IMPORTANT]
> Enabling your interior Flex-powered pages in your sitemap is a good SEO practice, and not something unique to Algolia Pro.

**reviews.php**
```php
...
public function onPluginsInitialized()
{
    $this->enable([
        'onTwigTemplatePaths'       => ['onTwigTemplatePaths', 0],
        'onAssetsInitialized'       => ['onAssetsInitialized', 0],
        'onSitemapProcessed'        => ['onSitemapProcessed', 0],
    ]);
}
...
public function onSitemapProcessed(Event $e)
{
    $sitemap = $e['sitemap'];
    $directory = $this->grav['flex']->getDirectory('reviews');
    foreach ($directory->getCollection()->filterBy(['published' => true]) as $review) {
        $route = "reviews/id:{$review->review_route}";
        $entry = new SitemapEntry(
            Utils::url($route, true),
            date('Y-m-d', $review->getTimestamp()),
            'daily',
            '1.0'
        );
        $sitemap[Utils::url($route)] = $entry;
    }
    $e['sitemap'] = $sitemap;
}
```

In the `onPluginsInitialized()` event we register the `onSitemapProcesed()` method.  An in that method, we first retrieve the existing **sitemap**, load our `reviews` collection, and then iterate over that collection.  For each published item we find, we define a `$route`, and then add a new `SitemapEntry()` object with the full URL, date, and update frequency.

After this we can test the sitemap by going to `http://yourserver/yoursite/sitemap.json`.  You should see all your pages as well as the newly added dynamic Flex-based pages.

> [!NOTE]
> You don't need to restrict the sitemap to only show the flex pages, we can leverage the CSS Selectors that are part of the options to only index review-related data.

Now we have to modify our `algolia-crawl-pages` index to first ensure that it's now **enabled**, and also set the **Body Selectors** to `#reviews`

![Crawl Body Selectors](crawl-body-selectors.png?class=shadow)

As long as your plugin (Reviews in our example here) wraps it's content with an HTML element that has an `id="reviews"` then the crawler should pick those up and index them. Our collection page where we list all the reviews has a twig template that does just that:

**templates/flex/reviews/collection/default.html.twig**
```twig
{%- set object_context = object ?? {} -%}
{%- set object_layout = object_context.layout ?? ('list-' ~ layout) -%}

<div id="reviews">
    <h1>Reviews</h1>
    <div class="columns">
    {% for object in collection.filterBy({ published: true }) %}
      <div class="column col-6">
        {% render object layout: object_layout with { options: options } %}
      </div>
    {% endfor %}
    </div>
</div>
```

## Custom Search Classes (Advanced)

While utilizing the **CrawlPageSearch** option is relatively quick and painless and it will work on a wide variety of page types on your site, there are use-cases where you just need to a very custom solution that is not served by either the **GravPageSearch** or **CrawlPageSearch** options.  For these situations, you can create a completely custom search class that meets your  needs exactly. We'll continue by utilizing the same **Reviews** plugin which uses Flex Objects.

We will need to do several things:

1. Create a custom search class.  (**FlexReviewsSearch**)
1. Define a custom blueprint definition that will be used by the Admin to configure the class.  (**flex-reviews-search.yaml**)
1. Register the **FlexReviewsSearch** class with Algolia so it can be choosen as a valid search type.
1. more...

### Step 1 - Create a custom search class

The first step is to create a new class for the search logic.  We will need to create the stub class and also an entry in the `composer.json` file to ensure the class can be auto-loaded:

**classes/algolia-pro/FlexReviewsSearch.php**
```php
<?php declare(strict_types=1);

namespace Grav\Plugin\AlgoliaPro;

use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;

class FlexReviewsSearch extends FlexSearch implements AlgoliaProClassInterface
{
    /**
     * Return collection of objects to be indexed. Make sure you filter away inaccessible objects.
     *
     * @return FlexCollectionInterface
     */
    protected function getFilteredCollection(): FlexCollectionInterface 
    {
    }
    
    /**
     * Return true if object can be handled by this class. 
     * 
     * @param FlexObjectInterface $object
     * @return bool
     */
    protected function checkObject(FlexObjectInterface $object): bool 
    {
    }
    
    /**
     * Each object can have multiple records, so return array of records.
     *
     * @param FlexObjectInterface $object
     * @return array
     */
    protected function getRecord(FlexObjectInterface $object): array 
    {
    }
    
    /**
     * Get URL for the object.
     *
     * @param FlexObjectInterface $object
     * @return string|null
     */
    protected function getUrl(FlexObjectInterface $object): ?string 
    {
    }
}
```

**composer.json**
```json
...
"autoload": {
"psr-4": {
    "Grav\\Plugin\\Reviews\\": "classes/",
    "Grav\\Plugin\\AlgoliaPro\\": "classes/algolia-pro"
},
"classmap":  ["reviews.php"]
},
```

### Step 2 - Register search type

Now we can add the `onAlgoliaRegisterSearch()` event and register the search type:

**reviews.php**
```php
...
public function onPluginsInitialized()
{
    $this->enable([
        ...
        'onAlgoliaProRegisterSearch' => ['onAlgoliaProRegisterSearch', 0]
    ]);
}

...

public function onAlgoliaProRegisterSearch(Event $e): void
{
    /** @var Data $register */
    $register = $e['register'];
    $register->merge([
        'flex-reviews-search' => 'Flex Reviews Search',
    ]);
}
```

Next we need to create a blueprint that will allow us to define and fill in the Search details.  We can use the **GravPagesSearch** file which is contained in `user/plugins/algolia-pro/blueprints/flex/search/algolia-grav-pages.yaml` and create our own in the reviews plugin:

**blueprints/flex/search/flex-reviews-search.yaml**
```yaml
title: Flex Reviews Search

form:
  fields:
    crawl_section:
      ordering@: 4
      type: section
      title: Flex Reviews Options
      underline: true
      fields:
        common_section:
          type: section
          import@:
            type: search/common-config
            context: blueprints://
```

Currently there's no way to set defaults automatically so you should set the following values via the admin:

* **Search Class**: `Grav\Plugin\AlgoliaPro\FlexReviewsSearch`
* **Distinct Field**: `url`
* **Searchable Fields**:
    * `title`
    * `name`
    * `url`
    * `headers`
    * `good`
    * `bad`
    * `content`

### Step 3 - Flesh out the class methods

This part is a bit grueling and depends on your logic, but for the Reviews plugin our Search class ends up looking like this:

**classes/algolia-pro/FlexReviewsSearch.php**

```php
<?php declare(strict_types=1);

namespace Grav\Plugin\AlgoliaPro;

use Grav\Common\Grav;
use Grav\Framework\Flex\Flex;
use Grav\Framework\Flex\FlexDirectory;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Plugin\Reviews\ReviewCollection;
use Grav\Plugin\Reviews\ReviewObject;

class FlexReviewsSearch extends FlexSearch
{
    /**
     * Return collection of objects to be indexed. Make sure you filter away inaccessible objects.
     *
     * @return ReviewCollection
     */
    protected function getFilteredCollection(): FlexCollectionInterface
    {
        $grav = Grav::instance();

        /** @var Flex $flex */
        $flex = $grav['flex'];

        /** @var FlexDirectory $directory */
        $directory = $flex->getDirectory('reviews');

        /** @var ReviewCollection $collection */
        $collection = $directory->getCollection()->filterBy(['published' => true]);

        return $collection;
    }

    /**
     * Return true if object can be handled by this class. 
     * 
     * @param FlexObjectInterface $object
     * @return bool
     */
    protected function checkObject(FlexObjectInterface $object): bool
    {
        return $object instanceof ReviewObject;
    }

    /**
     * Each object can have multiple records, so return array of records.
     *
     * @param ReviewObject $object
     * @return array
     */
    protected function getRecord(FlexObjectInterface $object): array
    {
        $records = [];
        $record = new \stdClass();
        $counter = 0;

        // Standard bits
        $record->id = $object->getFlexKey();
        $record->title = $object->review_title;
        $record->name = $object->product_name;
        $record->url = $this->getUrl($object);

        // Store entry for each section
        foreach ($object->sections as $section) {
            $record->header = $section['intro'];
            $content_chunks = $this->splitHTMLContent($section['content']);

            foreach ($content_chunks as $content_chunk) {
                $record->content = $content_chunk['content'];
                $record->objectID = $record->id . '-' . $counter++;
                $records[] = (array) $record;
            }
        }

        // Store entry with good/bad score
        $record->content = "score: {$object->score}\ngood: {$object->good}\nbad: {$object->bad}";
        $record->objectID = $record->id . '-score';
        $records[] = (array) $record;

        return $records;
    }
    
    /**
     * Get URL for the object.
     *
     * @param ReviewObject $object
     * @return string|null
     */
    protected function getUrl(FlexObjectInterface $object): ?string
    {
        // Return object URL. If the object doesn't have the method, generate route here, for example: /reviews/id:[KEY].
        return $object->url();
    }
}
```

### Step 4 - Validating the results

I know that's pretty meaty! When you start digging through it and comparing it to the **GravPageSearch** class it will start to make sense.  To test this out, you can simply disable your other search indexes, so your custom one is the only one active.

Our test plugin only had 3 reviews, so those are what we indexed:

![Custom Reviews Indexing](custom-reviews-index.png?class=shadow)

and a quick query results in:

![Custom Reviews Query](custom-reviews-query.png?class-shadow)

Just as expected... 😉

## Adding custom CLI Index Options (advanced)

If you have created a custom Search class, you might need to have custom options available at index time.  To facilitate this you can make use of the `onAlgoliaProCliConfiguration` and `onAlgoliaProCliServe` events.  Algolia Pro actually uses this to add a custom options and setting this as options that are passed to the internal class methods.

You can see how this works by looking at the code:

```php
public function onAlgoliaProCliConfiguration(Event $e): void
    {
        /** @var ConsoleCommand $command */
        $command = $e['command'];

        if ($command instanceof AlgoliaIndexerCommand) {
            $command->addOption(
                'url',
                'u',
                InputOption::VALUE_REQUIRED,
                'Optional URL of JSON sitemap (CrawlPageSearch only)'
            );
            $command->addOption(
                'route',
                null,
                InputOption::VALUE_REQUIRED,
                'Optional route of a single specific page to index (GravPageSearch only)'
            );
        }

        $command->addOption(
            'indexes',
            'x',
            InputOption::VALUE_REQUIRED,
            'Optional comma-separated list of enabled index configurations to use'
        );
    }

    public function onAlgoliaProCliServe(Event $e): void
    {
        /** @var ConsoleCommand $command */
        $command = $e['command'];
        /** @var \stdClass $options */
        $options = $e['options'];

        if ($command instanceof AlgoliaIndexerCommand) {
            if ($url = $command->getInput()->getOption('url')) {
                $options->url = $url;
            }
            if ($route = $command->getInput()->getOption('route')) {
                $options->route = $route;
            }
        }

        $indexes = $command->getInput()->getOption('indexes');
        if (is_string($indexes)) {
            $indexes_list = array_map('trim', explode(',', $indexes));
            $options->indexes = $indexes_list;
        }

        if ($lang_code = $command->getInput()->getOption('lang')) {
            $options->lang = $lang_code;
        }
    }
```
