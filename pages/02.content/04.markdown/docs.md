---
title: Markdown Syntax
page-toc:
  active: true
taxonomy:
    category: docs
---

Let's face it: Writing content for the Web is tiresome. WYSIWYG editors help alleviate this task, but they generally result in horrible code, or worse yet, ugly web pages.

**Markdown** is a better way to write **HTML**, without all the complexities and ugliness that usually accompanies it.

Some of the key benefits are:

1. Markdown is simple to learn, with minimal extra characters, so it's also quicker to write content.
2. Less chance of errors when writing in markdown.
3. Produces valid XHTML output.
4. Keeps the content and the visual display separate, so you cannot mess up the look of your site.
5. Write in any text editor or Markdown application you like.
6. Markdown is a joy to use!

John Gruber, the author of Markdown, puts it like this:

> The overriding design goal for Markdown’s formatting syntax is to make it as readable as possible. The idea is that a Markdown-formatted document should be publishable as-is, as plain text, without looking like it’s been marked up with tags or formatting instructions. While Markdown’s syntax has been influenced by several existing text-to-HTML filters, the single biggest source of inspiration for Markdown’s syntax is the format of plain text email.
> -- <cite>John Gruber</cite>


Grav ships with built-in support for [Markdown](https://daringfireball.net/projects/markdown/) and [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/). You must enable **Markdown Extra** in your `system.yaml` configuration file.

Without further delay, let us go over the main elements of Markdown and what the resulting HTML looks like:

!! <i class="fa fa-bookmark"></i> Bookmark this page for easy future reference!

## Headings

Headings from `h1` through `h6` are constructed with a `#` for each level:

[prism classes="language-markdown"]
# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading
[/prism]

Renders to:

# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading

HTML:

[prism classes="language-html"]
<h1>h1 Heading</h1>
<h2>h2 Heading</h2>
<h3>h3 Heading</h3>
<h4>h4 Heading</h4>
<h5>h5 Heading</h5>
<h6>h6 Heading</h6>
[/prism]



## Comments

Comments should be HTML compatible

[prism classes="language-html"]
<!--
This is a comment
-->
[/prism]
Comment below should **NOT** be seen:

<!--
This is a comment
-->



## Horizontal Rules

The HTML `<hr>` element is for creating a "thematic break" between paragraph-level elements. In markdown, you can create a `<hr>` with any of the following:

* `___`: three consecutive underscores
* `---`: three consecutive dashes
* `***`: three consecutive asterisks

renders to:

___

---

***





## Body Copy

Body copy written as normal, plain text will be wrapped with `<p></p>` tags in the rendered HTML.

So this body copy:

[prism classes="language-markdown"]
Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.
[/prism]
renders to this HTML:

[prism classes="language-html"]
<p>Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.</p>
[/prism]

A **line break** can be done with 2 spaces followed by 1 return.





## Inline HTML

If you need a certain HTML tag (with a class) you can simply use HTML:

[prism classes="language-html"]
Paragraph in Markdown.

<div class="class">
    This is <b>HTML</b>
</div>

Paragraph in Markdown.
[/prism]





## Emphasis

### Bold
For emphasizing a snippet of text with a heavier font-weight.

The following snippet of text is **rendered as bold text**.

[prism classes="language-markdown"]
**rendered as bold text**
[/prism]
renders to:

**rendered as bold text**

and this HTML:

[prism classes="language-html"]
<strong>rendered as bold text</strong>
[/prism]

### Italics
For emphasizing a snippet of text with italics.

The following snippet of text is _rendered as italicized text_.

[prism classes="language-markdown"]
_rendered as italicized text_
[/prism]

renders to:

_rendered as italicized text_

and this HTML:

[prism classes="language-html"]
<em>rendered as italicized text</em>
[/prism]


### Strikethrough
In GFM (GitHub flavored Markdown) you can do strikethroughs.

[prism classes="language-markdown"]
~~Strike through this text.~~
[/prism]
Which renders to:

~~Strike through this text.~~

HTML:

[prism classes="language-html"]
<del>Strike through this text.</del>
[/prism]




## Blockquotes
For quoting blocks of content from another source within your document.

Add `>` before any text you want to quote.

[prism classes="language-markdown"]
> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.
[/prism]

Renders to:

> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.

and this HTML:

[prism classes="language-html"]
<blockquote>
  <p><strong>Fusion Drive</strong> combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.</p>
</blockquote>
[/prism]

Blockquotes can also be nested:

[prism classes="language-markdown"]
> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
[/prism]

Renders to:

> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.




## Notices

! The old mechanism for notices overriding the block quote syntax (`>>>`) has been deprecated.  Notices are now handled via a dedicated plugin called [Markdown Notices](https://github.com/getgrav/grav-plugin-markdown-notices)



## Lists

### Unordered
A list of items in which the order of the items does not explicitly matter.

You may use any of the following symbols to denote bullets for each list item:

[prism classes="language-markdown"]
* valid bullet
- valid bullet
+ valid bullet
[/prism]

For example

[prism classes="language-markdown"]
+ Lorem ipsum dolor sit amet
+ Consectetur adipiscing elit
+ Integer molestie lorem at massa
+ Facilisis in pretium nisl aliquet
+ Nulla volutpat aliquam velit
  - Phasellus iaculis neque
  - Purus sodales ultricies
  - Vestibulum laoreet porttitor sem
  - Ac tristique libero volutpat at
+ Faucibus porta lacus fringilla vel
+ Aenean sit amet erat nunc
+ Eget porttitor lorem
[/prism]

Renders to:

+ Lorem ipsum dolor sit amet
+ Consectetur adipiscing elit
+ Integer molestie lorem at massa
+ Facilisis in pretium nisl aliquet
+ Nulla volutpat aliquam velit
  - Phasellus iaculis neque
  - Purus sodales ultricies
  - Vestibulum laoreet porttitor sem
  - Ac tristique libero volutpat at
+ Faucibus porta lacus fringilla vel
+ Aenean sit amet erat nunc
+ Eget porttitor lorem

And this HTML

[prism classes="language-html"]
<ul>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit
    <ul>
      <li>Phasellus iaculis neque</li>
      <li>Purus sodales ultricies</li>
      <li>Vestibulum laoreet porttitor sem</li>
      <li>Ac tristique libero volutpat at</li>
    </ul>
  </li>
  <li>Faucibus porta lacus fringilla vel</li>
  <li>Aenean sit amet erat nunc</li>
  <li>Eget porttitor lorem</li>
</ul>
[/prism]

### Ordered

A list of items in which the order of items does explicitly matter.

[prism classes="language-markdown"]
1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem
[/prism]

Renders to:

1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem

And this HTML:

[prism classes="language-html"]
<ol>
  <li>Lorem ipsum dolor sit amet</li>
  <li>Consectetur adipiscing elit</li>
  <li>Integer molestie lorem at massa</li>
  <li>Facilisis in pretium nisl aliquet</li>
  <li>Nulla volutpat aliquam velit</li>
  <li>Faucibus porta lacus fringilla vel</li>
  <li>Aenean sit amet erat nunc</li>
  <li>Eget porttitor lorem</li>
</ol>
[/prism]

**TIP**: If you just use `1.` for each number, Markdown will automatically number each item. For example:

[prism classes="language-markdown"]
1. Lorem ipsum dolor sit amet
1. Consectetur adipiscing elit
1. Integer molestie lorem at massa
1. Facilisis in pretium nisl aliquet
1. Nulla volutpat aliquam velit
1. Faucibus porta lacus fringilla vel
1. Aenean sit amet erat nunc
1. Eget porttitor lorem
[/prism]

Renders to:

1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem





## Code

### Inline code
Wrap inline snippets of code with `` ` ``.

[prism classes="language-markdown"]
In this example, `<section></section>` should be wrapped as **code**.
[/prism]

Renders to:

In this example, `<section></section>` should be wrapped with **code**.

HTML:

[prism classes="language-html"]
<p>In this example, <code>&lt;section&gt;&lt;/section&gt;</code> should be wrapped with <strong>code</strong>.</p>
[/prism]

### Indented code

Or indent several lines of code by at least four spaces, as in:

<pre>
  // Some comments
  line 1 of code
  line 2 of code
  line 3 of code
</pre>

Renders to:

[prism classes="language-txt"]
// Some comments
line 1 of code
line 2 of code
line 3 of code
[/prism]

HTML:

[prism classes="language-html"]
<pre>
  <code>
    // Some comments
    line 1 of code
    line 2 of code
    line 3 of code
  </code>
</pre>
[/prism]


### Block code "fences"

Use "fences"  ```` ``` ```` to block in multiple lines of code with a language attribute

<pre>
```
Sample text here...
```
</pre>

HTML:

[prism classes="language-html"]
<pre language-html>
  <code>Sample text here...</code>
</pre>
[/prism]

### Syntax highlighting

GFM, or "GitHub Flavored Markdown" also supports syntax highlighting. To activate it, simply add the file extension of the language you want to use directly after the first code "fence", ` ```js `, and syntax highlighting will automatically be applied in the rendered HTML. For example, to apply syntax highlighting to JavaScript code:

<pre>
```js
grunt.initConfig({
  assemble: {
    options: {
      assets: 'docs/assets',
      data: 'src/data/*.{json,yml}',
      helpers: 'src/custom-helpers.js',
      partials: ['src/partials/**/*.{hbs,md}']
    },
    pages: {
      options: {
        layout: 'default.hbs'
      },
      files: {
        './': ['src/templates/pages/index.hbs']
      }
    }
  }
};
```
</pre>

Renders to:

[prism classes="language-js"]
grunt.initConfig({
  assemble: {
    options: {
      assets: 'docs/assets',
      data: 'src/data/*.{json,yml}',
      helpers: 'src/custom-helpers.js',
      partials: ['src/partials/**/*.{hbs,md}']
    },
    pages: {
      options: {
        layout: 'default.hbs'
      },
      files: {
        './': ['src/templates/pages/index.hbs']
      }
    }
  }
};
[/prism]

!!! For syntax highlighting to work, the [Highlight plugin](https://github.com/getgrav/grav-plugin-highlight) needs to be installed and enabled. It in turn utilizes a jquery plugin, so jquery needs to be loaded in your theme too.





## Tables
Tables are created by adding pipes as dividers between each cell, and by adding a line of dashes (also separated by bars) beneath the header. Note that the pipes do not need to be vertically aligned.


[prism classes="language-markdown"]
| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/prism]

Renders to:

[div class="table"]
| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/div]

And this HTML:

[prism classes="language-html"]
<table>
  <thead>
    <tr>
      <th>Option</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>data</td>
      <td>path to data files to supply the data that will be passed into templates.</td>
    </tr>
    <tr>
      <td>engine</td>
      <td>engine to be used for processing templates. Handlebars is the default.</td>
    </tr>
    <tr>
      <td>ext</td>
      <td>extension to be used for dest files.</td>
    </tr>
  </tbody>
</table>
[/prism]

### Right aligned text

Adding a colon on the right side of the dashes below any heading will right align text for that column.

[prism classes="language-markdown"]
| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/prism]

[div class="table"]
| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/div]





## Links

### Basic link

[prism classes="language-markdown"]
[Assemble](https://assemble.io)
[/prism]

Renders to (hover over the link, there is no tooltip):

[Assemble](https://assemble.io)

HTML:

[prism classes="language-html"]
<a href="https://assemble.io">Assemble</a>
[/prism]


### Add a title

[prism classes="language-markdown"]
[Upstage](https://github.com/upstage/ "Visit Upstage!")
[/prism]

Renders to (hover over the link, there should be a tooltip):

[Upstage](https://github.com/upstage/ "Visit Upstage!")

HTML:

[prism classes="language-html"]
<a href="https://github.com/upstage/" title="Visit Upstage!">Upstage</a>
[/prism]

### Named Anchors

Named anchors enable you to jump to the specified anchor point on the same page. For example, each of these chapters:

[prism classes="language-markdown"]
# Table of Contents
  * [Chapter 1](#chapter-1)
  * [Chapter 2](#chapter-2)
  * [Chapter 3](#chapter-3)
[/prism]
will jump to these sections:

[prism classes="language-markdown"]
## Chapter 1 <a id="chapter-1"></a>
Content for chapter one.

## Chapter 2 <a id="chapter-2"></a>
Content for chapter one.

## Chapter 3 <a id="chapter-3"></a>
Content for chapter one.
[/prism]

**NOTE** that specific placement of the anchor tag seems to be arbitrary. They are placed inline here since it seems to be unobtrusive, and it works.





## Images
Images have a similar syntax to links but include a preceding exclamation point.

[prism classes="language-markdown"]
![Minion](https://octodex.github.com/images/minion.png)
[/prism]
![Minion](https://octodex.github.com/images/minion.png)

or:

[prism classes="language-markdown"]
![Alt text](https://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")
[/prism]
![Alt text](https://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")

Like links, images also have a footnote style syntax:

[prism classes="language-markdown"]
![Alt text][id]
[/prism]
![Alt text][id]

With a reference later in the document defining the URL location:

[id]: https://octodex.github.com/images/dojocat.jpg  "The Dojocat"


    [id]: https://octodex.github.com/images/dojocat.jpg  "The Dojocat"
