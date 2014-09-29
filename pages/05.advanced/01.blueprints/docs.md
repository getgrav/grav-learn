---
title: Blueprints
taxonomy:
    category: docs
---

The Blueprints are an important aspect of a plugin and theme, it serves two purposes and we are going to cover them both. Although, the honest truth is that if you aren't a developer and just use Grav, then you could live without knowing that Blueprints even existed and you shouldn't care much about them.

The Blueprints is a container of metadata informations regarding a resource. The first set of metadata informations is the identity of the resource itself, the second set is about the forms. All these informations are stored in a `blueprints.yaml` file and can be found at the root of each plugin and theme.

## Resource Identity
Each plugin and theme identity is defined in the `blueprints.yaml`. Without a properly formatted and compiled Blueprints, a resource won't be added in the Grav repository, consequently it won't be available through [Grav downloads][grav-downloads] and [GPM][gpm].

There are different properties that you can use to give your resource and identity, some **required**, other _optionals_.

|      property     |                                                                                                                                                                               description                                                                                                                                                                                |
|-------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| __name*__         | Name of the resource, avoid appending Plugin or Theme, there is no need for that                                                                                                                                                                                                                                                                                         |
| __version*__      | Version of the resource. This value should always change on each release, incrementally. You should follow the [semver][semver] standard, too.                                                                                                                                                                                                                           |
| __description*__  | Description of your resource. Please don't exceed the **200** characters, a description should be short and straight to the point. You can use markdown syntax if needed. It's also a good idea to wrap your description between quotes.                                                                                                                                 |
| __icon*__         | Icon is what will be used on [getgrav.org][getgrav]. At this state we are using [FontAwesome][fa] icons library, so if you are developing a new plugin or theme, it should be your job to ensure the icon you picked is not already used, otherwise we will have to change it for you.                                                                                   |
| _screenshot_      | _(optional)_ Screenshot is only ever evaluated for _Themes_ and completely ignored for _Plugins_. For _Themes_ this would be the filename of the screenshot that comes with the theme (default: `screenshot.jpg`). If you have a _screenshot.jpg_ image at the root of your theme, then you can avoid using this property, our repository will automatically pick it up. |
| __author.name*__  | The developer full name                                                                                                                                                                                                                                                                                                                                                  |
| __author.email*__ | The developer email                                                                                                                                                                                                                                                                                                                                                      |
| _author.url_      | _(optional)_ The developer homepage                                                                                                                                                                                                                                                                                                                                      |
| _homepage_        | _(optional)_ If you have a dedicated homepage for your resource, this would be the place for it.                                                                                                                                                                                                                                                                         |
| _docs_            | _(optional)_ If you have written documentation for your resource, you can link them here.                                                                                                                                                                                                                                                                                |
| _demo_            | _(optional)_ If you have a demo up and running about your resource, link it here.                                                                                                                                                                                                                                                                                        |
| _guide_           | _(optional)_ If you have tutorials or howtos about your resource, link it here.                                                                                                                                                                                                                                                                                          |
| _keywords_        | _(optional)_ Although there is no real use of keywords yet, you can list keywords relative to your resource here, comma separated.                                                                                                                                                                                                                                       |
| _bugs_            | _(optioanl)_ The URL where bugs can be reported, usually this would be the [GitHub issues][github-issues] link.                                                                                                                                                                                                                                                          |
| _license_         | _(optional)_ The type of license your resource is (MIT, GPL, etc). It is adviced you always provide a `LICENSE` file with your resource.                                                                                                                                                                                                                                 |

Here is an example of the identity portion of the [github plugin][plugin-github] Blueprints:

```yaml
name: GitHub
version: 1.0.1
description: "This plugin wraps the [GitHub v3 API](https://developer.github.com/v3/) and uses the [php-github-api](https://github.com/KnpLabs/php-github-api/) library to add a nice GitHub touch to your Grav pages."
icon: github
author:
  name: Team Grav
  email: devs@getgrav.org
  url: http://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-github
keywords: github, plugin, api
bugs: https://github.com/getgrav/grav-plugin-github/issues
license: MIT
```


## Forms
The forms metadata defines what aspect of the resource are configurable through the **Admin Plugin**.

>>> Although this is working already, the Admin Plugin is still a work in progress, further updates to this document will come as soon as the new admin will be available.


[grav-downloads]: http://getgrav.org/downloads
[gpm]: ../grav-gpm
[plugin-github]: http://github.com/getgrav/grav-plugin-github
[semver]: http://semver.org/
[getgrav]: http://getgrav.org
[fa]: http://fortawesome.github.io/Font-Awesome/icons/
[github-issues]: https://guides.github.com/features/issues/
