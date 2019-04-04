---
title: Build a Blog
taxonomy:
    category: docs
---

!! Download and install locally the Blog Site skeleton from [https://getgrav.org/downloads/skeletons](https://getgrav.org/downloads/skeletons), or at least have ready the [https://github.com/getgrav/grav-skeleton-blog-site](https://github.com/getgrav/grav-skeleton-blog-site) repository to check. This is a sample site that uses the Antimatter theme. Having an up and running Grav site that already works with a Blog structure will surely give a hand if you’re stuck or you don’t understand what to do next.

## Check your theme provides the Blog and Item page templates

Let’s start simple: choose a theme that already provides a blog page template. For example Antimatter, TwentyFifteen, Deliver, Lingonberry, Afterburner2, and many others.
How do you check if your theme already provides a blog page template? Go in the `/user/themes/[yourtheme]/templates` folder, and check the existence of the `blog.html.twig` and `item.html.twig` files.

If you’ve already chosen a theme, and your theme does not come with those files, then copy them from Antimatter: [https://github.com/getgrav/grav-theme-antimatter/tree/develop/templates](https://github.com/getgrav/grav-theme-antimatter/tree/develop/templates)

You might need to tweak the markup to suit your theme. The best option if you’re just starting out if to use a theme that already comes with them.

## Create the blog pages structure
There are different ways to structure the pages. The default and simpler one is to have a parent page, of type Blog, and have child pages for the blog posts.

### With the Admin Plugin
Create a page of type Blog. That page is the blog "Homepage", with the blog posts list.

Create one or more child pages of type `Item`. Those are the blog posts.

### Manually
Go in your pages/ folder, create a `01.blog` page (change the number to reflect your menu structure), add a `blog.md` file in it.
In this file, add this content:

[prism classes="language-yaml line-numbers"]
---
content:
    items: '@self.children'
---
[/prism]

This tells Grav to iterate over the subpages (the blog posts).

Create a subfolder for each post you want to add, and add in each folder an `item.md` file, with the content of the blog post.

## URLs

The structure explained above will create blog posts with `/blog/` in the URL. This might not be what you need. For example: If a blog is all you have on your site, and the blog posts listing is the home page. In these cases, you would just want your root domain to access this content rather than referring visitors to a child directory.

In this case, in system.yaml (System configuration in Admin) set `home.hide_in_urls` option (Hide Home in URLs in Admin) to true.

## The inner workings

You might want to know how this works. The Blog template, the content of the `blog.html.twig` file provided in the theme `templates/` folder, simply iterates over its child pages.

In its simplest way:

[prism classes="language-twig line-numbers"]
{% set collection = page.collection() %}`

{% for child in collection %}
        {% include 'partials/blog_item.html.twig' with {'blog':page, 'page':child, 'truncate':true} %}
{% endfor %}
[/prism]

page.collection() by default picks the `content.items` property of the page YAML frontmatter, and returns an array containing the elements that match that definition.

If the page contains:

[prism classes="language-yaml line-numbers"]
---
content:
    items: '@self.children'
---
[/prism]

then `collection` will be the array of the subpages of the current page.

In this case the theme includes the partial `partials/blog_item.html.twig`, responsible for rendering the single blog post, and passes it the `child` object containing the actual blog post to render.

### To learn more

- Collections: [https://learn.getgrav.org/content/collections](https://learn.getgrav.org/content/collections)
- Listing Page: [https://learn.getgrav.org/content/content-pages#listing-page](https://learn.getgrav.org/content/content-pages#listing-page)
- Folders: [https://learn.getgrav.org/content/content-pages#folders](https://learn.getgrav.org/content/content-pages#folders)
- Taxonomy: [https://learn.getgrav.org/content/taxonomy#taxonomy-example](https://learn.getgrav.org/content/taxonomy#taxonomy-example)
