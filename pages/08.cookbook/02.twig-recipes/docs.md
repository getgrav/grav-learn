---
title: Twig Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Twig templating.

1. [List the last 5 recent blog posts](#list-the-last-5-recent-blog-post)
1. [List the blog bosts for the year](#list-the-blog-posts-for-the-year)
1. [Displaying a translated month](#displaying-a-translated-month)

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

### List the blog bosts for the year

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

This has come up a few times and also is used in the [Multilang Skeleton](https://github.com/getgrav/grav-skeleton-multilang-site) where a user wants to display the current month translated in a particular language.  For this to work, it's assumed you have your [multi-language site setup and configured](../../content/multi-language) as outlined in the documentation.

##### Solution:

Let's also assume you have some language translations setup in your `user/languages/` folder called `en.yaml` that contains the entry:
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
An Example Post                  July 2015
```

And the French:

```
Un exemple d’article             Juillet 2015
```
