---
title: Page Collections
taxonomy:
    category: docs
---

Collections have grown considerably since the early betas of Grav. We started off with a very limited set of page-based collections, but with the help of our community we have increased these capabilities to make them even more powerful!  So much so that they now have their own section in the documentation.

## Collection Headers

To tell Grav that a specific page should be a listing page and contain child-pages, there are a number of variables that can be used:

### Summary of collection options

| String                                    | Result                                                    |
| :----------                               | :----------                                               |
| '@root'                                   | Get the root children                                     |
| '@root.children'                          | Get the root children (alternative)                       |
| '@root.descendants'                       | Get the root and recurse through ALL children             |
|                                           |                                                           |
| '@self.parent'                            | Get the parent of the current page                        |
| '@self.siblings'                          | A collection of all other pages on this level             |
| '@self.modular'                           | Get only the modular children                             |
| '@self.children'                          | Get the non-modular children                              |
| '@self.descendants'                       | Recurse through all the non-modular children              |
|                                           |                                                           |
| '@page': '/fruit'                         | Get all the children of page `/fruit'                     |
| '@page.children': '/fruit'                | Alternative to above                                      |
| '@page.self': '/fruit'                    | Get a collecton with only the page `/fruit'               |
| '@page.descendants': '/fruit'             | Get and recurse through all the children of page '/fruit' |
|                                           |                                                           |
| '@taxonomy.tag': photography              | taxonomy with tag='photography'                           |
| '@taxonomy': {tag: birds, category: blog} | taxonomy with tag='photography' && category='blog'        |

We will cover these more in detail. The `content.items` value tells Grav to gather up a collection of items and information passed to this defines how the collection is to be built.

## Root Collections

##### @root - Top level children

This can be used to retrieve the top/root level **published non-modular children** of a site. Particular useful for getting the items that make up the primary navigation for example:

```ruby
content:
    items: '@root'
```

an alias is also valid:

```ruby
content:
    items: '@root.children'
```

##### @root - Top level children + all descendants

This will effectively get every page in your site as it recursively navigates through all the children from the root page down, and builds a collection of **all** the **published non-modular children** of a site.

```ruby
content:
    items: '@root.descendants'
```

## Self Collections

##### @self.children - Children of the current page

This is used to list the **published non-modular children** of the current page:

```ruby
content:
    items: '@self.children'
```

##### @self.descendants - Modular children + all descendants of the current page

Similar to `.children`, the `.descendants` collection will retrieve all the **published non-modular children** but continue to recurse through all their children.

```ruby
content:
    items: '@self.descendants'
```

##### @self.modular - Modular children of the current page

The inverse of `.children`, this method retrieves only **published modular children** of the current page (`_features`, `_showcase`, etc.)

```ruby
content:
    items: '@self.modular'
```

##### @self.parent - The parent page of the current page

This is a special case collection because it will always return just the one **parent** of the current page

```ruby
content:
    items: '@self.parent'
```

##### @self.siblings - All the sibling pages

This collection will collect all the **published** Pages at the same level of the current page, excluding the current page.

```ruby
content:
    items: '@self.siblings'
```

## Page Collections

##### @page - Collection of children of a specific page

This collection takes a slug route of a page as an argument and will return all the **publish non-modular** children of that page

```ruby
content:
    items:
      '@page': /blog
```

alternatively:

```ruby
content:
    items:
      '@page.children': /blog
```

##### @page.self - Collection of just the specific page

This collection takes a slug route of a page as an argument and will return collection containing that page (if it is **published and non-modular**)

```ruby
content:
    items:
      '@page.self': /blog
```

##### @page.descendants - Collection of children + all descendants of a specific page

This collection takes a slug route of a page as an argument and will return all the **publish non-modular** children and all their descendants of that page

```ruby
content:
    items:
      '@page.descendants': /blog
```

## Taxonomy Collections

```ruby
content:
   items:
      '@taxonomy.tag': foo
```

Using the '@taxonomy` option, you can utilize Grav's powerful taxonomy functionality.  This is where the `taxonomy` variable in the [Site Configuration](../../basics/grav-configuration#site-configuration) file comes into play. There **must** be a definition for the taxonomy defined in that configuration file for Grav to interpret a page reference to it as valid.

By setting '@taxonomy.tag: foo`, Grav will find all the **published pages** in the `/user/pages` folder that have themselves set `tag: foo` in their taxonomy variable.

```ruby
content:
    items:
       '@taxonomy.tag': [foo, bar]
```

The `content.items` variable can take an array of taxonomies and it will gather up all pages that satisfy these rules. Publsihed pages that have **both** `foo` **and** `bar` tags will be collected.  The [Taxonomy](../taxonomy) chapter will cover this concept in more detail.

>>> If you wish to place multiple variables inline, you will need to separate sub-variables from their parents with `{}` brackets. You can then separate individual variables on that level with a comma. For example: '@taxonomy: {category: [blog, featured], tag: [foo, bar]}`. In this example, the `category` and `tag` sub-variables are placed under '@taxonomy` in the hierarchy, each with listed values placed within `[]` brackets. Pages must meet **all** these requirements to be found.

If you have multiple variables in a single parent to set, you can do this using the inline method, but for simplicity, we recommend using the standard method. Here is an example.

```ruby
content:
  items:
    '@taxonomy':
      category: [blog, featured]
      tag: [foo, bar]
```

Each level in the hierarchy adds two whitespaces before the variable. YAML will allow you to use as many spaces as you want here, but two is standard practice. In the above example, both the `category` and `tag` variables are set under '@taxonomy`.

### Multiple Collections

With Grav **0.9.41** you can now provide multiple collection definition and the resulting collection will be the sum of all the pages found from each of the collection definitions.

for example:

```ruby
content:
  items:
    - '@self.children'
    - '@taxonomy':
         category: [blog, featured]
```

### Ordering Options

```ruby
content:
    order:
        by: date
        dir: desc
        custom:
            - _showcase
            - _highlights
            - _callout
            - _features
    limit: 5
    pagination: true
```

Ordering of sub-pages follows the same rules as ordering of folders, the available options are:

| Ordering     | Details                                                                                                                                            |
| :----------  | :----------                                                                                                                                        |
| **default**  | The order based on the file system, i.e. `01.home` before `02.advark`                                                                              |
| **title**    | The order is based on the title as defined in each page                                                                                            |
| **basename** | The order is based on the alphabetic folder name after it has been processed by the `basename()` PHP function                                      |
| **date**     | The order based on the date as defined in each page                                                                                                |
| **modified** | The order based on the modified timestamp of the page                                                                                              |
| **folder**   | The order based on the folder name with any numerical prefix, i.e. `01.`, removed                                                                  |
| **header.x** | The order based on any page header field. i.e. `header.taxonomy.year`. Also a default can be added via a pipe. i.e. `header.taxonomy.year|2015`    |
| **manual**   | The order based on the `order_manual` variable                                                                                                     |
| **random**   | The order is randomized                                                                                                                            |

The `content.items.dir` variable controls which direction the ordering should be in. Valid values are either `desc` or `asc`.

In this configuration, you can see that `content.order.custom` is defining a **custom manual ordering** to ensure the page is constructed with the **showcase** first, **highlights** section second etc. Please note that if a page is not specified in the custom ordering list, then Grav falls back on the `content.order.by` for the unspecified pages.

`content.limit` is pretty self explanatory, and the `content.pagination` is a simple boolean flag to be used by plugins etc to know if **pagination** should be initialized for this collection.

### Date Range

New as of **Grav 0.9.13** is the ability to filter by a date range:

```
content:
    items: '@self.children'
    dateRange:
        start: 1/1/2014
        end: 1/1/2015
```

You can use any string date format supported by [strtotime()](http://php.net/manual/en/function.strtotime.php) such as `-6 weeks` or `last Monday` as well as more traditional dates such as `01/23/2014` or `23 January 2014`. The dateRange will filter out any pages that have a date outside the provided dateRange.  Both **start** and **end** dates are optional, but at least one should be provided.
