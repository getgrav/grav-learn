---
title: Markdown Syntax
description: Learn about Markdown Syntax in Grav
page-toc:
  active: true
taxonomy:
    category: docs
---
# Markdown Syntax

Let's face it: Writing content for the Web is tiresome. WYSIWYG editors help alleviate this task, but they generally result in horrible code, or worse yet, ugly web pages.

**Markdown** is a better way to write **HTML**, without all the complexities and ugliness that usually accompanies it.

===

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

> [!NOTE]
> **New in Grav 2.0** — Markdown rendering gained a fuller [GitHub Flavored Markdown](https://github.github.com/gfm/) feature set that is **enabled by default**: [task lists](#task-lists), [highlight](#highlight)/[subscript](#subscript)/[superscript](#superscript) marks, automatic [linking of bare `www.` and email addresses](#automatic-links), and escaping of disallowed raw HTML tags. A set of opt-in [enhanced table extensions](#enhanced-tables) — colspan, header-less, captions, attributes, and multi-line cells — is also available. All of it is configurable; see [Configuration](#configuration).

Without further delay, let us go over the main elements of Markdown and what the resulting HTML looks like:

> [!CAUTION]
> <i class="fa fa-bookmark"></i> Bookmark this page for easy future reference!

## Headings

Headings from `h1` through `h6` are constructed with a `#` for each level:

[codesh=markdown]
# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading
[/codesh]

Renders to:

# h1 Heading
## h2 Heading
### h3 Heading
#### h4 Heading
##### h5 Heading
###### h6 Heading

HTML:

[codesh=html]
<h1>h1 Heading</h1>
<h2>h2 Heading</h2>
<h3>h3 Heading</h3>
<h4>h4 Heading</h4>
<h5>h5 Heading</h5>
<h6>h6 Heading</h6>
[/codesh]

## Comments

Comments should be HTML compatible

[codesh=html]
<!--
This is a comment
-->
[/codesh]

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

[codesh=markdown]
Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.
[/codesh]

renders to this HTML:

[codesh=html]
<p>Lorem ipsum dolor sit amet, graecis denique ei vel, at duo primis mandamus. Et legere ocurreret pri, animal tacimates complectitur ad cum. Cu eum inermis inimicus efficiendi. Labore officiis his ex, soluta officiis concludaturque ei qui, vide sensibus vim ad.</p>
[/codesh]

A **line break** can be done with 2 spaces followed by 1 return.

## Inline HTML

If you need a certain HTML tag (with a class) you can simply use HTML:

[codesh=html]
Paragraph in Markdown.

<div class="class">
    This is <b>HTML</b>
</div>

Paragraph in Markdown.
[/codesh]

> [!NOTE]
> **Grav 2.0** escapes a small denylist of "disallowed raw HTML" tags in your content — `title`, `textarea`, `style`, `xmp`, `iframe`, `noembed`, `noframes`, `script`, and `plaintext` — so they render as visible text rather than active markup, matching GitHub Flavored Markdown's `tagfilter`. This is a convenience to avoid accidental breakage, not a security boundary; broad HTML sanitization remains the job of your site's security layer. It can be turned off under [Configuration](#configuration).

## Emphasis

### Bold

For emphasizing a snippet of text with a heavier font-weight.

The following snippet of text is **rendered as bold text**.

[codesh=markdown]
**rendered as bold text**
[/codesh]

renders to:

**rendered as bold text**

and this HTML:

[codesh=html]
<strong>rendered as bold text</strong>
[/codesh]

### Italics

For emphasizing a snippet of text with italics.

The following snippet of text is _rendered as italicized text_.

[codesh=markdown]
_rendered as italicized text_
[/codesh]

renders to:

_rendered as italicized text_

and this HTML:

[codesh=html]
<em>rendered as italicized text</em>
[/codesh]

### Strikethrough

In GFM (GitHub flavored Markdown) you can do strikethroughs.

[codesh=markdown]
~~Strike through this text.~~
[/codesh]

Which renders to:

~~Strike through this text.~~

HTML:

[codesh=html]
<del>Strike through this text.</del>
[/codesh]

### Highlight

> [!NOTE]
> Highlight, subscript, and superscript marks are **new in Grav 2.0** and are enabled by default.

Wrap text in double equals signs to mark it as highlighted, which renders as an HTML `<mark>` element.

[codesh=markdown]
Markdown makes ==certain words stand out==.
[/codesh]

Renders to:

Markdown makes ==certain words stand out==.

HTML:

[codesh=html]
<p>Markdown makes <mark>certain words stand out</mark>.</p>
[/codesh]

### Subscript

Wrap text in single tildes for subscript, which renders as a `<sub>` element. A single `~text~` is subscript while a double `~~text~~` remains [strikethrough](#strikethrough), so the two never collide.

[codesh=markdown]
The chemical formula for water is H~2~O.
[/codesh]

Renders to:

The chemical formula for water is H~2~O.

HTML:

[codesh=html]
<p>The chemical formula for water is H<sub>2</sub>O.</p>
[/codesh]

### Superscript

Wrap text in single carets for superscript, which renders as a `<sup>` element.

[codesh=markdown]
Einstein's famous equation is E = mc^2^.
[/codesh]

Renders to:

Einstein's famous equation is E = mc^2^.

HTML:

[codesh=html]
<p>Einstein's famous equation is E = mc<sup>2</sup>.</p>
[/codesh]

## Blockquotes

For quoting blocks of content from another source within your document.

Add `>` before any text you want to quote.

[codesh=markdown]
> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.
[/codesh]

Renders to:

> **Fusion Drive** combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.

and this HTML:

[codesh=html]
<blockquote>
  <p><strong>Fusion Drive</strong> combines a hard drive with a flash storage (solid-state drive) and presents it as a single logical volume with the space of both drives combined.</p>
</blockquote>
[/codesh]

Blockquotes can also be nested:

[codesh=markdown]
> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.
[/codesh]

Renders to:

> Donec massa lacus, ultricies a ullamcorper in, fermentum sed augue.
Nunc augue augue, aliquam non hendrerit ac, commodo vel nisi.
>> Sed adipiscing elit vitae augue consectetur a gravida nunc vehicula. Donec auctor
odio non est accumsan facilisis. Aliquam id turpis in dolor tincidunt mollis ac eu diam.

## Notices

> [!WARNING]
> The old mechanism for notices overriding the block quote syntax (`>>>`) has been deprecated.  Notices are now handled via a dedicated plugin called [Markdown Notices](https://github.com/getgrav/grav-plugin-markdown-notices)

## Lists

### Unordered

A list of items in which the order of the items does not explicitly matter.

You may use any of the following symbols to denote bullets for each list item:

[codesh=markdown]
* valid bullet
- valid bullet
+ valid bullet
[/codesh]

For example

[codesh=markdown]
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
[/codesh]

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

[codesh=html]
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
[/codesh]

### Ordered

A list of items in which the order of items does explicitly matter.

[codesh=markdown]
1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem
[/codesh]

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

[codesh=html]
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
[/codesh]

**TIP**: If you just use `1.` for each number, Markdown will automatically number each item. For example:

[codesh=markdown]
1. Lorem ipsum dolor sit amet
1. Consectetur adipiscing elit
1. Integer molestie lorem at massa
1. Facilisis in pretium nisl aliquet
1. Nulla volutpat aliquam velit
1. Faucibus porta lacus fringilla vel
1. Aenean sit amet erat nunc
1. Eget porttitor lorem
[/codesh]

Renders to:

1. Lorem ipsum dolor sit amet
2. Consectetur adipiscing elit
3. Integer molestie lorem at massa
4. Facilisis in pretium nisl aliquet
5. Nulla volutpat aliquam velit
6. Faucibus porta lacus fringilla vel
7. Aenean sit amet erat nunc
8. Eget porttitor lorem

### Task Lists

> [!NOTE]
> Task lists are **new in Grav 2.0** and are enabled by default.

Add `[ ]` (incomplete) or `[x]` (complete) immediately after a list marker to render the item as a checkbox, following GitHub Flavored Markdown.

[codesh=markdown]
- [x] Write the documentation
- [x] Review the examples
- [ ] Ship it
[/codesh]

Renders to:

- [x] Write the documentation
- [x] Review the examples
- [ ] Ship it

HTML:

[codesh=html]
<ul>
  <li class="task-list-item"><input type="checkbox" disabled="" checked="" /> Write the documentation</li>
  <li class="task-list-item"><input type="checkbox" disabled="" checked="" /> Review the examples</li>
  <li class="task-list-item"><input type="checkbox" disabled="" /> Ship it</li>
</ul>
[/codesh]

The checkboxes are rendered read-only (`disabled`), and each `<li>` gets a `task-list-item` class so you can style task lists in your theme.

## Code

### Inline code

Wrap inline snippets of code with `` ` ``.

[codesh=markdown]
In this example, `<section></section>` should be wrapped as **code**.
[/codesh]

Renders to:

In this example, `<section></section>` should be wrapped with **code**.

HTML:

[codesh=html]
<p>In this example, <code>&lt;section&gt;&lt;/section&gt;</code> should be wrapped with <strong>code</strong>.</p>
[/codesh]

### Indented code

Or indent several lines of code by at least four spaces, as in:

<pre>
  // Some comments
  line 1 of code
  line 2 of code
  line 3 of code
</pre>

Renders to:

[codesh=txt]
// Some comments
line 1 of code
line 2 of code
line 3 of code
[/codesh]

HTML:

[codesh=html]
<pre>
  <code>
    // Some comments
    line 1 of code
    line 2 of code
    line 3 of code
  </code>
</pre>
[/codesh]

### Block code "fences"

Use "fences"  ```` ``` ```` to block in multiple lines of code with a language attribute

<pre>
```
Sample text here...
```
</pre>

HTML:

[codesh=html]
<pre language-html>
  <code>Sample text here...</code>
</pre>
[/codesh]

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

[codesh=js]
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
[/codesh]

> [!NOTE]
> For syntax highlighting to work, the [Highlight plugin](https://github.com/getgrav/grav-plugin-highlight) needs to be installed and enabled. It in turn utilizes a jquery plugin, so jquery needs to be loaded in your theme too.

## Tables

Tables are created by adding pipes as dividers between each cell, and by adding a line of dashes (also separated by bars) beneath the header. Note that the pipes do not need to be vertically aligned.

[codesh=markdown]
| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/codesh]

Renders to:

[div class="table"]
| Option | Description |
| ------ | ----------- |
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/div]

And this HTML:

[codesh=html]
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
[/codesh]

### Right aligned text

Adding a colon on the right side of the dashes below any heading will right align text for that column.

[codesh=markdown]
| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/codesh]

[div class="table"]
| Option | Description |
| ------:| -----------:|
| data   | path to data files to supply the data that will be passed into templates. |
| engine | engine to be used for processing templates. Handlebars is the default. |
| ext    | extension to be used for dest files. |
[/div]

### Enhanced Tables

Grav 2.0 adds five **opt-in** table extensions. They are all **off by default**, so a standard table is never changed unless you turn one on — globally under [Configuration](#configuration), or per page in the page's front matter:

[codesh=yaml]
markdown:
  tables:
    colspan: true
    headerless: true
    captions: true
    attributes: true
    multiline: true
[/codesh]

#### Colspan

Leave a cell empty and it merges into the cell on its left, increasing that cell's `colspan` (the MultiMarkdown convention).

[codesh=markdown]
| Item    | Jan | Feb | Mar |
| :--     | --: | --: | --: |
| Widgets | 10  | 12  | 9   |
| Total for the quarter |   |   | 57 |
[/codesh]

The last row's label spans the first three columns:

[codesh=html]
<tr>
  <td style="text-align: left;" colspan="3">Total for the quarter</td>
  <td style="text-align: right;">57</td>
</tr>
[/codesh]

#### Header-less

Start a table directly at the divider row to produce a `<tbody>`-only table with no header.

[codesh=markdown]
| --- | --- |
| Mercury | Closest to the Sun |
| Neptune | Furthest from the Sun |
[/codesh]

[codesh=html]
<table>
  <tbody>
    <tr><td>Mercury</td><td>Closest to the Sun</td></tr>
    <tr><td>Neptune</td><td>Furthest from the Sun</td></tr>
  </tbody>
</table>
[/codesh]

#### Captions

A `[Caption]` line immediately after a table becomes a `<caption>` (rendered as the table's first child). Inline Markdown inside the caption is parsed.

[codesh=markdown]
| Symbol | Element |
| --- | --- |
| H | Hydrogen |
| He | Helium |
[The first two elements of the periodic table]
[/codesh]

[codesh=html]
<table>
  <caption>The first two elements of the periodic table</caption>
  <thead>...</thead>
  <tbody>...</tbody>
</table>
[/codesh]

#### Attributes

A `{.class #id}` line immediately after a table sets the `class` and `id` on the `<table>` element — handy for CSS frameworks that style classes like `.striped` or `.responsive`. The kramdown-style `{:.class}` form (with a leading colon) is accepted too. Only `class` and `id` are recognized; any other token leaves the line untouched.

[codesh=markdown]
| Name | Role |
| --- | --- |
| Ada | Engineer |
| Grace | Architect |
{.striped .responsive #team-table}
[/codesh]

[codesh=html]
<table class="striped responsive" id="team-table">
  ...
</table>
[/codesh]

#### Multi-line cells

End a row with a backslash (`\`) and the next line continues it: the following line's cells are merged column-wise into the row above, each joined with a `<br>`. An empty continuation cell adds nothing, so you can carry just one column onto the next line.

[codesh=markdown]
| Feature | Description |
| --- | --- |
| Tables | Alignment, escaped pipes, \
| | and inline cell content |
| Lists | Ordered, unordered and task lists |
[/codesh]

[codesh=html]
<tr>
  <td>Tables</td>
  <td>Alignment, escaped pipes,<br>and inline cell content</td>
</tr>
[/codesh]

## Links

### Basic link

[codesh=markdown]
[Assemble](https://assemble.io)
[/codesh]

Renders to (hover over the link, there is no tooltip):

[Assemble](https://assemble.io)

HTML:

[codesh=html]
<a href="https://assemble.io">Assemble</a>
[/codesh]

### Add a title

[codesh=markdown]
[Upstage](https://github.com/upstage/ "Visit Upstage!")
[/codesh]

Renders to (hover over the link, there should be a tooltip):

[Upstage](https://github.com/upstage/ "Visit Upstage!")

HTML:

[codesh=html]
<a href="https://github.com/upstage/" title="Visit Upstage!">Upstage</a>
[/codesh]

### Named Anchors

Named anchors enable you to jump to the specified anchor point on the same page. For example, each of these chapters:

[codesh=markdown]
# Table of Contents
  * [Chapter 1](#chapter-1)
  * [Chapter 2](#chapter-2)
  * [Chapter 3](#chapter-3)
[/codesh]

will jump to these sections:

[codesh=markdown]
## Chapter 1 <a id="chapter-1"></a>
Content for chapter one.

## Chapter 2 <a id="chapter-2"></a>
Content for chapter one.

## Chapter 3 <a id="chapter-3"></a>
Content for chapter one.
[/codesh]

**NOTE** that specific placement of the anchor tag seems to be arbitrary. They are placed inline here since it seems to be unobtrusive, and it works.

### Automatic Links

> [!NOTE]
> Autolinking of bare `www.` URLs and email addresses is **new in Grav 2.0** (GitHub Flavored Markdown autolinks) and is enabled by default. Bare `http(s)://` URLs are handled separately by the **Auto URL Links** option, which remains off by default.

Bare `www.` URLs and email addresses are turned into links automatically, with no markup required:

[codesh=markdown]
Visit www.getgrav.org or email hello@getgrav.org.
[/codesh]

Renders to:

Visit www.getgrav.org or email hello@getgrav.org.

HTML:

[codesh=html]
<p>Visit <a href="http://www.getgrav.org">www.getgrav.org</a> or email <a href="mailto:hello@getgrav.org">hello@getgrav.org</a>.</p>
[/codesh]

## Images

Images have a similar syntax to links but include a preceding exclamation point.

[codesh=markdown]
![Minion](https://octodex.github.com/images/minion.png)
[/codesh]
![Minion](https://octodex.github.com/images/minion.png)

or:

[codesh=markdown]
![Alt text](https://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")
[/codesh]
![Alt text](https://octodex.github.com/images/stormtroopocat.jpg "The Stormtroopocat")

Like links, images also have a footnote style syntax:

[codesh=markdown]
![Alt text][id]
[/codesh]
![Alt text][id]

With a reference later in the document defining the URL location:

[id]: https://octodex.github.com/images/dojocat.jpg  "The Dojocat"


    [id]: https://octodex.github.com/images/dojocat.jpg  "The Dojocat"

## Configuration

Markdown rendering is configured under **Configuration → System → Markdown** in the Admin panel, or in `user/config/system.yaml` under the `pages.markdown` key. Any option can also be overridden per page in the page's front matter under a `markdown:` key. The defaults are:

[codesh=yaml]
pages:
  markdown:
    extra: false              # Enable Markdown Extra
    auto_line_breaks: false   # Treat a single newline as a <br>
    auto_url_links: false     # Autolink bare http(s):// URLs
    escape_markup: false      # Escape inline HTML into entities
    gfm:                      # GitHub Flavored Markdown - on by default
      task_lists: true        # - [ ] / - [x] checkboxes
      marks: true             # ==highlight==, ~subscript~, ^superscript^
      tagfilter: true         # Escape disallowed raw HTML tags
      autolinks: true         # Autolink bare www. URLs and emails
    tables:                   # Enhanced table extensions - off by default
      colspan: false          # Empty cell merges into the cell on its left
      headerless: false       # Table may start at the divider row
      captions: false         # [Caption] line after a table becomes <caption>
      attributes: false       # {.class #id} line after a table sets attributes
      multiline: false        # Row ending in \ continues onto the next line
[/codesh]

The `gfm` options change how existing content renders (checkboxes, `<mark>`/`<sub>`/`<sup>`, autolinked URLs, escaped raw HTML), so each can be switched off individually if you need the previous behavior. The `tables` extensions are all off by default and never affect a standard table unless you opt in.

> [!TIP]
> Plugin developers can add their own Markdown syntax — custom blocks and inline marks — through the [Markdown Extensions API](../../plugins/markdown-extensions).
