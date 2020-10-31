---
title: General Recipes
page-toc:
  active: true
  depth: 1
taxonomy:
    category: docs
---

This page contains an assortment of problems and their respective solutions related to Grav in general.

## Change the PHP CLI version

Sometimes on the terminal, the PHP version is different than the PHP version used by the web server.

You can check the PHP version running in the CLI by running the command `php -v`.
If the PHP version is less than 5.5.9, Grav won't run as it requires at least PHP 5.5.9.

How to fix?

You need to enter some configuration to `.bashrc`, or to `.bash_profile` in your user home folder. Create those files if you don't already have them in the user folder. They are hidden files, so you might have to do `ls -al` to show them. Once the configuration is added, you'll need to start a new terminal session for those settings to apply.

An example configuration could be:

[prism classes="language-bash command-line"]
alias php="/usr/local/bin/php53"
export PHP_PATH = /usr/local/bin/php53
[/prism]

An alternative way is to add:

[prism classes="language-bash line-numbers"]
# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
        . ~/.bashrc
fi

# User specific environment and startup programs

PATH=/usr/local/lib/php-5.5/bin:$PATH:$HOME/bin

export PATH
[/prism]

The exact path of course depends on how your system is set up, where it stores the more recent PHP version binaries. That might be something you find in the Hosting documentation, or you can ask your hosting setup if you do not find it anywhere.

You could also try looking in the `php-something` files or folders under the `/usr/local/bin` or `/usr/local/lib` folders, with `ls -la /usr/local/lib/ |grep -i php`.

## Creating a simple gallery

##### Problem:

A common web design requirement is to have a gallery of some kind rendered on a page.  This could be to display photographs of your new family pet, a portfolio of previous design work, or even a basic catalog of some products you wish to display and sell to your users.  In this example, we'll assume you want to just display a bunch of photographs with a caption below.  This can of course be adapted to other uses also.

##### Solution:

The simplest way to provide a solution for this problem is to make use of Grav's [media functionality](../../content/media) which allows a page to be aware of the images available in its folder.

Let's assume you have a page you've called `gallery.md` and also you have a variety of images in the same directory. The filenames themselves are not important as we will just iterate over each of the images.  Because we want to have extra data associated with each image, we will include a `meta.yaml` file for each image.  For example, we have a few images:

[prism classes="language-yaml line-numbers"]
- fido-playing.jpg
- fido-playing.jpg.meta.yaml
- fido-sleeping.jpg
- fido-sleeping.jpg.meta.yaml
- fido-eating.jpg
- fido-eating.jpg.meta.yaml
- fido-growling.jpg
- fido-growling.jpg.meta.yaml
[/prism]

Each of the `.jpg` files are a relatively good size that is appropriate for a full-size version, 1280px x 720px in size. Each of the `meta.yaml` files contain a few key entries, let's look at `fido-playing.jpg.meta.yaml`:

[prism classes="language-yaml line-numbers"]
title: Fido Playing with his Bone
description: The other day, Fido got a new bone, and he became really captivated by it.
[/prism]

You have **complete control** over what you put in these meta files, they can be absolutely anything you need.

Now we need to display these images in reverse chronological order so the newest images are shown first and display them.  Because our page is called `gallery.md` we should create an appropriate `templates/gallery.html.twig` to contain the rendering logic we need:

[prism classes="language-twig line-numbers"]
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
            <p>{{ image.meta.description }}</p>
        </div>
    </li>
    {% endfor %}
    </ul>

{% endblock %}
[/prism]

For a modular gallery to be displayed inside another page, remove the following code from the Twig file in order to make it work:

[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% block content %}
    {{ page.content }}
[/prism]

and

[prism classes="language-twig"]
{% endblock %}
[/prism]

Basically, this extends the standard `partials/base.html.twig` (assuming your theme has this file), it then defines the `content` block and provides the content for it.  The first thing we do is echo out any `page.content`.  This would be the content of the `gallery.md` file, so it could contain a title, and a description of this page.

The next section simply loops over all the media of the page that are **images**.  We are outputting these in an unordered list to make the output semantic, and easy to style with CSS.  we are assigning each image the variable name `image` and then we are able to perform a simple `cropResize()` method to resize the image to something suitable, and then below it, we provide an information section with the `title` and `description`.

You could make a more advanced gallery-implementation by using creating filters for camera-data, with the [EXIF](/themes/twig-filters-functions#exif)-function.

## Render content in columns

##### Problem:

A question that has come up several times is how to quickly render a single page in multiple columns.

##### Solution:

There are many potential solutions, but one simple solution is to divide up your content into logical sections using a delimiter such as the HTML `<hr />` or *thematic break* tag.  In markdown, this is represented by 3 or more dashes or `---`.  We simply create our content and separate our sections of content with these dashes:

**columns.md**
[prism classes="language-md line-numbers"]
---
title: 'Columns Page Test'
---

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas arcu leo, hendrerit ut rhoncus eu, dictum vitae ligula. Suspendisse interdum at purus eget congue. Aliquam erat volutpat. Proin ultrices ligula vitae nisi congue sagittis. Nulla mollis, libero id maximus elementum, ante dolor auctor sem, sed volutpat mauris nisl non quam.

---
Phasellus id eleifend risus. In dui tellus, dignissim id viverra non, convallis sed ante. Suspendisse dignissim, felis vitae faucibus dictum, dui mi tempor lectus, non porta elit libero quis orci. Morbi porta neque quis magna imperdiet hendrerit.

---
Praesent eleifend commodo purus, sit amet viverra nunc dictum nec. Mauris vehicula, purus sed convallis blandit, massa sem egestas ex, a congue odio lacus non quam. Donec vitae metus vitae enim imperdiet tempus vitae sit amet quam. Nam sed aliquam justo, in semper eros. Suspendisse magna turpis, mollis quis dictum sit amet, luctus id tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eu rutrum mi.
[/prism]
!! Note: the extra line after the column and before the `---`.  This is because if you put a triple dash right underneath text, it's actually interpreted as a header.

Then we simply need to render this content with a `columns.html.twig` template (as the page file was named `columns.md`):

[prism classes="language-twig line-numbers"]
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
[/prism]

You can see how the content is being **split** by the `<hr />` tag and converted into an array of 3 columns which we loop over and render.  In this example we are using a simple HTML table tag, but you could use anything you wish.

## Really simple css image slider

##### Problem:

You need an image slider without any overhead.

##### Solution:

This recipe is for 4 images and a page called `slider.md`! Simply put the images where the .md file is. Next, create a new Twig template and extend `base.html.twig`.


[prism classes="language-twig line-numbers"]
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
[/prism]

For modular slider, please remove the
[prism classes="language-twig line-numbers"]
{% extends 'partials/base.html.twig' %}

{% block content %}
[/prism]

and

[prism classes="language-twig"]
{% endblock %}
[/prism]

from the previous Twig file.

Time for css stuff. Add this to your _custom.scss

[prism classes="language-scss line-numbers"]
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
[/prism]

That's all.

## Wrapping markdown into html

On some pages you might want to wrap parts of the markdown content into some custom html code instead of creating a new Twig template.

To achieve this you follow these steps:

in your system configuration file `user/config/system.yaml` make sure to activate the markdown extra option:

[prism classes="language-yaml line-numbers"]
pages:
  markdown:
    extra: true
[/prism]

in your wrapper tag make sure to add the parameter `markdown="1"` to activate processing of markdown content:

[prism classes="language-md line-numbers"]
<div class="myWrapper" markdown="1">
# my markdown content

this content is wrapped into a div with class "myWrapper"
</div>
[/prism]

done.

## Add a recent post widget to your sidebar

#### Problem:

You want to create a recent post widget on the sidebar

#### Solution:

It's always possible to create a partial template extending `partials/base.html.twig` (see other solutions on this page), but here you're going to create a full template instead. The final code for your Twig template is shown below: 

[prism classes="language-twig line-numbers"]
<div class="sidebar-content recent-posts">
    <h3>Recent Posts</h3>
    {% for p in page.find('/blog').children.order('date', 'desc').slice(0, 5) %}
        {% set bannerimage = p.media['banner.jpg'] %}
        <div class="recent-post">
            {% if bannerimage %}
                <div class="recent-post-image">{{ bannerimage.cropZoom(60,60).quality(60) }}</div>
            {% else %}
                <div class="recent-post-image"><img src="{{ url('theme://images/logo.png') }}" width="60" height="60"></div>
            {% endif %}
            <div class="recent-post-text">
                <h4><a href="{{p.url}}">{{ p.title }}</a></h4>
                <p>{{ p.date|date("M j, Y")}}</p>
            </div>
        </div>
    {% endfor %}
</div>
[/prism]

All this code does is sort the children (blog posts) of the `/blog` page by decending date order. It then takes the first five blog posts using the `slice` Twig filter. By the way, `slice(n,m)` takes elements from `n` to `m-1`. In this example, any blog posts that have a banner image have been named `banner.jpg`. This is set in a variable `bannerimage`. If `bannerimage` exists, it is shrunk down to a `60px x 60px` box and will appear to the left of the post title text and date. If it does not exist, the website logo is resized to `60px x 60px` and placed to the left of the title and date text instead.

The CSS for this widget is listed below:

[prism classes="language-css line-numbers"]
.sidebar-content .recent-post {
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #F0F0F0;
    float: left;
    clear: both;
    width: 100%;
}

.sidebar-content [class~='recent-post']:last-of-type {
    border-bottom: none;
}

.sidebar-content .recent-post .recent-post-image,
.sidebar-content .recent-post .recent-post-text {
    float: left;
}

.sidebar-content .recent-post .recent-post-image {
    margin-right: 10px;
}

.sidebar-content .recent-post .recent-post-text h4 {
    font-family: serif;
    margin-bottom: 10px;
}

.sidebar-content .recent-post .recent-post-text h4 a {
    color: #193441;
}

.sidebar-content .recent-post .recent-post-text p {
    font-family: Arial, sans-serif;
    font-size: 1.5rem;
    color: #737373;
    margin: 0;
}
[/prism]
Adjust the spacing between recent post items, font-family, font-size and font-weight to taste.

## Create a private area

Grav makes it very easy to create a private area on a website.
It all works thanks to the Login Plugin.

## Require users to login prior to access a part of the site

If you don’t have it already, install it through the Admin Panel or using the GPM command line utility.

Next, open a page in Admin, switch to expert mode and in the FrontMatter section add

[prism classes="language-yaml line-numbers"]
access:
    site.login: true
[/prism]

Users accessing the page will need to login prior to see the page content.

Notice that the permission does not extend by default to subpages. To do so, from the Login plugin configuration enable "Use parent access rules".

This option allows you to create extended private areas without worrying further about access level. Just put all under a page which has a restriction on access.

## Require special permissions to view one or more pages

Similarly to the above process, you can assign any permission you want to a page. You can even come up with your own permission names.

For example:

[prism classes="language-yaml line-numbers"]
access:
    site.onlybob: true
[/prism]

Next, add the `site.onlybob` permission to Bob, in its `bob.yaml` user file under the `user/accounts` folder:

[prism classes="language-yaml line-numbers"]
access:
    site.onlybob: true
[/prism]

## Use group-based permissions

You can also assign users to a group, and assign permissions to the group instead of to individual users. Users will inherit the group permissions.

Add a `user/config/groups.yaml` file, for example with this content:

[prism classes="language-yaml line-numbers"]
registered:
  readableName: 'Registered Users'
  description: 'The group of registered users'
  access:
    site:
      login: true
premium:
  readableName: 'Premium Members'
  description: 'The group of premium members'
  access:
    site:
      login: true
      paid: true
[/prism]

Now assign users to a group by adding

[prism classes="language-yaml line-numbers"]
groups:
      - premium
[/prism]

to their yaml user file, under `user/accounts`

Now users belonging to the `premium` group will be allowed to access pages with a `site.paid` permission.

## Add JavaScript to the footer

In many cases you'd want "some" javascript to be added to the footer instead of the page header, to be loaded after the content has been rendered.

A good example of doing this is to check the Antimatter theme.

Antimatter's `templates/partials/base.html.twig` defines a bottom block for js by calling `{{ assets.js('bottom') }}`

[prism classes="language-twig line-numbers"]
{% block bottom %}
    {{ assets.js('bottom') }}
{% endblock %}
[/prism]

You can add assets in that block in Twig for example by calling

`{% do assets.addJs('theme://js/slidebars.min.js', {group: 'bottom'}) %}`

or in PHP by calling

`$this->grav['assets']->addJs($this->grav['base_url'] . '/user/plugins/yourplugin/js/somefile.js', ['group' => 'bottom']);`

## Override the default logs folder location

The default location for the logs output of Grav is simply called `logs/`.  Unfortunately, there are instances where that `logs/` folder is already used or is off-limits.  Grav's flexible stream system allows the ability to customize the locations of these folders.

First, you need to create your new folder.  In this example, we'll create a new folder in the root of your Grav install called `grav-logs/`.  Then create a new root-level file called `setup.php` and paste the following code:

[prism classes="language-php line-numbers"]
<?php
use Grav\Common\Utils;


return [
    'streams' => [
        'schemes' => [
            'log' => [
               'type' => 'ReadOnlyStream',
               'prefixes' => [
                   '' => ["grav-logs"],
               ]
            ]
        ]
    ]
];
[/prism]

This basically overrides the `log` stream with the `grav-logs/` folder rather than the default `logs/` folder as defined in `system/src/Grav/Common/Config/Setup.php`.

## Split vertical menu system

To create a vertical, collapsible, hierarchical menu of pages you need a Twig-loop, a bit of CSS, and a bit of JavaScript. The final result will, when using the Antimatter-theme, look like this:

![Vertical Menu](vertical_menu.png)

Let's start with Twig:

[prism classes="language-twig line-numbers"]
<ol class="tree">
    {% for page in pages.children.visible %}
        {% if page.children.visible is empty %}
            <li class="item">
            <a href="{{ page.url }}">{{ page.title }}</a>
        {% else %}
            <li class="parent">
            <a href="javascript:void(0);">{{ page.title }}</a>
            <ol>
                {% for child in page.children.visible %}
                    {% if child.children.visible is empty %}
                        <li class="item">
                        <a href="{{ child.url }}">{{ child.title }}</a>
                    {% else %}
                        <li class="parent">
                        <a href="javascript:void(0);">{{ child.title }}</a>
                        <ol>
                            {% for subchild in child.children.visible %}
                                <li><a href="{{ subchild.url }}">{{ subchild.title }}</a></li>
                            {% endfor %}
                        </ol>
                    {% endif %}
                    </li>
                {% endfor %}
            </ol>
        {% endif %}
        </li>
    {% endfor %}
</ol>
[/prism]

This creates an ordered list which iterates over all visible pages within Grav, going three levels deep to create a structure for each level. The list wrapped around the entire structure has the class *tree*, and each list-item has the class *parent* if it contains children or *item* if it does not.

Clicking on a parent opens the list, whilst regular items link to the page itself. You could add this to virtually any Twig-template in a Grav theme, provided that Grav can access the visible pages.

To add some style, we add some CSS:

[prism classes="language-css line-numbers"]
<style>
ol.tree li {
    position: relative;
}
ol.tree li ol {
    display: none;
}
ol.tree li.open > ol {
    display: block;
}
ol.tree li.parent:after {
    content: '[+]';
}
ol.tree li.parent.open:after {
    content: '';
}
</style>
[/prism]

This should generally be placed before the Twig-structure, or ideally be streamed into the [Asset Manager](/themes/asset-manager) in your theme. The effect is to add **[+]** after each parent-item, indicating that it can be opened, which disappears when opened.

Finally, let's add a bit of JavaScript to [handle toggling](https://stackoverflow.com/a/36297446/603387) the *open*-class:

[prism classes="language-js line-numbers"]
<script type="text/javascript">
var tree = document.querySelectorAll('ol.tree a:not(:last-child)');
for(var i = 0; i < tree.length; i++){
    tree[i].addEventListener('click', function(e) {
        var parent = e.target.parentElement;
        var classList = parent.classList;
        if(classList.contains("open")) {
            classList.remove('open');
            var opensubs = parent.querySelectorAll(':scope .open');
            for(var i = 0; i < opensubs.length; i++){
                opensubs[i].classList.remove('open');
            }
        } else {
            classList.add('open');
        }
    });
}
</script>
[/prism]

This should always be placed **after** the Twig-structure, also ideally in the [Asset Manager](/themes/asset-manager).

## Dynamically style one or more pages
You can dynamically style different pages/posts in your Grav site (independent of template file assignment) by customizing a Theme's Twig file to apply a CSS class passed as a variable in a page's FrontMatter.

You can style different posts/pages in your Grav site by two methods:

1. If you are using the Antimatter theme, you can use the existing `body_classes` header property to set your custom CSS class for that page
2. If you are using a theme not based on Antimatter (or not implementing `body_classes` as it does), you can customize a Theme's Twig file to apply a CSS class passed as a variable in a page's header property

For example, in your theme's `base.html.twig` file or a more specific template such as `page.html.twig` file you could add a class to the display of page content, such as:

[prism classes="language-html line-numbers"]
<div class="{{ page.header.body_classes }}">
...
</div>
[/prism]

Then, for each page you wish to have a unique style, you would add the following header property (assuming you have defined a CSS class for `featurepost`):

[prism classes="language-yaml line-numbers"]
body_classes: featurepost
[/prism]

Note: This is how the Antimatter theme applies page-specific classes, and so it's a good standard to follow.

## Migrate an HTML theme to Grav

Migrating an HTML theme to Grav is a common task. Here is a hands-on step-by-step process that can be used to achieve this goal.

You probably have downloaded the theme, and it's composed of several HTML files. Let's start with simply making Grav load the home page. No custom content, just replicate the HTML theme, but within a Grav structure.

First, [use the Grav Devtools plugin](/themes/theme-tutorial) to create a blank theme, and set Grav to use it in the System settings.

Create a `templates/home.html.twig` Twig template inside the theme’s templates folder. This will represent a template specific for the home page. Usually, the home is a unique page on the site, so it probably deserves a dedicated Twig file.

Copy the HTML code from the template's home page, starting at `<html>` and ending at `</html>` to your new `home.html.twig` file.

Now, move all the HTML theme assets (images, CSS, JS) into your theme folder. You can keep the existing theme folder structure, or change it.

Create a `pages/01.home/home.md` empty file. Now point your browser to yoursite.com/home: it should show up the content, but the CSS, JS and images will not be loaded, probably because the theme has them hardcoded as `/img/*` or `/css/*` links. 

#### Adding the correct asset links

In Grav the links are broken because they point to the home route, so instead of pointing to `/user/themes/mytheme/img`, they point to `/img` in the Grav root. Since it's best to keep all theme-related assets inside the theme, we need to point Grav to the correct location.

Search within the page for assets and change the images references from `img/*.*` to `<img src="{{ url('theme://img/*.*', true) }}" />`.

Stylesheets require a bit more thought as there’s an asset pipeline we’ll want to enable at some point, so we move them to a stylesheets block within the `<head>` tag.

Example:
[prism classes="language-twig line-numbers"]
    {% block stylesheets %}
        {% do assets.addCss('theme://css/styles.min.css', 100) %}
    {% endblock %}
    {{ assets.css() }}
[/prism]

The same applies to JavaScript files, with the additional requirement that some JS is loaded in the footer.

Example:
[prism classes="language-twig line-numbers"]
    {% block javascripts %}
        {% do assets.addJs('theme://js/custom.js') %}
        {% do assets.addJs('jquery', 101) %}
    {% endblock %}
    {{ assets.js() }}
[/prism]

The page changes should now be shown in your Browser. If not, make sure that the pages cache and the twig cache are disabled in the Grav system configuration settings.

This is just the start. Now you might need to add more pages, and come up with better ways to present the content of your pages using the header FrontMatter, and custom Twig that processes usual building blocks need: the home page testimonials, reviews, the product features and so on.

#### Adding another page

To add another page, the process is similar. For example, let's say you want to next create the blog page. 
Repeat the process to add a `templates/blog.html.twig` file, paste the HTML source, and create a `pages/02.blog/blog.md` page. 

Now, while images links inside the pages still need to be migrated to Grav's assets syntax (or simply change the path), you don't want to repeat the same work you did above for CSS and JS assets. This should be reused across the site.

#### Shared Elements

Identify the common parts of the pages (header and footer), and move them to the `templates/partials/base.html.twig` file.

Each page template then needs to extend `partials/base.html.twig` (https://github.com/getgrav/grav-theme-antimatter/blob/develop/templates/default.html.twig#L1) and just add their unique content. 

## Add an asset to a specific page

#### Problem

You need to add an asset to a specific template on your theme.

#### Solution

Most of the time, your assets will be added inside a twig block in your base template like below. 

[prism classes="language-twig line-numbers"]
{% block javascripts %}
{% do assets.addJs('theme://js/jquery.js', 91) %}
{% endblock %}
{{ assets.js() }}
[/prism]

In order to add your asset, you have to extend this block in your template and call `{{ parent() }}` which will get the assets already added in your base template.
Let's say you want to add a "gallery.js" file on your "Portfolio Gallery" page. 
Edit your template and add your asset with the `{{ parent() }}`.

[prism classes="language-twig line-numbers"]
{% block javascripts %}
     {% do assets.addJs('theme://js/gallery.js', 100) %}
     {{ parent() }}
{% endblock %}
[/prism]

## Reuse page or modular content on another page

#### Problem:
You have many pages or modules and would like to share the same content block on more than one page without having to maintain multiple separate instances of the same text.

#### Solution:

This is a very simple straightforward method which does not require a plugin and can be used within the admin panel.

**Note:** There is also plugin [Grav Page Inject Plugin](https://github.com/getgrav/grav-plugin-page-inject) for this functionality which may be suitable for more advanced scenarios.

First, create a new template file to act as a placeholder for the content - it can have any name, this one is named "modular_reuse" and will be in the stored in your theme's templates/modular_ folder for this example but can be stored anywhere in the templates folder.
 

`modular_reuse.html.twig` contains only one line:
[prism classes="language-twig line-numbers"]
{{ page.content }}
[/prism]
Next, create a new modular page in the admin panel where this content should be displayed using this new "modular reuse" template. The new page name can be anything you like as it will not be displayed - the original page title will be output.

The content of the page is just one line: 
Page:
[prism classes="language-twig line-numbers"]
{% include 'modular_reuse.html.twig' with {'page': page.find('/test-page/amazing-offers')} %}
[/prism]
Modular:
[prism classes="language-twig line-numbers"]
{% include 'modular/modular_reuse.html.twig' with {'page': page.find('/test-page/_amazing-offers')} %}
[/prism]

What comes after "include" is where the template from step one is stored, probably in the `templates` folder for pages in the `templates/modular` folder for modulars.

After page.find should come the actual link to the original content that you want to reuse. Modular content starts with an _ but pages do not. The easiest way to find the correct link is to open the page in the admin panel and copy the url after the word admin.

The final page should look like this:
[prism classes="language-twig line-numbers"]
---
title: 'Modular Reuse Example'
---

{% include 'modular/modular_reuse.html.twig' with {'page': page.find('/test-page/_amazing-offers')} %}
[/prism]

Now "amazing offers" can be displayed in multiple places but only needs to be updated once.

## Make a custom anti-spam field for your contact form

#### Problem:

Normal methods of spam-prevention, like the honeypot-field, is bypassed by certain spam-bots.

#### Solution:

Make it harder for the bot to guess what it can and can't fill it in, when filling out the contact form. Put simply, ask a question the user won't fail to answer, but whose answers are hard for a bot to understand the significance of. In your Markdown-file with [Form-data](https://learn.getgrav.org/forms/forms/example-form), add this field:

[prism classes="language-yaml line-numbers"]
    - name: personality
      type: radio
      label: What is five times eight?
      options:
        alaska: 32
        oklahoma: 40
        california: 48
      validate:
        required: true
        pattern: "^oklahoma$"
        message: Not quite, try that math again.
[/prism]

The question should be something simple, but with multiple simple wrong answers accompanying it. What matters is the order of the answers. The right answer should never be the first one; aim for somewhere in the middle. It's important to randomize the values behind the answers (labels) yourself, so a database of associated values and answers won't help in answering.

Bots get smarter all the time, but they tend to forego trying to answer the same question several times if the first attempt fails. Also, even the smartest of them rely on dictionaries of known data to guess at an answer. We ask a simple question, "What is five times eight?", and give three options, "32", "40", and "48". The right answer is obviously "40", but instead of checking the bot's math-skills, we're assigning the values "alaska", "oklahoma", and "california" to these numbers, respectively. Because bots look at the possible values, rather than their label, the answers bears no relation to the question. You could even add an answer "Pineapple" with the value "mississippi" and validate against that, and just tell your users to choose that as their answer. The point is to personalize the randomization of data.


## Display different robots.txt contents for different environments

#### Problem:

You've setup a subdomain, `dev.yourdomain.com`, as a development site to preview what you're working on before publishing changes to `yourdomain.com`, and want to disallow search indexers from crawling it while keeping the production site visible in search results.

#### Solution:

While you should password-protect your development site to really keep it private, sometimes it's sufficient, and just more practical, to simply disallow search engine indexers from crawling your site. Luckily, Grav can handle pages in txt format just as it does html, so we can use [environment configurations](/advanced/environment-config) and twig templates to complete the job.

First, let's create a configuration file `site.yaml` that will tell our template that `dev.yourdomain.com` is a development environment.

`/user/[dev.yourdomain.com]/config/site.yaml`:

    environment: dev


Then, create a `robots.txt.twig` page template that checks if Grav is currently running on our development site, and displays different contents if it is.

`/user/themes/[yourtheme]/templates/robots.txt.twig`:

[prism classes="language-twig line-numbers"]
{% if config.site.environment == 'dev' %}
{% for rule in page.header.dev %}
{{ rule }}
{% endfor %}

{% else %}
{{ page.content }}

{% endif %}
[/prism]

Finally, create a page routed at `/robots.txt` with the default `robots.txt` rules in the page content, and our alternative development version rules in the page frontmatter. To render the page contents as raw text instead of html, we'll also disable markdown rendering.

`/user/pages/robots/robots.md`:

[prism classes="language-md line-numbers"]
---
routes:
  default: /robots.txt
process:
  markdown: false

dev:
  - 'User-agent: *'
  - 'Disallow: /'
---

User-agent: *
Disallow: /backup/
Disallow: /bin/
Disallow: /cache/
Disallow: /grav/
Disallow: /logs/
Disallow: /system/
Disallow: /vendor/
Disallow: /user/
Allow: /user/pages/
Allow: /user/themes/
Allow: /user/images/
Allow: /user/plugins/*.css$
Allow: /user/plugins/*.js$
[/prism]

Now you should have a `robots.txt` file placed at your site's root with dynamic contents, also editable with the Admin plugin. 

Note: make sure your production site won't display `Disallow: /`, as that will completely obliterate your search engine visibility.
