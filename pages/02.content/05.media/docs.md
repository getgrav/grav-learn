---
title: Media
markdown_extra: true
gravui:
    enabled: true
    tabs: true
taxonomy:
    category: docs
process:
	twig: true
---

When creating content in **Grav**, you often need to display **image**, **video**, and **file** document types. These files are automatically found and processed by Grav and are made available to use by any page.  This is particularly handy because you can then use the built-in functionality of of the page to create thumbnails, and resize images dynamically as you need them.

Grav uses a **smart-caching** system to automatically create any required image the first time it is requested, then use this image for each subsequent request.

{% verbatim %}
>>>> The media examples below use markdown syntax for displaying images `![Sample Image](sample-image.jpg?cropZoom=300,200)`.
However, you can also use these same functions in your **Twig** templates by using the PHP syntax.  For example: `{{ page.media['sample-image.jpg'].cropZoom(300, 200).html() }}`
{% endverbatim %}

**Supported Media Files**

The following media file types are supported natively by Grav. Additional support for media files and streaming embeds may be added via plugins.

| Media Type         | File Type                   |
| :----------        | :----------                 |
| Image              | jpg, jpeg, png, gif         |
| Video              | mp4, mov, m4v, swf          |
| Data / Information | txt, doc,html, pdf, zip, gz |

## Actions

Grav employs a **builder-pattern** when handling media, so you can perform **multiple actions** on a particular medium.  Grav currently has the following actions built-in:

##### resize(width, height, [background])

Resizing does exactly what you would expect it to do.  `resize` lets you create a new image based on the `width` and the `height`.  The aspect ratio is maintained and the new image will contain blank areas in the color of the **optional** background color provided as a `hex value`, e.g. `0xffffff`. The background parameter is optional, and if not provided will default to **transparent** if the image is a PNG, or **white** if it is a JPEG.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?resize=400,200)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].resize(400, 200).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?resize=400,200)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### forceResize(width, height)

Resizes the image to the `width` and `height` as provided.  `forceResize` will not respect original aspect-ratio and will stretch the image as needed to fit the new image size.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?forceResize=200,300)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].forceResize(200, 300).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?forceResize=200,300)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### cropResize(width, height)

`cropResize` resizes an image to a smaller or larger size based on the `width` and the `height`.  The aspect ratio is maintained and the new image will be resized to fit in the bounding-box as described by the `width` and `height` provided. In other words, any background area you would see in a regular `resize` is cropped.

For example, if you have an image that is `640` x `480` and you perform a `cropResize(100, 100)` action upon it, you will end up with an image that is `100` x `75`.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropResize=300,300)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropResize(300, 300).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropResize=300,300)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### crop(x, y, width, height)

`crop` will not resize the image at all, it will merely crop the original image so that only the portion of the bounding box as described by the `width` and the `height` originating from the `x` and `y` location is used to create the new image.

For example, an image that is `640` x `480` that has the `crop(0, 0, 400, 100)` action upon it, will simply get the width and height both cropped so that the resulting image is an image with a width of `400` and a height of `100` originated from the top-left corner as described by `0, 0`.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?crop=100,100,300,200)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].crop(100,100,300,200).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?crop=100,100,300,200)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### cropZoom(width, height)

Similar to regular `cropResize`, `cropZoom` also takes a `width` and a `height` but will **resize and crop** the image to ensure the resulting image is the exact size you requested.  The aspect ratio is maintained but parts of the image may be cropped, however the resulting image is centered.

>>> The primary difference between **resizeCrop** and **cropZoom** is that in resizeCrop, the image is resized maintaining aspect ratio so that the entire image is shown, and any extra space is considered background.

With **cropZoom**, the image is resized so that there is no background visible, and the extra image area of the image outside of the new image size is cropped.

For example if you have an image that is `640` x `480` and you perform a `cropZoom(400, 100)` action, the resulting image will be resized to `400` x `300` and then the height is cropped resulting in a `400` x `100` image.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=600,200)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(600,200).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=600,200)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### quality(value)

Dynamically allows the setting of a **compression percentage** `value` for the image between `0` and `100`. A lower number means less quality, where `100` means maximum quality.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&quality=95)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).quality(95).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&quality=95)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### negate()

Applies a **negative filter** to the image where colors are inverted.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&negate)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).negate.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&negate)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### brightness(value)

Applies a **brightness filter** to the image with a `value` from `-255` to `+255`. Larger negative numbers will make the image darker, while larger positive numbers will make the image brighter.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&brightness=-100)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).brightness(-100).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&brightness=-100)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### contrast(value)

This applies a **contrast filter** to the image with a `value` from `-100` to `+100`. Larger negative numbers will increase the contrast, while larger positive numbers will reduce the contrast.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&contrast=-50)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).contrast(-50).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&contrast=-50)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### grayscale()

This processes the image with a **grayscale filter**.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&grayscale)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).grayscale.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&grayscale)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### emboss()

This processes the image with an **embossing filter**.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&emboss)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).emboss.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&emboss)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### smooth(value)

This applies a **smoothing filter** to the image based on smooth `value` setting from `-10` to `10`.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&smooth=5)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).smooth(5).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&smooth=5)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### sharp()

This applies a **sharpening filter** on the image.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&sharp)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).sharp.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&sharp)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### edge()

This applies an **edge finding filter** on the image.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&edge)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).edge.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&edge)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### colorize(red, green, blue)

You can colorize the image based on adjusting the `red`, `green`, and `blue` values for the image from `-255` to `+255` for each color.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&colorize=100,-100,40)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).colorize(100,-100,40).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&colorize=100,-100,40)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### sepia()

This applies a **sepia filter** on the image to produce a vintage look.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=300,200&sepia)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(300,200).sepia.html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=300,200&sepia)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


##### url()

>>> This method is only intended to be used in **Twig** templates, hence the lack of Markdown syntax.

This returns **raw url path** to the image.

{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].url }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
```
{{ page.media['sample-image.jpg'].url|e }}
```
{% endset %}
{{ gravui_tabs({'Twig':tab2, 'Result':tab3}) }}


##### html([alt][, classes])

>>> This method is only intended to be used in **Twig** templates, hence the lack of Markdown syntax.

The `html` action will output a valid HTML tag for the image. This is particularly helpful when you want to perform some action on an image, and then get output the HTML tag to this URL of this *automagically* generated image.

{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(400,300).html('some ALT text', 'myclass') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
```
{{ page.media['sample-image.jpg'].cropZoom(400,300).html('some ALT text', 'myclass')|e }}
```
{% endset %}
{{ gravui_tabs({'Twig':tab2, 'Result':tab3}) }}


>>> The URL contains an automatically generated and cached image file that Grav created for the newly generated image.

##### lightbox([width, height])

Similar to the `html` action, the **lightbox** outputs the required HTML tag information to display the current image (resized, cropped, etc) as a thumbnail with a link to resized image in a lightbox. The `width` and `height` dictate the size of the lightbox when activated.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?lightbox=1024,cropResize=200,200)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].lightbox(1024,768).cropResize(200,200).html('Sample Image') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?lightbox=1024,768&cropResize=200,200)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}

This is a **Twig** output that will take the `image1.jpg` file associated with the page, and output a `lightbox` tag that will link to an image that is `resize`'d to `1024` x `768` from a thumbnail image that is `cropResize`'d  to `200` x `200`.

>>>> NOTE: A lightbox-compatible plugin is **required** in order to have a functioning lightbox on your Grav site.  You can use the [FeatherLight Grav plugin](https://github.com/getgrav/grav-plugin-featherlight) to achieve this.

### Combinations

As you can see: Grav provides some powerful image manipulation functionality that makes it really easy to work with images!  The real power comes when you combine multiple effects and produce some very sophisticated dynamic image manipulations.  For example, this is totally valid:

{% set tab1 %}
```
![Sample Image](sample-image.jpg?cropZoom=600,200&contrast=-100&sharp&sepia&lightbox)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].cropZoom(600,200).contrast(-100).sharp.sepia.lightbox }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?cropZoom=600,200&contrast=-100&sharp&sepia&lightbox)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}


### Images

JPEG, PNG, and GIF image formats are supported with the following file extensions: `jpg`, `jpeg`, `png`, `gif`.

Thumbnails are automatically created from the image provided.

### Videos

>>>> NOTE: **Video** media are work-in-progress. They are not fully implemented currently.

>>> This method is only intended to be used in **Twig** templates, hence the Twig syntax.

Video files with the following file extensions: `mp4`, `mov`, `m4v`, `swf` are also supported in Grav. Because PHP cannot handle dynamically resizing videos, you will have to create your videos in the size and format you wish to display on your site.

All the regular actions are available for videos but interact with the thumbnail of the video only.  The **tag** action for videos is slightly different from images as you have to also provide an `x` width and a `y` height.


{% verbatim %}
```
{{ page.media['sample-trailer.mov'].lightbox(852,480).cropResize(200,100).html() }}
```
{% endverbatim %}

{{ page.media['sample-trailer.mov'].lightbox(852,480).cropResize(200,100).html() }}

### Files

>>>> NOTE: **File** media are work-in-progress. They are not fully implemented currently.

>>> This method is only intended to be used in **Twig** templates, hence the Twig syntax.

Grav supports a selection of other assorted document file types including: `txt`, `doc`,` html`, `pdf`, `zip`, `gz`.

These are handled in a similar fashion to video files so thumbnails need to be provided if you don't want to use the default images for thumbnails.

The **lightbox** action is not supported for files, and the **tag** action will **link** to download the file, but has a boolean set to `true` to show the image thumbnail, or `false` to show just the plain text filename with a class that indicates the file-type.

{% verbatim %}
```
{{ page.media['archive.zip'].html() }}
```
{% endverbatim %}

### Metafiles

Every medium that you reference in Grav, e.g. `image1.jpg`, `sample-trailer.mov`, or even `archive.zip` has the ability to have variables set or even overridden via a **metafile**.  These files take the format of `<filename>.meta.yaml`.  For example, for a image with the filename `image1.jpg` you could create a metafile called `image1.jpg.meta.yaml`.

You can add just about any setting or piece of metadata you would like using this method.

The contents of this file should be in YAML syntax, an example could be:

```ruby
images:
	filters:
		default:
			- [cropResize, 300, 300]
			- sharp
alt_text: My Alt Text
```

If you are using this method to add file-specific styling or meta tags for a single file, you will want to put the YAML file in the same folder as the referenced file. This will ensure that the file is pulled along with the YAML data. It's a handy way to even set file-specific metadata as you are unable to do so from the page itself.

Let's say you wanted to just pull the alt_text value listed for the image file `sample-image.jpg`. You would then create a file called `sample-image.jpg.meta.yaml` and place it in the folder with the referenced image file. Then, insert the data used in the example above and save that YAML file. In the markdown file for the page, you can display this data by using the following line:

{% verbatim %}
```ruby
{{ page.media['sample-image.jpg'].alt_text }}
```
{% endverbatim %}

This will pull up the example phrase `My Alt Text` instead of the image. This is just a basic example. You can use this method for a number of things, including creating a gallery with multiple unique data points you want to have referenced for each image. Your images, in essence, have a set of data unique to them that can be easily referenced and pulled as needed.

The other **metafile** that is supported is the overriding of the thumbnail for a particular medium.  This is particularly important for **videos** and **files** that natively don't have an associated image that can be used and manipulated. Simply create a `<filename>.meta.jpg|png|gif` and it will be used for any media manipulation requiring an image.

>>>> NOTE: If you do not provide a **metafile** image for **videos** and **files**, a default image will be used.


