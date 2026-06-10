---
title: Algolia Pro Frontend
description: Customize the UI interface
taxonomy:
    category: docs
---

# Algolia Pro Frontend

The User Interface configuration is tied to the Algolia Pro Indexes, there are no global settings for them. However, thanks to the powerful configuration mechanism of Algolia Pro, you will be able to tweak these settings for particular Pages, as well as have Children inherit a Parent set of configuration.

To reach these settings, head over to the **Algolia Pro** menu item, then from the **Algolia Indexes** tab you can select one of the Indexes listed.

At the end of the configuration page, you will find the **User Interface Parameters** section.

#### User Interface Parameters

![User Interface Configuration](frontend-options-1.png?classes=shadow)

- **Built-in CSS Style** → Whether to load the built-in CSS style (~15 KB / ~3.68 KB Gzipped)
- **Debounce Search** → Adds a debounce of `250ms` between search requests. This helps with reducing the search operations to Algolia, quite a lot. The downside is that it might feel slightly less responsive. When disabled, the search is instant as you type, however this increases substantially the search operations to Algolia. Most sites can handle immediate search, so Algolia Pro ships with Debounce disabled by default. 
- **Accent Color** → Changes the accent color for the UI. This includes input cursor, highlighted text, selected pagination tab, selected result items row.
  (Default: [div style="display: inline-flex;vertical-align: middle;align-items:center;"] [div style="display: block; width: 20px; height: 20px; border-radius: 3px;background-color:#3b82f6;margin-right:.25rem" /] [color="#3b82f6"]#3b82f6[/color][/div]).
- **Appearance** → The appearance style for the entire UI. It can be **Light**, **Dark** or **System**. When set to System (default), it will automatically change between Light and Dark, based on client Operating System settings.
- **Results Statistics** → Displays the search results statistics for a given query (ie, _428 results found in 7m_).
  ! Uses the [<ais-stats&gt; widget](https://www.algolia.com/doc/api-reference/widgets/stats/vue/?target=_blank) in [hits.html.twig template](#override-templates)
- **Display Subtitle (TOC Anchor)** → When enabled and if using [Page TOC](../backend#page-toc-plugin-for-better-results), results' title will display with the anchor subtitle in parentheses. This option allows displaying or hiding the subtitle.
- **Warm Connection** → By default, Algolia will automatically perform an initial search in the background, as soon as the page loads. This is beneficial to speed up subsequent query requests by the users because it will take out of the way any dns resolution, ssl handshake, api prefetch and so on. However highly recommended to leave enabled, if desired this optimization can be disabled.
- **Language Strings** → A definition of language strings to be used in the twig templates. By default, the built-in terms are set to point to the Grav languages so that it is multi-language compatible. However, if desired, it can be set to any specific terms. These are also fully customizable at a per-page level.
  ! To reference a language string from a template via the global settings variable as such: <br />`{{ settings.interface.lang.placeholder|t }}`

#### Preview Options

![Preview Options](frontend-options-2.png?classes=shadow)

- **Preview Results** → When enabled, hovering over an item from the search results, will bring up a Preview panel where the user can peak at the page found. The Preview panel will include the breadcrumbs' path, the title, a summary and the "On This Page" list.
  ! Uses the twig block `hits_preview` that is referenced from the [hits.html.twig template](#override-templates)
- **"On This Page" list** → When enabled and meaningful, this setting will display a list of header titles pertinent to the search result item selected. The list displays in the Preview panel but it won't display if the selected item is a header chunk, even if the setting is enabled.
  ! Referenced from the [hits.html.twig template](#override-templates)

#### Footer Options

![Footer Options](frontend-options-3.png?classes=shadow)

- **Display Footer** → When disabled, the footer in the UI will disappear, taking with it Pagination and Copyrights.
  ! Referenced from the [footer.html.twig template](#override-templates) within the `footer` block.
- **Pagination** → When enabled, it allows navigating through different pages of the search results. Otherwise, only the configured "Hits Per Page" amount of items will display.
  ! Uses the [<ais-pagination&gt; widget](https://www.algolia.com/doc/api-reference/widgets/pagination/vue/?target=_blank) in [pagination.html.twig template](#override-templates). Referenced from the [footer.html.twig template](#override-templates).
- **Algolia Copyrights** → Displays the "Search by Algolia" copyrights. Be mindful that Algolia requires that you use this widget if you only use your free usage credits, or are on a Community or Free legacy plan.
  ! Uses the [<ais-powered-by&gt; widget](https://www.algolia.com/doc/api-reference/widgets/powered-by/vue/?target=_blank) in [pagination.html.twig template](#override-templates). Referenced from the [footer.html.twig template](#override-templates).
- **Powered by Algolia Pro** → Displays the "Powered by Algolia Pro Plugin" logo. 
  ! Uses in [pagination.html.twig template](#override-templates). Referenced from the [footer.html.twig template](#override-templates).

#### Advanced Options

![Advanced Options](frontend-options-4.png?classes=shadow)

* **Expose Global JS Object** → Exposes the window global object `window.AlgoliaPro`

## Usage

To integrate Algolia Pro on your site you will need to first load the template and then to delegate one or more elements, to serve as the trigger for opening the search interface. 

This is made very simple for you, let's take a look at the details.

#### Loading the template
The best place to load the template would be in the footer of the the `base.html.twig` template, to guarantee it's always loaded on every page.

All that's needed is this one line of twig:

```twig
{% include 'partials/algolia-pro/instantsearch.html.twig' ignore missing with { index: 'pages' } %}
```

`Index` is a required parameter and needs to match the _Index Name_ you have configured. It will also be used to determine the User Interface configuration to load for the search interface.

Once the template is loaded on your site, you are now ready to delegate a trigger to interacting with it.

> [!WARNING]
> You can only load one instance of `instantsearch` template per page.

#### Delegate a trigger element
Algolia Pro doesn't come with any built-in UI element for the search input to be typed in. By design, everything needed is contained within the modal interface that opens, including the search input field. 

All that's really needed is for the Algolia Pro's Search Interface to be opened through **user interaction**. This can be **ANY** element on your site. An input field, a button, a text link, an image. It is entirely up to you and will allow you to truly integrate Algolia Pro seamlessly.

Because we know every site's design is different, we made it extremely simple to delegate an item to toggle the search interface open. All you need to do is decide which element (or elements) should trigger and add the data attribute `data-algolia-pro-trigger` to them. Algolia Pro will see the elements and attach a click event to it. Now everytime the user clicks on the element, Algolia Pro will open up. 

##### Example
Let's assume your site has a **search input** field at the top right of the header, and a "Search" button in the sidebar.


[div style="display: flex"]
[div style="flex: 1 1 0%; overflow: auto;margin-right:1rem"]
**Before**

```html
<!-- header input field -->
<label for="search">Search</label>
<input type="text" name="search" id="search">

<!-- button in sidebar -->
<button type="button">Search</button>
```
[/div]
[div style="flex: 1 1 0%; overflow: auto;"]
**After**

```html
<!-- header input field -->
<label for="search">Search</label>
<input type="text" name="search" id="search" data-algolia-pro-trigger>

<!-- button in sidebar -->
<button type="button" data-algolia-pro-trigger>Search</button>
```
[/div]
[/div]


### Overriding Twig Templates {#override-templates}

The User Interface for the Algolia Pro search is a **Vue application** built with **twig templates**, **twig blocks** and utilizing [Vue InstantSearch widgets](https://www.algolia.com/doc/api-reference/widgets/vue/?target=_blank). Templates are broken out in a way that simplifies overriding specific portions of the interface as well as easing the process of adding new features. 

Even if not familiar with Vue or JS in general, one will find it extremely simple to modify or expand on this, so long there is some basic knowledge of Grav template overriding system and Twig.

Before we delve deep into the templates themselves, it is worth first taking a picture of how the blocks and templates are organized and what portion of the interface they are responsible for.

[div class="algolia-pro-overlay"]
![Template Structure Overlay](twig-structure-overlay.png?class=overlay-on)
![Template Structure](twig-structure.png?class=overlay-on)
[/div]

#### instantsearch.html.twig
This is the **main** template, the one that you will [include in your site](#loading-the-template) to load the interface. 

In here the [`<ais-instant-search>` widget](https://www.algolia.com/doc/api-reference/widgets/instantsearch/vue/) will be initialized with all of the configuration and settings that Algolia Pro has figured out and narrowed down for your page inclusion.

A few other templates will be included in this page. The [Special `assets.html.twig` template](#assets-html-twig) and the [`instantsearch-scopes.html.twig` template](#instantsearch-scopes-html-twig), both necessary for the styling and inclusion of the rest of the template.

The `<ais-instant-search>` widget is also tied to a custom Vue application that comes with Algolia Pro where we use custom middlewares and reactive variables such as `isOpen` to render the interface. [More about the Vue App, reactive variables and how to programmatically interact with Algolia Pro later.](#javascript-and-programmatic-interaction)

If deciding to override this template, you should be aware of what the `<ais-instant-search>` widget is currenctly doing in order to replicate it on your own template. Chances are you will likely never need to change anything in here.

#### instantsearch-scopes.html.twig
This template is a simple middle-man container where the main twig `blocks` are imported and defined. This is kept specifically simple to allow for easy overriding in case a new block and twig are required.

Please note also that in here the second [Special `configure.html.twig` template](#configure-html-twig) is loaded. If you decide to override this template, be aware that you will need to at the very least include the "configure" block.

#### searchbox.html.twig
The searchbox template provides the `searchbox` block and serves as a wrapper for the search input, where the queries get input, and the cancel button.

#### searchbox_input.html.twig
This template provides the `searchbox_input` block and contains all the logic to display the actual input search field for typing queries and triggering search results.

This block makes use of the [`<ais-search-box>` widget](https://www.algolia.com/doc/api-reference/widgets/search-box/vue/?target=_blank) and is heavily customized through the use of [**slots**](https://www.algolia.com/doc/api-reference/widgets/search-box/vue/#customize-the-ui?target=_blank).

The input field in this block is what starts every query and keeps the state of the Algolia Pro app synchronized with the Algolia service. When overriding this template, you should be mindful of the events and slot logic provided by default.

#### hits.html.twig
The `hits` template provides the `hits` block and serves as a wrapper for the search results template ([hits_items](#hits_items-html-twig)) and the selected result preview ([hits_preview](#hits_preview-html-twig)). This block also displays the search result statistics if the option is [enabled](#user-interface-configuration). 

Statistics are rendered through the [`<ais-stats>` widget](https://www.algolia.com/doc/api-reference/widgets/stats/vue/?target=_blank).

#### hits_items.html.twig
This template takes care of looping through all the search results and rendering their output. There is a lot of JavaScript (Vue) logic involved with this template but for the most part it all comes down to rendering the items in a certain way based on what is the state of the app.

Just like the [searchbox_input](#searchbox_input-html-twig), this template is heavily customized with the use of [slots](https://www.algolia.com/doc/api-reference/widgets/hits/vue/#customize-the-ui?target=_blank).

Let's examine at a high level what is the JavaScript/Vue logic that happens in this template for rendering the results

###### Empty vs Non-Empty results
The first bit of logic happening in this template to check whether there are results to even show. This is possible to do by checking if the `items` slot scope is empty.

This allows our application to render 2 entirely different type of HTML based on this state, making it possible to display a very simplified HTML content when there are no results to go through.

```html
<template slot-scope="{ items }">
  <span v-if="!Object.keys(items).length">Empty</span>
  <span v-else>Non Empty</span>
</template>
```

###### Loop
Once established there are in fact results to display, they need to be looped through and rendered one by one. 

We loop through with [regular Vue `v-for` logic](https://v3.vuejs.org/guide/list.html#v-for-with-an-object?target=_blank) and render each item as an `<li>`. It is important to also always associate a unique `key` to each element, as Vue recommends.

```html
<ul v-if="Object.keys(items).length">
  <li 
    v-for="(item, index) in items" 
    :key="item.objectID"
  >
    <a :href="`{{ uri.rootUrl }}${item.url}`">
      [[ item.title ]]
    </a>
  </li>
</ul>
```

Few things are happening here, first you can notice attributes prefixed with a colon `:`. This is Vue behavior and it tells the framework to evaluate the content of said attribute. Without the colon they would just be interpreted as strings, which is not desired.

Secondly, you can notice to render the title, we are using the syntax `[[ item.title ]]`. Usually Vue wraps variables in curly brackets `{{ item.title }}`. However, because Twig and Grav also use curly brackets, Algolia Pro templating system has been configured to use double square brackets instead.

Lastly you can notice the href value syntax. We already know about the colon in the attribute. However in the value you can see a mix of twig and JavaScript.  
It makes use of the JavaScript template literals with backticks (` ` `), the Twig/Grav URI evaluation `{{ uri.rootUrl }}` and finally of the embed of the Vue value `item.url` through the syntactic sugar syntax `${item.url}`. 

> [!TIP]
> The object data available for each item corresponds to the fields of your Index. For example `title`, `url`, `summary`, `headers`, etc.

###### Selected state
The Algolia Pro Vue application carries a global stateful `selected` variable that can be used to render differently certain areas of the interface. It also provides a method `isSelected` to determine whether an item is in fact selected or not.

Let's modify slightly our `<li>` element from the **loop** above and change the item behavior based on the user mouse hovering over it.

```html
<li 
  v-for="(item, index) in items" 
  :key="item.objectID"
  @mouseenter="selected = item"
  :class="{
    'is-selected': isSelected(item)  
  }"
>
```

Now our item will listen to the user mouse hovering over it ([`@mouseenter`](https://v3.vuejs.org/guide/events.html#listening-to-events?target=_blank)), and when that happens our global stateful variable `selected` will be set to the `item` in question.

Additionally, if the item is in fact being hovered over, a class `is-selected` will be added to it, thanks to the check `isSelected(item)` returning true. If an item is not selected, then the `isSelected` method will return false and no class name will be added to it.

###### Highlighting results
It is possible to highlight portion of a text based on the query. For example if we were to search for "**colle**", we would expect the results with the wording "Collection" to be highlighted as "**`Colle`ction**"

This is very simple to do thanks to the [`<ais-highlight>` widget](https://www.algolia.com/doc/api-reference/widgets/highlight/vue/?target=_blank). By passing the `item` object and the property that needs highlighting to the widget, it will return a properly highlighted HTML element.

Let's take our item from the previous sections and instead of just rendering the text `[[ item.title ]]`, we make it highlight it when necessary.

```html
<ul v-if="Object.keys(items).length">
  <li 
    v-for="(item, index) in items" 
    :key="item.objectID"
    @mouseenter="selected = item"
    :class="{
      'is-selected': isSelected(item)  
    }"
  >
    <a :href="`{{ uri.rootUrl }}${item.url}`">
      <ais-highlight
        attribute="title"
        :hit="item"
        highlighted-tag-name="span"
        :class-names="{
          'ais-Highlight-highlighted': 'bg-yellow text-black'
        }"
      ></ais-highlight>
    </a>
  </li>
</ul>
```

Now our items will render the title within a `span` tags and properly highlight portions of the text when matching the query, by adding the classes `bg-yellow text-black` to it.

###### Conclusion
The syntax and logic explained above is what is being used throughout the whole interface, understanding it will be very useful if you decide to extend and create your own UI. The structure and flexibility of the templates and the application will lett you use different approaches if you just follow the JavaScript and Vue standards. 


#### hits_preview.html.twig
The `hits_preview` template provides the twig block that displays a preview panel detailing the selected item from the search results.

Like we learned in the [Selected state](#selected-state) section, `selected` is a global stateful object variable that it's available to us across the interface templates to determine whether an item has been selected or not.  
The Preview panel takes advantage of this by wrapping the whole container into an if statements that checks just that.

```html
<div v-if="selected">[... preview panel HTML ...]</div>
```

Unlike the [`hits_items` loop](#loop) section, The Preview panel doesn't require you to loop through items. Instead, you can display details about the item by referencing the `selected` object.

If you wanted to display the title and summary of the selected item, this is how you would do it:

```html
<div v-if="selected">
  <h1>[[ selected.title ]]</h1>
  <p>[[ selected.summary ]]</p>
</div>
```

> [!TIP]
> You can highlight the text of the `selected` object and match the query, by taking advantage of the `<ais-highlight>` widget. [Learn more](#highlighting-results)

> [!NOTE]
> In this block you will also find the logic to handle the "On This Page" section.

#### footer.html.twig
The footer is the bottom area of the interface, and can be entirely turned off [via "Footer Options" settings](#user-interface-configuration).

Other than simple HTML and Twig logic to show/hide elements of the footer, the template also includes the `pagination` block. This has been separated to its own template to better separate the html/twig logic from the Vue widget.

#### pagination.html.twig
This block is the rendering of the [`<ais-pagination> widget`](https://www.algolia.com/doc/api-reference/widgets/pagination/vue/?target=_blank) and it has been entirely customized with the use of [slots](https://www.algolia.com/doc/api-reference/widgets/pagination/vue/#customize-the-ui?target=_blank).

### Special templates
There are a couple of special templates that are design to separate some logic from the UI and to make it easier to extend and modify the interface, without affecting anything else directly.

#### assets.html.twig
The assets' template is responsible for loading the CSS and JavaScript that make the interface work. Without these, you will have a hard time having anything functional and usable on the frontend.

The template has logic to load the built-in style, which can be [disabled](#user-interface-configuration) if needed, and injects a dynamic CSS variable in your site for the accent color.

There is also logic to load the JavaScript either from the compiled version (which is often all you need), or the Webpack HMR in case you decide to do some development with it.

###### Tailwind CSS
Algolia Pro interface is built with the popular CSS framework [TailwindCSS](https://tailwindcss.com/?target=_blank). If your site comes already with Tailwind CSS, you should consider disabling the built-in css from the [configuration](#user-interface-configuration).

Additionally, you will need to recompile your theme's CSS. To do so, ensure that the `algolia-pro` plugin folder is part of the content sources in your theme's `tailwind.config.js`.

```js
// Tailwind 2
purge: {
  content: [
    // ...
    '../../plugins/algolia-pro/**/*.twig',
  ]
}

// Tailwind 3
content: [
  // ...
  '../../plugins/algolia-pro/**/*.twig',
]
```

> [!NOTE]
> You might have to tweak the `..` parent paths based on your `tailwind.config.js` location, relative to the `user` folder.

#### configure.html.twig
The `configure` template serves as a proxy between the Algolia Pro settings and the Algolia InstantSearch service. This happens within a `configure` block and through the [`<ais-configure>` widget](https://www.algolia.com/doc/api-reference/widgets/configure/vue/?target=_blank).

The provided implementation loops through all the settings available within the **Search Parameters** configuration (`settings.search`) and feeds them to the `<ais-configure>`. Unless you are confident in what you are doing, we do not recommend changing this template.

> [!NOTE]
> Dash separated attributes should be transformed with the `.camel` modifier. For example `hits-per-page` should be rendered as `hits-per-page.camel`.

## JavaScript and programmatic interaction
As a developer you might find useful having the opportunity to interact with the Algolia Pro frontend class. Algolia Pro makes this possible by exposing a window global `AlgoliaPro` array of instances.

The global object is not exposed by default and might return a `protected` string instead of the expected object. If you need to access it from your JavaScript, turn on the [Expose Global JS Object](#user-interface-configuration) option. 

Like any other interface setting, you can tweak which instance can be exposed and which cannot. However, at this time, we only support one instance at a time.

When accessing the object you should be targeting the `0` index of the array. At this time Algolia Pro provides and is tested for only one instance. Below is a list of properties and methods available to you from the global object `window.AlgoliaPro[0]`:

##### Properties
Some properties are reactive which means you can change their values and affect the state of the app. For example to open the modal programmatically, you can write `window.AlgoliaPro[0].isOpen = true`.

- **isOpen** → (_reactive_) State of the Algolia Pro modal, whether is open or not. Set to `true` or `false` to open/close
- **warmConnection** → The current warm connection setting. [See configuration](#user-interface-configuration).
- **selected** →  (_reactive_) The currently selected item. Contains an Algolia object with all the details regarding the item. Set to `null` to unselect the item
- **query** → The current query used for searching.
- **appearance** → The current appearance option. [See configuration](#user-interface-configuration).
- **activeAppearance** → The current actual active theme with automatic calculation if set to system. Can be either `light` or `dark`.
- **isDark** → Whether the appearance theme is dark or not
- **mq** → The [Media Query List](https://developer.mozilla.org/en-US/docs/Web/API/Window/matchMedia?target=_blank) object on which the system color scheme `change` event is attached to.
- **searchClient** → The Algolia search client instance. This is the core InstantSearch object that makes the whole magic happens. [Documentation](https://www.algolia.com/doc/api-reference/widgets/instantsearch/js/#widget-param-searchclient?target=_blank)


##### Methods
- **isSelected(item)** → Checks whether the passed in item object is the one being selected or not 
- **setAppearance(appearance)** → Changes the appearance theme of the search. Can be `light`, `dark`, or `system`.


---

[![Backend Docs](../backend-docs.png?class=image-shadow,subdocs&cropResize=350)](../backend)
