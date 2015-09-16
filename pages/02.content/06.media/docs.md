---
title: Media
markdown:
  extra: true
gravui:
    enabled: true
    tabs: true
taxonomy:
    category: docs
process:
	twig: true
---

When creating content in **Grav**, you often need to display different types of media like **images**, **videos**, and various other **files**. These files are automatically found and processed by Grav and are made available to use by any page.  This is particularly handy because you can then use the built-in functionality of the page to leverage thumbnails, access metadata and modify the media dynamically (e.g. resizing images, setting the display size for videos, etc.) as you need them.

Grav uses a **smart-caching** system that automatically creates in-cache copies of the dynamically generated media when necessary. This way all subsequent requests can use the cached version instead of having to generate the media all over again.

## Supported Media Files

The following media file types are supported natively by Grav. Additional support for media files and streaming embeds may be added via plugins.

|     Media Type     |          File Type          |
| :----------------- | :-------------------------- |
| Image              | jpg, jpeg, png              |
| Animated image     | gif                         |
| Vectorized image   | svg                         |
| Video              | mp4, mov, m4v, swf          |
| Data / Information | txt, doc, html, pdf, zip, gz |

## Display modes

Grav provides a few different display modes for every kind of media object.

|    Mode   |                                   Explanation                                   |
| :-------- | :------------------------------------------------------------------------------ |
| source    | Visual representation of the media itself, i.e. the actual image, video or file |
| text      | Textual representation of the media                                             |
| thumbnail | The thumbnail image for this media object                                       |

>>>> **Data / Information** type media do not support `source` mode, they will default to `text` mode if another mode is not explicitly chosen.

## Thumbnail Location

There are three locations Grav will look for your thumbnail.

1. In the same folder as your media file: `[media-name].[media-extension].thumb.[thumb-extension]` where `media-name` and `media-extension` are respectively the name and extension of the original media file and `thumb-extension` is any extension that is supported by the `image` media type. Examples are `my_video.mp4.thumb.jpg` and `my-image.jpg.thumb.png`
**For images only!** The image itself will be used as thumbnail.
2. Your user folder: `user/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. Examples are `thumb-mp4.png` and `thumb-jpg.jpg`
3. The system folder: `system/images/media/thumb-[media-extension].png` where `media-extension` is the extension of the original media file. **The thumbnails in the system folders are pre-provided by Grav.**

>>> You can also manually select the desired thumbnail with the actions explained below.

## Links and Lightboxes

The display modes above can also be used in combination with links and lightboxes, which are explained in more detail later. Important to note however is:

>>>> Grav does not provide lightbox-functionality out of the box, you need a plugin for this. You can use the [FeatherLight Grav plugin](https://github.com/getgrav/grav-plugin-featherlight) to achieve this.

When you use Grav's media functionality to render a lightbox, all Grav does is output an **anchor** tag that has some attributes for the lightbox plugin to read. If you are interested in using a lightbox library that is not in our plugin repository or you want to create your own plugin, you can use the table below as a reference.

|  Attribute  |                                                 Explanation                                                  |
| :---------- | :----------------------------------------------------------------------------------------------------------- |
| rel         | A simple indicator that this is not a regular link, but a lightbox link. The value will always be `lightbox` |
| href        | A URL to the media object itself                                                                             |
| data-width  | The width the user requested this lightbox to be                                                             |
| data-height | The height the user requested this lightbox to be                                                            |
| data-srcset | In case of image media, this contains the `srcset` string. ([more info](../media#responsive-images))                 |

## Actions

Grav employs a **builder-pattern** when handling media, so you can perform **multiple actions** on a particular medium. Some actions are available for every kind of medium while others are specific to the medium.

### General

These actions are available for all media types.

##### url()

>>> This method is only intended to be used in **Twig** templates, hence the lack of Markdown syntax.

This returns **raw url path** to the media.

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
{{ gravui_tabs({'Twig':tab2, 'HTML Code':tab3}) }}


##### html([title][, alt][, classes])

>>> In Markdown this method is implicitly called when using the `![]` syntax.

The `html` action will output a valid HTML tag for the media based on the current display mode.

{% set tab1 %}
```
![Some ALT text](sample-image.jpg "My title") {.myclass}
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].html('My title', 'Some ALT text', 'myclass') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
{{ page.media['sample-image.jpg'].html('My title', 'some ALT text', 'myclass') }}
{% endset %}
{% set tab4 %}
```
{{ page.media['sample-image.jpg'].html('My title', 'some ALT text', 'myclass')|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

>>> To use classes in Markdown, you need to enable Markdown Extra.

<div></div>

##### display(mode)

Use this action to switch between the various display modes that Grav provides. Once you switch display mode, all previous actions will be reset. The exceptions to this rule are the `lightbox` and `link` actions and any actions that have been used before those two.

For example, the thumbnail that results from calling `page.media['sample-image.jpg'].sepia().display('thumbnail').html()` will not have the `sepia()` action applied, but `page.media['sample-image.jpg'].display('thumbnail').sepia().html()` will.

>>>>> Once you switch to thumbnail mode, you will be manipulating an image. This means that even if your current media is a video, you can use all the image-type actions on the thumbnail.

##### link()

Turn your media object into a link. All actions that you call before `link()` will be applied to the target of the link, while any actions called after will apply to what's displayed on your page.

>>> After calling `link()`, Grav will automatically switch the display mode to **thumbnail**.

The following example will display a textual link (`display('text')`) to a sepia version of the `sample-image.jpg` file:

{% set tab1 %}
```
![Image link](sample-image.jpg?sepia&link&display=text)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].sepia().link().display('text').html('Image link') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
{{ page.media['sample-image.jpg'].sepia().link().display('text').html('Image link') }}
{% endset %}
{% set tab4 %}
```
{{ page.media['sample-image.jpg'].sepia().link().display('text').html('Image link')|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

##### lightbox([width, height])

The lightbox action is essentially the same as the link action but with a few extras. Like explained above, the lightbox action will not do anything more than create a link with some extra attributes. It differs from the link action in that it adds a `rel="lightbox"` attribute and accepts a `width` and `height` attribute.

If possible (currently only in the case of images), Grav will resize your media to the requested width and height. Otherwise it will simply add a `data-width` and `data-height` attribute to the link.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?lightbox=600,400&resize=100,100)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].lightbox(600,400).resize(100,100).html('Sample Image') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?lightbox=600,400&resize=100,100)
{% endset %}
{% set tab4 %}
```
{{ page.media['sample-image.jpg'].lightbox(600,400).resize(100,100).html('Sample Image')|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

##### Thumbnail

Manually choose the thumbnail Grav should use. You can choose between `page` and `default` for any type of media as well as `media` for image media if you want to use the media object itself as your thumbnail.

{% set tab1 %}
```
![Sample Image](sample-image.jpg?thumbnail=default&display=thumbnail)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].thumbnail('default').display('thumbnail').html('Sample Image') }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Sample Image](sample-image.jpg?thumbnail=default&display=thumbnail)
{% endset %}
{% set tab4 %}
```
{{ page.media['sample-image.jpg'].thumbnail('default').display('thumbnail').html('Sample Image')|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

### Image actions

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

>>> The primary difference between **cropResize** and **cropZoom** is that in cropResize, the image is resized maintaining aspect ratio so that the entire image is shown, and any extra space is considered background.

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

### Animated and vectorized image and video actions

##### resize(width, height)

Because PHP cannot handle dynamically resizing these types of media, the resize action will only make sure that a `width` and `height` or `data-width` and `data-height` attribute are set on your `<img>`/`<video>` or `<a>` tag respectively. This means your image or video will be displayed in the requested size, but the actual image or video file will not be converted in any way.

{% set tab1 %}
```
![](sample-trailer.mov?resize=400,200)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-trailer.mov'].resize(400, 200).html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
```
{{ page.media['sample-trailer.mov'].resize(400, 200).html()|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}

Some examples of this:

{% set tab1 %}
```
![](sample-vector.svg?resize=300,300)
```
![](sample-vector.svg?resize=300,300)
{% endset %}
{% set tab2 %}
```
![](sample-animated.gif?resize=300,300)
```
![](sample-animated.gif?resize=300,300)
{% endset %}
{% set tab3 %}
```
![](sample-trailer.mov?resize=400,200)
```
![](sample-trailer.mov?resize=400,200)
{% endset %}
{{ gravui_tabs({'Vector image':tab1, 'Animated image':tab2, 'Video':tab3}) }}



#### File actions

Grav does not provide any custom actions on files at this point in time and there are no plans to add any. Should you think of something, please contact us.

### Combinations

As you can see: Grav provides some powerful image manipulation functionality that makes it really easy to work with images!  The real power comes when you combine multiple effects and produce some very sophisticated dynamic image manipulations.  For example, this is totally valid:

{% set tab1 %}
```
![Sample Image](sample-image.jpg?negate&cropZoom=500,500&lightbox&cropZoom=600,200&contrast=-100&sharp&sepia)
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
![Sample Image](sample-image.jpg?negate&cropZoom=500,500&lightbox&cropZoom=600,200&contrast=-10&sharp&sepia)
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3}) }}

### Responsive images

#### Higher density displays

Grav has built-in support for responsive images for higher density displays (e.g. **Retina** screens). Grav accomplishes this by implementing `srcset` from the [Picture element HTML proposal](https://html.spec.whatwg.org/multipage/embedded-content.html#the-picture-element). A good article to read if you want to understand this better is [this blog post by Eric Portis](http://ericportis.com/posts/2014/srcset-sizes/).

>>> Grav sets the `sizes` argument mentioned in the posts above to full viewport width by default. Use the `sizes` action showcased below to choose yourself.

To start using responsive images, all you need to to is add higher density images to your pages by adding a suffix to the file name. If you only provide higher density images, Grav will automatically generate lower quality versions for you. Naming works as follows: `[image-name]@[density-ratio]x.[image-extension]`, so for example adding `sample-image@3x.jpg` to your page will result in Grav creating a `2x` and a `1x` (regular size) version by default.

>>>>> These files generated by Grav will be stored in the `images/` cache folder, not your page folder.

{% set tab1 %}
```
![Retina Image](retina.jpg?sizes=80vw)
```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['retina.jpg'].sizes('80vw').html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![Retina Image](retina.jpg?sizes=80vw)
{% endset %}
{% set tab4 %}
```
{{ page.media['retina.jpg'].sizes('80vw').html()|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

>>>> Depending on your display and your browser's implementation and support for `srcset`, you might never see a difference. We included the HTML markup in the fourth tab so you can see what's happening behind the screens.

#### Sizes with media queries

Grav has also support for media queries inside the sizes attribute, allowing you to use different widths on devices. In contrast to the first method, you don't have to create multiple images, they will get created automatically. The fallback image is the current image, so browser without support for srcset, will display the original image.

>>> For the moment it does not work inside markdown, only in your ```twig``` files.

{% set tab1 %}
```
![](sample-image.jpg?derivatives=320,1440,100&sizes=%28max-width%3A26em%29+100vw%2C+50vw)

```
{% endset %}
{% set tab2 %}
{% verbatim %}
```
{{ page.media['sample-image.jpg'].derivatives(320, 1440, 100).sizes('(max-width:26em) 100vw, 50vw').html() }}
```
{% endverbatim %}
{% endset %}
{% set tab3 %}
![](sample-image.jpg?derivatives=320,1440,100&sizes=%28max-width%3A26em%29+100vw%2C+50vw)
{% endset %}
{% set tab4 %}
```
{{ page.media['sample-image.jpg'].derivatives(320, 1440, 100).sizes('(max-width:26em) 100vw, 50vw').html()|e }}
```
{% endset %}
{{ gravui_tabs({'Markdown':tab1, 'Twig':tab2, 'Result':tab3, 'HTML Code':tab4}) }}

>>>> Depending on your display and your browser's implementation and support for `srcset`, you might never see a difference. We included the HTML markup in the fourth tab so you can see what's happening behind the screens.


### Metafiles

Every medium that you reference in Grav, e.g. `image1.jpg`, `sample-trailer.mov`, or even `archive.zip` has the ability to have variables set or even overridden via a **metafile**.  These files take the format of `<filename>.meta.yaml`.  For example, for an image with the filename `image1.jpg` you could create a metafile called `image1.jpg.meta.yaml`.

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

Let's say you wanted to just pull the `alt_text` value listed for the image file `sample-image.jpg`. You would then create a file called `sample-image.jpg.meta.yaml` and place it in the folder with the referenced image file. Then, insert the data used in the example above and save that YAML file. In the markdown file for the page, you can display this data by using the following line:

{% verbatim %}
```ruby
{{ page.media['sample-image.jpg'].meta.alt_text }}
```
{% endverbatim %}

This will pull up the example phrase `My Alt Text` instead of the image. This is just a basic example. You can use this method for a number of things, including creating a gallery with multiple unique data points you want to have referenced for each image. Your images, in essence, have a set of data unique to them that can be easily referenced and pulled as needed.
