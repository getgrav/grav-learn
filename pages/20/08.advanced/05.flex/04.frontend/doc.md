---
title: Displaying Flex Content
taxonomy:
    category: docs
process:
    twig: false
---

# Displaying Flex Content

Once you have a Flex Type defined and its directory enabled, the next step is getting those objects onto the frontend. Grav gives you three complementary ways to do that, each suited to a different job:

1. The **[flex-objects] shortcode**, the sandbox-safe way to drop a collection straight into page content.
2. The **flex-objects page type**, a page that renders a directory (or a single object) using URL parameters.
3. **Twig in your theme templates**, where the `render` tag and the Flex template lookup give you full control.

You can mix and match these freely. A landing page might use the shortcode for a quick list, while a dedicated theme template renders the detailed single-object view.

## The `[flex-objects]` Shortcode

The `[flex-objects]` shortcode (aliased as `[flex]`) renders a Flex collection inline, anywhere page content is processed. It is the recommended way to show Flex data inside content because it does not require you to open up Twig-in-content.

### Why not just use Twig?

In Grav 2.0 the frontend Twig environment runs inside a **sandbox**. The sandbox blocks the kind of privileged calls you would need to fetch a Flex collection from content, for example:

[codesh=twig]
{% render grav.get('flex').collection('people').select([...]) %}
[/codesh]

That call is denied by default, and for good reason: content authors should not be able to reach arbitrary framework internals from a page body. The shortcode solves this cleanly. The handler runs server-side with full privileges, so editors only ever type the safe, limited shortcode syntax while the actual Flex render happens in PHP. You get dynamic Flex output in content without loosening the sandbox.

### Accepted parameters

The shortcode reads the following parameters:

[div class="table-keycol"]

| Parameter | Description |
| :--- | :--- |
| `collection` | The Flex Type (directory) to render, for example `people`. You can also use `type=` as an alias, or the bbcode form `[flex-objects=people]`. This is the only required value. |
| `select` | A comma-separated list of object keys. Narrows the collection to just those objects, preserving the order you list them in. |
| `sort` | A field to sort by. Use `sort="field"` for ascending, or `sort="field|asc"` / `sort="field|desc"` to set the direction explicitly. `order=` is accepted as an alias. |
| `limit` | A positive integer. Renders only the first N objects. |
| `layout` | The collection layout to use. Falls back to `default` when omitted. |

[/div]

### Examples

[codesh-group]
[codesh=twig title="Basic"]
[flex-objects collection=people /]
[/codesh]
[codesh=twig title="Selected keys"]
[flex-objects collection=people select=a131e8aa65,d46e15eaf5,987691a5c3 /]
[/codesh]
[codesh=twig title="Layout, limit, sort"]
[flex-objects collection=people layout=cards limit=10 sort="last_name|asc" /]
[/codesh]
[/codesh-group]

The collection is rendered through its Flex template, exactly as `{% render %}` would, so any collection layout you already have keeps working. See [Twig in Theme Templates](#twig-in-theme-templates) below for how those layouts are resolved.

> [!WARNING]
> The shortcode can render **any registered directory**, including one whose objects you did not intend to publish. Because content authors can type any `collection=` value, be deliberate about which directories are renderable on public pages. Treat the shortcode as a public read path to that data, and do not rely on it to hide anything sensitive. If a directory should never appear on the frontend, do not enable it on a public site, and lean on per-object publish flags in your layouts (for example filtering on a `published` field).

## The `flex-objects` Page Type

The second mechanism is a dedicated page type. A page becomes a Flex page in one of two ways: give its header a `flex` block whose `directory` is set to a type, or set the page `template` to `flex-objects`. The page then renders a directory listing or a single object, driven by URL parameters.

By default a `flex-objects` page takes two URL parameters, **directory** and **id**. They are used to navigate directories.

Display multiple directories in a `directories/flex-objects.md` page:

[codesh=yaml]
---
title: Directories
flex:
  layout: default
  list:
  - contacts
  - services
---

# Directories
[/codesh]

Alternatively you can pass separate configuration for each directory:

[codesh=yaml]
---
title: Directories
flex:
  layout: default
  directories:
    contacts:
      collection:
        title: '{{ directory.title }}'
        layout: default
        object:
          layout: list-default
      object:
        title: 'Contact: {{ object.first_name }} {{ object.last_name }}'
        layout: default
    services:
---

# Directories
[/codesh]

Display a single directory in a `contacts/flex-objects.md` page:

[codesh=yaml]
---
title: Contacts
flex:
  directory: contacts
  collection:
    title: '{{ directory.title }}'
    layout: default
    object:
      layout: list-default
  object:
    title: 'Contact: {{ object.first_name }} {{ object.last_name }}'
    layout: default
---

# Contacts
[/codesh]

Display a single object in a `my-contact/flex-objects.md` page:

[codesh=yaml]
---
title: Contact
flex:
  directory: contacts
  id: ki2ts4cbivggmtlj
  object:
    title: 'Contact: {{ object.first_name }} {{ object.last_name }}'
    layout: default
---

# Contacts
[/codesh]

Example URLs for these pages look like this:

[codesh=bash]
https://www.example.com/directories/directory:contacts/id:ki2ts4cbivggmtlj

https://www.example.com/contacts/id:ki2ts4cbivggmtlj
[/codesh]

When a page receives an `id` parameter it renders that single object; without one it renders the collection listing. The `directory` parameter picks which type to show when the page is not already pinned to one in its header.

> [!TIP]
> You can pass your own parameters inside the `flex` block and use them in your collection and object template files, so the page header doubles as a place to configure your own layouts.

## Twig in Theme Templates

For full control you render Flex collections and objects directly from Twig in your theme, using the `render` tag. Both collections and objects support rendering to HTML, and the output can be customized with two arguments: **layout** and **context**. The layout selects which template file to use (so you can have a compact card list and a richer detail view), while the context passes extra variables through to the template.

[codesh=twig]
{% render collection layout: 'custom' with { context_variable: true } %}

{% render object layout: 'custom' with { context_variable: true } %}
[/codesh]

### Template lookup

Flex templates live in your theme's (or plugin's) `templates/flex` folder. Each type gets two subfolders, one for rendering the collection and one for rendering a single object:

[codesh=bash]
templates/
  flex/
    contacts/
      collection/
        default.html.twig
      object/
        default.html.twig
[/codesh]

Grav resolves the template by type and layout name:

- Collections load from `flex/{TYPE}/collection/{LAYOUT}.html.twig`
- Objects load from `flex/{TYPE}/object/{LAYOUT}.html.twig`

The `{LAYOUT}` segment is the `layout:` you pass to `render` (falling back to `default`), and the filename basename is the layout name. In the example above we have a `default` layout for both the collection and the object.

### Collection template

A collection template is responsible for rendering all the objects in the collection. Rendered output is cached by default; the cache key is derived from the collection and the context passed to the `render()` method.

> [!NOTE]
> If the context contains non-scalar values, caching is turned off. Keep the context as simple as possible.

Here is an example collection template:

[codesh=twig]
<div id="flex-objects">
  <div class="text-center">
    <input class="form-input search" type="text" placeholder="Search by name, email, etc" />
    <button class="button button-primary sort asc" data-sort="name">
      Sort by Name
    </button>
  </div>

  <ul class="list">
    {% for object in collection.filterBy({ published: true }) %}
      <li>
        {% render object layout: layout with { options: options } %}
      </li>
    {% endfor %}
  </ul>
</div>
[/codesh]

> [!NOTE]
> If the rendered HTML has dynamic content, render caching can be disabled from inside the Twig template with `{% do block.disableCache() %}`.

### Object template

An object template renders a single object. Its output is cached by default too, keyed by the object and the context passed to `render()`.

> [!NOTE]
> If the context contains non-scalar values, caching is turned off. Keep the context as simple as possible.

Here is an example object template:

[codesh=twig]
<div class="entry-details">
    {% if object.website %}
        <a href="{{ object.website|e }}"><span class="name">{{ object.last_name|e }}, {{ object.first_name|e }}</span></a>
    {% else %}
        <span class="name">{{ object.last_name|e }}, {{ object.first_name|e }}</span>
    {% endif %}
    {% if object.email %}
        <p><a href="mailto:{{ object.email|e }}" class="email">{{ object.email|e }}</a></p>
    {% endif %}
</div>
<div class="entry-extra">
    {% for tag in object.tags %}
        <span>{{ tag|e }}</span>
    {% endfor %}
</div>
[/codesh]

### Custom layouts

Custom layouts let you build any number of different views into your collections and objects. Create one by adding a new file next to `default.html.twig`; the file's basename becomes the layout name. Rendering with `{% render collection layout: 'cards' %}` then loads `flex/{TYPE}/collection/cards.html.twig`.

> [!TIP]
> In collection layouts, prefer calling `{% render object layout: 'xxx' %}` for each item rather than outputting the object's fields directly in the collection template. This keeps the per-object markup in one place and reusable across layouts.

## Which Should I Use?

[div class="table-keycol"]

| If you want to... | Use |
| :--- | :--- |
| Drop a list into page content without touching a theme | The `[flex-objects]` shortcode |
| Give a directory its own frontend URL with list and detail views | The `flex-objects` page type |
| Fully control the markup and integrate with your theme | Twig `render` in theme templates |

[/div]

For the REST API and Admin Next ways of working with the same data, see [Flex REST API](/20/api/endpoints/flex-objects) and the [Admin Next](/20/advanced/flex) sections.
