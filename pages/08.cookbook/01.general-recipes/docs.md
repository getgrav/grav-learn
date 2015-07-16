---
title: General Recipes
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav in general.

1. [Creating a Simple Gallery](#creating-a-simple-gallery)


### Creating a Simple Gallery

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
