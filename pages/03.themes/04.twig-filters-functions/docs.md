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

##### Absolute URL

Take a relative path and convert it to an absolute URL format including hostname

`'<img src="/some/path/to/image.jpg" />'|absolute_url` <i class="fa fa-long-arrow-right"></i> `{{ '<img src="/some/path/to/image.jpg" />'|absolute_url }}`

##### Camelize

Converts a string into "CamelCase" format

`'send_email'|camelize` <i class="fa fa-long-arrow-right"></i> **{{ 'send_email'|camelize }}**

##### Contains

Determine if a particular string contains another string

`'some string with things in it'|contains('things')` <i class="fa fa-long-arrow-right"></i> **{{ 'some string with things in it'|contains('things') }}**

##### Defined

Sometimes you want to check if some variable is defined, and if it's not, provide a default value.  For example:

`set header_image_width  = page.header.header_image_width|defined(900)`

This will set the variable `header_image_width` to the value `900` if it's not defined in the page header.

##### Ends-With

Takes a needle and a haystack and determines if the haystack ends with the needle.  Also now works with an array of needles and will return `true` if **any** haystack ends with the needle.

`'the quick brown fox'|ends_with('fox')` <i class="fa fa-long-arrow-right"></i> {{  'the quick brown fox'|ends_with('fox') ? 'true' : 'false' }}

##### FieldName

Filters field name by changing dot notation into array notation

`'field.name|fieldName`

##### Humanize

Converts a string into a more "human readable" format

`'something_text_to_read'|humanize` <i class="fa fa-long-arrow-right"></i>

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

##### Left Trim

`'/strip/leading/slash/'|ltrim('/')`

Removes trailing spaces at the beginning of a string. It can also remove other characters by setting the character mask (see [http://php.net/manual/en/function.ltrim.php](http://php.net/manual/en/function.ltrim.php))

##### Markdown

Take an arbitrary string containing markdown and convert it to HTML using the markdown parser of Grav

`'something with **markdown** and [a link](http://www.cnn.com)'|markdown` <i class="fa fa-long-arrow-right"></i> {{ 'something with **markdown** and [a link](http://www.cnn.com)'|markdown }}

##### MD5

Creates an md5 hash for the string

`'anything'|md5` <i class="fa fa-long-arrow-right"></i> **{{ 'anything'|md5 }}**

##### Monthize

Converts an integer number of days into the number of months

`'181'|monthize` <i class="fa fa-long-arrow-right"></i> **{{ '181'|monthize }}**

##### Nice Time

Output a date in a human readable nice time format

`page.date|nicetime(false)` <i class="fa fa-long-arrow-right"></i> **{{ page.date|nicetime(false) }}**

##### Ordinalize

Adds an ordinal to the integer (such as 1st, 2nd, 3rd, 4th)

`'10'|ordinalize` <i class="fa fa-long-arrow-right"></i> **{{ '10'|ordinalize }}**

##### Pluralize

Converts a string to the English plural version

`'person'|pluralize` <i class="fa fa-long-arrow-right"></i> **{{ 'person'|pluralize }}**

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

##### Right Trim

`'/strip/trailing/slash/'|ltrim('/')`

Removes trailing spaces at the end of a string. It can also remove other characters by setting the character mask (see [http://php.net/manual/en/function.rtrim.php](http://php.net/manual/en/function.rtrim.php))

##### Singularize

Converts a string to the English singular version

`'shoes'|singularize` <i class="fa fa-long-arrow-right"></i> **{{ 'shoes'|singularize }}**

##### Safe Email

The safe email filter converts an email address into ASCII characters to make it harder for email spam bots to recognize and capture.

`"someone@domain.com"|safe_email` <i class="fa fa-long-arrow-right"></i> {{ "someone@domain.com"|safe_email }}

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

##### Starts-With

Takes a needle and a haystack and determines if the haystack starts with the needle.  Also now works with an array of needles and will return `true` if **any** haystack starts with the needle.

`'the quick brown fox'|starts_with('the')` <i class="fa fa-long-arrow-right"></i> {{  'the quick brown fox'|starts_with('the') ? 'true' : 'false' }}

##### Translate

Translate a string into the current language

`{{'MY_LANGUAGE_KEY_STRING'|t}}` <i class="fa fa-long-arrow-right"></i> 'Some Text in English'

This assumes you have these language strings translated in your site and have enabled multi-language support.  Please refer to the [multi-language documentation](../../content/multi-language) for more detailed information.

##### Translate Admin

Translate a string into the current language set in the admin interface user preferences

`{{'MY_LANGUAGE_KEY_STRING'|tu}}` <i class="fa fa-long-arrow-right"></i> 'Some Text in English'

This uses the language field set in the user yaml.

##### Titleize

Converts a string to "Title Case" format

`'welcome page'|titleize` <i class="fa fa-long-arrow-right"></i> **{{ 'welcome page'|titleize }}**

##### Trimming a String

You can left-trim and right-trim a string with the following two filters:

`'/this/is/a/path/'|ltrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/this/is/a/path/'|ltrim('/') }}

`'/this/is/a/path/'|rtrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/this/is/a/path/'|rtrim('/') }}

##### Truncate a String

You can easily generated a shortened, truncated, version of a string by using this filter.  It takes a number of characters as the only required field, but has some other options:

`'one sentence. two sentences'|truncate(5)` <i class="fa fa-long-arrow-right"></i> {{ 'one sentence. two sentences'|truncate(5) }}

Simply truncates to 5 characters.

`'one sentence. two sentences'|truncate(5, true)` <i class="fa fa-long-arrow-right"></i> {{ 'one sentence. two sentences'|truncate(5, true) }}

Truncates to closest sentence-end after 5 characters.

You can also truncate HTML text, but should first use the `striptags` filter to remove any HTML formatting that could get broken if you end between tags:

`'<p>one <strong>sentence<strong>. two sentences</p>'|striptags|truncate(5)` <i class="fa fa-long-arrow-right"></i> {{ '<p>one <strong>sentence<strong>. two sentences</p>'|striptags|truncate(5) }}

###### Specialized versions:

**|safe_truncate**

Truncate text by number of characters in a "word-safe" manor.

**|truncate_html**

Truncate HTML by number of characters. not "word-safe"!

**|safe_truncate_html**

Truncate HTML by number of characters in a "word-safe" manor.

##### Underscoreize

Converts a string into "under_scored" format

`'CamelCased'|underscorize` <i class="fa fa-long-arrow-right"></i> **{{ 'CamelCased'|underscorize }}**


### Twig Functions

Twig functions are called directly with any parameters being passed in via parenthesis.

##### Array

Cast a value to array

`array(value)`

##### Authorize

Authorizes an authenticated user to see a resource. Accepts an a single permission string or an array of permission strings.

`authorize(['admin.statistics', 'admin.super'])`

##### Dump

Takes a valid twig variable and dumps it out into the [Grav debugger panel](../../advanced/debugging).  The debugger must be **enabled** to see the values in the messages tab.

`dump(page.header)`

##### Debug

Same as `dump()`

##### Gist

Takes a Github Gist ID and creates appropriate Gist embed code

`gist('bc448ff158df4bc56217')` <i class="fa fa-long-arrow-right"></i> {{ gist('bc448ff158df4bc56217')}}

##### Random String Generation

Will generate a random string of the required number of characters.  Particularly useful in creating a unique id or key.

`generate_random_string(10)` <i class="fa fa-long-arrow-right"></i> **{{ random_string(10) }}**

##### Repeat

Will repeat whatever is passed in a certain amount of times.

`repeat('blah ', 10)` <i class="fa fa-long-arrow-right"></i> **{{ repeat('blah ', 10) }}**

##### String

Generates a random string. Pass count to set the characters lenght.

`ta(23)`

##### Translate

Translate a string, as the `|t` filter.

`t('SITE_NAME')` <i class="fa fa-long-arrow-right"></i> **Site Name**

##### Translate Array

Function related to the `|ta` filter.

##### Url

Will create a URL and convert any PHP URL streams into a valid HTML resources. A default value can be passed in in case the URL cannot be resolved.

`url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4')` <i class="fa fa-long-arrow-right"></i> **{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}**
