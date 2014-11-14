---
title: Basic Tutorial
taxonomy:
    category: docs
---

Assuming you successfully [installed Grav][installation] with the instructions listed in the previous chapter, we can continue on and play around with Grav a little to get you more comfortable.

Because Grav does not require a database, it is actually pretty easy to work with without having to worry about causing issues between your Grav installation and another big data source. If something goes awry, you can generally recover very easily.

## Content Basics

First, let us familiarize ourselves with where Grav stores content.  We will go into more depth in a [future chapter][folderstructure], but for the time being, you need to be aware that all our user content, is stored in the `user/pages/` folder of your Grav install.

Currently there is only one folder in the pages folder, and it is called `01.home`.  The `01.` portion of the folder is optional but provides a couple of things that can be handy.

Firstly, it lets you expressly define the order of your pages.  For example, `01` will come before `02`, but `00` will come before `01`.

The other thing that the numeric portion of the folder name does, is explicitly inform Grav this page should be visible in the menu.  It is important to note that the numeric portion up to and including the `.` will be removed from URLs.

## Home Page Configuration

There is an option in the `user/config/system.yaml` file that sets the location of the __home page__, in other words, where Grav points to when you reference the root of your site: `http://yoursite.com`.

If you examine this configuration file in your install, you will see that it already points to the alias for `/home`.  We can leave it like this in this example.

## Page Editing

Pages in **Grav** are composed in **Markdown** syntax.  Markdown is a formatting syntax that is written in plain text and then converted automatically to HTML. It uses very simple text symbols to indicate key HTML tags making it very easy to write without having to know the complexities of HTML. There are numerous other benefits of using Markdown including less-errors, valid markup, very readable, simple to learn, transferable, etc.

You can read an [extensive write-up of available syntax][syntax] with examples in the documentation, but for now, just follow along.

Open the home page in your text editor. The file that controls the homepage is located in the `user/pages/01.home/` folder and is called `default.md`. All of the content you create will be created in the `user/pages/` folder in your Grav installation.

When you edit the page in a text editor, the content will look something like this:

	---
	title: Home
	---

	# Grav is Running!
	## You have installed **Grav** successfully

	Congratulations! You have installed the **Base Grav Package** that provides a **simple page** and the default **antimatter** theme to get you started.

	>>>>> If you want a more **full-featured** base install, you should check out [**Skeleton** packages available in the downloads](http://getgrav.org/downloads).

	### Find out all about Grav

	* Learn about **Grav** by checking out our dedicated [Learn Grav](http://learn.getgrav.org) site.
	* Download **plugins**, **themes**, as well as other Grav **skeleton** packages from the [Grav Downloads](http://getgrav.org/downloads) page.
	* Check out our [Grav Development Blog](http://getgrav.org/blog) to find out the latest goings on in the Grav-verse.

	## Create a new page

	>>>> TODO: Walk through the process of creating a new page with title + content with simple markdown

Let us break this down a little so you can see how easy it is to write in Markdown. The stuff between the `---` indicators are the [Page Headers][pageheaders], and these are written in a very simple format called [YAML](yaml). This configuration block that sits in the `.md` file is commonly known as **YAML Front Matter**.

```ruby
title: Home
```

This block sets the HTML title tag for the page (the text you see in the browser tab).  You can also access this from your themes via the `page.title` attribute.  There are a [few standard headers][pageheaders] that let you configure a variety of options for this page. Another example is `menu: Something` that lets you override the text used to display the name of the page in a menu.  By default, Grav will use the title for the menu value.

```markdown
# Grav is Running!
## You have installed **Grav** successfully
```

The `#` or `hashes` syntax in markdown indicates a title.  A single `#` with a space and then text converts into an `<h1>` header in HTML. `##` or double hash would convert into an `<h2>` tag.  Of course, this goes all the way up to the HTML valid `<h6>` tag which of course, would be six hashes: `###### My H6 Level Header`.

```markdown
Congratulations! You have installed the **Base Grav Package** that provides a **simple page** and the default **antimatter** theme to get you started.
```

This is a simple paragraph that would have been wrapped in regular `<p>` tags when converted to HTML.  The `**` markers indicate bold text or `<b>` in HTML.  Italic text is indicated by wrapping text in `_` markers.

```markdown
>>>>> If you want a more **full-featured** base install, you should check out [**Skeleton** packages available in the downloads](http://getgrav.org/downloads).
```

This is a special feature provided by the default Grav theme.  Usually in Markdown, a `>` indicates a `<blockquote>` in HTML.  We have overridden three level deep blockquotes and onwards to provide [styling for notices][syntax]. In this case, 5 chevrons, or `>>>>>` will produce a blue notice box. Within this blue notice styling, we also have some text that is wrapped in brackets or `[` and `]` markers followed by a URL in parenthesis `(` and `)`.  This is the markdown syntax for hyperlinking text.  It is very simple when you get the hang of it.

```markdown
* Learn about **Grav** by checking out our dedicated [Learn Grav](http://learn.getgrav.org) site.
* Download **plugins**, **themes**, as well as other Grav **skeleton** packages from the [Grav Downloads](http://getgrav.org/downloads) page.
* Check out our [Grav Development Blog](http://getgrav.org/blog) to find out the latest goings on in the Grav-verse.
```

Creating unordered lists is super simple in markdown. Simply use an `*`, `-`, or `+`, and a space to indicate that text is part of a list.  For an ordered list, simply use a number and a period before the text.

This overview should provide you with a few key pointers for writing Markdown, but you should check out our more [detailed explanation][syntax] to get a thorough understanding.

>>> NOTE: Ensure you save your `.md` files as `UTF8` files.  This will ensure they work with language-specific special characters.

## Adding a New Page

Creating a new page is a simple affair in **Grav**.  Simply follow these simple steps:

1. Navigate to your pages folder: `user/pages/` and create a new folder.  In this example we will use [explicit default ordering][ordering] and call the folder `02.mypage`.
2. Launch your text editor and paste in the following sample code:

	```markdown
	---
	title: My New Page
	---
	# My New Page!

	This is the body of **my new page** and I can easily use _Markdown_ syntax here.
	```

3. Save this file in the `user/pages/02.mypage/` folder as `default.md`. This will tell **Grav** to render the page using the **default** template.
4. That is it! Reload your browser to see your new page in the menu.

The page will automatically show up in the Menu after the **"Home"** menu item. If you wish to change the name that shows up in the Menu, simply add: `menu: My Page` between the dashes in the page content.

**Congratulations**, you have now successfully created a new page in Grav.  There is much more you can do with Grav, so please continue reading to find out about more advanced capabilities and in-depth features.

>>> If you have any issues accessing this new page, you probably either missing your `.htaccess` file (Apache web server only) or you may need to edit the `RewriteBase` command in you `.htaccess` file. Please consult the [Troubleshooting](../../troubleshooting) section for more information.



[installation]: ../installation
[folderstructure]: ../folder-structure
[syntax]: ../../content/markdown
[pageheaders]: ../../content/headers
[yaml]: ../../advanced/yaml
[ordering]: http://learn.getgrav.org/content/content-pages
