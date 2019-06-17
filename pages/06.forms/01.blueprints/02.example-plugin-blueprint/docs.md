---
title: 'Example: Plugin Blueprint'
taxonomy:
    category: docs
---

A Plugin's blueprint gives Grav insight into what a plugin is, its source, support and author information, dependencies, and and form fields used to administer the plugin in the Grav Admin.

As an example, here's the Blueprint for a plugin:

[prism classes="language-yaml line-numbers"]
name: Assets
version: 1.0.4
description: "This plugin provides a convenient way to add CSS and JS assets directly from your pages."
icon: list-alt
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-assets
demo: https://learn.getgrav.org
keywords: assets, javascript, css, inline
bugs: https://github.com/getgrav/grav-plugin-assets/issues
license: MIT

dependencies:
  - { name: afterburner2 }
  - { name: github }
  - { name: email, version: '~2.0' }
[/prism]

There are different properties that you can use to give your resource an identity. Some are **required**, others are _optional_.

[div class="table"]
| property         | description                                                                                                                                                                                                                                                                                                                                                                                                      |
| :-----           | :-----                                                                                                                                                                                                                                                                                                                                                                                                           |
| __name*__        | This is the name of the resource. Avoid appending Plugin or Theme, there is no need for that.                                                                                                                                                                                                                                                                                                                    |
| __version*__     | The version of the resource. This value should always change on each release, incrementally. You should follow the [semver](http://semver.org/) standard, too.                                                                                                                                                                                                                                                   |
| __description*__ | The description of your resource. Please don't exceed **200** characters. A description should be short and straight to the point. You can use markdown syntax if needed. It's also a good idea to wrap your description in quotation marks.                                                                                                                                                                     |
| __icon*__        | Icon is what will be used on [getgrav.org](https://getgrav.org). At this stage, we are using [FontAwesome](http://fortawesome.github.io/Font-Awesome/icons/) icons library, so if you are developing a new plugin or theme, it should be your job to ensure the icon you picked is not already used. Otherwise we will have to change it for you.                                                                |
| _screenshot_     | _(optional)_ Screenshot is only ever evaluated for _Themes_ and completely ignored for _Plugins_. For _Themes_, this would be the filename of the screenshot that comes with the theme (default: `screenshot.jpg`). If you have a _screenshot.jpg_ image at the root of your theme, then you can avoid using this property. Our repository will automatically pick it up.                                        |
| __author.name*__ | The developer full name                                                                                                                                                                                                                                                                                                                                                                                          |
| _author.email_   | _(optional)_ The developer email.                                                                                                                                                                                                                                                                                                                                                                                |
| _author.url_     | _(optional)_ The developer homepage.                                                                                                                                                                                                                                                                                                                                                                             |
| _homepage_       | _(optional)_ If you have a dedicated homepage for your resource, this would be the place for it.                                                                                                                                                                                                                                                                                                                 |
| _docs_           | _(optional)_ If you have written documentation for your resource, you can link them here.                                                                                                                                                                                                                                                                                                                        |
| _demo_           | _(optional)_ If you have a demo up and running about your resource, link it here.                                                                                                                                                                                                                                                                                                                                |
| _guide_          | _(optional)_ If you have tutorials or how-to guides for your resource, link it here.                                                                                                                                                                                                                                                                                                                             |
| _keywords_       | _(optional)_ Although there is no real use of keywords yet, you can list keywords relative to your resource here, comma separated.                                                                                                                                                                                                                                                                               |
| _bugs_           | _(optional)_ The URL where bugs can be reported, usually this would be the [GitHub issues](https://guides.github.com/features/issues/) link.                                                                                                                                                                                                                                                                     |
| _license_        | _(optional)_ The type of license your resource is (MIT, GPL, etc). It is advised that you always provide a `LICENSE` file with your resource.                                                                                                                                                                                                                                                                    |
| _dependencies_   | _(optional)_ A list of dependencies that the plugin/theme requires.  The default process is to use GPM to install them, however, if an optional GIT repository URL is provided, installing direct from the repository will be an option also. Also if you use an array, you can define a name and a version explicitly using [Composer-style package versions](https://getcomposer.org/doc/articles/versions.md) |
[/div]

Here is an example of the identity portion of the [GitHub plugin](https://github.com/getgrav/grav-plugin-github) blueprints:

[prism classes="language-yaml line-numbers"]
name: GitHub
version: 1.0.1
description: "This plugin wraps the [GitHub v3 API](https://developer.github.com/v3/) and uses the [php-github-api](https://github.com/KnpLabs/php-github-api/) library to add a nice GitHub touch to your Grav pages."
icon: github
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-plugin-github
keywords: github, plugin, api
bugs: https://github.com/getgrav/grav-plugin-github/issues
license: MIT
[/prism]

Theme blueprints work in very much the same way as plugins.
