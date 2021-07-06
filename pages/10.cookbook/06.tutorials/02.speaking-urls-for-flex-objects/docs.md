---
title: Speaking URLs for Flex Objects
taxonomy:
    category: docs
---

This is an advanced dig in the functionalities of Flex Objects and gravs routing.

## Problem:

When using Flex Objects you will often have a page for listing the entities and a page for the single entity itself. The built in way to achieve this will produce URLs like `/places/id:1a726c314d6bc80d0dc0904026c53973`. But in a lot of cases you prefer speaking URLs like `/places/high-street`.

## Solution:

We will hook into the routing of grav and create a page on the fly using a predefined page which will be our corpus for this.

For the examples we will assume we have a Flex Directory named `places` and for our URLs we match the field `slug` instead of the ID. We also assue the directory has fields like `title` and `description`.

### Pages

First we need a page which will be the root for our Flex Objects and a subpage that will be the empty corpus to fill for single entities.

In `/user/pages/places/places.md` we define `fx_entity_page` to tell our code later how the subpage, we will use do display the single entity with, is called.

[prism classes="language-md line-numbers"]
---
title: Our Places
fx_entity_page: 'place'
---
Some content you will show above the list…
[/prism]

In `/user/pages/places/place/place.md` we set the name of our Flex Directory in `fx_directory` and prepare an empty `fx_object` to be filled with the single entity object. We also tell which field from the Flex Object we want to use as page title (`fx_title`).

[prism classes="language-md line-numbers"]
---
title: Single Place
fx_directory: 'places'
fx_title: 'title'
fx_object: null
---
[/prism]

### Template

`place.html.twig` will look a bit like this:

[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% set places = grav.get('flex').collection( header.fx_directory ) %}

{% block content %}
    <h1 class="headline">
        {{ page.title }}
    </h1>
    <ul class="places__list">
        {% for place in places %}
            <li class="places__item">
                <a href="{{ uri.path }}/{{ place.slug }}">
                    {{ place.title }}
                </a>
            </li>
        {% endfor %}
    </ul>
{% endblock %}
[/prism]

`place.html.twig` will look a bit like this:

[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% set object = page.header.fx_object %}

{% block content %}
    <h1 class="headline">
        {{ object.title }}
    </h1>
    <div class="textflow">
        {{ object.description|markdown|raw }}
    </div>
{% endblock %}
[/prism]

### Routing

In your themes `THEMENAME.php` add the following:

[prism classes="language-php line-numbers"]
use Grav\Common\Uri;

public static function getSubscribedEvents(): array
{
    return [
        'onPagesInitialized'       => ['onPagesInitialized', 0],
    ];
}

public function onPagesInitialized(): void
{
    $current = Uri::getCurrentRoute();
    $route = $current->getRoute();
    $this->customRouting($route);
}

protected function customRouting( string $route ): void
{
    $normalized = trim($route, '/');
    if (!$normalized) {
        return;
    }

    // split the base from the slug
    $parts = explode('/', $normalized, 2);
    $path = array_shift($parts);
    $key = array_shift($parts);

    // get the reference to the details page corpus
    $parent = $this->grav['pages']->find( '/' . $path );
    $entity_page = $parent->header()->fx_entity_page ?? null;

    // if we have a slug and a valid page to fill
    if ( $entity_page && $key )
    {
        $entity_path = '/' . $path . '/' . $entity_page;
        $this->addFlexPage( $route, $key, $entity_path ) ;
    }
}

protected function addFlexPage( string $route, string $key, string $fx_page ): void
{
    /** @var Pages $pages */
    $pages = $this->grav['pages'];
    if ( $pages->find( $route ) )
    {
        /** @var Debugger $debugger */
        $debugger = $this->grav['debugger'];
        $debugger->addMessage("Page {$route} already exists, page cannot be added", 'error');
        return;
    }

    // grab the single page corpus for later rerouting
    $page = $pages->find( $fx_page );

    // get the flex object to ensure it exists
    $collection = $this->grav['flex']->getCollection( $page->header()->fx_directory );
    $object = $collection->filterBy( ['slug'=> $key] )->first();

    // if the corpus page and the single flex object exist
    if ( $page && $object )
    {
        // now we prepare the virtual page based on the corpus
        $page->id($page->modified() . md5($route));
        $page->slug(basename($route));
        $page->folder(basename($route));
        $page->route($route);
        $page->rawRoute($route);
        // we change the title (page.title) and hand over the object for later use
        $page->title( $object->{$page->header()->fx_title} );
        $page->modifyHeader( 'fx_object', $object );
        // and here we create the virtual page so the routing will find and display it
        $pages->addPage($page, $route);
    }
}
[/prism]