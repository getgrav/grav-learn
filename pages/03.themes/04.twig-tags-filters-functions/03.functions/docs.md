---
title: Twig Functions
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

Twig functions are called directly with any parameters being passed in via parenthesis.

### `array`

Cast a value to array

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set value = array(value) %}
[/prism]
{% endverbatim %}

### `array_diff`

Computes the difference of arrays.

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set diff = array_diff(array1, array2...) %}
[/prism]
{% endverbatim %}

### `array_key_value`

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

### `array_key_exists`

Wrapper for PHP's `array_key_exists` function that returns whether or not a key exists in an associative array.

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set my_array = {fruit: 'apple', meat: 'steak'} %}
{{ array_key_exists('meat', my_array) }}
[/prism]
{% endverbatim %}

{% set my_array = {fruit: 'apple', meat: 'steak'} %}
outputs: **{{ array_key_exists('meat', my_array) }}**

### `array_intersect`

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

### `array_unique`

Wrapper for PHP `array_unique()` that removes duplicates from an array.

`array_unique(['foo', 'bar', 'foo', 'baz'])` <i class="fa fa-long-arrow-right"></i> **{{ print_r(array_unique(['foo', 'bar', 'foo', 'baz'])) }}**

### `authorize`

Authorizes an authenticated user to see a resource. Accepts a single permission string or an array of permission strings.

`authorize(['admin.statistics', 'admin.super'])`

[version=16,17]
### `body_class`

Takes an array of classes, and if they are not set on `body_classes` look to see if they are set in current theme configuration.

`set body_classes = body_class(['header-fixed', 'header-animated', 'header-dark', 'header-transparent', 'sticky-footer'])`

### `cron`

Create a "Cron" object from cron syntax

`cron("3 * * * *").getNextRunDate()|date(config.date_format.default)`

[/version]


### `dump`

Takes a valid Twig variable and dumps it out into the [Grav debugger panel](../../../advanced/debugging).  The debugger must be **enabled** to see the values in the messages tab.

`dump(page.header)`

### `debug`

Same as `dump()`

### `evaluate`

The evaluate function can be used to evaluate a string as Twig:

`evaluate('grav.language.getLanguage')`

### `evaluate_twig`

Similar to evaluate, but will evaluate and process with Twig

{% verbatim %}
`evaluate_twig('This is a twig variable: {{ foo }}', {foo: 'bar'})`)  <i class="fa fa-long-arrow-right"></i> **This is a twig variable: bar**
{% endverbatim %}

### `exif`

Output the EXIF data from an image based on its filepath. This requires that `media: auto_metadata_exif: true` is set in `system.yaml`. For example, in a Twig-template:

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set image = page.media['sample-image.jpg'] %}
{% set exif = exif(image.filepath, true) %}
{{ exif.MaxApertureValue }}
[/prism]
{% endverbatim %}

This would write the `MaxApertureValue`-value set in the camera, for example "40/10". You can always use `{% verbatim %}{{ dump(exif)}}{% endverbatim %}` to show all the available data in the debugger.

### `get_cookie`

Retrieve the value of a cookie with this function:

`get_cookie('your_cookie_key')`

[version=16,17]
### `get_type`

Gets the type of a variable:

`get_type(page)` <i class="fa fa-long-arrow-right"></i> **{{ get_type(page) }}**
[/version]

### `gist`

Takes a Github Gist ID and creates appropriate Gist embed code

`gist('bc448ff158df4bc56217')` <i class="fa fa-long-arrow-right"></i> **{{ gist('bc448ff158df4bc56217')|e }}**

### `header_var`
`header_var($variable, $pages = null)`

Returns `page.header.<variable>`.

! **NOTE:** Deprecated since Grav 1.7. `theme_var` should be used.

! The logic of finding the variable has changed, which might lead to unexptected results:
! - If an array of lookup pages is provided as second parameter, only the first page will be used.
! - If `<variable>` is not defined in het header of the page, Grav will search for the variable in the tree of parents of the page.
! - If still not found, Grav will search for the variable in the config file of the theme

Given frontmatter of
```
---
title: Home
---
```

`header_var('title')` <i class="fa fa-long-arrow-right"></i> **Home**

[version=16,17]
### `http_response_code`

If response_code is provided, then the previous status code will be returned. If response_code is not provided, then the current status code will be returned. Both of these values will default to a 200 status code if used in a web server environment.

`http_response_code(404)`
[/version]

### `isajaxrequest`

the `isajaxrequest()` function can be used to check if `HTTP_X_REQUESTED_WITH` header option is set:


### `json_decode`

You can decode JSON by simply applying this filter:

`json_decode({"first_name": "Guido", "last_name":"Rossum"})`

### `media_directory`

Returns a media object for an arbitrary directory.  Once obtained you can manipulate images in a similar fashion to pages.

`media_directory('theme://images')['some-image.jpg'].cropResize(200,200).html`

[version=16,17]
### `nicefilesize`

Output a file size in a human readable nice size format

`nicefilesize(612394)` <i class="fa fa-long-arrow-right"></i> **{{ nicefilesize(612394) }}**

### `nicenumber`

Output a number in a human readable nice number format

`nicenumber(12430)` <i class="fa fa-long-arrow-right"></i> **{{ nicenumber(12430)}}**

### `nicetime`

Output a date in a human readable nice time format

`nicetime(page.date)` <i class="fa fa-long-arrow-right"></i> **{{ nicetime(page.date) }}**
[/version]

### `nonce_field`

Generate a Grav security nonce field for a form with a required `action`:

`nonce_field('action')` <i class="fa fa-long-arrow-right"></i> **{{ nonce_field('action')|e }}**

[version=16,17]
### `of_type`

Checks the type of a variable to the param:

`of_type(page, 'string')` <i class="fa fa-long-arrow-right"></i> **{{ of_type(page, 'string') ? 'true' : 'false' }}**
[/version]

### `pathinfo`

Parses a path into an array.

{% verbatim %}
[prism classes="language-twig"]
{% set parts = pathinfo('/www/htdocs/inc/lib.inc.php') %}
{{ print_r(parts) }}
[/prism]
{% endverbatim %}

{% set parts = pathinfo('/www/htdocs/inc/lib.inc.php') %}

outputs: **{{ print_r(parts) }}**

[version=16,17]
### `print_r`

Prints a variable in a readable format

`print_r(page.header)`

[prism classes="language-text"]
{{ print_r(page.header) }}
[/prism]

[/version]

### `random_string`

Will generate a random string of the required number of characters.  Particularly useful in creating a unique id or key.

`random_string(10)` <i class="fa fa-long-arrow-right"></i> **{{ random_string(10) }}**

### `unique_id`

Generates a random string with configurable length, prefix and suffix. Unlike the built-in PHP `uniqid()` function and the `random_string` utils, this string will be generated truly unique and non-conflicting.


`unique_id(9)` <i class="fa fa-long-arrow-right"></i> **{{ unique_id(9) }}**
`unique_id(11, { prefix: 'user_' })` <i class="fa fa-long-arrow-right"></i> **unique_id(11, { prefix: 'user_' }) }}**
`unique_id(13, { suffix: '.json' })` <i class="fa fa-long-arrow-right"></i> **unique_id(13, { suffix: '.json' }) }}**

### `range`

Generates an array containing a range of elements, optionally stepped

`range(25, 300, 50)` <i class="fa fa-long-arrow-right"></i> **{{ print_r(range(25, 300, 50)) }}**

[version=16,17]
### `read_file`

Simple function to read a file based on a filepath and output it.

`read_file('plugins://admin/README.md')|markdown`

[prism classes="language-markdown line-numbers"]
# Grav Standard Administration Panel Plugin

This **admin plugin** for [Grav](https://github.com/getgrav/grav) is an HTML user interface that provides a convenient way to configure Grav and easily create and modify pages...
[/prism]

[/version]

### `redirect_me`

Redirects to a URL of your choosing

`redirect_me('http://google.com', 304)`

[version=16,17]
### `regex_filter`

Performs a `preg_grep` on an array with a regex pattern

`regex_filter(['pasta', 'fish', 'steak', 'potatoes'], "/p.*/")`

{% set var = regex_filter(['pasta', 'fish', 'steak', 'potatoes'], "/p.*/") %}
[prism classes="language-text"]
{{ print_r(var) }}
[/prism]

### `regex_replace`

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

{% verbatim %}
`regex_replace('The quick brown fox jumps over the lazy dog.', ['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle'])`
{% endverbatim %}

{% set var = regex_replace('The quick brown fox jumps over the lazy dog.', ['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) %}
[prism classes="language-text"]
{{ var }}
[/prism]

[/version]

[version=17]
### `regex_match`

A helpful wrapper for the PHP [preg_match()](https://php.net/manual/en/function.preg-math.php) method, you can perform complex regular expression match on text via this filter:

{% verbatim %}
`regex_match('http://www.php.net/index.html', '@^(?:http://)?([^/]+)@i')`
{% endverbatim %}

{% set var = regex_match('http://www.php.net/index.html', '@^(?:http://)?([^/]+)@i') %}
[prism classes="language-text"]
{{ print_r(var) }}
[/prism]

### `regex_split`

A helpful wrapper for the PHP [preg_split()](https://php.net/manual/en/function.preg-split.php) method. Split string by a regular expression on text via this filter:

{% verbatim %}
`regex_split('hypertext language, programming', '/\\s*,\\s*/u')`
{% endverbatim %}

{% set var = regex_split('hypertext language    ,    programming', '/\\s*,\\s*/u') %}
[prism classes="language-text"]
{{ print_r(var) }}
[/prism]

[/version]

### `repeat`

Will repeat whatever is passed in a certain amount of times.

`repeat('blah ', 10)` <i class="fa fa-long-arrow-right"></i> **{{ repeat('blah ', 10) }}**

### `string`

Returns a string from a value. If the value is array, return it json encoded

`string(23)` => **"23"**

`string(['test' => 'x'])` => **{"test":"x"}**

[version=17]
### `svg_image`

Returns the content of an SVG image and adds extra classes as needed. Provides the benefits of inline svg without having to paste the code directly on the page. Useful for reusable images such as social media icons.

{% verbatim %}
`{{ svg_image(path, classes, strip_style) }}`
{% endverbatim %}

strip_style = remove the svg inline styling - useful for styling with css classes.

example:

{% verbatim %}
`{{ svg_image('theme://images/something.svg', 'my-class-here mb-10', true) }}`
{% endverbatim %}


[/version]

[version=16,17]
### `theme_var`
`theme_var($variable, $default = null, $page = null)`

Get a theme variable from the page's header, or, if not found, from its parent(s), the theme's config file, or the default value if provided:

`theme_var('grid-size')`

This will first try `page.header.grid-size`, if not set, it will traverse the tree of parents. If still not found, it will try `theme.grid-size` from the theme's configuration file.

It can optionally take a default value as fallback:

`theme_var('grid-size', 1024)`
[/version]

### `t`

Translate a string, as the [`|t`](../filters#t) filter.

`t('SITE_NAME')` <i class="fa fa-long-arrow-right"></i> **Site Name**

### `ta`

Functions the same way the [`|ta`](../filters#ta) filter does.

### `tl`

Translates a string in a specific language. For more details check out the [multi-language documentation](../../content/multi-language#complex-translations).

`tl('SIMPLE_TEXT', ['fr'])`

### `url`

Will create a URL and convert any PHP URL streams into a valid HTML resources. A default value can be passed in in case the URL cannot be resolved.

`url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4')` <i class="fa fa-long-arrow-right"></i> **{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}**

### `vardump`

The `vardump()` function outputs the current variable to the screen (rather than in the debugger as with `dump()`)

{% verbatim %}
[prism classes="language-twig line-numbers"]
{% set my_array = {foo: 'bar', baz: 'qux'} %}
{{ vardump(my_array) }}
[/prism]
{% endverbatim %}

{% set my_array = {foo: 'bar', baz: 'qux'} %}

[prism classes="language-twig"]
[
  "foo" => "bar"
  "baz" => "qux"
]
[/prism]

[version=16,17]
### `xss`

Allow a manual check of a string for XSS vulnerabilities

`xss('this string contains a <script>alert("hello");</script> XSS vulnerability')` <i class="fa fa-long-arrow-right"></i> **{{ xss('this string contains a <script>alert("hello");</script> XSS vulnerability') }}**

[/version]
