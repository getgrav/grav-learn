---
title: Routing
taxonomy:
    category: docs
---

As we already described in the opening [Page -> Folders section](../content-pages#folders), **routing** in Grav is primarily controlled by the folder structure you use when you build your site content.

There are certain scenarios where you need more flexibility and Grav comes packed with a variety of tools and configuration options to make your life simpler in this regard.

Imagine if you moved your site from some other CMS platform to Grav, you have several choices on how to set up your new site:

1. Try to replicate the URLs of your old site by building the folder structure to match.
2. Build your new site the way you want, and then have your web server 'rewrite' old URLs to redirect clients to the new locations.
3. Build your new site the way you want, and configure Grav to redirect clients from the old URLs to the new locations.

There are many other use cases where you may wish to have the Grav site respond to different URLs than the folder structure dictates, and Grav has the following capabilities to help you realize your objectives.

## Page Level Route Overrides

As outlined in the [Headers -> Routes section](../headers#routes), you can provide explicit routing options for the **default route** as well as an array of **route aliases**:

[prism classes="language-yaml line-numbers"]
routes:
  default: '/my/example/page'
  canonical: '/canonical/url/alias'
  aliases:
    - '/some/other/route'
    - '/can-be-any-valid-slug'
[/prism]

These are processed and cached per-page, and are available along with what we call the **raw route** which is the route based on the **slugs** of the page hierarchy (which is how Grav works out a route by default).  So even if you provide custom page routes, the **raw route** is still always valid too.

## Site Level Routes and Redirects

Grav has a powerful regex-based mechanism for handling **route aliases** and **redirects** from one page to another. This feature is particularly useful when you migrate a site to Grav and want to ensure the old URLs will still work with the new site. This is often best accomplished via **rewrite rules** using your web server, but sometimes it's more convenient and flexible just to let Grav handle them.

These are handled via the [Site Configuration](../../basics/grav-configuration#site-configuration). Grav comes with a sample `system/config/site.yaml` but you can override or add any of your own settings by editing the `user/config/site.yaml` file.

!! All redirect rules apply on the slug-path beginning after the language part (if you use multi-language pages)


### Route Aliases

#### Simple Aliases

The most basic kind of alias is a direct one-to-one mapping. In the `routes:` section of the `site.yaml`, you can create a list of mappings to indicate the alias and the actual route that should be used.

!! It's important to note that these aliases are only used if no valid page is found with the route provided

[prism classes="language-yaml line-numbers"]
routes:
  /something/else: '/blog/focus-and-blur'
[/prism]

If you requested a URL `http://mysite.com/something/else` and that was not a valid page, the routes definition would actually serve you the page located at `/blog/focus-and-blur`, assuming it exists. This does not actually **redirect** the user to the provided page, it simply displays the page when you request the alias.

#### Regex-Based Aliases

A more advanced type of alias redirect allows the use of a simple **regex** to map part of an alias to a route.  For example, if you had:

[prism classes="language-yaml line-numbers"]
routes:
   /another/(.*): '/blog/$1'
[/prism]

This would route the wildcard from the alias to the route, so `http://mysite.com/another/focus-and-blur` would actually display the page found at the `/blog/focus-and-blur` route. This is a powerful way to map one set of URLs to another. Great for moving your site from WordPress to Grav :)

You can also perform the match to capture any alias, and map that to a specific route:

[prism classes="language-yaml line-numbers"]
routes:
  /one-ring/(.*): '/blog/sunshine-in-the-hills'
[/prism]

With this route alias, any URL that confirms to the wildcard: `/one-ring/to-rule-them-all` or `/one-ring/is-mine.html` will both show the content from the page with the route `/blog/sunshine-in-the-hills`.

You can even get much more creative and map multiple items or use any regex syntax:

[prism classes="language-yaml line-numbers"]
routes:
  /complex/(category|section)/(.*): /blog/$1/folder/$2
[/prism]

This would match and rewrite the following:

[prism classes="language-text line-numbers"]
/complex/category/article-1      -> /blog/category/folder/article-1
/complex/section/article-2.html  -> /blog/section/folder/article-2.html
[/prism]

This route would not match anything that doesn't start with `complex/category` or `complex/section`.  For more information, [Regexr.com](http://regexr.com/) is a fantastic resource to learn about and test regular expressions.

### Redirects

The other corollary option to **route aliases** is provided by **redirects**. These are similar, but rather than keeping the URL and simply serving the content from the aliased route, Grav actually redirects the browser to the mapped page.

There are three system-level configuration options that affect Redirects:

[prism classes="language-yaml line-numbers"]
pages:
  redirect_default_route: false
  redirect_default_code: 302
  redirect_trailing_slash: true
[/prism]

* `redirect_default_route` enables Grav to automatically redirect to the page's default route.
* `redirect_default_code` allows you to set the default HTTP redirect codes:
    * **301**: Permanent redirect. Clients making subsequent requests for this resource should use the new URI. Clients should not follow the redirect automatically for POST/PUT/DELETE requests.
    * **302**: Redirect for undefined reason. Clients making subsequent requests for this resource should not use the new URI. Clients should not follow the redirect automatically for POST/PUT/DELETE requests.
    * **303**: Redirect for undefined reason. Typically, 'Operation has completed, continue elsewhere.' Clients making subsequent requests for this resource should not use the new URI. Clients should follow the redirect for POST/PUT/DELETE requests.
    * **307**: Temporary redirect. Resource may return to this location at a later point. Clients making subsequent requests for this resource should use the old URI. Clients should not follow the redirect automatically for POST/PUT/DELETE requests.
* `redirect_trailing_slash` option lets you redirect to a non-trailing slash version of the current URL

For example:

[prism classes="language-yaml line-numbers"]
redirects:
    /jungle: '/blog/the-urban-jungle'
[/prism]

You can also explicitly pass the redirect code between square brackets `[]` as part of the URL:

[prism classes="language-yaml line-numbers"]
redirects:
    /jungle: '/blog/the-urban-jungle[303]'
[/prism]

If you were to point your browser to `http://mysite.com/jungle`, you would actually get redirected and end up on the page: `http://mysite.com/blog/the-urban-jungle`.

The same regular expression capabilities that exist for Route Aliases, also exist for Redirects.  For example:

[prism classes="language-yaml line-numbers"]
redirects:
    /redirect-test/(.*): /$1
    /complex/(category|section)/(.*): /blog/$1/folder/$2
[/prism]

These look almost identical to the Route Alias version, but instead of transparently showing the new page, Grav actually redirects the browser and loads the new page specifically.

## Hiding the Home Route

When you set a certain page to be your site's home via the `system.yaml` file:

[prism classes="language-yaml line-numbers"]
home:
  alias: '/home'
[/prism]

You are effectively telling Grav to add a route of `/` as an alias for that page.  This means that when Grav is requesting the page for the `/` URL, it finds the page you have set.

However, Grav really doesn't do anything special for pages that are beneath this homepage.  So if you have a page called `/blog` that displays a list of your blog posts, and you set this to be your homepage, it will work as expected.  If however, you click on a blog post that sits beneath the `/blog` folder, the URL could be `/blog/my-blog-post`.  This is expected behavior, but it might not be what you intend.  There is a new option available via the `system.yaml` that let's you hide this top level `/blog` from the route if so enabled.

You can enable this behavior by toggling the following value:

[prism classes="language-yaml line-numbers"]
home:
  hide_in_urls: true
[/prism]
