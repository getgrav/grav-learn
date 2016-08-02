---
title: How to: Add a file upload
taxonomy:
    category: docs
---

### File Uploads

You can add file upload functionality in Pages, Config, Plugins and Themes blueprints.

Example usage:

```
custom_file:
  type: file
  label: A Label
  destination: 'user/plugins/my-plugin/assets'
  blueprint: 'plugins.admin-pro'
  accept:
    - image/*
```

```
custom_file:
  type: file
  label: A Label
  destination: 'user/themes/my-theme/assets'
  blueprint: 'themes.mytheme'
  accept:
    - image/*
```

For pages, you can also use the `pagemediaselect` field. It allows users to choose a media from one of the page media already uploaded through FTP or using the page media manager.
Example usage:

```
header.img_link:
  label: Choose media
  type: pagemediaselect
```