---
title: Image Linking
taxonomy:
    category: docs
---

Grav has a variety of flexible linking options that allow you to link images from one page to another, and even from remote sources. If you have ever linked files using HTML or worked with a file system using a command line, a lot of this should be very easy to pick up.

We will run to some easy examples using this very basic, trimmed down model of what a Grav site's **Pages** directory might look like.

![Pages Directory](pages.png)

Using this directory structure as an example, we will take a look at the different types of links you can use to display media files in your content. We have image files in every folder, including one image for each blog post, and three images in a special `/images` directory which acts as a page, but contains only media files. 

The use of the `/images` folder serves as an example of how you can maintain a simple centralized image directory to store files that are frequently used by multiple pages. This simplifies the linking process in these cases.

>>>> If you decide to use a centralized image directory, be advised that this directory should exist within the `/pages` folder as this folder is intended for front-facing content.

To get us started, here is a quick look at some of the common components of a Grav link, and what they mean.

| String |                                                                           Description                                                                            |
| :----- | :--------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `[]`   | The square bracket is used to wrap the text or alternate content that becomes linked. In HTML, this would be the content placed between `<a href="">` and `</a>` |
| `()`   | The parenthesis is used to surround the link itself. This is placed directly after the square bracket.                                                           |
| `../`  | When used in the link, it indicates a move up a directory.                                                                                                       |
| `!`    | When placed at the beginning of a link, it indicates that content contained within should be loaded into the page, such as an image file.                        |

### Slug Relative

**Relative** links use destinations set relative to the current page. This can be as simple as linking to another file in the current directory, such as an image file, or as complex as going up several directory levels and then back down to the specific folder/file you need to have displayed. 

With relative links, the location of the source file is every bit as important as that of the destination. If either file in the mix is moved, changing the path between them, the link can be broken.

The advantage of this type of linking structure is that you can easily switch between a local development server and a live server with a different domain name and as long as the file structure remains consistent, the links should work without a problem.

A file link points to a particular file by name, rather than its directory or slug. If you were creating a link from `pages/01.blog/test-post-1/item.md` to `/pages/01.blog/test-post-3/test_image_3.jpg` you would use the following command.

```markdown
![Test Image 3](../test-post-3/test_image_3.jpg)
```

This link moves up one folder, as indicated by `../`, and then down one folder, pointing directly to `test_image_3.jpg` as the destination.

If we want to load `blog-header.jpg` from the `01.blog` directory, we would do the following:

```markdown
![Blog Header](../../blog/blog-header.jpg)
```

>>>>> You do not need to include ordering numerals (`01.`) for relative links. 

Grav has integrated support for slugs in the header of the page's primary markdown file. This slug superseedes the folder name for the page, and any media files contained within. 

For example, **Test Post 2** has a slug set through its markdown file (`/pages/01.blog/test-post-2/item.md`). The header of this file contains the following:

```yaml
---
title: Test Post 2
slug: test-slug
taxonomy:
    category: blog
---
```

You will notice the slug `test-slug` has been set. Slugs set this way are completely optional, and do not have to be present. As mentioned in the last chapter, they do provide an easy way of linking. If a slug is set, then any link you make to a media file within that folder will have to be either **Slug Relative** or **Absolute** with a full URL set for the link.

If we want to link `test_image_2.jpg` from **Test Post 1**, we would enter the following:

```markdown
![Test Image 2](../test-slug/test_image_2.jpg)
```

You will notice that we navigated up one directory using (`../`) and then to the `test-slug` page folder using the slug which was set in `/pages/01.blog/test-post-2/item.md` file.

### Absolute

Absolute links are similar to relative links, but are relative to the root of the site. In **Grav**, this is typically based in your **/user/pages/** directory. This type of link can be done in two different ways. 

You can do it in a similar fashion to the **Slug Relative** style which uses the slug, or directory name in the path for simplicity. This method removes potential issues of order changes later on (changing the number at the beginning of the folder name) breaking the link. This would be the most commonly used method of absolute linking.

In an absolute link, the link opens with a `/`. Here is an example of an absolute link made to `pages/01.blog/test-post-2/test_image_2.jpg` in the **Slug** style from `pages/01.blog/blog.md`. 

```markdown
![Test Image 2](/blog/test-slug/test_image_2.jpg)
```

### Remote 

Remote image links enable you to directly display pretty much any media file via its URL. This doesn't have to include your own site's content, but it can. Here is an example of how you would display to a remote image file.

```markdown
![Remote Image 1](http://getgrav.org/images/testimage.png)
```

You can link to pretty much any direct URL, including secured HTTPS links.

### Styling

You can also style files, even if they have been linked remotely using one of the methods described in this page. For example, here is a line you would use to load an image from `/pages/01.blog/test-post-3/test_image_3.jpg` from `/pages/01.blog/test-post-1/test_image_1.jpg`

```markdown
![Styling Example](../test-post-3/test_image_3.jpg?resize=400,200)
```
You will find more information about styling and other media file handling in the next chapter.