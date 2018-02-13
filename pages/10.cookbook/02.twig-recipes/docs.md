---
title: Twig Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Twig templating.

1. [List the last 5 recent blog posts](#list-the-last-5-recent-blog-posts)
1. [List the blog posts for the year](#list-the-blog-posts-for-the-year)
1. [Displaying a translated month](#displaying-a-translated-month)
1. [Displaying page content without summary](#displaying-page-content-without-summary)
1. [Hiding the email to spam bots](#hiding-the-email-to-spam-bots)
1. [Picking a random item from a translated array](#picking-a-random-item-from-a-translated-array)
1. [Displaying an image uploaded in a file field](#displaying-an-image-uploaded-in-a-file-field)
1. [Displaying an image picked in a mediapicker field](#displaying-an-image-picked-in-a-mediapicker-field)

### List the last 5 recent blog posts

##### Problem:

You want to display the last 5 blog posts in a sidebar of your site so a reader can see recent blog activity.

##### Solution:

Simply find the `/blog` page, obtain it's children, order them by date in a descending order, and then get the first 5 to display in a list:

```
<ul>
{% for post in page.find('/blog').children.order('date', 'desc').slice(0, 5) %}
    <li class="recent-posts">
        <strong><a href="{{ post.url }}">{{ post.title }}</a></strong>
    </li>
{% endfor %}
</ul>
```

when using within pages make sure you add following configuration to the page header:

```
twig_first: true
process:
    twig: true
```


### List the blog posts for the year

##### Problem:

You want to display all the blog posts that have occurred in this calendar year.

##### Solution:

Simply find the `/blog` page, obtain it's children, filter by appropriate `dateRange()`, and order them by date in a descending order:

```
<ul>
{% set this_year = "now"|date('Y') %}
{% for post in page.find('/blog').children.dateRange('01/01/' ~ this_year, '12/31/' ~ this_year).order('date', 'desc') %}
    <li class="recent-posts">
        <strong><a href="{{ post.url }}">{{ post.title }}</a></strong>
    </li>
{% endfor %}
</ul>
```

### Displaying a translated month

##### Problem:

In some page templates, the Twig `date` filter is used, and it does not handle locales / multilanguage. So even if your page is in a language different than english, it could show the month in english, if the template chooses to show the month name.

##### Solution:

There are two solutions to this problem. 

###### First approach

The first involves the use of the Twig intl extension.

Install https://github.com/Perlkonig/grav-plugin-twig-extensions. Make sure you have the PHP intl extension installed.

In your twig template, instead of for example (like in the Antimatter theme) `{{ page.date|date("M") }}` to `{{ page.date|localizeddate('long', 'none', 'it', 'Europe/Rome', 'MMM') }}` (add your language and timezone here)

###### Second approach

Let's assume you have some language translations setup in your `user/languages/` folder called `en.yaml` that contains the entry:
```
MONTHS_OF_THE_YEAR: [January, February, March, April, May, June, July, August, September, October, November, December]
```

And in `fr.yaml`:
```
MONTHS_OF_THE_YEAR: [Janvier, Février, Mars, Avril, Mai, Juin, Juillet, Août, Septembre, Octobre, Novembre, Décembre]
```

Then you have your Twig:

```
<li>
    <a href='{{ post.url }}'><aside class="dates">{{ 'MONTHS_OF_THE_YEAR'|ta(post.date|date('n') - 1) }} {{ post.date|date('d') }}</aside></a>
    <a href='{{ post.url }}'>{{ post.title }}</a>
</li>
```

This makes use of the Grav custom Twig filter `|ta` that stands for **Translate Array**.  In the English version, the output might be something like:

```
An Example Post  July 2015
```

And the French:

```
Un exemple d’article Juillet 2015
```

### Displaying page content without summary

##### Problem:

You want to display the content of a page without the summary at top.

##### Solution:

Use the  `slice` filter to remove the summary from the page content:

```
{% set content = page.content|slice(page.summary|length) %}
{{ content }}
```


### Hiding the email to spam bots

##### Problem:

You want to hide the email from spam bots

##### Solution:

Enable Twig processing in the page header:

```
process:
    twig: true
```

Then use the `safe_email` Twig filter:

```html
<a href="mailto:{{'your.email@server.com'|safe_email}}">
  Email me
</a>
```

### Picking a random item from a translated array

##### Problem:

You want to pick a random item from an array translated in a particular language.  For this to work, it's assumed you have your [multi-language site setup and configured](../../content/multi-language) as outlined in the documentation.

##### Solution:

Let's also assume you have some language translations setup in your `user/languages/` folder called `en.yaml` that contains the entry:

```
FRUITS: [Banana, Cherry, Lemon, Lime, Strawberry, Raspberry]
```

And in `fr.yaml`:

```
FRUITS: [Banane, Cerise, Citron, Citron Vert, Fraise, Framboise]
```

Then you have your Twig:

```
{% set langobj  = grav['language'] %}
{% set curlang  = langobj.getLanguage() %}
{% set fruits   = langobj.getTranslation(curlang,'FRUITS',true) %}
<span data-ticker="{{ fruits|join(',') }}">{{ random(fruits) }}</span>
```

### Displaying an image uploaded in a file field

##### Problem

You added a `file` field in your custom blueprint, and you want to display an image added in this field.

##### Solution

As the `file` field allows for multiple images to be uploaded, it generates two nested objects in your frontmatter, the first object is the list of the uploaded images, the nested object within is a group of property/value for the given image.

_Note that in the case where you would want your user to only select a single image, it could be easier to use the `filepicker` field, that store a single object with the selected images properties._

If you have a single image, you can display it in your template by using:

```
{{ page.media[header.yourfilefield|first.name] }}
```

If you allowed your user to upload multiple images, your twig could look like this:

```
{% for imagesuploaded in page.header.yourfilefield %}
{{ page.media[imagesuploaded.name] }}
{% endfor %}
```

### Displaying an image picked in a mediapicker field

##### Problem

You added a `mediapicker` field in your custom blueprint, and you want to display the image selected.

##### Solution

A `mediapicker` field can be added to your blueprint like below:

```
header.myimage:
  type: mediapicker
  folder: 'self@'
  label: Select a file
  preview_images: true
```    

The `mediapicker` field store the path to the image as a string such as `/home/background.jpg`
In order to access this image with the page media functionality, you have to split this string and get:
 - the path to the page where this image is stored
 - the name of the image.

You can do this via twig by using the snippet below:

```
{% set image_parts = pathinfo(header.myimage) %}
{% set image_basename = image_parts.basename %}
{% set image_page = image_parts.dirname == '.' ? page : page.find(image_parts.dirname) %}

{{ image_page.media[image_basename].html() }}
```
