---
title: Twig Filters
body_classes: twig__headers
page-toc:
  active: true
  start: 3
  depth: 1
process:
    twig: true
taxonomy:
    category: docs
---

Twig filters are applied to Twig variables by using the `|` character followed by the filter name.  Parameters can be passed in just like Twig functions using parenthesis.

### `absolute_url`

Take a relative path and convert it to an absolute URL format including hostname

`'<img src="/some/path/to/image.jpg" />'|absolute_url` <i class="fa fa-long-arrow-right"></i> `{{ '<img src="/some/path/to/image.jpg" />'|absolute_url|raw }}`

### `array_unique`

Wrapper for PHP `array_unique()` that removes duplicates from an array.

`['foo', 'bar', 'foo', 'baz']|array_unique` <i class="fa fa-long-arrow-right"></i> **{{ print_r(['foo', 'bar', 'foo', 'baz']|array_unique) }}**

### `base32_encode`

Performs a base32 encoding on variable
`'some variable here'|base32_encode` <i class="fa fa-long-arrow-right"></i> **{{ 'some variable here'|base32_encode }}**

### `base32_decode`

Performs a base32 decoding on variable
`'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK'|base32_decode` <i class="fa fa-long-arrow-right"></i> **{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK'|base32_decode }}**

### `base64_encode`

Performs a base64 encoding on variable
`'some variable here'|base64_encode` <i class="fa fa-long-arrow-right"></i> **{{ 'some variable here'|base64_encode }}**

### `base64_decode`

Performs a base64 decoding on variable
`'c29tZSB2YXJpYWJsZSBoZXJl'|base64_decode` <i class="fa fa-long-arrow-right"></i> **{{ 'c29tZSB2YXJpYWJsZSBoZXJl'|base64_decode }}**

### `basename`

Return the basename of a path.

`'/etc/sudoers.d'|basename` <i class="fa fa-long-arrow-right"></i> **{{ '/etc/sudoers.d'|basename }}**

### `camelize`

Converts a string into "CamelCase" format

`'send_email'|camelize` <i class="fa fa-long-arrow-right"></i> **{{ 'send_email'|camelize }}**

[version=16,17]
### `chunk_split`

Splits a string into smaller chunks of a certain sizeOf

`'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGKA'|chunk_split(6, '-')` <i class="fa fa-long-arrow-right"></i> **{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGKA'|chunk_split(6, '-') }}**
[/version]

### `contains`

Determine if a particular string contains another string

`'some string with things in it'|contains('things')` <i class="fa fa-long-arrow-right"></i> **{{ 'some string with things in it'|contains('things') }}**

#### Casting Values

PHP 7 is getting more strict type checks, which means that passing a value of wrong type may now throw an exception. To avoid this, you should use filters which ensure that the value passed to a method is valid:

### `string`

Use `|string` to cast value to string.

### `int`

Use `|int` to cast value to integer.

### `bool`

Use `|bool` to cast value to boolean.

### `float`

Use `|float` to cast value to floating point number.

### `array`

Use `|array` to cast value to an array.

### `defined`

Sometimes you want to check if some variable is defined, and if it's not, provide a default value.  For example:

`set header_image_width  = page.header.header_image_width|defined(900)`

This will set the variable `header_image_width` to the value `900` if it's not defined in the page header.

### `dirname`

Return the dirname of a path.

`'/etc/sudoers.d'|dirname` <i class="fa fa-long-arrow-right"></i> **{{ '/etc/sudoers.d'|dirname }}**


### `ends_width`

Takes a needle and a haystack and determines if the haystack ends with the needle.  Also now works with an array of needles and will return `true` if **any** haystack ends with the needle.

`'the quick brown fox'|ends_with('fox')` <i class="fa fa-long-arrow-right"></i> {{  'the quick brown fox'|ends_with('fox') ? 'true' : 'false' }}

### `fieldName`

Filters field name by changing dot notation into array notation

`'field.name'|fieldName` <i class="fa fa-long-arrow-right"></i> **{{ 'field.name'|fieldName }}**


[version=16,17]
### `get_type`

Gets the type of a variable:

`page|get_type` <i class="fa fa-long-arrow-right"></i> **{{ page|get_type }}**
[/version]

### `humanize`

Converts a string into a more "human readable" format

`'something_text_to_read'|humanize` <i class="fa fa-long-arrow-right"></i> **{{ 'something_text_to_read'|humanize }}**

### `hyphenize`

Converts a string into a hyphenated version.

`'Something Text to Read'|hyphenize` <i class="fa fa-long-arrow-right"></i> **{{ 'Something Text to Read'|hyphenize }}**

### `json_decode`

You can decode JSON by simply applying this filter:

`array|json_decode` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set array = '{"first_name": "Guido", "last_name":"Rossum"}'|json_decode %}
{{ print_r(array) }}
[/prism]
{% endverbatim %}

{% set array = '{"first_name": "Guido", "last_name":"Rossum"}'|json_decode %}
[prism classes="language-text"]
{{ print_r(array) }}
[/prism]

### `ksort`

Sort an array map by each key

`array|ksort` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set items = {'orange':1, 'apple':2, 'peach':3}|ksort %}
{{ print_r(items) }}
[/prism]
{% endverbatim %}

{% set items = {'orange':1, 'apple':2, 'peach':3}|ksort %}
[prism classes="language-text"]
{{ print_r(items) }}
[/prism]

### `ltrim`

`'/strip/leading/slash/'|ltrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/strip/leading/slash/'|ltrim('/') }}

Left trim removes trailing spaces at the beginning of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.ltrim.php](https://php.net/manual/en/function.ltrim.php))

### `markdown`

Take an arbitrary string containing markdown and convert it to HTML using the markdown parser of Grav. Optional `boolean` parameter:

* `true` (default): process as block (text mode, content will be wrapped in `<p>` tags)
* `false`: process as line (content will not be wrapped)

```
string|markdown($is_block)
```

{% verbatim %}
[prism classes="language-twig line-numbers"]
<div class="div">
{{ 'A paragraph with **markdown** and [a link](http://www.cnn.com)'|markdown }}
</div>

<p class="paragraph">{{'A line with **markdown** and [a link](http://www.cnn.com)'|markdown(false) }}</p>
[/prism]
{% endverbatim %}

{% set var %}
<div class="div">
{{ 'A paragraph with **markdown** and [a link](http://www.cnn.com)'|markdown }}
</div>

<p class="paragraph">{{'A line with **markdown** and [a link](http://www.cnn.com)'|markdown(false) }}</p>
{% endset %}
[prism classes="language-text"]
{{ var|e }}
[/prism]

### `md5`

Creates an md5 hash for the string

`'anything'|md5` <i class="fa fa-long-arrow-right"></i> **{{ 'anything'|md5 }}**

### `modulus`

Performs the same functionality as the Modulus `%` symbol in PHP. It operates on a number by passing in a numeric divider and an optional array of items to select from.

`7|modulus(3, ['red', 'blue', 'green'])` <i class="fa fa-long-arrow-right"></i> **{{ 7|modulus(3, ['red', 'blue', 'green']) }}**

### `monthize`

Converts an integer number of days into the number of months

`'181'|monthize` <i class="fa fa-long-arrow-right"></i> **{{ '181'|monthize }}**

[version=16,17]

### `nicecron`

Gets a human readable output for cron syntax

`"2 * * * *"|nicecron` <i class="fa fa-long-arrow-right"></i> **{{ '2 * * * *'|nicecron }}**

### `nicefilesize`

Output a file size in a human readable nice size format

`612394|nicefilesize` <i class="fa fa-long-arrow-right"></i> **{{ 612394|nicefilesize }}**

### `nicenumber`

Output a number in a human readable nice number format

`12430|nicenumber` <i class="fa fa-long-arrow-right"></i> **{{ 12430|nicenumber }}**
[/version]

### `nicetime`

Output a date in a human readable nice time format

`page.date|nicetime(false)` <i class="fa fa-long-arrow-right"></i> **{{ page.date|nicetime(false) }}**

The first argument specifies whether to use a full format date description. It's `true` by default.

You can provide a second argument of `false` if you want to remove the time relative descriptor (like 'ago' or 'from now' in your language) from the result.

[version=16,17]

### `of_type`

Checks the type of a variable to the param:

`page|of_type('string')` <i class="fa fa-long-arrow-right"></i> **{{ page|of_type('string') ? 'true' : 'false' }}**
[/version]

### `ordinalize`

Adds an ordinal to the integer (such as 1st, 2nd, 3rd, 4th)

`'10'|ordinalize` <i class="fa fa-long-arrow-right"></i> **{{ '10'|ordinalize }}**

### `pad`

Pads a string to a certain length with another character. This is a wrapper for the PHP [str_pad()](https://php.net/manual/en/function.str-pad.php) function.

`'foobar'|pad(10, '-')` <i class="fa fa-long-arrow-right"></i> **{{ 'foobar'|pad(10, '-') }}**

### `pluralize`

Converts a string to the English plural version

`'person'|pluralize` <i class="fa fa-long-arrow-right"></i> **{{ 'person'|pluralize }}**

[version=16,17]

### `print_r`

Prints human-readable information about a variable

`page.header|print_r`

[prism classes="language-text"]
{{ page.header|print_r }}
[/prism]
[/version]

### `randomize`

Randomizes the list provided.  If a value is provided as a parameter, it will skip first n values and keep them in order.

`array|randomize` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{{ print_r(ritems) }}
[/prism]
{% endverbatim %}

{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
[prism classes="language-text"]
{{ print_r(ritems) }}
[/prism]

### `regex_replace`

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

`'The quick brown fox jumps over the lazy dog.'|regex_replace(['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle'])` <i class="fa fa-long-arrow-right"></i> **{{ 'The quick brown fox jumps over the lazy dog.'|regex_replace(['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) }}**

! Use the `~`-delimiter rather than the `/`-delimiter where possible. Otherwise you'll most likely have to [double-escape certain characters](https://github.com/getgrav/grav/issues/833). Eg. `~\/\#.*~` rather than `'/\\/\\#.*/'`, which conforms more closely to the [PCRE-syntax](https://www.php.net/manual/en/regexp.reference.delimiters.php) used by PHP.

### `rtrim`

`'/strip/trailing/slash/'|rtrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/strip/trailing/slash/'|rtrim('/') }}

Removes trailing spaces at the end of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.rtrim.php](https://php.net/manual/en/function.rtrim.php))

### `singularize`

Converts a string to the English singular version

`'shoes'|singularize` <i class="fa fa-long-arrow-right"></i> **{{ 'shoes'|singularize }}**

### `safe_email`

The safe email filter converts an email address into ASCII characters to make it harder for email spam bots to recognize and capture.

`"someone@domain.com"|safe_email` <i class="fa fa-long-arrow-right"></i> **{{ "someone@domain.com"|safe_email }}**

Usage example with a mailto link:

{% verbatim %}
[prism classes="language-html line-numbers"]
<a href="mailto:{{ 'your.email@server.com'|safe_email }}">
  Email me
</a>
[/prism]
{% endverbatim %}

You might not notice a difference at first, but examining the page source (not using the Browser Developer Tools, the actual page source) will reveal the underlying characters encoding.

### `sort_by_key`

Sort an array map by a particular key

`array|sort_by_key` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set people = [{'email':'fred@yahoo.com', 'id':34}, {'email':'tim@exchange.com', 'id':21}, {'email':'john@apple.com', 'id':2}]|sort_by_key('id') %}
{% for person in people %}{{ person.email }}:{{ person.id }}, {% endfor %}
[/prism]
{% endverbatim %}

<strong>
{% set people = [{'email':'fred@yahoo.com', 'id':34}, {'email':'tim@exchange.com', 'id':21}, {'email':'john@apple.com', 'id':2}]|sort_by_key('id') %}
{% for person in people %}{{ person.email }}:{{ person.id }}, {% endfor %}
</strong>

### `starts_with`

Takes a needle and a haystack and determines if the haystack starts with the needle.  Also now works with an array of needles and will return `true` if **any** haystack starts with the needle.

`'the quick brown fox'|starts_with('the')` <i class="fa fa-long-arrow-right"></i> **{{ 'the quick brown fox'|starts_with('the') ? 'true' : 'false' }}**

### `titleize`

Converts a string to "Title Case" format

`'welcome page'|titleize` <i class="fa fa-long-arrow-right"></i> **{{ 'welcome page'|titleize }}**


### `t`

Translate a string into the current language

`'MY_LANGUAGE_KEY_STRING'|t` <i class="fa fa-long-arrow-right"></i> **'Some Text in English'**

This assumes you have these language strings translated in your site and have enabled multi-language support.  Please refer to the [multi-language documentation](../../content/multi-language) for more detailed information.

### `tu`

Translate a string into the current language set in the admin interface user preferences

`'MY_LANGUAGE_KEY_STRING'|tu` <i class="fa fa-long-arrow-right"></i> **'Some Text in English'**

This uses the language field set in the user yaml.

### `ta`

Translates an array with a language use the `|ta` filter. See the [multi-language documentation](../../content/multi-language) for a detailed example.

`'MONTHS_OF_THE_YEAR'|ta(post.date|date('n') - 1)` <i class="fa fa-long-arrow-right"></i> **{{ now|date('F') }}**

### `tl`

Translates a string in a specific language. For more details check out the [multi-language documentation](../../content/multi-language#complex-translations).

`'SIMPLE_TEXT'|tl(['fr'])`

### `truncate`

You can easily generate a shortened, truncated, version of a string by using this filter.  It takes a number of characters as the only required field, but has some other options:

`'one sentence. two sentences'|truncate(5)|raw` <i class="fa fa-long-arrow-right"></i> **{{ 'one sentence. two sentences'|truncate(5)|raw }}**

Simply truncates to 5 characters.

`'one sentence. two sentences'|truncate(5, true)|raw` <i class="fa fa-long-arrow-right"></i> **{{ 'one sentence. two sentences'|truncate(5, true)|raw }}**

!! The `|raw` Twig filiter should be used with the default `&helip;` (elipsis) padding element in order for it to render with Twig auto-escaping

Truncates to closest sentence-end after 5 characters.

You can also truncate HTML text, but should first use the `|striptags` filter to remove any HTML formatting that could get broken if you end between tags:

`'<span>one <strong>sentence</strong>. two sentences</span>'
|raw|striptags|truncate(25)` <i class="fa fa-long-arrow-right"></i> **{{ '<span>one <strong>sentence</strong>. two sentences</span>'|raw|striptags|truncate(25) }}**


#### Specialized versions:

### `safe_truncate`

Use `|safe_truncate` to truncate text by number of characters in a "word-safe" manner.

### `truncate_html`

Use `|truncate_html` to truncate HTML by number of characters. not "word-safe"!

### `safe_truncate_html`

Use `|safe_truncate_html` to truncate HTML by number of characters in a "word-safe" manner.

### `underscorize`

Converts a string into "under_scored" format

`'CamelCased'|underscorize` <i class="fa fa-long-arrow-right"></i> **{{ 'CamelCased'|underscorize }}**

[version=16,17]
### `yaml_encode`

Dump/Encode a variable into YAML syntax

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set array = {foo: [0, 1, 2, 3], baz: 'qux' } %}
{{ array|yaml_encode }}
[/prism]
{% endverbatim %}

{% set array = {foo: [0, 1, 2, 3], baz: 'qux' } %}
[prism classes="language-yaml"]
{{ array|yaml_encode|e }}
[/prism]

### `yaml_decode`

Decode/Parse a variable from YAML syntax

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set yaml = "foo: [0, 1, 2, 3]\nbaz: qux" %}
{{ yaml|yaml_decode|var_dump }}
[/prism]
{% endverbatim %}

{% set yaml = "foo: [0, 1, 2, 3]\nbaz: qux" %}
[prism]
{{ yaml|yaml_decode|var_dump }}
[/prism]
[/version]