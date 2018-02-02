---
title: How to: Add a file upload
taxonomy:
    category: docs
---

### File Uploads

You can add file upload functionality in Pages, Config, Plugins and Themes blueprints. File uploads are always Ajax based and allow Drag & Drop from the desktop or picking them as regular file fields. Every time a file is added to the field, it's automatically uploaded to a temporary folder, and will only be stored when the Save (or Submit) action takes place. 

Example of usage:

```
custom_file:
  name: myfile
  type: file
  label: A Label
  destination: 'user/plugins/my-plugin/assets'
  multiple: true
  autofocus: false
  accept:
    - image/*
```

! In order to add a file upload, you must have a bottom javascript render command in your base Twig template.  `{{ assets.js('bottom') }}`

## Options

A file field has multiple options available, from the accepted MIME type or extension, to the file size allowed:

#### Defaults

```yaml
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
```

#### `multiple`

``` yaml
multiple: false # [false | true]
```

Like a regular HTML5 file field, when the `multiple` option is enabled, it allows to upload more than a single file. This setting is also tied to the [`limit`](#limit) option, which determines how many of the multiple files are allowed for the field.

#### `destination`

``` yaml
destination: 'self@' # [<path> | self@ | page@:<path> | theme@:<path>]
```

Destination is the location where uploaded files should be stored. This can be either a regular `path` (relative to the root of Grav), `self@` or one of the special  `page@:` and `theme@:` prefixes.

!! `self@` is not allowed outside of the Pages scope, an error will be thrown. If you use a file field outside of a Page, you should always change the `destination` setting.

##### Examples

1. If it's desired to upload files to a plugin `testing` folder (`user/plugins/testing`), destination would be:
  ```yaml
  destination: 'user/plugins/testing'
  ```

2. Assuming we have a blog item at the route `/blog/ajax-upload` (physical location being `user/pages/02.blog/ajax-upload`), with the `page@:` prefix the destination would be:

  ```yaml
  destination: 'page@:/blog/ajax-upload'
  ```
3. Assuming the current theme is `antimatter` and we want to upload to the assets folder (physical location being `user/themes/antimatter/assets`), with the `theme@:` prefix the destination would be:

   ```yaml
   destination: 'theme@:/assets'
   ```

#### `random_name`

``` yaml
random_name: false # [false | true]
```

When the `random_name` is enabled, the uploaded file will get renamed with a random string **15** characters long. This is helpful if you wish to hash your uploaded files or if you are looking for a way to reduce names collision.

##### Example
```
'my_file.jpg' => 'y5bqsGmE1plNTF2.jpg'
```

#### `avoid_overwriting`

``` yaml
avoid_overwriting: false # [false | true]
```

When the `avoid_overwriting` is enabled and a file with the same name of the uploaded one already exists in `destination`, it will be renamed. The newly uploaded file will be prefixed with the current date and time, concatenated by a dash.

##### Example
```
'my_file.jpg' => '20160901130509-my_file.jpg'
```

#### `limit`

``` yaml
limit: 10 # [1...X | 0 (unlimited)]
```

When the [`multiple`](#multiple) setting is enabled, `limit` allows to constrain the number of allowed files for an individual field. If `multiple` is not enabled (not enabled by default), `limit` automatically falls back to **1**.

When `limit` is set to **0**, it means that there are no restrictions on the amount of allowed files that can be uploaded.

!! It is good practice to always ensure you have a set limit of allowed files that can be uploaded. This way you have more control over your server resources utilizations.

#### `accept`

``` yaml
accept:
  - 'image/*' # Array of MIME types and/or extensions. ['*'] for allowing any file.
```

The `accept` setting allows an array of MIME type as well as extensions definitions. All of the extensions need to be starting with the `.` (dot) plus the extension itself.

In addition you can also allow any file by simply using the __*__ (star) notation `accept: ['*']`.

##### Examples

1. To only allow `yaml` and `json` files:
   ``` yaml
     accept:
       - .yaml
       - .json
   ```
2. To only allow images and videos:
   ``` yaml
     accept:
       - 'image/*'
       - 'video/*'
   ```
3. To allow any image, any video and only mp3 files:
   ``` yaml
     accept:
       - 'image/*'
       - 'video/*'
       - .mp3
   ```
4. To allow any file:
   ``` yaml
     accept:
       - '*'
   ```
