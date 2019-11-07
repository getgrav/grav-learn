---
title: Taxonomy
taxonomy:
    category: docs
---

With **Grav**, the ability to group or tag pages is baked right into the system with **Taxonomy**.

> **Taxonomy (general),** the practice and science (study) of classification of things or concepts, including the principles that underlie such classification.
>
> <cite>Wikipedia</cite>

There are a couple of key parts to using taxonomy in your site:

1. Define a list of Taxonomy types in your [`site.yaml`](../../basics/grav-configuration).
2. Assign your pages to the appropriate `taxonomy` types with values.

## Taxonomy Example

This concept is best explained with an example. Let us say you want to create a simple blog. In that blog, you will create posts that you might want to assign to certain tags to provide a **tag cloud** display. Also, you could have several authors, and you might want to assign each post to that author.

Accomplishing this in Grav is a simple procedure. Grav provides a default `site.yaml` file that is located in the `system/config` folder. By default that configuration defines two taxonomy types of `category` and `tag`:

```yaml
taxonomies: [category,tag]
```

As `tag` is already defined, you just need to add `authors`. To do this simply create a new `site.yaml` file in your `user/config` folder and add the following line:

```yaml
taxonomies: [category,tag,author]
```

This will override the taxonomies that Grav knows about so that pages can be assigned to any of these three taxonomies.

The next step is to create some pages that make use of these taxonomy types. For example, you could have a page that looks like this:

[prism classes="language-markdown line-numbers"]
---
title: Post 1
taxonomy:
    tag: [animal, dog]
    author: ksmith
---

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
[/prism]

...and another page that looks like:

[prism classes="language-markdown line-numbers"]
---
title: Post 2
taxonomy:
    tag: [animal, cat]
    author: jdoe
---

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
[/prism]


As you can see in the YAML configuration, each page is assigning **values** to the **taxonomy types** we defined in our user `site.yaml` configuration. This information is used by Grav when the pages are processed and creates an internal **taxonomy map** which can be used to find pages based on the taxonomy you defined.

!!!! Your pages do not have to use every taxonomy you define in your `site.yaml`, but you must define any taxonomy you use.

In your theme, you can easily display a list of pages that are written by `ksmith` by using `taxonomy.findTaxonomy()` to find them and iterate over them:

[prism classes="language-twig line-numbers"]
<h2>Kevin Smith's Posts</h2>
<ul>
{% for post in taxonomy.findTaxonomy({'author':'ksmith'}) %}
    <li>{{ post.title }}</li>
{% endfor %}
</ul>
[/prism]

You can also do sophisticated searches based on multiple taxonomies by using arrays/hashes, for example:

[prism classes="language-twig line-numbers"]
{% for post in taxonomy.findTaxonomy({'tag':['animal','cat'],'author':'jdoe'}) %}
[/prism]

This will find all posts with `tag` set to `animal` **and** `cat` **and** `author` set to `jdoe`. Basically, this will specifically find **Post 2**.

If you need a collection which includes one term **or** the other, just add the `'or'` parameter after the array, example:

[prism classes="language-twig line-numbers"]
{% for post in taxonomy.findTaxonomy({'tag':['dog','cat']},'or') %}
[/prism]

This will find all posts with `tag` set to `dog` **or** `cat`.


## Taxonomy based Collections

We covered this in an earlier chapter, but it is important to remember that you can also use taxonomies in the [page headers](../headers) to filter a collection of pages associated with a parent page. If you need a refresher on this subject, please refer back to that [chapter on taxonomy collection headers](../collections).

## Adding Custom Taxonomy Values in Default and Options

You can use the format below in blueprints to override the `Default` and/or `Options` taxonomies. An important note here is that if you are using this method to override both of these attributes, you should add `validate: type: commalist`, otherwise it may not function as desired.

[prism classes="language-yaml line-numbers"]
taxonomies:
  fields:
    header.taxonomy:
      default:
        category: ['blog','page']
        tag: ['test']
      options:
        category: ['grav']
      validate:
        type: commalist
[/prism]
