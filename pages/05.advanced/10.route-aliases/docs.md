---
title: Route Aliases & Redirects
taxonomy:
    category: docs
---

Grav has a simple yet powerful mechanism for handling **route aliases** and **redirects** from one page to another. This feature is particularly useful when you migrate a site to Grav and want to ensure the old URLs will still work with the new site. This is often best accomplished via **rewrite rules** using your web server, but sometimes it's more convenient and flexible just to let Grav handle them.

These are handled via the [Site Configuration](http://localhost/grav-learn/basics/grav-configuration#site-configuration). Grav comes with a sample `system/config/site.yaml` but you can override or add any of your own settings by editing the `user/config/site.yaml` file.

## Route Aliases

### Simple Aliases

The most basic kind of alias is a direct one-to-one mapping. In the `routes:` section of the `site.yaml`, you can create a list of mappings to indicate the alias and the actual route that should be used.

>>> It's important to note that these aliases are only used if no valid page is found with at the route provided

```
routes:
  /something/else: '/blog/focus-and-blur'
```

If you requested a URL `http://mysite.com/something/else` and that was not a valid page, the routes definition would actually serve you the page located at `/blog/focus-and-blur`, assuming it exists. This does not actually **redirect** the user to the provided page, it simply displays the page when you request the alias.

### Wild-Card Aliases

A more advanced type of alias redirect allows the use of a simple **wild card** (`*`) to map part of a alias to a route.  For example, if you had:

```
routes:
   /another/*: /blog/*
```

This would route the wild card from the alias to the route, so `http://mysite.com/another/focus-and-blur` would actually display the page found at the `/blog/focus-and-blur` route. This is a powerful way to map one set of URLs to another. Great for moving your site from WordPress to Grav :)

You can also perform the match to capture any alias, and map that to a specific route:

```
routes:
  /one-ring/*: /blog/sunshine-in-the-hills
```

With this route alias, any URL that confirms to the wild-card: `/one-ring/to-rule-them-all` or `/one-ring/is-mine` will both show the content from the page with the route `/blog/sunshine-in-the-hills`.

### Redirects

The other corollary option to **route aliases** is provided by **redirects**. These are similar, but rather than keeping the URL and simply serving the content from the aliased route, Grav actually redirects the browser to the mapped page. For example:

```
redirects:
    /jungle: /blog/the-urban-jungle
```

If you were to point your browser to `http://mysite.com/jungle`, you would actually get redirected and end up on the page: `http://mysite.com/blog/the-urban-jungle`.

>>> There is no support for wild-card functionality in redirects currently. This is something we plan on adding in the future.
