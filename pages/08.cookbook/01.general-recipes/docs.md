---
title: General Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav in general.

1. [Creating a simple gallery](#creating-a-simple-gallery)
1. [Render content in blocks or columns](#render-content-in-columns)
1. [Really simple css image slider](#really-simple-css-image-slider)


### Creating a simple gallery

##### Problem:

A common web design requirement is to have a gallery of some kind rendered on a page.  This could be to display photographs of your new family pet, a portfolio of previous design work, or even a basic catalog of some products you wish to display and sell to your users.  In this example, we'll assume you want to just display a bunch of photographs with a caption below.  This can of course be adapted to other uses also.

##### Solution:

The simplest way to provide a solution for this problem is to make use of Grav's [media functionality](../../content/media) which allows a page to be aware of the images available in it's folder.

Let's assume you have a page you've called `gallery.md` and also you have a variety of images in the same directory. The filenames themselves are not important as we will just iterate over each of the images.  Because we want to have extra data associated with each image, we will include a `meta.yaml` file for each image.  For example we have a few images:

```
- fido-playing.jpg
- fido-playing.jpg.meta.yaml
- fido-sleeping.jpg
- fido-sleeping.jpg.meta.yaml
- fido-eating.jpg
- fido-eating.jpg.meta.yaml
- fido-growling.jpg
- fido-growling.jpg.meta.yaml
```

Each of the `.jpg` files are a relatively good size that is appropriate for a full-size version, 1280px x 720px in size. Each of the `meta.yaml` files contains a few key entries, let's look at `fido-playing.jpg.meta.yaml`:

```
title: Fido Playing with his Bone
description. The other day, Fido got a new bone, and he became really captivated by it.
```

You have **complete control** over what you put in these meta files, they can be absolutely anything you need.

Now we need to display these images in reverse chronological order so the newest images are shown first and display them.  Because our page is called `gallery.md` we should create an appropriate `templates/gallery.html.twig` to contain the rendering logic we need:

```
{% extends 'partials/base.html.twig' %}

{% block content %}
    {{ page.content }}

    <ul>
    {% for image in page.media.images %}
    <li>
        <div class="image-surround">
            {{ image.cropResize(300,200).html }}
        </div>
        <div class="image-info">
            <h2>{{ image.meta.title }}</h2>
            <p>{{ image.meta.description }}
        </div>
    </li>
    {% endfor %}
    </ul>

{% endblock %}
```

Basically this extends the standard `partials/base.html.twig` (assuming your theme has this file), it then defines the `content` block and provides the content for it.  The first thing we do is echou out any `page.content`.  This would be the content of the `gallery.md` file, so it could contain a title, and a description of this page.

The next section simply loops over all the media of the page that are **images**.  We are outputting these in an unordered list to make the output semantic, and easy to style with CSS.  we are assigning each image the variable name `image` and then we are able to perform a simple `cropResize()` method to resize the image to something suitable, and then below it we provide an information section with the `title` and `description`.

### Render content in columns

##### Problem:

A question that has come up several times is how to quickly render a single page in multiple columns.

##### Solution:

There are many potential solutions, but one simple solutions is to divide up your content into logical sections using a delimiter such as as the HTML `<hr />` or *thematic break* tag.  In markdown this is represented by 3 or more dashes or `---`.  We simply create our content and separate are sections of content with these dashes:

**columns.md**

    ---
    title: 'Columns Page Test'
    ---

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas arcu leo, hendrerit ut rhoncus eu, dictum vitae ligula. Suspendisse interdum at purus eget congue. Aliquam erat volutpat. Proin ultrices ligula vitae nisi congue sagittis. Nulla mollis, libero id maximus elementum, ante dolor auctor sem, sed volutpat mauris nisl non quam.

    ---
    Phasellus id eleifend risus. In dui tellus, dignissim id viverra non, convallis sed ante. Suspendisse dignissim, felis vitae faucibus dictum, dui mi tempor lectus, non porta elit libero quis orci. Morbi porta neque quis magna imperdiet hendrerit.

    ---
    Praesent eleifend commodo purus, sit amet viverra nunc dictum nec. Mauris vehicula, purus sed convallis blandit, massa sem egestas ex, a congue odio lacus non quam. Donec vitae metus vitae enim imperdiet tempus vitae sit amet quam. Nam sed aliquam justo, in semper eros. Suspendisse magna turpis, mollis quis dictum sit amet, luctus id tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eu rutrum mi.

>>> Note: the extra line after the column and before the `---`.  This is because if you put a triple dash right underneath text, it's actually interpreted as a header.

Then we simply need to render this content with a `columns.html.twig` template (as the page file was named `columns.md`):

```
{% extends 'partials/base.html.twig' %}

{% block content %}
    <table>
        <tr>
            {% for column in page.content|split('<hr />') %}
            <td>{{ column }}</td>
            {% endfor %}
        </tr>
    </table>
{% endblock %}
```

You can see how the content is being **split** by the `<hr />` tag and converted into an array of 3 columns which we loop over and render.  In this example we are using a simple HTML table tag, but you could use anything you wish.

### Really simple css image slider

##### Problem:

You need a image slider without any overhead.

##### Solution:

This recipe is for 4 images! Simply put the images where the .md file is. I create a new twig template and extend the base.html.twig.  

```
{% extends 'partials/base.html.twig' %}

{% block content %}

    <div id="slider">
        <figure>
        {% for image in page.media.images %}
            {{ image.html }}
        {% endfor %}
        </figure>
    </div>

    {{ page.content }}
{% endblock %}
```

Time for css stuff. Add this to you _custom.scss

```
@keyframes slidy {
    0% { left: 0%; }
    20% { left: 0%; }
    25% { left: -100%; }
    45% { left: -100%; }
    50% { left: -200%; }
    70% { left: -200%; }
    75% { left: -300%; }
    95% { left: -300%; }
    100% { left: -400%; }
}
body { margin: 0; }
div#slider {
    overflow: hidden;
    margin-top: -3rem;
    max-height: 30rem;
}
div#slider figure img { width: 20%; float: left; }
div#slider figure {
    position: relative;
    width: 500%;
    margin: 0;
    left: 0;
    animation: 30s slidy infinite;
}
```

Thats all.

