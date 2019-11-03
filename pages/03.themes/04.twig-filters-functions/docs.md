---
title: Twig Filters & Functions
page-toc:
  active: true
  depth: 3  
process:
    twig: true
taxonomy:
    category: docs
---

Although Twig already provides an extensive list of [filters, functions, and tags](http://twig.sensiolabs.org/documentation), Grav also provides a selection of useful additions to make the process of theming easier.

!! For information about developing your own custom Twig Filters, check out the [Custom Twig Filter/Function](/cookbook/twig-recipes/#custom-twig-filter-function) example in the **Twig Recipes** section of the **Cookbook** chapter.


## Grav Twig Filters

Twig filters are applied to Twig variables by using the `|` character followed by the filter name.  Parameters can be passed in just like Twig functions using parenthesis.  

#### Absolute URL

Take a relative path and convert it to an absolute URL format including hostname

`'<img src="/some/path/to/image.jpg" />'|absolute_url` <i class="fa fa-long-arrow-right"></i> `{{ '<img src="/some/path/to/image.jpg" />'|absolute_url }}`

#### Array Unique

Wrapper for PHP `array_unique()` that removes duplicates from an array.

`['foo', 'bar', 'foo', 'baz']|array_unique` <i class="fa fa-long-arrow-right"></i> **{{ print_r(['foo', 'bar', 'foo', 'baz']|array_unique) }}**

#### Base32 Encode

Performs a base32 encoding on variable
`'some variable here'|base32_encode` <i class="fa fa-long-arrow-right"></i> **{{ 'some variable here'|base32_encode }}**

#### Base32 Decode

Performs a base32 decoding on variable
`'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK'|base32_decode` <i class="fa fa-long-arrow-right"></i> **{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGK'|base32_decode }}**

#### Base64 Encode

Performs a base64 encoding on variable
`'some variable here'|base64_encode` <i class="fa fa-long-arrow-right"></i> **{{ 'some variable here'|base64_encode }}**

#### Base64 Decode

Performs a base64 decoding on variable
`'c29tZSB2YXJpYWJsZSBoZXJl'|base64_decode` <i class="fa fa-long-arrow-right"></i> **{{ 'c29tZSB2YXJpYWJsZSBoZXJl'|base64_decode }}**

#### Basename

Return the basename of a path.

`'/etc/sudoers.d'|basename` <i class="fa fa-long-arrow-right"></i> **{{ '/etc/sudoers.d'|basename }}**

#### Camelize

Converts a string into "CamelCase" format

`'send_email'|camelize` <i class="fa fa-long-arrow-right"></i> **{{ 'send_email'|camelize }}**

[version=16]
#### Chunk Split

Splits a string into smaller chunks of a certain sizeOf

`'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGKA'|chunk_split(6, '-')` <i class="fa fa-long-arrow-right"></i> **{{ 'ONXW2ZJAOZQXE2LBMJWGKIDIMVZGKA'|chunk_split(6, '-') }}**
[/version]

#### Contains

Determine if a particular string contains another string

`'some string with things in it'|contains('things')` <i class="fa fa-long-arrow-right"></i> **{{ 'some string with things in it'|contains('things') }}**

#### Casting Values

PHP 7 is getting more strict type checks, which means that passing a value of wrong type may now throw an exception. To avoid this, you should use filters which ensure that the value passed to a method is valid:  

**|string**

Cast value to string.

**|int**

Cast value to integer.

**|bool**

Cast value to boolean.

**|float**

Cast value to floating point number.

**|array**

Cast value to an array.

#### Defined

Sometimes you want to check if some variable is defined, and if it's not, provide a default value.  For example:

`set header_image_width  = page.header.header_image_width|defined(900)`

This will set the variable `header_image_width` to the value `900` if it's not defined in the page header.

#### Dirname

Return the dirname of a path.

`'/etc/sudoers.d'|dirname` <i class="fa fa-long-arrow-right"></i> **{{ '/etc/sudoers.d'|dirname }}**


#### Ends-With

Takes a needle and a haystack and determines if the haystack ends with the needle.  Also now works with an array of needles and will return `true` if **any** haystack ends with the needle.

`'the quick brown fox'|ends_with('fox')` <i class="fa fa-long-arrow-right"></i> {{  'the quick brown fox'|ends_with('fox') ? 'true' : 'false' }}

#### FieldName

Filters field name by changing dot notation into array notation

`'field.name|fieldName`


[version=16]
#### Get Type

Gets the type of a variable:

`page|get_type` <i class="fa fa-long-arrow-right"></i> **{{ page|get_type }}**
[/version]

#### Humanize

Converts a string into a more "human readable" format

`'something_text_to_read'|humanize` <i class="fa fa-long-arrow-right"></i> **{{ 'something_text_to_read'|humanize }}**

#### Hyphenize

Converts a string into a hyphenated version.

`'Something Text to Read'|hyphenize` <i class="fa fa-long-arrow-right"></i> **{{ 'Something Text to Read'|hyphenize }}**

#### JSON Decode

You can decode JSON by simply applying this filter:

`{"first_name": "Guido", "last_name":"Rossum"}|json_decode`

#### Ksort

Sort an array map by each key

`array|ksort` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set ritems = {'orange':1, 'apple':2, 'peach':3}|ksort %}
{% for key, value in ritems %}{{ key }}:{{ value }}, {% endfor %}
[/prism]
{% endverbatim %}

{% set ritems = {'orange':1, 'apple':2, 'peach':3}|ksort %}
[prism classes="language-twig line-numbers"]
{% for key, value in ritems %}{{ key }}:{{ value }}, {% endfor %}
[/prism]

#### Left Trim

`'/strip/leading/slash/'|ltrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/strip/leading/slash/'|ltrim('/') }}

Removes trailing spaces at the beginning of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.ltrim.php](https://php.net/manual/en/function.ltrim.php))

#### Markdown

Take an arbitrary string containing markdown and convert it to HTML using the markdown parser of Grav

`'something with **markdown** and [a link](http://www.cnn.com)'|markdown` <i class="fa fa-long-arrow-right"></i> something with **markdown** and [a link](http://www.cnn.com)

#### MD5

Creates an md5 hash for the string

`'anything'|md5` <i class="fa fa-long-arrow-right"></i> **{{ 'anything'|md5 }}**

#### Modulus

Performs the same functionality as the Modulus `%` symbol in PHP. It operates on a number by passing in a numeric divider and an optional array of items to select from.

`7|modulus(3, ['red', 'blue', 'green'])` <i class="fa fa-long-arrow-right"></i> **{{ 7|modulus(3, ['red', 'blue', 'green']) }}**

#### Monthize

Converts an integer number of days into the number of months

`'181'|monthize` <i class="fa fa-long-arrow-right"></i> **{{ '181'|monthize }}**

[version=16]
#### NiceCron

Gets a human readable output for cron syntax

`"2 * * * *"|nicecron` <i class="fa fa-long-arrow-right"></i> **{{ '2 * * * *'|nicecron }}**

#### NiceFilesize

Output a file size in a human readable nice size format

`612394|nicefilesize` <i class="fa fa-long-arrow-right"></i> **{{ 612394|nicefilesize }}**

#### NiceNumber

Output a number in a human readable nice number format

`12430|nicenumber` <i class="fa fa-long-arrow-right"></i> **{{ 12430|nicenumber }}**
[/version]

#### NiceTime

Output a date in a human readable nice time format

`page.date|nicetime(false)` <i class="fa fa-long-arrow-right"></i> **{{ page.date|nicetime(false) }}**

[version=16]
#### Of Type

Checks the type of a variable to the param:

`page|of_type('string')` <i class="fa fa-long-arrow-right"></i> **{{ page|of_type('string') ? 'true' : 'false' }}**
[/version]

#### Ordinalize

Adds an ordinal to the integer (such as 1st, 2nd, 3rd, 4th)

`'10'|ordinalize` <i class="fa fa-long-arrow-right"></i> **{{ '10'|ordinalize }}**

#### Pad

Pads a string to a certain length with another character. This is a wrapper for the PHP [str_pad()](https://php.net/manual/en/function.str-pad.php) function.

`'foobar'|pad(10, '-')` <i class="fa fa-long-arrow-right"></i> **{{ 'foobar'|pad(10, '-') }}**

#### Pluralize

Converts a string to the English plural version

`'person'|pluralize` <i class="fa fa-long-arrow-right"></i> **{{ 'person'|pluralize }}**

[version=16]
#### Print Variable

Prints human-readable information about a variable

`page.header|print_r`

[prism classes="language-text"]
{{ page.header|print_r }}
[/prism]
[/version]

#### Randomize

Randomizes the list provided.  If a value is provided as a parameter, it will skip those values and keep them in order.

`array|randomize` {% verbatim %}
[prism classes="language-twig line-numbers"]
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{% for ritem in ritems %}{{ ritem }}, {% endfor %}
[/prism]
{% endverbatim %}

<strong>
{% set ritems = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten']|randomize(2) %}
{% for ritem in ritems %}{{ ritem }}, {% endfor %}
</strong>

#### Regex Replace

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

`'The quick brown fox jumps over the lazy dog.'|regex_replace(['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle'])` <i class="fa fa-long-arrow-right"></i> **{{ 'The quick brown fox jumps over the lazy dog.'|regex_replace(['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) }}**

#### Right Trim

`'/strip/trailing/slash/'|rtrim('/')` <i class="fa fa-long-arrow-right"></i> {{ '/strip/trailing/slash/'|rtrim('/') }}

Removes trailing spaces at the end of a string. It can also remove other characters by setting the character mask (see [https://php.net/manual/en/function.rtrim.php](https://php.net/manual/en/function.rtrim.php))

#### Singularize

Converts a string to the English singular version

`'shoes'|singularize` <i class="fa fa-long-arrow-right"></i> **{{ 'shoes'|singularize }}**

#### Safe Email

The safe email filter converts an email address into ASCII characters to make it harder for email spam bots to recognize and capture.

`"someone@domain.com"|safe_email` <i class="fa fa-long-arrow-right"></i> {{ "someone@domain.com"|safe_email }}

Usage example with a mailto link:

[prism classes="language-html line-numbers"]
<a href="mailto:{{'your.email@server.com'|safe_email}}">
  Email me
</a>
[/prism]

You might not notice a difference at first, but examining the page source (not using the Browser Developer Tools, the actual page source) will reveal the underlying characters encoding.

#### Sort by Key

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

#### Starts-With

Takes a needle and a haystack and determines if the haystack starts with the needle.  Also now works with an array of needles and will return `true` if **any** haystack starts with the needle.

`'the quick brown fox'|starts_with('the')` <i class="fa fa-long-arrow-right"></i> {{  'the quick brown fox'|starts_with('the') ? 'true' : 'false' }}

#### Titleize

Converts a string to "Title Case" format

`'welcome page'|titleize` <i class="fa fa-long-arrow-right"></i> **{{ 'welcome page'|titleize }}**


#### Translate

Translate a string into the current language

`'MY_LANGUAGE_KEY_STRING'|t` <i class="fa fa-long-arrow-right"></i> 'Some Text in English'

This assumes you have these language strings translated in your site and have enabled multi-language support.  Please refer to the [multi-language documentation](../../content/multi-language) for more detailed information.

#### Translate Admin

Translate a string into the current language set in the admin interface user preferences

`'MY_LANGUAGE_KEY_STRING'|tu` <i class="fa fa-long-arrow-right"></i> 'Some Text in English'

This uses the language field set in the user yaml.

#### Translate Array

Translates an array with a language use the `|ta` filter. See the [multi-language documentation](../../content/multi-language) for a detailed example.

`'MONTHS_OF_THE_YEAR'|ta(post.date|date('n') - 1)` <i class="fa fa-long-arrow-right"></i> **{{ now|date('F') }}**

#### Translate Language

Translates a string in a specific language. For more details check out the [multi-language documentation](../../content/multi-language#complex-translations).

`'SIMPLE_TEXT'|tl(['fr'])`

#### Truncate a String

You can easily generate a shortened, truncated, version of a string by using this filter.  It takes a number of characters as the only required field, but has some other options:

`'one sentence. two sentences'|truncate(5)` <i class="fa fa-long-arrow-right"></i> {{ 'one sentence. two sentences'|truncate(5) }}

Simply truncates to 5 characters.

`'one sentence. two sentences'|truncate(5, true)` <i class="fa fa-long-arrow-right"></i> {{ 'one sentence. two sentences'|truncate(5, true) }}

Truncates to closest sentence-end after 5 characters.

You can also truncate HTML text, but should first use the `striptags` filter to remove any HTML formatting that could get broken if you end between tags:

`'<p>one <strong>sentence<strong>. two sentences</p>'|striptags|truncate(5)` <i class="fa fa-long-arrow-right"></i> {{ '<p>one <strong>sentence<strong>. two sentences</p>'|striptags|truncate(5) }}

##### Specialized versions:

**|safe_truncate**

Truncate text by number of characters in a "word-safe" manner.

**|truncate_html**

Truncate HTML by number of characters. not "word-safe"!

**|safe_truncate_html**

Truncate HTML by number of characters in a "word-safe" manner.

#### Underscoreize

Converts a string into "under_scored" format

`'CamelCased'|underscorize` <i class="fa fa-long-arrow-right"></i> **{{ 'CamelCased'|underscorize }}**

[version=16]
#### Yaml Encode

Dump/Encode a variable into YAML syntax

`{foo: [0,1,2,3], baz: 'qux' }|yaml_encode` 

[prism classes="language-twig"]
{{ {foo: [0,1,2,3], baz: 'qux' }|yaml_encode }}
[/prism]

#### Yaml Decode

Decode/Parse a variable from YAML syntax

{% verbatim %}
`{% set yaml = "foo: [0, 1, 2, 3]\nbaz: qux" %}`

`yaml|yaml_decode` 
{% endverbatim %}

{% set yaml = "foo: [0, 1, 2, 3]\nbaz: qux" %}
[prism classes="language-twig"]
{{ yaml|yaml_decode|var_dump}}
[/prism]
[/version]


## Grav Twig Functions

Twig functions are called directly with any parameters being passed in via parenthesis.

#### Array

Cast a value to array

`array(value)`

#### Array Key Value

The `array_key_value` function allows you to add a key/value pair to an associate array

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set my_array = {fruit: 'apple'} %}
{% set my_array = array_key_value('meat','steak', my_array) %}
{{ print_r(my_array)}}
[/prism]
{% endverbatim %}

{% set my_array = {fruit: 'apple'} %}
{% set my_array = array_key_value('meat','steak', my_array) %}
outputs: ** {{ print_r(my_array) }} **

#### Array Key Exists

Wrapper for PHP's `array_key_exists` function that returns whether or not a key exists in an associative array.

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set my_array = {fruit: 'apple', meat: 'steak'} %}
{{ array_key_exists('meat', my_array) }}
[/prism]
{% endverbatim %}

{% set my_array = {fruit: 'apple', meat: 'steak'} %}
outputs: **{{ array_key_exists('meat', my_array) }}**

#### Array Intersect

The `array_intersect` function provides the intersection of two arrays or Grav collections.

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set array_1 = {fruit: 'apple', meat: 'steak'} %}
{% set array_2 = {fish: 'tuna', meat: 'steak'} %}
{{ print_r(array_intersect(array_1, array_2)) }}
[/prism]
{% endverbatim %}

{% set array_1 = {fruit: 'apple', meat: 'steak'} %}
{% set array_2 = {fish: 'tuna', meat: 'steak'} %}

outputs: **{{ print_r(array_intersect(array_1, array_2)) }}**

#### Array Unique

Wrapper for PHP `array_unique()` that removes duplicates from an array.

`array_unique(['foo', 'bar', 'foo', 'baz'])` <i class="fa fa-long-arrow-right"></i> **{{ print_r(array_unique(['foo', 'bar', 'foo', 'baz'])) }}**

#### Authorize

Authorizes an authenticated user to see a resource. Accepts a single permission string or an array of permission strings.

`authorize(['admin.statistics', 'admin.super'])`

[version=16]
#### Body Class

Takes an array of classes, and if they are not set on `body_classes` look to see if they are set in current theme configuration.

`set body_classes = body_class(['header-fixed', 'header-animated', 'header-dark', 'header-transparent', 'sticky-footer'])`

#### Cron

Create a "Cron" object from cron syntax

`cron("3 * * * *").getNextRunDate()|date(config.date_format.default)`

[/version]


#### Dump

Takes a valid Twig variable and dumps it out into the [Grav debugger panel](../../advanced/debugging).  The debugger must be **enabled** to see the values in the messages tab.

`dump(page.header)`

#### Debug

Same as `dump()`

#### Evaluate

The evaluate function can be used to evaluate a string as Twig:

`evaluate('grav.language.getLanguage')`

#### Evaluate Twig

Similar to evaluate, but will evaluate and process with Twig

{% verbatim %}
`evaluate_twig({foo: 'bar'}, 'This is a twig variable: {{ foo }}')`)  <i class="fa fa-long-arrow-right"></i> **This is a twig variable: bar**
{% endverbatim %}

#### EXIF

Output the EXIF data from an image based on its filepath. This requires that `media: auto_metadata_exif: true` is set in `system.yaml`. For example, in a Twig-template:

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set image = page.media['sample-image.jpg'] %}
{% set exif = exif(image.filepath, true) %}
{{ exif.MaxApertureValue }}
[/prism]
{% endverbatim %}

This would write the `MaxApertureValue`-value set in the camera, for example "40/10". You can always use `{% verbatim %}{{ dump(exif)}}{% endverbatim %}` to show all the available data in the debugger.

#### Get Cookie

Retrieve the value of a cookie with this function:

`get_cookie('your_cookie_key')`

[version=16]
#### Get Type Function

Gets the type of a variable:

`get_type(page)` <i class="fa fa-long-arrow-right"></i> **{{ get_type(page) }}**
[/version]

#### Gist

Takes a Github Gist ID and creates appropriate Gist embed code

`gist('bc448ff158df4bc56217')` <i class="fa fa-long-arrow-right"></i> {{ gist('bc448ff158df4bc56217')}}

[version=16]
#### HTTP Response Code

If response_code is provided, then the previous status code will be returned. If response_code is not provided, then the current status code will be returned. Both of these values will default to a 200 status code if used in a web server environment.

`http_response_code(404)`

[/version]

#### Is Ajax Request

the `isajaxrequest()` function can be used to check if `HTTP_X_REQUESTED_WITH` header option is set:


#### JSON Decode Function

You can decode JSON by simply applying this filter:

`json_decode({"first_name": "Guido", "last_name":"Rossum"})`

#### Media Directory

Returns a media object for an arbitrary directory.  Once obtained you can manipulate images in a similar fashion to pages.

`media_directory('theme://images')['some-image.jpg'].cropResize(200,200).html`

[version=16]
#### NiceFilesize Function

Output a file size in a human readable nice size format

`nicefilesize(612394)` <i class="fa fa-long-arrow-right"></i> **{{ nicefilesize(612394) }}**

#### NiceNumber Function

Output a number in a human readable nice number format

`nicenumnber(12430)` <i class="fa fa-long-arrow-right"></i> **{{ nicenumber(12430)}}**

#### NiceTime Function

Output a date in a human readable nice time format

`nicetime(page.date)` <i class="fa fa-long-arrow-right"></i> **{{ nicetime(page.date) }}**
[/version]

#### Nonce Field

Generate a Grav security nonce field for a form with a required `action`:

`nonce_field('action')` <i class="fa fa-long-arrow-right"></i> **{{ nonce_field('action')|e }}**

[version=16]
#### Of Type Function

Checks the type of a variable to the param:

`of_type(page, 'string')` <i class="fa fa-long-arrow-right"></i> **{{ of_type(page, 'string') ? 'true' : 'false' }}**
[/version]

#### Pathinfo

Parses a path into an array.

{% verbatim %}
[prism classes="language-twig"]
{% set parts = pathinfo('/www/htdocs/inc/lib.inc.php') %}
{{ print_r(parts) }}
[/prism]
{% endverbatim %}

{% set parts = pathinfo('/www/htdocs/inc/lib.inc.php') %}

outputs: **{{ print_r(parts) }}**

[version=16]
#### Print Variable Function

Prints a variable in a readable format

`print_r(page.header)`

[prism classes="language-twig"]
{{ print_r(page.header) }}
[/prism]

[/version]

#### Random String Generation

Will generate a random string of the required number of characters.  Particularly useful in creating a unique id or key.

`random_string(10)` <i class="fa fa-long-arrow-right"></i> **{{ random_string(10) }}**

#### Range

Generates an array containing a range of elements, optionally stepped

`range(25, 300, 50)` <i class="fa fa-long-arrow-right"></i> **{{ print_r(range(25, 300, 50)) }}**

[version=16]
#### Read File

Simple function to read a file based on a filepath and output it.

`read_file('plugins://admin/README.md')|markdown`

[prism classes="language-markdown line-numbers"]
# Grav Standard Administration Panel Plugin

This **admin plugin** for [Grav](https://github.com/getgrav/grav) is an HTML user interface that provides a convenient way to configure Grav and easily create and modify pages...
[/prism]

[/version]

#### Redirect Me

Redirects to a URL of your choosing

`redirect_me('http://google.com', 304)`

[version=16]
#### Regex Filter Function

Performs a `preg_grep` on an array with a regex pattern

`regex_filter(['pasta', 'fish', 'steak', 'potatoes'], "/p.*/")` 

[prism classes="language-twig"]
{{ var_dump(regex_filter(['pasta', 'fish', 'steak', 'potatoes'], "/p.*/")) }}
[/prism]

#### Regex Replace Function

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

`regex_replace('The quick brown fox jumps over the lazy dog.', ['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle'])` 

[prism classes="language-twig"]
{{ regex_replace('The quick brown fox jumps over the lazy dog.', ['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) }}
[/prism]

[/version]

#### Repeat

Will repeat whatever is passed in a certain amount of times.

`repeat('blah ', 10)` <i class="fa fa-long-arrow-right"></i> **{{ repeat('blah ', 10) }}**

#### String

Returns a string from a value. If the value is array, return it json encoded

`string(23)` => `"23"`
`string(['test' => 'x'])` => `{"test":"x"}`

[version=16]
#### Theme Variable

Get a theme variable from the page header if it exists, else use the theme config:

`theme_var('grid-size')`

This will first try `page.header.grid-size`, if that is not set, it will try `theme.grid-size` from the theme configuration file.  it can optionally take a default:

`theme_var('grid-size', 1024)`

[/version]

#### Translate Function

Translate a string, as the `|t` filter.

`t('SITE_NAME')` <i class="fa fa-long-arrow-right"></i> **Site Name**

#### Translate Array Function

Function related to the `|ta` filter.

#### Translate Language Function

Translates a string in a specific language. For more details check out the [multi-language documentation](../../content/multi-language#complex-translations).

`tl('SIMPLE_TEXT', ['fr'])`

#### Url

Will create a URL and convert any PHP URL streams into a valid HTML resources. A default value can be passed in in case the URL cannot be resolved.

`url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4')` <i class="fa fa-long-arrow-right"></i> **{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}**

#### VarDump

The `vardump()` function outputs the current variable to the screen (rather than in the debugger as with `dump()`)

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set my_array = {foo: 'bar', baz: 'qux'} %}
{{ vardump(my_array)}}
[/prism]
{% endverbatim %}

{% set my_array = {foo: 'bar', baz: 'qux'} %}
{{ vardump(my_array)}}

[version=16]
#### XSS

Allow a manual check of a string for XSS vulnerabilities

`xss('this string contains a <script>alert("hello");</script> XSS vulnerability')` <i class="fa fa-long-arrow-right"></i> **{{ xss('this string contains a <script>alert("hello");</script> XSS vulnerability') }}**

[/version]
