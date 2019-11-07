---
title: Basic Tutorial
taxonomy:
    category: docs
---

Assuming you successfully [installed Grav](../installation) with the instructions listed in the previous chapter, we can continue and play around with Grav a little to get you more comfortable.

Because Grav does not require a database, it is pretty easy to work with, without having to worry about causing issues between your Grav installation and any other significant data source. If something goes awry, you can generally recover very easily.

## Content Basics

First, let us familiarize ourselves with where Grav stores content.  We will go into more depth in a [future chapter](../folder-structure), but for the time being, you need to be aware that all our user content, is stored in the `user/pages/` folder of your Grav install.

Currently, there are two folders in the pages folder, the first one is called `01.home` and the second is `02.typography`.  The `01.` portion of the folder is optional but provides a couple of things that can be handy.

Firstly, it lets you expressly define the order of your pages.  For example, `01` will come before `02`, but `00` will come before `01`.

The other thing that the numeric portion of the folder name does is explicitly inform Grav this page should be visible in the menu.  It is important to note that the numeric portion up to and including the `.` will be removed from URLs.

## Home Page Configuration

There is an option in the `user/config/system.yaml` file that sets the location of the __home page__, in other words, where Grav points to when you reference the root of your site: `http://yoursite.com`.

If you examine this configuration file in your install, you will see that it already points to the alias for `/home`.  We can leave it like this in this example.

## Page Editing

Pages in **Grav** are composed in **Markdown** syntax.  Markdown is a plain text formatting syntax that a computer can readily parse and convert to HTML. It uses basic text symbols to indicate presentation (e.g. **bold**, _italics_, headings, lists, etc.), making it easy to write without needing to know the complexities of HTML. Benefits of Markdown include lower error rate, readability, ease of learning and use, etc.

You can read an [extensive write-up of available syntax](../../content/markdown) with examples in the documentation, but for now, follow along.

Open the home page in your text editor. The file that controls the homepage is located in the `user/pages/01.home/` folder and is called `default.md`. All of the content you create will be created in the `user/pages/` folder in your Grav installation.

When you edit the page in a text editor, the content will look something like this:

[div class="no-margin-bottom"]
[prism classes="language-yaml line-numbers"]
---
title: Home
body_classes: title-center title-h1h2
---
[/prism]
[/div]
[div class="no-margin-top"]
[prism classes="language-markdown line-numbers" ln-start="5"]
# Say Hello to Grav!
## installation successful...

Congratulations! You have installed the **Base Grav Package** that provides a **simple page** and the default **Quark** theme to get you started.

!! If you see a **404 Error** when you click `Typography` in the menu, please refer to the [troubleshooting guide](https://learn.getgrav.org/troubleshooting/page-not-found).
[/prism]
[/div]

Let us break this down a little so you can see how easy it is to write in Markdown. The stuff between the `---` indicators are the [Page Headers](../../content/headers), and these are written in a straightforward format called [YAML](../../advanced/yaml). This configuration block that sits in the `.md` file is commonly known as **YAML Front Matter**.

[prism classes="language-bash line-numbers"]
title: Home
body_classes: title-center title-h1h2
[/prism]

This block sets the HTML title tag for the page (the text you see in the browser tab).  You can also access this from your themes via the `page.title` attribute.  There are a [few standard headers](../../content/headers) that let you configure a variety of options for this page. Another example is `menu: Something` that lets you override the text used to display the name of the page in a menu.  By default, Grav will use the title for the menu value.

[prism classes="language-markdown line-numbers"]
# Say Hello to Grav!
## installation successful...
[/prism]

The `#` or `hashes` syntax in markdown indicates a title.  A single `#` with a space and then text converts into an `<h1>` header in HTML. `##` or double hash would convert into an `<h2>` tag.  Of course, this goes all the way up to the HTML valid `<h6>` tag which of course, would be six hashes: `###### My H6 Level Header`.

[prism classes="language-markdown line-numbers"]
Congratulations! You have installed the **Base Grav Package** that provides a **simple page** and the default **Quark** theme to get you started.
[/prism]

This is a simple paragraph that would have been wrapped in regular `<p>` tags when converted to HTML.  The `**` markers indicate bold text or `<strong>`, formerly `<b>`, in HTML.  Italic text is indicated by wrapping text in `_` markers.

[prism classes="language-markdown line-numbers"]
!! If you see a **404 Error** when you click `Typography` in the menu, please refer to the [troubleshooting guide](https://learn.getgrav.org/troubleshooting/page-not-found).
[/prism]

This section uses a custom markdown feature that is provided by the included `markdown-notices` plugin.  This allows you to create simple notices by prefix a paragraph of text with a number of `!` (exclamation mark) symbols, from `!` to `!!!!`.

This overview should provide you with a few key pointers for writing Markdown, but you should check out our more [detailed explanation](../../content/markdown) to get a thorough understanding.

!! Ensure you save your `.md` files as `UTF8` files.  This will ensure they work with language-specific special characters.

## Adding a New Page

Creating a new page is a simple affair in **Grav**.  Just follow these simple steps:

1. Navigate to your pages folder: `user/pages/` and create a new folder.  In this example, we will use [explicit default ordering](https://learn.getgrav.org/content/content-pages) and call the folder `03.mypage`.
2. Launch your text editor, create a new file, and paste in the following sample code:

[div class="no-margin-bottom"]
[prism classes="language-yaml line-numbers"]
---
title: My New Page
---
[/prism]
[/div]
[div class="no-margin-top"]
[prism classes="language-markdown line-numbers" ln-start="4"]
# My New Page!

This is the body of **my new page** and I can easily use _Markdown_ syntax here.
[/prism]
[/div]

3. Save this file in the `user/pages/03.mypage/` folder as `default.md`. This will tell **Grav** to render the page using the **default** template in the current theme: `user/themes/quark/templates/default.html.twig`.
4. That's it! Reload your browser to see your new page in the menu at the top.

The page will automatically show up in the menu after the **"Typography"** menu item. If you wish to change the name that shows up in the menu, add: `menu: My Page` between the dashes in the page content.

**Congratulations**, you have now successfully created a new page in Grav.  There is much more you can do with Grav, so please continue reading to find out about more advanced capabilities and in-depth features.

!! If you have any issues accessing this new page, you are either missing an `.htaccess` file (Apache web server only) or you may need to edit the `RewriteBase` command in the `.htaccess` file. Please consult the [Troubleshooting](../../troubleshooting) chapter for more information.
