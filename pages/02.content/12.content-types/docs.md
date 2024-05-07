---
title: Content Types
taxonomy:
    category: docs
---

## Default Content Type

As is typical with most web platforms, Grav's default content type is **HTML**. This means that when a user requests a route in their browser, for example: `/blog/new-macbook-pros-soon`, because there is no file extension Grav assumes you are requesting an HTML page.  If your page was defined by a page with filename of  `blog-item.md`, Grav in turn looks for a Twig template called `blog-item.html.twig`  to render the page.

If the user requested the type explicitly via `/blog/new-macbook-pros-soon.html`, Grav would still look for that same `blog-item.html.twig` file.

## Other Content Types

Grav is a flexible platform however, and can actually serve up any content type you could wish for (`xml`, `rss`, `json`, `pdf`, etc.), you just have to provide a way to render it appropriately.

If you were to request a route with a `.xml` extension, for example: `/blog.xml`,  instead of using the regular `blog.html.twig` template to render it,
Grav looks for a template called `blog.xml.twig`.  You would need to ensure that template outputs the appropriate XML structure.

### Example with JSON files

A particular common way to access files is via a `.json` extension.  This allows data to be requested via JSON files that are easily processed by JavaScript.

Say you wanted the **frontmatter** and **content** of a particular page in JSON format, and that page was defined in a file called `item.md`.  All you would need to do is to provide a Twig template called `item.json.twig`.  You could put this in your theme's `templates/` folder, or if you were using a plugin to load custom templates, you could add it there.

The contents of this `item.json.twig` file could look something like:

[prism classes="language-twig line-numbers"]
{% set payload = {frontmatter: page.header, content: page.content}  %}
{{ payload|json_encode|raw }}
[/prism]

All this Twig file does is create an array with the page header as **frontmatter** and page **content**, then uses the Twig `json_encode` filter to encode it.

When a user requests the url `/blog/new-macbook-pros-soon.json`, this new Twig file would be used and the output sent would be in the format:

[prism classes="language-json line-numbers"]
{
   "frontmatter":{
      "title":"New Macbook Pros Arriving Soon",
      "date": "14:23 08/01/2016",
      "taxonomy":{
         "category":[
            "blog"
         ],
         "tag":[
            "apple",
            "mbpr",
            "laptops"
         ]
      }
   },
   "content":"<p>this has an -&gt; arrow here and <strong>bold</strong> here</p>\n<blockquote>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies tristique nulla et mattis. Phasellus id massa eget nisl congue blandit sit amet id ligula. Praesent et nulla eu augue tempus sagittis. Mauris faucibus nibh et nibh cursus in vestibulum sapien egestas. Curabitur ut lectus tortor. Sed ipsum eros, egestas ut eleifend non, elementum vitae eros.\n-- <cite> Ronald Wade</cite></p>\n</blockquote>\n<p>Mauris felis diam, pellentesque vel lacinia ac, dictum a nunc. Mauris mattis nunc sed mi sagittis et facilisis tortor volutpat. Etiam tincidunt urna mattis erat placerat placerat ac eu tellus.</p>\n<p>This is a new paragraph</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies tristique nulla et mattis.</p>"
}
[/prism]

This is valid JSON that can easily be parsed and processed by JavaScript.  Easy Peasy!

## Custom Content Types

In order to send the data with the appropriate content type, Grav needs to know the MIME type that the browser expects in order for it to render that content type.  Grav knows about most of the standard content types as defined in the `system/config/media.yaml` file.  If you wish to handle a content type that is not provided, you just need to add an entry to this file.

For example, if you wish to be able to render iCal calendar events, you would need to add this media type to the `media.yaml`:

[prism classes="language-yaml line-numbers"]
  ics:
    type: iCal
    thumb: media/thumb.png
    mime: text/calendar
[/prism]

This defines the `.ics` file extension as an `iCal` file with mime type: `text/calendar`.  Then all you need to do is provide the appropriate `.ical.twig` template to render any file you request of this type.
