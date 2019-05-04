---
title: 'How to: Add a file upload'
taxonomy:
    category: docs
---

### File Uploads

You can add file upload functionality in Pages, Config, Plugins and Themes blueprints. File uploads are always Ajax based and allow Drag & Drop from the desktop or picking them as regular file fields. Every time a file is added to the field, it's automatically uploaded to a temporary folder, and will only be stored when the Save (or Submit) action takes place. 

Example of usage:

[prism classes="language-yaml line-numbers"]
custom_file:
  name: myfile
  type: file
  label: A Label
  destination: 'user/plugins/my-plugin/assets'
  multiple: true
  autofocus: false
  accept:
    - image/*
[/prism]

! In order to add a file upload, you must have a bottom javascript render command in your base Twig template.  `{{ assets.js('bottom') }}`

## Options

A file field has multiple options available, from the accepted MIME type or extension, to the file size allowed:

#### Defaults

[prism classes="language-yaml line-numbers"]
custom_file:
  type: file
  label: A Label
  multiple: false
  destination: 'self@'
  random_name: false
  avoid_overwriting: false
  limit: 10
  accept:
    - image/*
[/prism]

#### `multiple`

[prism classes="language-yaml"]
multiple: false # [false | true]
[/prism]

Like a regular HTML5 file field, when the `multiple` option is enabled, it allows to upload more than a single file. This setting is also tied to the [`limit`](#limit) option, which determines how many of the multiple files are allowed for the field.

#### `destination`

``` yaml
destination: 'self@' # [<path> | self@ | page@:<path> | theme@:<path>]
```

Destination is the location where uploaded files should be stored. This can be either a regular `path` (relative to the root of Grav), `self@` or one of the special  `page@:` and `theme@:` prefixes.

!! `self@` is not allowed outside of the Pages scope, an error will be thrown. If you use a file field outside of a Page, you should always change the `destination` setting.

##### Examples

1. If it's desired to upload files to a plugin `testing` folder (`user/plugins/testing`), destination would be:

  [prism classes="language-yaml"]
  destination: 'user/plugins/testing'
  [/prism]

2. Assuming we have a blog item at the route `/blog/ajax-upload` (physical location being `user/pages/02.blog/ajax-upload`), with the `page@:` prefix the destination would be:

  [prism classes="language-yaml"]
  destination: 'page@:/blog/ajax-upload'
  [/prism]
3. Assuming the current theme is `antimatter` and we want to upload to the assets folder (physical location being `user/themes/antimatter/assets`), with the `theme@:` prefix the destination would be:

   [prism classes="language-yaml"]
   destination: 'theme@:/assets'
   [/prism]

#### `random_name`

[prism classes="language-yaml"]
random_name: false # [false | true]
[/prism]

When the `random_name` is enabled, the uploaded file will get renamed with a random string **15** characters long. This is helpful if you wish to hash your uploaded files or if you are looking for a way to reduce names collision.

##### Example
[prism classes="language-php"]
'my_file.jpg' => 'y5bqsGmE1plNTF2.jpg'
[/prism]

#### `avoid_overwriting`

[prism classes="language-yaml"]
avoid_overwriting: false # [false | true]
[/prism]

When the `avoid_overwriting` is enabled and a file with the same name of the uploaded one already exists in `destination`, it will be renamed. The newly uploaded file will be prefixed with the current date and time, concatenated by a dash.

##### Example
[prism classes="language-php"]
'my_file.jpg' => '20160901130509-my_file.jpg'
[/prism]

#### `limit`

[prism classes="language-yaml"]
limit: 10 # [1...X | 0 (unlimited)]
[/prism]

When the [`multiple`](#multiple) setting is enabled, `limit` allows to constrain the number of allowed files for an individual field. If `multiple` is not enabled (not enabled by default), `limit` automatically falls back to **1**.

When `limit` is set to **0**, it means that there are no restrictions on the amount of allowed files that can be uploaded.

!! It is good practice to always ensure you have a set limit of allowed files that can be uploaded. This way you have more control over your server resources utilizations.

#### `accept`

[prism classes="language-yaml line-numbers"]
accept:
  - 'image/*' # Array of MIME types and/or extensions. ['*'] for allowing any file.
[/prism]

The `accept` setting allows an array of MIME type as well as extensions definitions. All of the extensions need to be starting with the `.` (dot) plus the extension itself.

In addition you can also allow any file by simply using the __*__ (star) notation `accept: ['*']`.

##### Examples
    
1. To only allow `yaml` and `json` files:
   [prism classes="language-yaml line-numbers"]
     accept:
       - .yaml
       - .json
   [/prism]
2. To only allow images and videos:
   [prism classes="language-yaml line-numbers"]
     accept:
       - 'image/*'
       - 'video/*'
   [/prism]
3. To allow any image, any video and only mp3 files:
   [prism classes="language-yaml line-numbers"]
     accept:
       - 'image/*'
       - 'video/*'
       - .mp3
   [/prism]
4. To allow any file:
   [prism classes="language-yaml line-numbers"]
     accept:
       - '*'
   [/prism]

#### `filesize`

The max file size is limited by: 

1. field level  `filesize:`, then ...

2. Form plugin level configuration `user/plugins/form.yaml` setting `files: filesize:`, then if neither of those are limiting... 

3. PHP level configuration for `upload_max_filesize` for individual files that are uploaded, and `post_max_size` for the max form post total size.

##### Examples

1. To limit a specific field to `5M`
   [prism classes="language-yaml line-numbers"]
   custom_file:
     name: myfile
     type: file
     label: A Label
     destination: 'user/plugins/my-plugin/assets'
     filesize: 5
     accept:
       - image/*
   [/prism]

2. To limit all file fields to `5M`, edit your `user/config/form.yaml` file:
   [prism classes="language-yaml line-numbers"]
   files:
     multiple: false
     limit: 10
     destination: '@self'
     avoid_overwriting: false
     random_name: false
     filesize: 5
     accept:
       - 'image/*
   [/prism]
