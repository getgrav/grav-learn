---
title: Route Aliases & Redirects
taxonomy:
    category: docs
---

Grav has a powerful regex-based mechanism for handling **route aliases** and **redirects** from one page to another. This feature is particularly useful when you migrate a site to Grav and want to ensure the old URLs will still work with the new site. This is often best accomplished via **rewrite rules** using your web server, but sometimes it's more convenient and flexible just to let Grav handle them.

These are handled via the [Site Configuration](../../basics/grav-configuration#site-configuration). Grav comes with a sample `system/config/site.yaml` but you can override or add any of your own settings by editing the `user/config/site.yaml` file.

>>> all redirect rules apply on the slug-path beginning after the language part (if you use multi-language pages)


## Route Aliases

### Simple Aliases

The most basic kind of alias is a direct one-to-one mapping. In the `routes:` section of the `site.yaml`, you can create a list of mappings to indicate the alias and the actual route that should be used.

>>> It's important to note that these aliases are only used if no valid page is found with the route provided

```
routes:
  /something/else: '/blog/focus-and-blur'
```

If you requested a URL `http://mysite.com/something/else` and that was not a valid page, the routes definition would actually serve you the page located at `/blog/focus-and-blur`, assuming it exists. This does not actually **redirect** the user to the provided page, it simply displays the page when you request the alias.

### Regex-Based Aliases

A more advanced type of alias redirect allows the use of a simple **regex** to map part of an alias to a route.  For example, if you had:

```
routes:
   /another/(.*): '/blog/$1'
```

This would route the wildcard from the alias to the route, so `http://mysite.com/another/focus-and-blur` would actually display the page found at the `/blog/focus-and-blur` route. This is a powerful way to map one set of URLs to another. Great for moving your site from WordPress to Grav :)

You can also perform the match to capture any alias, and map that to a specific route:

```
routes:
  /one-ring/(.*): '/blog/sunshine-in-the-hills'
```

With this route alias, any URL that confirms to the wildcard: `/one-ring/to-rule-them-all` or `/one-ring/is-mine.html` will both show the content from the page with the route `/blog/sunshine-in-the-hills`.

You can even get much more creative and map multiple items or use any regex syntax:

```
routes:
  /complex/(category|section)/(.*): /blog/$1/folder/$2
```

This would match and rewrite the following:

```
/complex/category/article-1      -> /blog/category/folder/article-1
/complex/section/article-2.html  -> /blog/section/folder/article-2.html
```

This route would not match anything that doesn't start with `complex/category` or `complex/section`.  For more information, [Regexr.com](http://regexr.com/) is a fantastic resource to learn about and test regular expressions.

### Redirects

The other corollary option to **route aliases** is provided by **redirects**. These are similar, but rather than keeping the URL and simply serving the content from the aliased route, Grav actually redirects the browser to the mapped page. For example:

```
redirects:
    /jungle: '/blog/the-urban-jungle'
```

If you were to point your browser to `http://mysite.com/jungle`, you would actually get redirected and end up on the page: `http://mysite.com/blog/the-urban-jungle`.

The same regular expression capabilities that exist for Route Aliases, also exist for Redirects.  For example:

```
redirects:
    /redirect-test/(.*): /$1
    /complex/(category|section)/(.*): /blog/$1/folder/$2
```

These look almost identical to the Route Alias version, but instead of transparently showing the new page, Grav actually redirects the browser and loads the new page specifically.
