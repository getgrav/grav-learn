---
title: Media
taxonomy:
    category: docs
process:
	twig: true
---

When creating content in **Grav**, you often need to display **images**, **videos**, and **file** document types. These files are automatically found and processed by Grav and are made available to use by any page.  This is particularly handy because you can then use the built-in functionality of of the page to create thumbnails, and resize images dynamically as you need them.  

Grav uses a **smart-caching** system to automatically create any required image the first time it's requested, then use this image for each subsequent request.

>>>> The media examples below use Twig syntax (that's the stuff with the curly braces: {% verbatim %}`{{ media[sample-image.jpg] }}`{% endverbatim %}) that needs to be enabled on a per-page basis. You can either **a)** enable Twig on the page with `process: twig: true` in the page header, or **b)** set `pages: process: twig: true` in your system.yaml to change it site-wide.

## Actions

Grav employs a **builder-pattern** when handling media, so you can perform **multiple actions** on a particular medium.  Grav currently has the following actions built-in:

### resize(w, h, background='0xffffff')

Resizing does exactly what you would expect it to do.  `resize` lets you create a new image based on the `w` width and the `h` height.  The aspect ratio is maintained and the new image will be contain blank areas in the color of the background color provided as a `hex value`. The background parameter is optional, and if not provided with default to **transparent** if the image is a PNG, or **white** if a JPEG.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].resize(200, 200, '75879a').html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].resize(200, 200, '75879a').html() }}

### forceResize(w, h)

Resizes the image to the `w` width and `h` height as provided.  `forceResize` will not respect original aspect-ratio and will stretch the image as needed to fit the new image size.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].forceResize(200, 200).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].forceResize(200, 200).html() }}

### cropResize(w, h)

`cropResize` resizes an image to a smaller or larger size based on the `w` width and the `h` height.  The aspect ratio is maintained and the new image will be resized to fit in the bounding-box as described by the `w` and `h` provided. In other words, any background area you would see in a regular `resize` is cropped.

For example if you have an image that is `640` x `480` and you perform a `cropResize(100, 100)` action upon it, you will end up with an image that is `100` x `75`.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(200, 200).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(200, 200).html() }}

### crop(x, y, w, h)

`crop` will not resize the image at all, it will merely crop the original image so that only the portion of the bounding box as described by the `w` width and the `h` height originating from the `x` and `y` location is used to create the new image.

For example an image that is `640` x `480` that as the `crop(0, 0, 400, 100)` action upon it, will simply get the width and height both cropped so that the resulting image is an image with a width of `400` and a height of `100` originated from the top-left corner as described by `0, 0`.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].crop(100, 100, 300, 200).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].crop(100, 100, 300, 200).html() }}


### cropZoom(x, y)

Similar to regular `cropResize`, `cropZoom` also takes an `x` width and a `y` height but will **resize and crop** the image to ensure the resulting image is the exact size you requested.  The aspect ratio is maintained but parts of the image may be cropped, however the resulting image is centered.

>>> The primary difference between resizeCrop and cropZoom is that in resizeCrop, the image is resized maintaining aspect-ratio so that the entire image is shown, any extra space is considered background.  With cropZoom, the image is resized so that the there is no background visible, and the extra image area of the image outside of the new image size is cropped.

For example if you have an image that is `640` x `480` and you perform a `cropZoom(400, 100)` action, the resulting image will be resized to `400` x `300` and then the height is cropped resulting in a `400` x `100` image.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropZoom(400, 100).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropZoom(400, 100).html() }}

### negate()

Applies a **negative filter** to the image where colors are inverted.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).negate.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).negate.html() }}

### brighness(b)

Applies a **brightness filter** to the image (from -255 to +255). Larger negative numbers will make the image darker, while larger positive numbers makes the image brighter.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).brightness(-100).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).brightness(-100).html() }}

### contrast(c)

Applies a **contrast filter** to the image (from -100 to +100). Larger negative numbers will increase the contrast, while larger positive numbers will reduce the contrast.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).contrast(-50).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).contrast(-50).html() }}

### grayscale()

Processes the image with a **greyscale filter**.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).grayscale.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).grayscale.html() }}

### emboss()

Processes the image with an **embossing filter**.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).emboss.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).emboss.html() }}

### smooth(p)

Applies a **smoothing filter** to the image based on smooth setting (from -10 to 10)

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).smooth(5).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).smooth(5).html() }}

### sharp()

Applies a **sharpening filter** on the image.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).sharp.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).sharp.html() }}

### edge()

Applies an **edge finding filter** on the image.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).edge.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).edge.html() }}

### colorize(red, green, blue)

Colorize the image based on adjusting the **red, green, and blue** values for the image (from -255 to +255 for each color).

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).colorize(100, -100, 40).html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).colorize(100, -100, 40).html() }}

### sepia()

Applies a **sepia filter** on the image to produce a vintage look.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropResize(300, 200).sepia.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropResize(300, 200).sepia.html() }}

### url()

Returns **raw url path** to the image.

{% verbatim %}
```bash
{{ media['sample-image.jpg'].url }}
```
{% endverbatim %}

```
{{ media['sample-image.jpg'].url }}
```

### html(alt)

The `html` action will output a valid HTML tag for the image. This is particularly helpful when you want to perform some action on an image, and then get output the HTML tag to this URL of this *automagically* generated image.

An example might be:

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropZoom(400, 300).html('some ALT text') }}
```
{% endverbatim %}

which would output the following HTML:

```
{{ media['sample-image.jpg'].cropZoom(400, 300).html('some ALT text')|e }}
```

{{ media['sample-image.jpg'].cropZoom(400, 300).html('some ALT text') }}

>>> The URL contains an automatically generated and cached image file that Grav created for the newly generated image.

### lightbox(x, y)

Similar to the `html` action, the **lightbox** outputs the required HTML tag information to display the current image (resized, cropped, etc) as a thumbnail with a link to resized image in a lightbox.

A real-world example of using this in your own page content is the following

{% verbatim %}
```bash
{{ media['sample-image.jpg'].lightbox(1024, 768).cropResize(150, 150).html('some ALT text') }}
```
{% endverbatim %}

```
{{ media['sample-image.jpg'].lightbox(1024, 768).cropResize(150, 150).html('some ALT text')|e }}
```

{{ media['sample-image.jpg'].lightbox(1024, 768).cropResize(150, 150).html('some ALT text') }}

This is a **Twig** output that will take the `image1.jpg` file associated with the page, and output a `lightbox` tag that will link to an image that is `resize`'d to `1024` x `768` from a thumbnail image that is `cropResize`'d  to `400` x `300`.

## Combinations

As you can see Grav provides some powerful image manipulation functionality that makes it really easy to work with images!  The real power comes when you combine multiple effects and produce some very sophisticated dynamic image manipulations.  For example, this is totally valid:

{% verbatim %}
```bash
{{ media['sample-image.jpg'].cropZoom(600, 200).contrast(-100).sharp.sepia.html() }}
```
{% endverbatim %}

{{ media['sample-image.jpg'].cropZoom(600, 200).contrast(-100).sharp.sepia.html() }}

## Images

JPEG, PNG, and GIF image formats are supported with the following file extensions: `jpg`, `jpeg`, `png`, `gif`.

Thumbnails are automatically created from the image provided. 

## Videos

>>>> NOTE: **Video** media are work-in-progress. They are not fully implemented currently

Video files with the following file extensions: `mp4`, `mov`, `m4v`, `swf` are also supported in Grav. Because PHP cannot handle dynamically resizing videos, you will have to create your videos in the size and format you wish to display on your site.

All the regular actions are available for videos but interact with the thumbnail of the video only.  The **tag** action for videos is slightly different from images as you have to also provide an `x` width and a `y` height.

{% verbatim %}
```bash
{{ media['sample-trailer.mov'].lightbox(852,480).cropResize(200,100).html() }}
```
{% endverbatim %}

{{ media['sample-trailer.mov'].lightbox(852,480).cropResize(200,100).html() }}

## Files

>>>> NOTE: **File** media are work-in-progress. They are not fully implemented currently

Grav supports a selection of other assorted document file types including: `txt`, `doc`,` html`, `pdf`, `zip`, `gz`.

These are handled in a similar fashion to video files so thumbnails need to be provided if you don't want to use the default images for thumbnails.

The **lightbox** action is not supported for files, and the **tag** action will **link** to download the file, but has a boolean set to `true` to show the image thumbnail, or `false` to show just the plain text filename with a class that indicates the file-type.

{% verbatim %}
```bash
{{ media['archive.zip'].html() }}
```
{% endverbatim %}

## Metafiles

Every medium that you reference in Grav, e.g. `image1.jpg`, `sample-trailer.mov`, or even `archive.zip` has the ability to have variables set or even overridden via a **metafile**.  These files take the format of `<filename>.meta.yaml`.  For example for a image with the filename `image1.jpg` you could create a metafile called `image1.jpg.meta.yaml`.

The contents of this file should be in YAML syntax, an example could be:

```ruby
images:
	filters:
		default:
			- [cropResize, 300, 300]
			- sharp
```

The other **metafile** that is supported is the overriding of the thumbnail for a particular medium.  This is particularly important for **videos** and **files** that natively don't have an associated image that can be used and manipulated. Simply create a `<filename>.meta.jpg|png|gif` and it will be used for any media manipulation requiring an image. 

>>>> NOTE: If you do not provide a **metafile** image for **videos** and **files**, a default image will be used.


