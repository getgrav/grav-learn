---
title: 'How to: Add a file upload'
taxonomy:
    category: docs
---

### File Uploads

You can add file upload functionality in Pages, Config, Plugins and Themes blueprints. File uploads are always Ajax based and allow Drag & Drop from the desktop or picking them as regular file fields. Every time a file is added to the field, it's automatically uploaded to a temporary folder, and will only be stored when the Save (or Submit) action takes place.

Example of usage:

[codesh=yaml line-numbers="true"]
custom_file:
  name: myfile
  type: file
  label: A Label
  destination: 'plugins://my-plugin/assets'
  multiple: true
  autofocus: false
  accept:
    - image/*
[/codesh]

> [!WARNING]
> In order to add a file upload, you must have a bottom javascript render command in your base Twig template.  `{{ assets.js('bottom') }}`

## Options

A file field has multiple options available, from the accepted MIME type or extension, to the file size allowed:

#### Defaults

[codesh=yaml line-numbers="true"]
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
[/codesh]

#### `multiple`

[codesh=yaml]
multiple: false # [false | true]
[/codesh]

Like a regular HTML5 file field, when the `multiple` option is enabled, it allows to upload more than a single file. This setting is also tied to the [`limit`](#limit) option, which determines how many of the multiple files are allowed for the field.

#### `destination`

``` yaml
destination: 'self@' # [<path> | <stream> | self@ | page@:<path>]
```

Destination is the location where uploaded files should be stored. This can be either a regular `path` (relative to the root of Grav), a `stream` (such as `theme://images`), `self@` or the special  `page@:` prefix. You can also reference a subfolder relative to the current page with `self@/path`. 

> [!CAUTION]
> `self@` is not allowed outside the Pages or Flex Objects scope, an error will be thrown. If you use a file field outside a Page or Flex Object, you should always change the `destination` setting.

##### Examples

1. If it's desired to upload files to a plugin `testing` folder (`user/plugins/testing`), destination would be:

  [codesh=yaml]
  destination: 'plugins://testing'
  [/codesh]

2. Assuming we have a blog item at the route `/blog/ajax-upload` (physical location being `user/pages/02.blog/ajax-upload`), with the `page@:` prefix the destination would be:

  [codesh=yaml]
  destination: 'page@:/blog/ajax-upload'
  [/codesh]
3. Assuming the current theme is `antimatter` and we want to upload to the assets folder (physical location being `user/themes/antimatter/assets`), with the `theme` stream the destination would be:

   [codesh=yaml]
   destination: 'theme://assets'
   [/codesh]

#### `random_name`

[codesh=yaml]
random_name: false # [false | true]
[/codesh]

When the `random_name` is enabled, the uploaded file will get renamed with a random string **15** characters long. This is helpful if you wish to hash your uploaded files or if you are looking for a way to reduce names collision.

##### Example
[codesh=php]
'my_file.jpg' => 'y5bqsGmE1plNTF2.jpg'
[/codesh]

#### `avoid_overwriting`

[codesh=yaml]
avoid_overwriting: false # [false | true]
[/codesh]

When the `avoid_overwriting` is enabled and a file with the same name of the uploaded one already exists in `destination`, it will be renamed. The newly uploaded file will be prefixed with the current date and time, concatenated by a dash.

##### Example
[codesh=php]
'my_file.jpg' => '20160901130509-my_file.jpg'
[/codesh]

#### `limit`

[codesh=yaml]
limit: 10 # [1...X | 0 (unlimited)]
[/codesh]

When the [`multiple`](#multiple) setting is enabled, `limit` allows to constrain the number of allowed files for an individual field. If `multiple` is not enabled (not enabled by default), `limit` automatically falls back to **1**.

When `limit` is set to **0**, it means that there are no restrictions on the amount of allowed files that can be uploaded.

> [!CAUTION]
> It is good practice to always ensure you have a set limit of allowed files that can be uploaded. This way you have more control over your server resources utilizations.

#### `accept`

[codesh=yaml line-numbers="true"]
accept:
  - 'image/*' # Array of MIME types and/or extensions. ['*'] for allowing any file.
[/codesh]

The `accept` setting allows an array of MIME type as well as extensions definitions. All of the extensions need to be starting with the `.` (dot) plus the extension itself.

In addition you can also allow any file by simply using the __*__ (star) notation `accept: ['*']`.

##### Examples

1. To only allow `yaml` and `json` files:
   [codesh=yaml line-numbers="true"]
     accept:
       - .yaml
       - .json
   [/codesh]
2. To only allow images and videos:
   [codesh=yaml line-numbers="true"]
     accept:
       - 'image/*'
       - 'video/*'
   [/codesh]
3. To allow any image, any video and only mp3 files:
   [codesh=yaml line-numbers="true"]
     accept:
       - 'image/*'
       - 'video/*'
       - .mp3
   [/codesh]
4. To allow any file:
   [codesh=yaml line-numbers="true"]
     accept:
       - '*'
   [/codesh]

#### `filesize`

The max file size is limited by:

1. field level  `filesize:`, then ...

2. Form plugin level configuration `user/plugins/form.yaml` setting `files: filesize:`, then if neither of those are limiting...

3. PHP level configuration for `upload_max_filesize` for individual files that are uploaded, and `post_max_size` for the max form post total size.

##### Examples

1. To limit a specific field to `5M`
   [codesh=yaml line-numbers="true"]
   custom_file:
     name: myfile
     type: file
     label: A Label
     destination: 'plugins://my-plugin/assets'
     filesize: 5
     accept:
       - image/*
   [/codesh]

2. To limit all file fields to `5M`, edit your `user/config/form.yaml` file:
   [codesh=yaml line-numbers="true"]
   files:
     multiple: false
     limit: 10
     destination: 'self@'
     avoid_overwriting: false
     random_name: false
     filesize: 5
     accept:
       - 'image/*
   [/codesh]

   ### Legacy File Upload Processing and Manual Control

   For basic file handling, all you need is the field defintion. The files get uploaded to a temporary location via the Dropzone widget via an XHR call to the server.  On form submission, the files are moved from their temporary location to their final location automatically.  You can however use the `upload: true` action in the `process:` block to manually trigger where in the workflow you want those files to be moved.

   ##### Example:

[codesh=yaml line-numbers="true"]
process:
    upload: true
    message: 'Thank you for your files'
    reset: true 
[/codesh]
