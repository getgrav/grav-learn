---
title: GPM Submission
page-toc:
  active: true
taxonomy:
    category: docs
---
# GPM Submission

When you have created a new theme and would like to see it added to the [Grav Repository](https://getgrav.org/downloads) so it can be installed via **GPM** and the **Admin** interface, there are a few standard things you need to ensure. This page is in two parts: first, **publishing the theme itself** to GPM, and second, **shipping a skeleton** — a complete, ready-to-unzip demo site built around your theme. If you are publishing a plugin, see the [plugins version of this page](../../plugins/gpm-submission) instead.

## Part 1: Publishing Your Theme

### Theme Requirements

A proper Grav theme requires certain files in order to function properly, be listed in the Grav repository, and be visible in the Grav admin. Please ensure your theme contains all these files:

* **yourtheme.php** - theme PHP file that should be named the same as the folder
* **yourtheme.yaml** - theme configuration file that contains any options and stream inheritance information
* **blueprints.yaml** - theme definition file and form definition file
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the theme
* **LICENSE** - license file, probably MIT if in line with Grav core
* **screenshot.jpg** - a large 1:1 preview image of the theme
* **thumbnail.jpg** - a smaller 1:1 thumbnail image of the theme
* **languages.yaml** (optional) - a language definition file

### Screenshot and Thumbnail

Unlike plugins, which are represented by a Font Awesome `icon:` in their blueprint, themes are visual products and are represented by real images. Both files must be **JPG format** with those **exact filenames**, sitting in the root of the theme:

* **screenshot.jpg** is the full-size preview shown on the [getgrav.org downloads page](https://getgrav.org/downloads) and in the theme details view of the Admin interface. It must be a **1:1 aspect ratio** and at least **800px x 800px** — official Team Grav themes and skeletons ship at 1000px x 1000px.
* **thumbnail.jpg** is the smaller image used in the Admin theme listing grid. It must also be **1:1 aspect ratio** at around **300px x 300px** — official packages ship at 500px x 500px for crisp rendering on high-DPI displays.

> [!TIP]
> The easiest way to produce a good screenshot is to capture your theme's demo homepage in a square viewport, rather than cropping a wide capture after the fact. Generate the thumbnail by scaling down the same image so the two stay visually consistent.

### The blueprints.yaml File

The `blueprints.yaml` in the root of your theme is what GPM and the Admin interface read to present your theme. A real-world example, from the **Quark2** theme:

[codesh=yaml]
name: Quark 2
slug: quark2
type: theme
version: 1.1.10
description: The modernized Grav default theme — Blades CSS foundation, with light/dark/auto mode.
icon: meteor
author:
  name: Team Grav
  email: devs@getgrav.org
  url: https://getgrav.org
homepage: https://github.com/getgrav/grav-theme-quark2
demo: https://demo.getgrav.org/blog-skeleton
keywords: quark2, theme, modern, fast, responsive, html5, dark-mode
bugs: https://github.com/getgrav/grav-theme-quark2/issues
license: MIT
compatibility:
  grav: ['1.7', '2.0']
dependencies:
  - { name: grav, version: '>=1.7.0' }
[/codesh]

The `name`, `slug`, `type`, `version`, `description`, `author`, and `license` fields are required for GPM listing. See [Blueprints](../../forms/blueprints) for the full field reference, including the `form:` section that defines your theme's configuration options in the Admin interface.

> [!NOTE]
> Themes targeting Grav 2.0 should declare a `compatibility:` section so GPM and the migration wizard know which major Grav versions the theme supports. See [Plugin Compatibility](../../plugins/plugin-compatibility) for details — the property works identically for themes.

### Release Process

When your theme is ready to be added to the repository, work through this checklist:

1. It is open source with a `LICENSE` file that provides an [MIT](http://en.wikipedia.org/wiki/MIT_License) compatible license. [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/LICENSE)
2. Contains a `README.md` file with a summary of functionality and instructions on how to install and configure it. [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/README.md)
3. Contains a `blueprints.yaml` file with [all required fields](../../forms/blueprints). [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/blueprints.yaml)
4. Provides a `CHANGELOG.md` in the [correct format](#changelog-format). [Example Here](https://github.com/getgrav/grav-theme-antimatter/blob/develop/CHANGELOG.md)
5. Provides appropriate attribution if you use any other libraries, scripts, code.
6. [Create a release](https://docs.github.com/en/repositories/releasing-projects-on-github) for your finished theme. The Grav repository system requires a release and will not find your theme unless there is a release that contains all of the above.
7. [Add an issue to the Grav issues tracker](https://github.com/getgrav/grav/issues/new?title=[add-resource]%20New%20Plugin/Theme&body=I%20would%20like%20to%20add%20my%20new%20plugin/theme%20to%20the%20Grav%20Repository.%0AHere%20are%20the%20project%20details:%20**user/repository**) with details about your theme, and we will give it a quick test to ensure it functions, and then add it. Note that you don't have to do this if you're releasing a new version of a theme that's already in the repository. It will be picked up automatically.

> [!WARNING]
> Ensure your **naming for each tag is consistent**. GPM uses this information to determine if your theme is newer than the last. We recommend using [Semantic Version Numbers](http://semver.org/) for tags. E.g. `1.2.4`. Consistency for all tags is paramount!

### ChangeLog Format

The GetGrav.org site uses a custom ChangeLog format that is written in standard markdown but can be manipulated with some simple CSS and [displayed in an attractive format](https://getgrav.org/downloads#changelog). In order to ensure your ChangeLogs can be parsed and formatted properly, please use this syntax:

[codesh=markdown line-numbers="true"]
# X.Y.Z
## 01/01/2015

1. [](#new)
    * New features added
    * Another new feature
2. [](#improved)
    * Improvement made
    * Another improvement
3. [](#bugfix)
     * Bugfix implemented
     * Another bugfix

...repeat...
[/codesh]

Each section `#new, #improved, #bugfix` are optional, just include the sections you need.

> [!TIP]
> Versions can be either `vX.Y.Z` or `X.Y.Z`, just ensure they are consistent between releases. Make sure you have the version with `#` the date (ensure US format) `##` and then a newline. Also make sure you indent your bullet items the same amount.

> [!WARNING]
> Dates can use either the **American** `m/d/y` [date format](../../content/headers#date), or the **European** `d-m-y` format. Also make sure there is an empty newline between the headers (version and date) and lists (new, improved, bugfix).

### Demo Content

You are able to provide demo content as part of a theme package. This means that anything found in a folder called `_demo/` will be copied over to the `user/` folder as part of the installation procedure. This means you can provide **pages**, or **configuration** or anything else that sits in the `user/` folder. The user is prompted to do this, and it's purely optional.

_Please note that demo content is not copied when your theme is installed via the `Admin` interface._

## Part 2: Shipping a Skeleton

A **Grav Skeleton** is an **all-in-one sample site**: a complete `user/` folder — pages, configuration, your theme, and any required plugins — that gets packaged together with the Grav core into a single zip that can simply be unzipped into a working site. If demo content (Part 1 above) is a taste of your theme, a skeleton is the full meal, and it is by far the best way for people to experience your theme exactly as you designed it. Skeletons are listed in the [Grav Repository](https://getgrav.org/downloads/skeletons) alongside plugins and themes.

### Skeleton Requirements

A skeleton repository is essentially the `user/` folder of a working Grav site, with a few packaging files in the root:

* **.dependencies** - a file that defines the theme and plugin dependencies for this skeleton
* **blueprints.yaml** - skeleton definition file with the same GPM fields as a theme (name, slug, version, description, author, license, etc.)
* **CHANGELOG.md** - a changelog file that should be in the proper Grav format for consistent rendering
* **README.md** - required file to explain and preview the skeleton
* **LICENSE** - license file, probably MIT if in line with Grav core
* **screenshot.jpg** - a 1:1 aspect ratio preview of the skeleton, same sizing rules as for themes
* **thumbnail.jpg** - a 1:1 aspect ratio thumbnail, same sizing rules as for themes
* **pages/**, **config/**, **accounts/**, **data/** - the actual site content and configuration

The official [Blog Site Skeleton](https://github.com/getgrav/grav-skeleton-blog-site) is the canonical Grav 2.0 reference — it bundles the **Quark2** theme and the **Admin Next** stack, and is the best starting point to copy from.

### The .dependencies File

The `.dependencies` file tells the build tooling which theme and plugins to pull into the package. Each dependency has a `git:` entry (where to fetch it from and where it lands) and a matching `links:` entry (used for symlinked development setups). Your own theme is just another dependency:

[codesh=yaml]
git:
    quark2:
        url: https://github.com/getgrav/grav-theme-quark2
        path: user/themes/quark2
        branch: develop
    breadcrumbs:
        url: https://github.com/getgrav/grav-plugin-breadcrumbs
        path: user/plugins/breadcrumbs
        branch: develop
links:
    quark2:
        src: grav-theme-quark2
        path: user/themes/quark2
        scm: github
    breadcrumbs:
        src: grav-plugin-breadcrumbs
        path: user/plugins/breadcrumbs
        scm: github
[/codesh]

> [!NOTE]
> A Grav 2.0 skeleton that ships the Admin Next stack should include **admin2**, **api**, and **flex-objects** in its `.dependencies`, as the Blog Site Skeleton does. The legacy **admin** plugin is only relevant to Grav 1.x skeletons.

### Building Packages with the Skeleton Builder

You do not assemble the zips by hand. The official [Skeleton Builder](https://github.com/getgrav/skeleton-builder) GitHub Action reads your `.dependencies` file, downloads the Grav core plus all listed themes and plugins, and produces finished packages attached to your GitHub release. Create a workflow file at `.github/workflows/build-skeleton.yaml` in your skeleton repository:

[codesh=yaml]
name: Build Skeleton

on:
  release:
    types: [ published ]
  workflow_dispatch:
    inputs:
      tag:
        description: 'Target tag for re-upload'
        required: true
        default: ''
      version:
        description: 'Which Grav release to use'
        required: true
        default: 'latest'
      admin:
        description: 'Create also a package with Admin'
        required: true
        default: true

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - name: Extract Tag
        run: echo "SKELETON_VERSION=${{ github.event.inputs.tag || github.ref_name }}" >> $GITHUB_ENV
      - name: Generate Skeleton Packages
        uses: getgrav/skeleton-builder@v1
        with:
          version: ${{ github.event.inputs.version || 'latest' }}
          admin: ${{ github.event.inputs.admin || true }}
      - name: Upload packages to release
        uses: svenstaro/upload-release-action@v2
        with:
          repo_token: ${{ secrets.GITHUB_TOKEN }}
          tag: ${{ env.SKELETON_VERSION }}
          file: dist/*.zip
          overwrite: true
          file_glob: true
[/codesh]

The workflow runs in two ways:

1. **Automatically** - every time you publish a GitHub release of your skeleton, the builder generates the packages and attaches them to that release. This is the release process for skeletons: tag, publish the release, and the packages appear.
2. **Manually** - via **Actions** -> **Build Skeleton** -> **Run workflow** on GitHub, targeting an existing tag. Use this to rebuild the packages of your latest release when a new version of Grav (or one of your dependencies) ships, without cutting a new skeleton release — the existing packages are overwritten with fresh contents.

> [!NOTE]
> The `admin: true` input produces a second package bundling the legacy **admin** plugin, which only makes sense for Grav 1.x skeletons. If your skeleton already carries **admin2**, **api**, and **flex-objects** in its `.dependencies` (the Grav 2.0 way), set `admin` to `false` so you don't ship a redundant package.

### Submitting the Skeleton

Skeletons are submitted to the repository exactly like themes: make sure a release exists with built packages attached, then [open an `[add-resource]` issue on the Grav issues tracker](https://github.com/getgrav/grav/issues/new?title=[add-resource]%20New%20Plugin/Theme&body=I%20would%20like%20to%20add%20my%20new%20plugin/theme%20to%20the%20Grav%20Repository.%0AHere%20are%20the%20project%20details:%20**user/repository**) pointing at your skeleton repository. Subsequent releases are picked up automatically. The same tag-consistency rules apply.

## Abandoned Resource Protocol

People move on, and user-generated content like themes may become abandoned. If you wish to take over the maintenance of an existing theme, you must follow this protocol:

1. Submit a well-formed, tested pull request to the original repository.

2. If the maintainer does not respond *at all* after 30 days, or if the maintainer states that they are abandoning the resource and are not willing to grant someone else write access, then proceed to the next step.

3. [Submit a new issue to Grav's GitHub repository](https://github.com/getgrav/grav/issues/new?title=%5Bchange-resource%5D%20Take%20over%20Plugin%2FTheme&body=I%20would%20like%20to%20take%20over%20an%20existing%20plugin%2Ftheme.%0AHere%20are%20the%20project%20details%3A%20%2A%2Auser%2Frepository%2A%2A) with the following details:

  * Title: `[change-resource] Take over plugin/theme`

  * Provide the name of the theme and link to the original repository.

  * Link to your pull request that went unanswered or a link to the conversation in which the maintainer has abandoned the resource.

4. The Grav maintainers will review the case and let you know if the takeover is approved. If approval is granted, proceed to the next step.

5. Prepare your forked repository with a new release.

6. Add a note to the README that this repository is the new master and link back to the old repository.

7. Reply to the issue, giving the maintainers the new URL for the theme.

8. The maintainers will update GPM and new and updated installs will now come from your forked repository.
