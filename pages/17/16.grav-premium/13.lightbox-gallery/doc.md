---
title: Lightbox Gallery
description: How to use Lightbox Gallery on your site
taxonomy:
    category: docs
---

# Lightbox Gallery

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

The Lightbox Gallery requires the **shortcode-core** plugin as a dependency, even though the shortcode syntax is optional. These are available via GPM, and because the plugin has dependencies you just need to proceed and install the Lightbox Gallery plugin, and confirm when prompted to install the others:

```
$ bin/gpm install lightbox-gallery
```

You can also install the plugin via the **Plugins** section in the admin plugin.

## Configuration

The simplest way to configure the plugin is via the Admin by navigating to **Plugins** then clicking on the **Lightbox Gallery ** plugin entry. The available options are:


#### General Configuration

![General Configuration](general.png?class=image-shadow)

* **Plugin status** → Will enable or disable the entire plugin.

* **Always Active** → When disabled, you can decide when to enable Lightbox Gallery per Page. To enable in a page, set `lightbox: active: true` in the frontmatter.

* **Always Include Assets** → When disabled, you will be responsible for including the CSS and JS files from the twig templates. By default this happens from the plugin class.


#### Appearance & Effects

![Appearance & Effects](appearance-effects.png?class=image-shadow)

* **Selector** → Name of the CSS selector for Lightbox Gallery to search for in the page. It can be comma separated and supports any valid CSS selector. By default this is `[rel="lightbox"], .glightbox`.

* **Skin** → Name of the skin, it will add a class to the lightbox so you can style it with css. By default there is only one skin available named `clean`.

* **Open Effect** → Type of effect when opening Lightbox Gallery. Can be **Zoom** (default), **Fade** or **None**.

* **Close Effect** → Type of effect when closing Lightbox Gallery. Can be **Zoom** (default), **Fade** or **None**.

* **Slide Effect** → Type of effect when sliding between slides. Can be **Slide** (default), **Fade**, **Zoom** or **None**.

* **More Text** → Text to display on mobile for lengthy descriptions.

* **More Length** → Number of characters to display on the description before adding the **More Text** link (only for mobiles). If set to 0 it will display the entire description.


#### Actions

![Actions](actions.png?class=image-shadow)

* **Close Button** → Will show or hide the close button.

* **Touch Navigation** → Will enable or disable the touch navigation (swipe).

* **Touch Follow Axis** → Image follows the axis when dragging on mobile.

* **Keyboard Navigation** → Will enable or disable the keyboard navigation.

* **Close with Outside Click** → Closes Lightbox Gallery when clicking outside of an active slide.

* **Start At** → Starts Lightbox Gallery at the defined index. Note that the numbering is zero based (Slide 1 is `0`, Slide 2 is `1`, etc).


#### Styling

![Styling](styling.png?class=image-shadow)

* **Width** → Default width for inline elements and iframes, you can define a specific size for each slide. You can also use any valid unit (90%, 100vw for full width).

* **Height** → Default height for inline elements and iframes, you can define a specific size for each slide. You can also use any valid unit for (90%, 100vh for full height). 
  !!! For inline elements you can set the height to `auto`.

* **Videos Width** → Default width for videos. The width can be in any valid unit (ie, 500px, 90%, 100vw for full width videos).
  ! Videos are responsive which makes having a height setting unnecessary.

* **Description Position** → Global position of the slides' description. You can also specify a different position for each slide. Available positions are **Bottom** (default), **Top**, **Left**, **Right**.

#### Behaviors

![Behaviors](behaviors.png?class=image-shadow)

* **Loop** → Will enable or disable Infinite sliding. Reaching the last slide will make it start over.

* **Zoomable** → Will enable or disable the zoom behavior on images.

* **Draggable** → Will enable or disable the mouse drag-n-drop behavior for moving between slides. Only images and inline content are supported.

* **Drag Tolerance X** → When **Draggable* is enabled, it defines the number of pixels the user has to drag before moving to the previous or next slide.

* **Drag Tolerance Y** → When **Draggable* is enabled, it defines the number of pixels the user has to drag up or down before the Lightbox Gallery closes.
  ! Set to `0` for disabling the vertical drag behavior.

* **Drag Auto-Snap** → Enable or disable automatically changing slides to previous and next, or close Lightbox Gallery, when **Drag Tolerance X** or **Drag Tolerance Y** have been reached. When disabled, it will wait until the mouse click has been released.

* **Preload** → When enabled it will preload the previous and next slides.

* **Autoplay Videos** → Will enable or disable autoplaying videos when the slide containing them becomes active.

* **Autofocus Videos** → When enabled, the videos will be on focused to allow for the keyboard shortcuts of the player to function.
  !!!! This setting enabled will disable the keyboard shortcuts behavior for the **previous** and **next** arrows. You will still be able to click the arrows to change slide.

## Usage
#### Standard Lightbox Mode

Grav Media handling supports a simple way of [providing a lightbox](https://learn.getgrav.org/16/content/media?target=_blank#lightbox) with a pure markdown solution. This does not provide a lot of options, rather it's just a quick way to show a thumbnail and popup a lightbox on clicking the thumbnail.

``` twig
![Sample Image](blue-superleggera.jpg?lightbox=1024,768&resize=200,200)
```

#### Legacy Lightbox with Shortcode

If you need more powerful flexibility you can make use of the `[raw][lightbox][/raw]` shortcode (**shorcode-core** plugin required). This exposes all the options at runtime and specific to this lightbox instance.
 
Shortcode attributes supported are:
 
* image → target image
* video → target video
* class → classes that will be applied to the lightbox link (already includes .lightbox-gallery)
* gallery → a gallery name
* title → title of the image
* desc → either a textual description or a class reference to an HTML element with the same class
* descPosition → position of description (top, bottom, left, right)
* effect → opening/close effect
* width → thumbnail width
* height → thumbnail height
* zoomable → true or false
* draggable → true or false

[raw]
``` bbcode
[lightbox image="white-vantage-v12.jpg" zoomable="false" draggable="false"]
![White V12 Vantage](white-vantage-v12.jpg?cropZoom=200,200)
[/lightbox]
```
[/raw]

#### New format of lightbox shortcode

While the above approach is the legacy approach by using a markdown link for the thumbnail between the shortcode tags, there's a new approach where you can define the thumbnail with the `thumb=""` attribute, which even supports media processing, and you can put markdown between the shortcode tags for the description that displays when you activate the lightbox.  This is the new and **preferred** approach as it makes using the new `lightbox-gallery` shortcode much easier.

For example: 

[raw]
```bbcode
[lightbox image="white-vantage-v12.jpg" thumb="white-vantage-v12.jpg?cropZoom=200,200"]
### White Vantage

This is a stunning photograph of a white Aston Martin V12 Vantage...
[/lightbox]
```
[/raw]

#### Video Lightbox with Shortcodes

Lightbox Gallery is capable of handling local page video files as well as remote URLs such as YouTube. Here's an example of a custom thumbnail spawning a YouTube video in a lightbox.

[raw]
```bbcode
[lightbox video="https://www.youtube.com/watch?v=4czjS9h4Fpg"]
![Mars Lander](mars-thumb.jpg?cropZoom=330,200)
[/lightbox]
```
[/raw]


#### Gallery Lightbox with Shortcodes

The preferred way to create a gallery is using the new `lightbox-gallery` wrapper shortcode. This simplifies the syntax, automatically handles grouping, allows sharing thumbnail options, and supports inline descriptions naturally.

You can pass `thumb_options` to the wrapper to automatically resize thumbnails for all images in the gallery. You can also apply classes to the wrapper (e.g. for grid layout). Note that if you need to use square brackets in your class names (e.g. Tailwind arbitrary values), you must escape them: `class="... \[&>a>img\]:rounded-md"`.

[raw]
``` bbcode
[lightbox-gallery thumb_options="cropZoom=200,200" class="grid grid-cols-4 gap-4"]
[lightbox image="red-dbs-1.jpg"]
### Aston Martin DBS 1
Morbi ac interdum velit. Ut sed purus in **erat feugiat mollis**. In porta ligula quis vulputate ullamcorper.
[/lightbox]
[lightbox image="red-dbs-2.jpg"]
### Aston Martin DBS 2
Aenean eu condimentum odio. Aliquam ac justo eget libero ullamcorper vehicula.
[/lightbox]
[lightbox image="red-dbs-3.jpg"]
### Aston Martin DBS 3
You can easily add rich descriptions to each item.
[/lightbox]
[/lightbox-gallery]
```
[/raw]

> [!IMPORTANT]
> NOTE: In the `lightbox` shortcodes above, the `thumb=""` attribute is not defined in the example above as it's automatically being created with a combination of the `image=""` attribute and the `thumb-options=""` attribute from the parent `lightbox-gallery`. You can however override this behavior by adding a `thumb=""` attribute to the `lightbox` shortcode.

#### Twig Template
You can use the provided partials/lightbox-gallery.html.twig template in your existing Twig templates. This template can accept the same twig variables as the shortcodes.

> [!NOTE]
> The `[raw][div class="prose"] ... [/div][/raw]` shortcode is to provide automatic CSS styling via Twig's `.prose` class.

#### Including your own assets
If you disable the auto-inclusion of assets (**Always Include Assets**), then you should include the assets via Twig on the pages where you need it with the following command.

``` twig
{% do lightbox_gallery.addAssets() %}
```

#### Displaying a Gallery of thumbnails via Twig

![Gallery View](gallery-view.jpg?classes=shadow)

The Typhoon theme already provides a a **modular** Twig template that provides a clean grid layout for thumbnails.  It makes use of Tailwind CSS classes to provide the styling it needs.  If you are not using Typhoon, or just want to create a nice grid layout in your own theme, you will need to create a Twig template and some styling.  In this example I've created a simple Twig partial: `partials/gallery.html.twig` which includes some basic HTML structure and also sample CSS which you can of course modify as your needs require:

```twig
{% set styling %}
.lightbox-gallery {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.lightbox-gallery .lightbox-gallery__columns {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -10px;
}

.lightbox-gallery .lightbox-gallery__column {
  width: 50%;
  padding: 0 10px;
  margin-bottom: 20px;
}

.lightbox-gallery img {
  display: block;
  border-radius: 5px;
  transition: all .2s ease-in-out;
}

.lightbox-gallery img:hover {
  filter: brightness(60%);
  transform: scale(1.05);
}

@media only screen and (min-width: 600px) {
  .lightbox-gallery .lightbox-gallery__column {
    width: calc(100% / 3);
  }
}

@media only screen and (min-width: 1000px) {
  .lightbox-gallery .lightbox-gallery__column {
    width: 25%;
  }
}

.lightbox-gallery .hidden {
  display: none;
}
{% endset %}

{% do assets.addInlineCss(styling) %}

{% set data = page.header.gallery %}
{% set thumb_width = data.thumb.width|default(600) %}
{% set thumb_height = data.thumb.height|default(450) %}

<div class="lightbox-gallery">
    <div class="lightbox-gallery__columns">
        {% set gallery = md5(page.url) %}
        {% for item in data.items %}
        <div class="lightbox-gallery__column">
            {% set item_image = page.media[item.image] %}
            {% if item.title %}
            {% set title = item.title %}
            {% endif %}
            {% if item.desc %}
            {% set desc = ".desc-" ~ md5(item.desc) %}
            {% endif %}
            {% set content = item_image.cropZoom(thumb_width,thumb_height).html(title, title) %}
            {% set image =  item_image.url %}
            {% include "partials/lightbox.html.twig" %}
        </div>
        {% endfor %}
    </div>
    <div class="hidden">
        {% for item in data.items %}
        {% if item.desc %}
            <div class="glightbox-desc desc-{{ md5(item.desc) }}">
            <p>{{ item.desc|markdown(false) }}</p>
            </div>
        {% endif %}
        {% endfor %}
    </div>
</div>
```

This example expects the gallery to be defined in a custom page header called `gallery:`, and it includes an easy to change thumbnail size, as well as description that will get used in the modal "gallery view".

```yaml
---
title: 'Powerful Gallery'
subtitle: 'Exploring the globe...'
gallery:
    thumb:
        width: 400
        height: 300
    items:
        -
            title: 'Climbing Hilly Peaks'
            image: david-marcu-78A265wPiO4-unsplash.jpg
            desc: 'Etiam pretium elit vitae eros fringilla, vel gravida augue eleifend. Ut convallis, lacus non eleifend maximus, turpis odio mollis enim, ac malesuada quam leo ut augue. Quisque mollis urna ac ex varius, vel faucibus enim lacinia. Aenean a lorem consectetur, pulvinar sem nec, ultrices quam. Ut scelerisque, nibh vitae bibendum tincidunt, urna nisl viverra nulla, in mollis erat purus a mauris'
        -
            title: 'Golden Sand Dunes'
            image: sergey-pesterev-_VqyrvQi6do-unsplash.jpg
            desc: 'Nulla tempus, ex vel commodo ullamcorper, velit leo sodales odio, ut viverra quam odio ut lacus. Maecenas a dolor quis risus aliquam interdum. Duis id consectetur odio, at iaculis lacus. Fusce lacinia maximus tortor, ac lacinia odio rutrum sed. Fusce tempor quis lectus eu consequat. Quisque orci nisl, eleifend eu risus ut, porta pretium ex.'
        -
            title: 'Streets of Tokyo'
            image: sorasak-_UIN-pFfJ7c-unsplash.jpg
            desc: 'Nullam pellentesque justo magna. Nunc a faucibus mauris. Quisque a hendrerit sem, id scelerisque arcu. Aliquam laoreet faucibus elit, at volutpat metus finibus et. Aenean tempor justo nibh, quis dignissim sapien aliquet eu. Vivamus risus neque, convallis ac laoreet sit amet, condimentum id tellus. Quisque porttitor arcu vitae sem sollicitudin efficitur.'
        -
            title: 'A Day of Scuba'
            image: thomas-ashlock-RAjND0B3HDw-unsplash.jpg
            desc: 'Aliquam id convallis ante. Mauris nec purus lacinia, tempus mauris eget, blandit tortor. Ut ut dolor vitae lacus rutrum venenatis sed sed augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas rhoncus commodo. Quisque id erat pharetra, consectetur nisl a, viverra nulla. Nunc quis euismod lorem. Aliquam erat volutpat. Fusce tincidunt mauris sed justo suscipit tempus.'
        -
            title: 'Travels with a VW Bus'
            image: simon-rae-kSJTEv9w5l4-unsplash.jpg
            desc: 'Maecenas maximus ipsum et dui pulvinar, vitae venenatis lectus sagittis. Praesent pellentesque felis in orci rhoncus pellentesque. Pellentesque mollis sed nibh sit amet vehicula. Integer vitae diam eget nisi feugiat rhoncus. Curabitur tristique nisl leo, et rutrum purus elementum et. Ut tincidunt mauris at nibh sagittis hendrerit. Vestibulum ut diam magna.'
        -
            title: 'Waterfall and Pool'
            image: stefan-stefancik-0wMmxNB6Xzc-unsplash.jpg
            desc: 'Pellentesque mattis enim non pharetra semper. Donec quis leo ut dolor ornare tempus. Mauris sagittis nisi ut mi malesuada, et commodo orci feugiat. Integer consectetur consequat lorem, vehicula faucibus mauris. Phasellus cursus mauris malesuada sapien rutrum, pharetra dictum tellus molestie. Integer vitae lectus sit amet mauris pulvinar rhoncus euismod ac dolor.'
```

## Credits

This plugin is built on top of the amazing [GLightbox](https://biati-digital.github.io/glightbox?target=_blank) library by `biati digital`
