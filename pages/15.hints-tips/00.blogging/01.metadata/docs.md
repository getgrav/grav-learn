---
title: Blogging Metadata
visible: true
twig_first: true
process:
    twig: true
taxonomy:
    category: docs
---

When you use Grav as your blogging platform you will want to include metadata that helps to populate descriptions and images when people share your post on Social Media such as Facebook, Twitter, etc. 

You would add this information into the [Header](/content/headers) section of your Grav page. 

Within the documentation there is reference to the meta data that you need to add within the header section, under [Meta Page Headers](/content/headers#meta-page-headers).  However, if you have transitioned from a platform such as WordPress where you use a plugin for this you might not realise the importance of the Metadata. 

At the start of each of your blog posts you will want to have the following: 

[prism classes="language-yaml line-numbers"]
---
title: Blog Post Title
publish_date: Date the blog post will go live
date: Date the blog post was written
metadata:
    'og:title': Blog Post Title
    'og:type': article
    'og:description': Description of what your blog post is covering.  This will be visible when people share your post on social media.
    'og:url': The URL of the blog post
    'og:site_name': The name of the overall site the blog post belongs to. 
    'og:locale': The language your blog post is written in
    'og:image': The image you reference here will be visible when shared on social media. 
    'twitter:card' : The type of Twitter card that should be used. 
    'twitter:site' : Your Twitter handle
    'twitter:title' : Blog Post Title
    'twitter:description' : Description of what your blog post is covering.  This will be visible when people share your post on social media.
    'twitter:image' : The image you reference here will be visible when shared on social media. 
    'twitter:creator': The twitter handle of the blog post author. 
taxonomy:
    category: [Blog post category]
    tag: [Tag 1, Tag 2, Tag 3, Tag 4]
    author: Author's name
---
[/prism]

Read more about [Twitter Cards](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started.html)

Read more about [The Open Graph Protocol](https://ogp.me/)
