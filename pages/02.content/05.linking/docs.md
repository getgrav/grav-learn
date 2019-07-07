---
title: Page Linking
taxonomy:
    category: docs
---

Grav has a variety of flexible linking options that allow you to link from one page to another, and even to remote pages. If you have ever linked files using HTML or worked with a file system using a command line, a lot of this should be very easy to pick up.

We will run to some easy examples using this very basic, trimmed down model of what a Grav site's **Pages** directory might look like.

![Pages Directory](pages.jpg)

Using this directory structure as an example, we will take a look at the different types of links you can use in your content.

To get us started, here is a quick look at some of the common components of a Grav link, and what they mean.

```markdown
[Linked Content](../path/slug/page)
```

[div class="table-keycol"]
| String | Description |
| :----- | :----- |
| `[]`   | The square bracket is used to wrap the text or alternate content that becomes linked. In HTML, this would be the content placed between `<a href="">` and `</a>`. |
| `()`   | The parenthesis is used to surround the link itself. This is placed directly after the square bracket. |
| `../`  | When used in the link, it indicates a move up a directory. |
[/div]

### Slug Relative

Grav doesn't just limit your internal links to specific names within your file/directory structure. It can also pull slugs assigned both in the header of the file, as well as the fallback directory name. This makes creating quick links easy as you don't have to remember the specific file name, but an easily remembered (and relevant) slug.

Grav's templating engine uses file names to determine which template to apply to them. For example, a blog might use the standard file name `item.md` for each blog post. The blog post itself can be assigned a slug that makes more sense, such as `grass` or `grass-is-green`.

Directory names also have numbers assigned which helps with ordering. You don't have to include these numbers with slug-relative links. Grav ignores them when creating the slug, so your site's URL structure is cleaner.

Here are a few examples of slug-relative links.

In this example, we're moving up a directory and loading the default page located in the `pages/01.blue/02.water/item.md` directory from `pages/01.blue/01.sky/item.md`. The file, `item.md`, has no assigned slug, so Grav uses the directory name.

```markdown
[link](../water)
```

This next example does a very similar thing, linking from `pages/01.blue/01.sky/item.md` to `pages/02.green/02.tree/item.md`, but when loading the `item.md` file, a slug has been assigned to the file of `tree-is-green`.

```markdown
[link](../../green/tree-is-green)
```

The slug placed in the header of `item.md` replaces the `green` slug from the defaulting folder name.

### Directory relative

**Directory Relative** links use destinations set relative to the current page. This can be as simple as linking to another file in the current directory, such as an image file, or as complex as going up several directory levels and then back down to the specific folder/file you need to have displayed.

With relative links, the location of the source file is every bit as important as that of the destination. If either file in the mix is moved, changing the path between them, the link can be broken.

The advantage of this type of linking structure is that you can easily switch between a local development server and a live server with a different domain name and as long as the file structure remains consistent, the links should work without a problem.

A file link points to a particular file by name, rather than its directory or slug. If you were creating a link from `pages/01.blue/01.sky/item.md` to `/pages/02.green/01.grass/item.md` you would use the following command.

```markdown
[link](../../02.green/01.grass/item.md)
```

This link moves up two folders, as indicated by `../../`, and then down two folders, pointing directly to `item.md` as the destination.

Sometimes, you just want to direct the user up a single directory, loading the default page. Since an exact file is not indicated, Grav is trusted to choose the right one to load. For a well-organized Grav site, this should be no problem.

In this example, we will be linking `pages/01.blue/01.sky/item.md` to `/pages/02.green/` which would load the `color.md` file by default.

```markdown
[link](../../02.green)
```

If you want to link to a directory two steps up, you can do so using this process. 

The next example is a lot like the file link we demonstrated earlier. Instead of linking directly to the file, we're linking to its directory, which should load the file we want anyway since it's the default file. If you were creating a link from `pages/01.blue/01.sky/item.md` to `/pages/02.green/01.grass/` you would use the following command.

```markdown
[link](../../02.green/01.grass)
```

### Absolute

Absolute links are similar to relative links, but are relative to the root of the site. In **Grav**, this is typically based in your **/user/pages/** directory. This type of link can be done in two different ways.

You can do it in a similar fashion to the **Slug Relative** style which uses the slug, or directory name in the path for simplicity. This method removes potential issues of order changes later on (changing the number at the beginning of the folder name) breaking the link. This would be the most commonly used method of absolute linking.

In an absolute link, the link opens with a `/`. Here is an example of an absolute link made to `pages/01.blue/01.sky/item.md` in the **Slug** style.

```markdown
[link](/blue/sky)
```

The second method is fashioned after the **Directory Relative** style detailed previously. This method leaves in elements like the ordering numbers at the beginning of directory names. While this does add the potential of a broken link when content is reordered, it is more reliable when used with services like [Github](https://github.com) where content links do not have the benefit of Grav's flexibility. Here is an example of an absolute link made to `pages/01.blue/01.sky/item.md` using this style.

```markdown
[link](/01.blue/01.sky)
```

### Remote

Remote links enable you to link directly to pretty much any file or document out there via its URL. This doesn't have to include your own site's content, but it can. Here is an example of how you would link to Google's home page.

```markdown
[link](http://www.google.com)
```

You can link to pretty much any direct URL, including secured HTTPS links. For example:

```markdown
[link](https://github.com)
```

### Link Attributes

A great new feature you can take advantage of is providing link attributes directly via the markdown syntax. This allows you to easily add **class**, **id**, **rel**, and **target** HTML attributes without the need of [Markdown Extra](https://michelf.ca/projects/php-markdown/extra/).

Some examples of this are:

##### Class/Classes Attribute

```markdown
[Big Button](../some-page?classes=button,big)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page" class="button big">Big Button</a>
```

##### ID Attribute

```markdown
[Unique Button](../some-page?id=important-button)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page" id="important-button">Unique Button</a>
```

##### Rel Attribute

```markdown
[NoFollow Link](../some-page?rel=nofollow)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page" rel="nofollow">NoFollow Link</a>
```

##### Target Attribute

```markdown
[Link in new Tab](../some-page?target=_blank)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page" target="_blank">Link in new Tab</a>
```

##### Attribute Combinations

```markdown
[Combinations of Attributes](../some-page?target=_blank&classes=button)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page" target="_blank" class="button">Combinations of Attributes</a>
```

##### Attribute Combinations with Anchors

```markdown
[Element Anchor](../some-page?target=_blank&classes=button#element-id)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page#element-id" target="_blank" class="button">Element Anchor</a>
```

##### Pass-through of Non-Supported Attributes

```markdown
[Pass-through of 'cat' attribute](../some-page?classes=underline&cat=black)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page?cat=black" class="underline">Pass-through of 'cat' attribute</a>
```

##### Pass-through Supported Attributes

```markdown
[Pass-through all attributes](../some-page?classes=underline&rel=nofollow&noprocess)
```

which will result in HTML similar to:

```html
<a href="/your/pages/some-page?rel=nofollow&classes=underline">Pass-through all attributes</a>
```

