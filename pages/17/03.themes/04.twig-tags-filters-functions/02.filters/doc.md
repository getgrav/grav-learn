---
title: Twig Filters
body_classes: twig__headers
page-toc:
  active: true
  start: 3
  depth: 1
process:
    twig: false
taxonomy:
    category: docs
---
# Twig Filters

Twig filters are applied to Twig variables by using the `|` character followed by the filter name.  Parameters can be passed in just like Twig functions using parenthesis.

### absolute_url

Takes an HTML snippet containing a `src` or `href` attribute which uses a relative path. Converts the path string to an absolute URL format including hostname.

[codesh-group]
[codesh=twig title="Twig"]
{{ '<img src="/some/path/to/image.jpg" />'|absolute_url }}
[/codesh]
[codesh=html title="Output"]
<img src="https://learn.getgrav.org/some/path/to/image.jpg">
[/codesh]
[/codesh-group]

### array_group_by

Groups items in an array or collection by a specified property or callback function. This filter is particularly useful for organizing blog posts, products, or any collection of items by common attributes like date, category, author, or custom criteria.

**Basic usage with a property name:**

`collection|array_group_by('category')` <i class="fa fa-long-arrow-right"></i> Groups items by their 'category' property

**Example: Grouping by taxonomy category**

[codesh=twig]
{# Prepare collection with category #}
{% set collection_with_category = [] %}
{% for post in page.collection() %}
    {% set category = post.taxonomy.category|first ?: 'uncategorized' %}
    {% set collection_with_category = collection_with_category|merge([{
        post: post,
        category: category
    }]) %}
{% endfor %}

{# Group by category #}
{% set posts_by_category = collection_with_category|array_group_by('category') %}

{# Display grouped posts #}
{% for category, posts in posts_by_category %}
    <h3>{{ category|capitalize }}</h3>
    {% for item in posts %}
        <div>{{ item.post.title }}</div>
    {% endfor %}
{% endfor %}
[/codesh]

### array_unique

Wrapper for PHP `array_unique()` that removes duplicates from an array.

[codesh-group]
[codesh=twig title="Twig"]
{{ ['foo', 'bar', 'foo', 'baz']|array_unique }}
[/codesh]
[codesh=txt title="Output"]
['foo', 'bar', 'baz']
[/codesh]
[/codesh-group]

### base32_encode

Performs a base32 encoding on variable

[codesh-group]
[codesh=twig title="Twig"]
{{ 'some variable here'|base32_encode }}
[/codesh]
[codesh=txt title="Output"]
ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK
[/codesh]
[/codesh-group]

### base32_decode

Performs a base32 decoding on variable

[codesh-group]
[codesh=twig title="Twig"]
{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK'|base32_decode }}
[/codesh]
[codesh=txt title="Output"]
some variable here
[/codesh]
[/codesh-group]

### base64_encode

Performs a base64 encoding on variable

[codesh-group]
[codesh=twig title="Twig"]
{{ 'some variable here'|base64_encode }}
[/codesh]
[codesh=txt title="Output"]
c29tZSB2YXJpYWJsZSBoZXJl
[/codesh]
[/codesh-group]

### base64_decode

Performs a base64 decoding on variable

[codesh-group]
[codesh=twig title="Twig"]
{{ 'c29tZSB2YXJpYWJsZSBoZXJl'|base64_decode }}
[/codesh]
[codesh=txt title="Output"]
some variable here
[/codesh]
[/codesh-group]

### basename

Return the basename of a path.

[codesh-group]
[codesh=twig title="Twig"]
{{ '/etc/sudoers.d'|basename }}
[/codesh]
[codesh=txt title="Output"]
sudoers.d
[/codesh]
[/codesh-group]

### camelize

Converts a string into "CamelCase" format

[codesh-group]
[codesh=twig title="Twig"]
{{ 'send_email'|camelize }}
[/codesh]
[codesh=txt title="Output"]
SendEmail
[/codesh]
[/codesh-group]

### chunk_split

Splits a string into smaller chunks of a certain sizeOf

[codesh-group]
[codesh=twig title="Twig"]
{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGKA'|chunk_split(6, '-') }}
[/codesh]
[codesh=txt title="Output"]
ONXW2Z-JAOZQX-E2LBMJ-WGKIDI-MVZGKA-
[/codesh]
[/codesh-group]

### contains

Determine if a particular string contains another string

[codesh-group]
[codesh=twig title="Twig"]
{{ 'some string with things in it'|contains('things') }}
[/codesh]
[codesh=txt title="Output"]
true
[/codesh]
[/codesh-group]

#### Casting Values

PHP 7 is getting more strict type checks, which means that passing a value of wrong type may now throw an exception. To avoid this, you should use filters which ensure that the value passed to a method is valid:

### string

Use `|string` to cast value to string.

### int

Use `|int` to cast value to integer.

### bool

Use `|bool` to cast value to boolean.

### float

Use `|float` to cast value to floating point number.

### array

Use `|array` to cast value to an array.

### defined

Sometimes you want to check if some variable is defined, and if it's not, provide a default value.  For example:

[codesh=twig]
set header_image_width = page.header.header_image_width|defined(900)
[/codesh]

This will set the variable `header_image_width` to the value `900` if it's not defined in the page header.

### dirname

Return the dirname of a path.

[codesh-group]
[codesh=twig title="Twig"]
{{ '/etc/sudoers.d'|dirname }}
[/codesh]
[codesh=txt title="Output"]
/etc
[/codesh]
[/codesh-group]

### ends_with

Takes a needle and a haystack and determines if the haystack ends with the needle.  Also now works with an array of needles and will return `true` if **any** haystack ends with the needle.

[codesh-group]
[codesh=twig title="Twig"]
{{ 'the quick brown fox'|ends_with('fox') }}
[/codesh]
[codesh=txt title="Output"]
true
[/codesh]
[/codesh-group]

### fieldName

Filters field name by changing dot notation into array notation

[codesh-group]
[codesh=twig title="Twig"]
{{ 'field.name'|fieldName }}
[/codesh]
[codesh=txt title="Output"]
field[name]
[/codesh]
[/codesh-group]

### get_type

Gets the type of a variable:

[codesh-group]
[codesh=twig title="Twig"]
{{ page|get_type }}
[/codesh]
[codesh=txt title="Output"]
Grav\Common\Page\Page
[/codesh]
[/codesh-group]

### humanize

Converts a string into a more "human readable" format

[codesh-group]
[codesh=twig title="Twig"]
{{ 'something_text_to_read'|humanize }}
[/codesh]
[codesh=txt title="Output"]
Something text to read
[/codesh]
[/codesh-group]

### hyphenize

Converts a string into a hyphenated version.

[codesh-group]
[codesh=twig title="Twig"]
{{ 'Something Text to Read'|hyphenize }}
[/codesh]
[codesh=txt title="Output"]
something-text-to-read
[/codesh]
[/codesh-group]

### json_decode

You can decode JSON by simply applying this filter:

[codesh-group]
[codesh=twig title="Twig"]
{% set array = '{"first_name": "Guido", "last_name":"Rossum"}'|json_decode %}
{{ print_r(array) }}
[/codesh]
[codesh=txt title="Output"]
[
    "first_name" => "Guido"
    "last_name" => "Rossum"
]
[/codesh]
[/codesh-group]

### ksort

Sort an array map by each key

[codesh-group]
[codesh=twig title="Twig"]
{% set items = {'orange':1, 'apple':2, 'peach':3}|ksort %}
{{ print_r(items) }}
[/codesh]
[codesh=txt title="Output"]
[
    "apple" => 2
    "orange" => 1
    "peach" => 3
]
[/codesh]
[/codesh-group]

### ltrim

Left trim removes trailing spaces at the beginning of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.ltrim.php](https://php.net/manual/en/function.ltrim.php))

[codesh-group]
[codesh=twig title="Twig"]
{{ '/strip/leading/slash/'|ltrim('/') }}
[/codesh]
[codesh=txt title="Output"]
strip/leading/slash/
[/codesh]
[/codesh-group]

### markdown

Take an arbitrary string containing markdown and convert it to HTML using the markdown parser of Grav. Optional `boolean` parameter:

* `true` (default): process as block (text mode, content will be wrapped in `<p>` tags)
* `false`: process as line (content will not be wrapped)

```
string|markdown($is_block)
```

[codesh-group]
[codesh=twig title="Twig"]
<div class="div">
{{ 'A paragraph with **markdown** and [a link](http://www.cnn.com)'|markdown }}
</div>

<p class="paragraph">{{'A line with **markdown** and [a link](http://www.cnn.com)'|markdown(false) }}</p>
[/codesh]
[codesh=html title="Output"]
<div class="div">
<p>A paragraph with <strong>markdown</strong> and <a href="http://www.cnn.com">a link</a></p>
</div>

<p class="paragraph">A line with <strong>markdown</strong> and <a href="http://www.cnn.com">a link</a></p>
[/codesh]
[/codesh-group]

### md5

Creates an md5 hash for the string

[codesh-group]
[codesh=twig title="Twig"]
{{ 'anything'|md5 }}
[/codesh]
[codesh=txt title="Output"]
f0e166dc34d14d6c228ffac576c9a43c
[/codesh]
[/codesh-group]

### modulus

Performs the same functionality as the Modulus `%` symbol in PHP. It operates on a number by passing in a numeric divider and an optional array of items to select from.

[codesh-group]
[codesh=twig title="Twig"]
{{ 7|modulus(3, ['red', 'blue', 'green']) }}
[/codesh]
[codesh=txt title="Output"]
blue
[/codesh]
[/codesh-group]

### monthize

Converts an integer number of days into the number of months

[codesh-group]
[codesh=twig title="Twig"]
{{ '181'|monthize }}
[/codesh]
[codesh=txt title="Output"]
6
[/codesh]
[/codesh-group]

### nicecron

Gets a human readable output for cron syntax

[codesh-group]
[codesh=twig title="Twig"]
{{ "2 * * * *"|nicecron }}
[/codesh]
[codesh=txt title="Output"]
At 2 minutes past the hour
[/codesh]
[/codesh-group]

### nicefilesize

Output a file size in a human readable nice size format

[codesh-group]
[codesh=twig title="Twig"]
{{ 612394|nicefilesize }}
[/codesh]
[codesh=txt title="Output"]
598.04 KB
[/codesh]
[/codesh-group]

### nicenumber

Output a number in a human readable nice number format

[codesh-group]
[codesh=twig title="Twig"]
{{ 12430|nicenumber }}
[/codesh]
[codesh=txt title="Output"]
12K
[/codesh]
[/codesh-group]

### nicetime

Output a date in a human readable nice time format

[codesh-group]
[codesh=twig title="Twig"]
{{ page.date|nicetime(false) }}
[/codesh]
[codesh=txt title="Output"]
1 month ago
[/codesh]
[/codesh-group]

The first argument specifies whether to use a full format date description. It's `true` by default.

You can provide a second argument of `false` if you want to remove the time relative descriptor (like 'ago' or 'from now' in your language) from the result.

### of_type

Checks the type of a variable to the param:

[codesh-group]
[codesh=twig title="Twig"]
{{ page|of_type('string') }}
[/codesh]
[codesh=txt title="Output"]
false
[/codesh]
[/codesh-group]

### ordinalize

Adds an ordinal to the integer (such as 1st, 2nd, 3rd, 4th)

[codesh-group]
[codesh=twig title="Twig"]
{{ '10'|ordinalize }}
[/codesh]
[codesh=txt title="Output"]
10th
[/codesh]
[/codesh-group]

### pad

Pads a string to a certain length with another character. This is a wrapper for the PHP [str_pad()](https://php.net/manual/en/function.str-pad.php) function.

[codesh-group]
[codesh=twig title="Twig"]
{{ 'foobar'|pad(10, '-') }}
[/codesh]
[codesh=txt title="Output"]
foobar----
[/codesh]
[/codesh-group]

### pluralize

Converts a string to the English plural version

[codesh-group]
[codesh=twig title="Twig"]
{{ 'person'|pluralize }}
[/codesh]
[codesh=txt title="Output"]
people
[/codesh]
[/codesh-group]

`pluralize` also takes an optional numeric parameter which you can pass in when you don't know in advance how many items the noun will refer to. It defaults to 2, so will provide the plural form if omitted. For example:

[codesh=twig]
<p>We have {{ num_vacancies }} {{ 'vacancy'|pluralize(num_vacancies) }} right now.</p>
[/codesh]

### print_r

Prints human-readable information about a variable

[codesh=twig]
page.header|print_r
[/codesh]

### randomize

Randomizes the list provided.  If a value is provided as a parameter, it will skip first n values and keep them in order.

[codesh-group]
[codesh=twig title="Twig"]
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{{ print_r(ritems) }}
[/codesh]
[codesh=txt title="Output"]
['one', 'two', 'eight', 'four', 'ten', 'seven', 'nine', 'three', 'six', 'five']
[/codesh]
[/codesh-group]

Note: The first two items ('one', 'two') remain in order, while the rest are randomized.

### regex_replace

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

[codesh-group]
[codesh=twig title="Twig"]
{{ 'The quick brown fox jumps over the lazy dog.'|regex_replace(['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) }}
[/codesh]
[codesh=txt title="Output"]
The slow black bear jumps over the lazy turtle.
[/codesh]
[/codesh-group]

> [!WARNING]
> Use the `~`-delimiter rather than the `/`-delimiter where possible. Otherwise you'll most likely have to [double-escape certain characters](https://github.com/getgrav/grav/issues/833). Eg. `~\/\#.*~` rather than `'/\\/\\#.*/'`, which conforms more closely to the [PCRE-syntax](https://www.php.net/manual/en/regexp.reference.delimiters.php) used by PHP.

### rtrim

Removes trailing spaces at the end of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.rtrim.php](https://php.net/manual/en/function.rtrim.php))

[codesh-group]
[codesh=twig title="Twig"]
{{ '/strip/trailing/slash/'|rtrim('/') }}
[/codesh]
[codesh=txt title="Output"]
/strip/trailing/slash
[/codesh]
[/codesh-group]

### singularize

Converts a string to the English singular version

[codesh-group]
[codesh=twig title="Twig"]
{{ 'shoes'|singularize }}
[/codesh]
[codesh=txt title="Output"]
shoe
[/codesh]
[/codesh-group]

### safe_email

The safe email filter converts an email address into ASCII characters to make it harder for email spam bots to recognize and capture.

[codesh-group]
[codesh=twig title="Twig"]
{{ "someone@domain.com"|safe_email }}
[/codesh]
[codesh=txt title="Output"]
&#115;&#111;&#109;&#101;&#111;&#110;&#101;&#64;&#100;&#111;&#109;&#97;&#105;&#110;&#46;&#99;&#111;&#109;
[/codesh]
[/codesh-group]

Usage example with a mailto link:

[codesh=html]
<a href="mailto:{{ 'your.email@server.com'|safe_email }}">
  Email me
</a>
[/codesh]

You might not notice a difference at first, but examining the page source (not using the Browser Developer Tools, the actual page source) will reveal the underlying characters encoding.

### sort_by_key

Sort an array map by a particular key

[codesh-group]
[codesh=twig title="Twig"]
{% set people = [{'email':'fred@yahoo.com', 'id':34}, {'email':'tim@exchange.com', 'id':21}, {'email':'john@apple.com', 'id':2}]|sort_by_key('id') %}
{% for person in people %}{{ person.email }}:{{ person.id }}, {% endfor %}
[/codesh]
[codesh=txt title="Output"]
john@apple.com:2, tim@exchange.com:21, fred@yahoo.com:34,
[/codesh]
[/codesh-group]

### starts_with

Takes a needle and a haystack and determines if the haystack starts with the needle.  Also now works with an array of needles and will return `true` if **any** haystack starts with the needle.

[codesh-group]
[codesh=twig title="Twig"]
{{ 'the quick brown fox'|starts_with('the') }}
[/codesh]
[codesh=txt title="Output"]
true
[/codesh]
[/codesh-group]

### titleize

Converts a string to "Title Case" format

[codesh-group]
[codesh=twig title="Twig"]
{{ 'welcome page'|titleize }}
[/codesh]
[codesh=txt title="Output"]
Welcome Page
[/codesh]
[/codesh-group]

### t

Translate a string into the current language

[codesh-group]
[codesh=twig title="Twig"]
{{ 'MY_LANGUAGE_KEY_STRING'|t }}
[/codesh]
[codesh=txt title="Output"]
Some Text in English
[/codesh]
[/codesh-group]

This assumes you have these language strings translated in your site and have enabled multi-language support.  Please refer to the [multi-language documentation](../../../content/multi-language) for more detailed information.

### tu

Translate a string into the current language set in the admin interface user preferences

[codesh-group]
[codesh=twig title="Twig"]
{{ 'MY_LANGUAGE_KEY_STRING'|tu }}
[/codesh]
[codesh=txt title="Output"]
Some Text in English
[/codesh]
[/codesh-group]

This uses the language field set in the user yaml.

### ta

Translates an array with a language use the `|ta` filter. See the [multi-language documentation](../../../content/multi-language) for a detailed example.

[codesh-group]
[codesh=twig title="Twig"]
{{ 'MONTHS_OF_THE_YEAR'|ta(post.date|date('n') - 1) }}
[/codesh]
[codesh=txt title="Output"]
December
[/codesh]
[/codesh-group]

### tl

Translates a string in a specific language. For more details check out the [multi-language documentation](../../../content/multi-language#complex-translations).

[codesh=twig]
'SIMPLE_TEXT'|tl(['fr'])
[/codesh]

### truncate

You can easily generate a shortened, truncated, version of a string by using this filter.  It takes a number of characters as the only required field, but has some other options:

[codesh-group]
[codesh=twig title="Twig"]
'one sentence. two sentences'|truncate(5)|raw
[/codesh]
[codesh=txt title="Output"]
one s&hellip;
[/codesh]
[/codesh-group]

Simply truncates to 5 characters.

[codesh-group]
[codesh=twig title="Twig"]
'one sentence. two sentences'|truncate(5, true)|raw
[/codesh]
[codesh=txt title="Output"]
one sentence.&hellip;
[/codesh]
[/codesh-group]

Truncates to closest sentence-end after 5 characters.

> [!CAUTION]
> The `|raw` Twig filter should be used with the default `&hellip;` (elipsis) padding element in order for it to render with Twig auto-escaping

You can also truncate HTML text, but should first use the `|striptags` filter to remove any HTML formatting that could get broken if you end between tags:

[codesh-group]
[codesh=twig title="Twig"]
'<span>one <strong>sentence</strong>. two sentences</span>'|raw|striptags|truncate(25)
[/codesh]
[codesh=txt title="Output"]
one sentence. two senten&hellip;
[/codesh]
[/codesh-group]

#### Specialized versions:

### safe_truncate

Use `|safe_truncate` to truncate text by number of characters in a "word-safe" manner.

### truncate_html

Use `|truncate_html` to truncate HTML by number of characters. not "word-safe"!

### safe_truncate_html

Use `|safe_truncate_html` to truncate HTML by number of characters in a "word-safe" manner.

### underscorize

Converts a string into "under_scored" format

[codesh-group]
[codesh=twig title="Twig"]
{{ 'CamelCased'|underscorize }}
[/codesh]
[codesh=txt title="Output"]
camel_cased
[/codesh]
[/codesh-group]

### wordcount

Counts the number of words in a text string with support for multiple languages and improved accuracy for HTML content.

[codesh-group]
[codesh=twig title="Twig"]
{{ page.content|wordcount }}
[/codesh]
[codesh=txt title="Output"]
36
[/codesh]
[/codesh-group]

The `wordcount` filter also takes an optional locale parameter to handle different languages appropriately. For Western languages (English, Spanish, French, etc.), it counts individual words separated by spaces. For Asian languages like Chinese, Japanese, and Korean, it counts characters instead of words, which is more appropriate for these writing systems.

[codesh=twig]
{# With specific locale for English content #}
{{ page.content|wordcount('en') }}

{# For Chinese content - counts characters instead of words #}
{{ page.content|wordcount('zh') }}

{# Usage in JSON-LD structured data #}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "wordCount": page.content|wordcount,
  "headline": page.title
}
</script>
[/codesh]

> [!CAUTION]
> **Supported locales:** `en` (English, default), `es` (Spanish), `fr` (French), `de` (German), and other Western languages use word-based counting. `zh`/`zh-cn`/`zh-tw`/`chinese` (Chinese), `ja`/`japanese` (Japanese), and `ko`/`korean` (Korean) use character-based counting.

### yaml_encode

Dump/Encode a variable into YAML syntax

[codesh-group]
[codesh=twig title="Twig"]
{% set array = {foo: [0, 1, 2, 3], baz: 'qux' } %}
{{ array|yaml_encode }}
[/codesh]
[codesh=yaml title="Output"]
foo:
    - 0
    - 1
    - 2
    - 3
baz: qux
[/codesh]
[/codesh-group]

### yaml_decode

Decode/Parse a variable from YAML syntax

[codesh-group]
[codesh=twig title="Twig"]
{% set yaml = "foo: [0, 1, 2, 3]\nbaz: qux" %}
{{ yaml|yaml_decode|var_dump }}
[/codesh]
[codesh=txt title="Output"]
array(2) {
  ["foo"]=> array(4) { [0]=> int(0) [1]=> int(1) [2]=> int(2) [3]=> int(3) }
  ["baz"]=> string(3) "qux"
}
[/codesh]
[/codesh-group]
