---
title: Twig Filters & Functions
process:
    twig: true
taxonomy:
    category: docs
---

Although Twig already provides an extensive list of [filters, functions, and tags](http://twig.sensiolabs.org/documentation), Grav also provides a selection of useful additions to make the process of theming easier.

### Grav Twig Filters

Twig filters are applied to Twig variables by using the `|` character then the filter name.  Parameters can be passed in just like Twig functions using parenthesis.

##### Safe Email

The safe email filter converts an email address into ASCII characters to make it harder for email spam bots to recognize and capture.

`"someone@domain.com"|safe_email` <i class="icon-right-open"></i> {{ "someone@domain.com"|safe_email }}

##### Pluralize

Converts a string to the English plural version

`'person'|pluralize` <i class="icon-right-open"></i> **{{ 'person'|pluralize }}**

##### Singularize

Converts a string to the English singular version

`'shoes'|singularize` <i class="icon-right-open"></i> **{{ 'shoes'|singularize }}**

##### Titleize

Converts a string to "Title Case" format

`'welcome page'|titleize` <i class="icon-right-open"></i> **{{ 'welcome page'|titleize }}**

##### Camelize

Converts a string into "CamelCase" format

`'send_email'|camelize` <i class="icon-right-open"></i> **{{ 'send_email'|camelize }}**

##### Underscoreize

Converts a string into "under_scored" format

`'CamelCased'|underscorize` <i class="icon-right-open"></i> **{{ 'CamelCased'|underscorize }}**

##### Humanize

Converts a string into a more "human readable" format

`'something_text_to_read'|humanize` <i class="icon-right-open"></i> **{{ 'something_text_to_read'|humanize }}**

##### Monthize

Converts an integer number of days into the number of months

`'181'|monthize` <i class="icon-right-open"></i> **{{ '181'|monthize }}**

##### Ordinalize

Adds an ordinal to the integer (such as 1st, 2nd, 3rd, 4th)

`'10'|ordinalize` <i class="icon-right-open"></i> **{{ '10'|ordinalize }}**

##### MD5

Creates an md5 hash for the string

`'anything'|md5` <i class="icon-right-open"></i> **{{ 'anything'|md5 }}**

##### Randomize

Randomizes the list provided.  If a value is provided as a parameter, it will skip those values and keep them in order.

`array|randomize` {% verbatim %}
```
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{% for ritem in ritems %}{{ ritem }}, {% endfor %}
```
{% endverbatim %}

<strong>
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{% for ritem in ritems %}{{ ritem }}, {% endfor %}
</strong>

##### SortByKey

Sort an array map by a particular key

`array|sort_by_key` {% verbatim %}
```
{% set people = [{'email':'fred@yahoo.com', 'id':34}, {'email':'tim@exchange.com', 'id':21}, {'email':'john@apple.com', 'id':2}]|sort_by_key('id') %}
{% for person in people %}{{ person.email }}:{{ person.id }}, {% endfor %}
```
{% endverbatim %}

<strong>
{% set people = [{'email':'fred@yahoo.com', 'id':34}, {'email':'tim@exchange.com', 'id':21}, {'email':'john@apple.com', 'id':2}]|sort_by_key('id') %}
{% for person in people %}{{ person.email }}:{{ person.id }}, {% endfor %}
</strong>

##### Ksort

Sort an array map by each key

`array|ksort` {% verbatim %}
```
{% set ritems = {'orange':1, 'apple':2, 'peach':3}|ksort %}
{% for key, value in ritems %}{{ key }}:{{ value }}, {% endfor %}
```
{% endverbatim %}

<strong>
{% set ritems = {'orange':1, 'apple':2, 'peach':3}|ksort %}
{% for key, value in ritems %}{{ key }}:{{ value }}, {% endfor %}
</strong>

##### Contains

Determine if a particular string contains another string

`'some string with things in it'|contains('things')` <i class="icon-right-open"></i> **{{ 'some string with things in it'|contains('things') }}**

##### Nice Time

Output a date in a human readable nice time format

`page.date|nicetime(false)` <i class="icon-right-open"></i> **{{ page.date|nicetime(false) }}**

##### Absolute URL

Take a relative path and convert it to an absolute URL format including hostname

`'<img src="/some/path/to/image.jpg" />'|absolute_url` <i class="icon-right-open"></i> `{{ '<img src="/some/path/to/image.jpg" />'|absolute_url }}`

##### Markdown

Take an arbitrary string containing markdown and convert it to HTML using the markdown parser of Grav

`'something with **markdown** and [a link](http://www.cnn.com)'|markdown` <i class="icon-right-open"></i> {{ 'something with **markdown** and [a link](http://www.cnn.com)'|markdown }}

### Twig Functions

Twig functions are called directly with any parameters being passed in via parenthesis.

##### Repeat

Will repeat whatever is passed in a certain amount of times.

`repeat('blah ', 10)` <i class="icon-right-open"></i> **{{ repeat('blah ', 10) }}**

##### Url

Will create a URL and convert any PHP URL streams into a valid HTML resources. A default value can be passed in in case the URL cannot be resolved.

`url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4')` <i class="icon-right-open"></i> **{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}**

##### Gist

Takes a Github Gist ID and creates appropriate Gist embed code

`gist('bc448ff158df4bc56217')` <i class="icon-right-open"></i> {{ gist('bc448ff158df4bc56217')}}

##### Dump

Takes a valid twig variable and dumps it out into the [Grav debugger panel](../../advanced/debugging).  The debugger must be **enabled** to see the values in the messages tab.

`dump(page.header)`

##### Generate Random String

Will generate a random string of the required number of characters.  Particularly useful in creating a unique id or key.

`generate_random_string(10)` <i class="icon-right-open"></i> **{{ random_string(10) }}**
