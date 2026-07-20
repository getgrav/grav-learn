---
title: Twig Functions
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
# Twig Functions

Twig functions are called directly with any parameters being passed in via parenthesis.

### array

Cast a value to array

[codesh-group]
[codesh=twig title="Twig"]
{% set value = array(value) %}
[/codesh]
[codesh=txt title="Output"]
(value cast to array)
[/codesh]
[/codesh-group]

### array_diff

Computes the difference of arrays.

[codesh-group]
[codesh=twig title="Twig"]
{% set diff = array_diff(array1, array2...) %}
[/codesh]
[codesh=txt title="Output"]
(array containing all entries from array1 not in other arrays)
[/codesh]
[/codesh-group]

### array_key_value

The `array_key_value` function allows you to add a key/value pair to an associate array

[codesh-group]
[codesh=twig title="Twig"]
{% set my_array = {fruit: 'apple'} %}
{% set my_array = array_key_value('meat','steak', my_array) %}
{{ print_r(my_array)}}
[/codesh]
[codesh=txt title="Output"]
[
    "fruit" => "apple"
    "meat" => "steak"
]
[/codesh]
[/codesh-group]

### array_key_exists

Wrapper for PHP's `array_key_exists` function that returns whether or not a key exists in an associative array.

[codesh-group]
[codesh=twig title="Twig"]
{% set my_array = {fruit: 'apple', meat: 'steak'} %}
{{ array_key_exists('meat', my_array) }}
[/codesh]
[codesh=txt title="Output"]
true
[/codesh]
[/codesh-group]

### array_intersect

The `array_intersect` function provides the intersection of two arrays or Grav collections.

[codesh-group]
[codesh=twig title="Twig"]
{% set array_1 = {fruit: 'apple', meat: 'steak'} %}
{% set array_2 = {fish: 'tuna', meat: 'steak'} %}
{{ print_r(array_intersect(array_1, array_2)) }}
[/codesh]
[codesh=txt title="Output"]
[
    "meat" => "steak"
]
[/codesh]
[/codesh-group]

### array_unique

Wrapper for PHP `array_unique()` that removes duplicates from an array.

[codesh-group]
[codesh=twig title="Twig"]
{{ array_unique(['foo', 'bar', 'foo', 'baz']) }}
[/codesh]
[codesh=txt title="Output"]
['foo', 'bar', 'baz']
[/codesh]
[/codesh-group]

### authorize

Authorizes an authenticated user to see a resource. Accepts a single permission string or an array of permission strings.

[codesh-group]
[codesh=twig title="Twig"]
{{ authorize(['admin.statistics', 'admin.super']) }}
[/codesh]
[codesh=txt title="Output"]
true/false (depending on user permissions)
[/codesh]
[/codesh-group]

### body_class

Takes an array of classes, and if they are not set on `body_classes` look to see if they are set in current theme configuration.

[codesh-group]
[codesh=twig title="Twig"]
set body_classes = body_class(['header-fixed', 'header-animated', 'header-dark', 'header-transparent', 'sticky-footer'])
[/codesh]
[codesh=txt title="Output"]
header-fixed header-animated header-dark
[/codesh]
[/codesh-group]

### cron

Create a "Cron" object from cron syntax

[codesh-group]
[codesh=twig title="Twig"]
{{ cron("3 * * * *").getNextRunDate()|date(config.date_format.default) }}
[/codesh]
[codesh=txt title="Output"]
2024-01-15 14:03:00
[/codesh]
[/codesh-group]

### dump

Takes a valid Twig variable and dumps it out into the [Grav debugger panel](../../../advanced/debugging).  The debugger must be **enabled** to see the values in the messages tab.

[codesh-group]
[codesh=twig title="Twig"]
{% do dump(page.header) %}
[/codesh]
[codesh=txt title="Output"]
(outputs variable to debugger panel)
[/codesh]
[/codesh-group]

### debug

Same as `dump()`

### evaluate

The evaluate function can be used to evaluate a string as Twig:

[codesh-group]
[codesh=twig title="Twig"]
{{ evaluate('grav.language.getLanguage') }}
[/codesh]
[codesh=txt title="Output"]
en
[/codesh]
[/codesh-group]

### evaluate_twig

Similar to evaluate, but will evaluate and process with Twig

[codesh-group]
[codesh=twig title="Twig"]
{{ evaluate_twig('This is a twig variable: {% verbatim %}{{ foo }}{% endverbatim %}', {foo: 'bar'}) }}
[/codesh]
[codesh=txt title="Output"]
This is a twig variable: bar
[/codesh]
[/codesh-group]

### exif

Output the EXIF data from an image based on its filepath. This requires that `media: auto_metadata_exif: true` is set in `system.yaml`. For example, in a Twig-template:

[codesh-group]
[codesh=twig title="Twig"]
{% set image = page.media['sample-image.jpg'] %}
{% set exif = exif(image.filepath, true) %}
{{ exif.MaxApertureValue }}
[/codesh]
[codesh=txt title="Output"]
40/10
[/codesh]
[/codesh-group]

This would write the `MaxApertureValue`-value set in the camera, for example "40/10". You can always use `{{ dump(exif) }}` to show all the available data in the debugger.

### get_cookie

Retrieve the value of a cookie with this function:

[codesh-group]
[codesh=twig title="Twig"]
{{ get_cookie('your_cookie_key') }}
[/codesh]
[codesh=txt title="Output"]
cookie_value
[/codesh]
[/codesh-group]

### get_type

Gets the type of a variable:

[codesh-group]
[codesh=twig title="Twig"]
{{ get_type(page) }}
[/codesh]
[codesh=txt title="Output"]
Grav\Common\Page\Page
[/codesh]
[/codesh-group]

### gist

Takes a Github Gist ID and creates appropriate Gist embed code

[codesh-group]
[codesh=twig title="Twig"]
{{ gist('bc448ff158df4bc56217') }}
[/codesh]
[codesh=html title="Output"]
<script src="https://gist.github.com/bc448ff158df4bc56217.js"></script>
[/codesh]
[/codesh-group]

### header_var

`header_var($variable, $pages = null)`

Returns `page.header.<variable>`.

> [!WARNING]
> **NOTE:** Deprecated since Grav 1.7. `theme_var` should be used.

> [!WARNING]
> The logic of finding the variable has changed, which might lead to unexptected results:
> - If an array of lookup pages is provided as second parameter, only the first page will be used.
> - If `<variable>` is not defined in het header of the page, Grav will search for the variable in the tree of parents of the page.
> - If still not found, Grav will search for the variable in the config file of the theme

Given frontmatter of
```
---
title: Home
---
```

[codesh-group]
[codesh=twig title="Twig"]
{{ header_var('title') }}
[/codesh]
[codesh=txt title="Output"]
Home
[/codesh]
[/codesh-group]

### http_response_code

If response_code is provided, then the previous status code will be returned. If response_code is not provided, then the current status code will be returned. Both of these values will default to a 200 status code if used in a web server environment.

[codesh-group]
[codesh=twig title="Twig"]
{% do http_response_code(404) %}
[/codesh]
[codesh=txt title="Output"]
(sets HTTP response code to 404)
[/codesh]
[/codesh-group]

### isajaxrequest

the `isajaxrequest()` function can be used to check if `HTTP_X_REQUESTED_WITH` header option is set:

[codesh-group]
[codesh=twig title="Twig"]
{{ isajaxrequest() }}
[/codesh]
[codesh=txt title="Output"]
true/false
[/codesh]
[/codesh-group]

### json_decode

You can decode JSON by simply applying this filter:

[codesh-group]
[codesh=twig title="Twig"]
{{ json_decode('{"first_name": "Guido", "last_name":"Rossum"}') }}
[/codesh]
[codesh=txt title="Output"]
[
    "first_name" => "Guido"
    "last_name" => "Rossum"
]
[/codesh]
[/codesh-group]

### media_directory

Returns a media object for an arbitrary directory.  Once obtained you can manipulate images in a similar fashion to pages.

[codesh-group]
[codesh=twig title="Twig"]
{{ media_directory('theme://images')['some-image.jpg'].cropResize(200,200).html }}
[/codesh]
[codesh=html title="Output"]
<img src="/user/themes/mytheme/images/some-image.jpg" width="200" height="200">
[/codesh]
[/codesh-group]

### nicefilesize

Output a file size in a human readable nice size format

[codesh-group]
[codesh=twig title="Twig"]
{{ nicefilesize(612394) }}
[/codesh]
[codesh=txt title="Output"]
598.04 KB
[/codesh]
[/codesh-group]

### nicenumber

Output a number in a human readable nice number format

[codesh-group]
[codesh=twig title="Twig"]
{{ nicenumber(12430) }}
[/codesh]
[codesh=txt title="Output"]
12K
[/codesh]
[/codesh-group]

### nicetime

Output a date in a human readable nice time format

[codesh-group]
[codesh=twig title="Twig"]
{{ nicetime(page.date) }}
[/codesh]
[codesh=txt title="Output"]
1 month ago
[/codesh]
[/codesh-group]

### nonce_field

Generate a Grav security nonce field for a form with a required `action`:

[codesh-group]
[codesh=twig title="Twig"]
{{ nonce_field('action') }}
[/codesh]
[codesh=html title="Output"]
<input type="hidden" name="nonce" value="abc123def456">
[/codesh]
[/codesh-group]

### of_type

Checks the type of a variable to the param:

[codesh-group]
[codesh=twig title="Twig"]
{{ of_type(page, 'string') }}
[/codesh]
[codesh=txt title="Output"]
false
[/codesh]
[/codesh-group]

### pathinfo

Parses a path into an array.

[codesh-group]
[codesh=twig title="Twig"]
{% set parts = pathinfo('/www/htdocs/inc/lib.inc.php') %}
{{ print_r(parts) }}
[/codesh]
[codesh=txt title="Output"]
[
    "dirname" => "/www/htdocs/inc"
    "basename" => "lib.inc.php"
    "extension" => "php"
    "filename" => "lib.inc"
]
[/codesh]
[/codesh-group]

### print_r

Prints a variable in a readable format

[codesh-group]
[codesh=twig title="Twig"]
{{ print_r(page.header) }}
[/codesh]
[codesh=txt title="Output"]
[
    "title" => "My Page"
    "published" => true
]
[/codesh]
[/codesh-group]

### random_string

Will generate a random string of the required number of characters.  Particularly useful in creating a unique id or key.

[codesh-group]
[codesh=twig title="Twig"]
{{ random_string(10) }}
[/codesh]
[codesh=txt title="Output"]
aBc123XyZ9
[/codesh]
[/codesh-group]

### unique_id

Generates a random string with configurable length, prefix and suffix. Unlike the built-in PHP `uniqid()` function and the `random_string` utils, this string will be generated truly unique and non-conflicting.

[codesh-group]
[codesh=twig title="Twig"]
{{ unique_id(9) }}
{{ unique_id(11, { prefix: 'user_' }) }}
{{ unique_id(13, { suffix: '.json' }) }}
[/codesh]
[codesh=txt title="Output"]
a1b2c3d4e
user_a1b2c3d4e5f
a1b2c3d4e5f6g.json
[/codesh]
[/codesh-group]

### range

Generates an array containing a range of elements, optionally stepped

[codesh-group]
[codesh=twig title="Twig"]
{{ range(25, 300, 50) }}
[/codesh]
[codesh=txt title="Output"]
[25, 75, 125, 175, 225, 275]
[/codesh]
[/codesh-group]

### read_file

Simple function to read a file based on a filepath and output it.

[codesh-group]
[codesh=twig title="Twig"]
{{ read_file('theme://README.md')|markdown }}
[/codesh]
[codesh=html title="Output"]
<h1>My Theme</h1>
<p>This <strong>theme</strong> for Grav...</p>
[/codesh]
[/codesh-group]

For security, `read_file` only reads files that pass three gates, all configurable under `security.read_file` in `system/config/security.yaml`:

- **`allowed_streams`** — the stream schemes it will resolve. Defaults to `theme`, `themes`, `page` and `user-data`. A path on any other stream (such as `plugins://` or `user://`) returns `false` until you add that stream here.
- **`allowed_extensions`** — the file extensions it will read. Defaults to text and content formats only: `md`, `markdown`, `txt`, `html`, `htm`, `css`, `json`, `csv`, `xml` and `svg`.
- **`max_size`** — the maximum file size in bytes (default `1048576`, i.e. 1 MB). Larger files return `false` rather than being read into memory. Set to `0` to disable the cap.

> [!NOTE]
> Adding executable or secret formats (such as `php`, `yaml`, `env` or `htaccess`) to `allowed_extensions` is discouraged — it turns `read_file` into a way to leak configuration and credentials into rendered output.

### redirect_me

Redirects to a URL of your choosing

[codesh-group]
[codesh=twig title="Twig"]
{% do redirect_me('http://google.com', 304) %}
[/codesh]
[codesh=txt title="Output"]
(redirects to http://google.com with 304 status)
[/codesh]
[/codesh-group]

### regex_filter

Performs a `preg_grep` on an array with a regex pattern

[codesh-group]
[codesh=twig title="Twig"]
{{ regex_filter(['pasta', 'fish', 'steak', 'potatoes'], "/p.*/") }}
[/codesh]
[codesh=txt title="Output"]
['pasta', 'potatoes']
[/codesh]
[/codesh-group]

### regex_replace

A helpful wrapper for the PHP [preg_replace()](https://php.net/manual/en/function.preg-replace.php) method, you can perform complex Regex replacements on text via this filter:

[codesh-group]
[codesh=twig title="Twig"]
{{ regex_replace('The quick brown fox jumps over the lazy dog.', ['/quick/','/brown/','/fox/','/dog/'], ['slow','black','bear','turtle']) }}
[/codesh]
[codesh=txt title="Output"]
The slow black bear jumps over the lazy turtle.
[/codesh]
[/codesh-group]

### regex_match

A helpful wrapper for the PHP [preg_match()](https://php.net/manual/en/function.preg-match.php) method, you can perform complex regular expression match on text via this filter:

[codesh-group]
[codesh=twig title="Twig"]
{{ regex_match('http://www.php.net/index.html', '@^(?:http://)?([^/]+)@i') }}
[/codesh]
[codesh=txt title="Output"]
[
    0 => "http://www.php.net"
    1 => "www.php.net"
]
[/codesh]
[/codesh-group]

### regex_split

A helpful wrapper for the PHP [preg_split()](https://php.net/manual/en/function.preg-split.php) method. Split string by a regular expression on text via this filter:

[codesh-group]
[codesh=twig title="Twig"]
{{ regex_split('hypertext language, programming', '/\\s*,\\s*/u') }}
[/codesh]
[codesh=txt title="Output"]
['hypertext language', 'programming']
[/codesh]
[/codesh-group]

### repeat

Will repeat whatever is passed in a certain amount of times.

[codesh-group]
[codesh=twig title="Twig"]
{{ repeat('blah ', 10) }}
[/codesh]
[codesh=txt title="Output"]
blah blah blah blah blah blah blah blah blah blah
[/codesh]
[/codesh-group]

### string

Returns a string from a value. If the value is array, return it json encoded

[codesh-group]
[codesh=twig title="Twig"]
{{ string(23) }}
{{ string(['test' => 'x']) }}
[/codesh]
[codesh=txt title="Output"]
"23"
{"test":"x"}
[/codesh]
[/codesh-group]

### svg_image

Returns the content of an SVG image and adds extra classes as needed. Provides the benefits of inline svg without having to paste the code directly on the page. Useful for reusable images such as social media icons.

```
{{ svg_image(path, classes, strip_style) }}
```

strip_style = remove the svg inline styling - useful for styling with css classes.

[codesh-group]
[codesh=twig title="Twig"]
{{ svg_image('theme://images/something.svg', 'my-class-here mb-10', true) }}
[/codesh]
[codesh=html title="Output"]
<svg class="my-class-here mb-10" viewBox="0 0 24 24">...</svg>
[/codesh]
[/codesh-group]

### theme_var

`theme_var($variable, $default = null, $page = null)`

Get a theme variable from the page's header, or, if not found, from its parent(s), the theme's config file, or the default value if provided:

[codesh-group]
[codesh=twig title="Twig"]
{{ theme_var('grid-size') }}
[/codesh]
[codesh=txt title="Output"]
1200
[/codesh]
[/codesh-group]

This will first try `page.header.grid-size`, if not set, it will traverse the tree of parents. If still not found, it will try `theme.grid-size` from the theme's configuration file.

It can optionally take a default value as fallback:

[codesh-group]
[codesh=twig title="Twig"]
{{ theme_var('grid-size', 1024) }}
[/codesh]
[codesh=txt title="Output"]
1024 (if not found elsewhere)
[/codesh]
[/codesh-group]

### t

Translate a string, as the [`|t`](../filters#t) filter.

[codesh-group]
[codesh=twig title="Twig"]
{{ t('SITE_NAME') }}
[/codesh]
[codesh=txt title="Output"]
Site Name
[/codesh]
[/codesh-group]

### ta

Functions the same way the [`|ta`](../filters#ta) filter does.

### tl

Translates a string in a specific language. For more details check out the [multi-language documentation](../../content/multi-language#complex-translations).

[codesh-group]
[codesh=twig title="Twig"]
{{ tl('SIMPLE_TEXT', ['fr']) }}
[/codesh]
[codesh=txt title="Output"]
Texte simple
[/codesh]
[/codesh-group]

### url

Will create a URL and convert any PHP URL streams into a valid HTML resources. A default value can be passed in in case the URL cannot be resolved.

[codesh-group]
[codesh=twig title="Twig"]
{{ url('theme://images/logo.png')|default('http://www.placehold.it/150x100/f4f4f4') }}
[/codesh]
[codesh=txt title="Output"]
/user/themes/mytheme/images/logo.png
[/codesh]
[/codesh-group]

### vardump

The `vardump()` function outputs the current variable to the screen (rather than in the debugger as with `dump()`)

[codesh-group]
[codesh=twig title="Twig"]
{% set my_array = {foo: 'bar', baz: 'qux'} %}
{{ vardump(my_array) }}
[/codesh]
[codesh=txt title="Output"]
[
  "foo" => "bar"
  "baz" => "qux"
]
[/codesh]
[/codesh-group]

### xss

Allow a manual check of a string for XSS vulnerabilities

[codesh-group]
[codesh=twig title="Twig"]
{{ xss('this string contains a <script>alert("hello");</script> XSS vulnerability') }}
[/codesh]
[codesh=txt title="Output"]
this string contains a  XSS vulnerability
[/codesh]
[/codesh-group]

The `xss()` function removes the malicious script tag from the string.
