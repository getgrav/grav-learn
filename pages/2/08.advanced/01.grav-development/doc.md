---
title: Grav Development
page-toc:
  active: true
taxonomy:
    category: docs
---

# Grav Development

This page is for people who want to work on Grav itself or build things for it. It covers how to set up a development site, run the test suite, scaffold a plugin or theme, and contribute changes back. It applies to the core, plugins, themes, Admin Next and the API plugin.

If you maintain a plugin or theme from Grav 1.x and want to know what changed, start with the [Developer Upgrade Guide](/2/migration/developer-upgrade-guide) and [Plugin Compatibility](/2/plugins/plugin-compatibility) instead.

## The Parts of Grav 2.0

Grav 2.0 is spread across several repositories. Knowing which one owns what saves time when you go to fix something.

| Part | Repository | What it is |
|------|------------|------------|
| Core | [getgrav/grav](https://github.com/getgrav/grav) | The `system` folder, the `bin/grav` CLI, and the base install. |
| API plugin | [getgrav/grav-plugin-api](https://github.com/getgrav/grav-plugin-api) | The REST API at `/api/v1`. Admin Next, the MCP server and any external tool talk to Grav through it. |
| Admin Next | [getgrav/grav-plugin-admin2](https://github.com/getgrav/grav-plugin-admin2) and [getgrav/grav-admin-next](https://github.com/getgrav/grav-admin-next) | The admin panel. The plugin repo is the PHP wrapper and the pre-built app. The `grav-admin-next` repo is the SvelteKit source. |
| MCP server | [getgrav/grav-mcp](https://github.com/getgrav/grav-mcp) | A Node.js app that lets AI clients drive a Grav site through the API. See [MCP Server](/2/advanced/mcp-server). |
| Plugins and themes | One repository each | For example `grav-plugin-error` or `grav-theme-quark2`. |

The classic admin plugin is not part of Grav 2.0. Do not build new admin UI against it.

## Requirements

- **PHP 8.3 or newer.** The core is tested through PHP 8.5.
- **Composer**, for installing dependencies and running the tests.
- **Git**, with a GitHub account if you plan to send pull requests.
- **Node.js 18 or newer**, only if you work on the Admin Next frontend, the MCP server, or a theme with a build step. Plain PHP and Twig work needs no Node.

## Setting Up a Development Site

The normal install copies files into your web root. For development you want the web root to point at your Git clones, so a change in the clone shows up on the site straight away. Grav supports this with symlinks.

### 1. Clone the repositories into one folder

Put every repository you plan to work on in the same parent folder. The CLI tools look for them there.

```bash
mkdir -p ~/Projects/grav
cd ~/Projects/grav
git clone https://github.com/getgrav/grav.git
git clone https://github.com/getgrav/grav-plugin-api.git
git clone https://github.com/getgrav/grav-plugin-admin2.git
git clone https://github.com/getgrav/grav-plugin-error.git
git clone https://github.com/getgrav/grav-plugin-problems.git
git clone https://github.com/getgrav/grav-plugin-shortcode-core.git
git clone https://github.com/trilbymedia/grav-plugin-github-markdown-alerts.git
git clone https://github.com/getgrav/grav-theme-quark2.git
```

> [!TIP]
> If you intend to contribute changes, fork the repository on GitHub first and clone your fork. The example above uses the upstream URLs for simplicity.

The plugins and theme listed here are the ones the core's `.dependencies` file expects. You can add any other plugin or theme repository to the same folder.

### 2. Tell Grav where the clones are

Create a file at `~/.grav/config` with one line pointing at the parent folder:

```yaml
github_repos: /Users/your_name/Projects/grav/
```

Both `bin/grav new-project` and `bin/grav install` read this file when asked to symlink.

### 3. Create the site with symlinks

Run `new-project` from the core clone with the `-s` flag. The destination is the folder your web server serves.

```bash
cd ~/Projects/grav/grav
composer install
bin/grav new-project -s ~/www/grav2
```

This creates the site folders, symlinks `system`, `bin`, `index.php` and `composer.json` back to the core clone, then symlinks each dependency from `.dependencies` into `user/plugins` and `user/themes`. Point your browser at the new site and you have a working Grav install where every edit happens in a Git repository.

### 4. Add more plugins or themes as symlinks

To link another plugin or theme from the same parent folder into an existing site, use `install` with `-p` or `-t`:

```bash
cd ~/www/grav2
bin/grav install -p api
bin/grav install -p admin2
bin/grav install -t my-theme
```

The name is the part after `grav-plugin-` or `grav-theme-`. Running `bin/grav install -s` with no name re-links everything in `.dependencies`.

> [!NOTE]
> Symlinked plugins still need their own Composer dependencies. If a plugin ships a `composer.json`, run `composer install` inside its clone.

## Running the Core Tests

The core uses [Codeception](https://codeception.com) for unit tests and [PHPStan](https://phpstan.org) for static analysis. Install the dev dependencies once, then run the suite from the core clone:

```bash
cd ~/Projects/grav/grav
composer install
composer test
```

To run a single test class or method, call Codeception directly:

```bash
vendor/bin/codecept run unit Grav/Common/InflectorTest
vendor/bin/codecept run unit Grav/Common/InflectorTest:testPluralize
```

Static analysis has its own scripts:

```bash
composer phpstan             # system/src at level 2
composer phpstan-framework   # Framework, Events and Installer at level 6
composer phpstan-plugins     # installed plugins at level 1
```

The full suite must pass before a pull request is merged. If you add behaviour, add a test in `tests/unit` alongside the existing ones.

## Developing Plugins

Most Grav development is plugin development. A plugin is a folder in `user/plugins` with a PHP class that subscribes to [events](/2/plugins/event-hooks). That model has not changed in 2.0.

### Scaffolding a new plugin

Install the [DevTools](https://github.com/getgrav/grav-plugin-devtools) plugin and run the wizard:

```bash
bin/gpm install devtools
bin/plugin devtools new-plugin
```

The wizard asks which Grav version to target and writes the matching `compatibility` block, Grav dependency and PHP requirement. The `api` template gives you a plugin that already registers an API route and a controller. Every option can be passed on the command line:

```bash
bin/plugin devtools new-plugin --grav=2.0 --template=api --name="My Plugin" --desc="What it does" --dev="Me" --email="me@example.com"
```

### What is new for plugins in 2.0

- **Compatibility flags.** Every plugin should declare which Grav versions it supports in `blueprints.yaml`. GPM and the migration tool read it. See [Plugin Compatibility](/2/plugins/plugin-compatibility).
- **API endpoints.** A plugin can register its own REST routes with the `onApiRegisterRoutes` event. See [API Integration](/2/plugins/plugin-api-integration).
- **Admin Next UI.** Custom fields, plugin pages, panels and menu bar items are web components backed by your API endpoints. Standard blueprint config pages need no extra work. See the [API Developer Guide](/2/api/developer-guide).
- **Translations.** Admin Next reads plugin language files differently from the classic admin. See [Admin Translations](/2/plugins/admin-translations).
- **Markdown extensions.** Plugins can add Markdown syntax through the new parser. See [Markdown Extensions](/2/plugins/markdown-extensions).
- **Twig sandbox.** Twig in page content runs in a sandbox. If your plugin adds Twig functions or filters meant for content, they must be allowlisted. See the [Developer Upgrade Guide](/2/migration/developer-upgrade-guide).

When the plugin is ready for other people, follow [GPM Submission](/2/plugins/gpm-submission). That page covers the required files, the changelog format, the release process and how to take over an abandoned plugin.

## Developing Themes

A theme is a folder in `user/themes` with Twig templates, assets and a `blueprints.yaml`. The [Themes](/2/themes) chapter covers the details. DevTools can scaffold one:

```bash
bin/plugin devtools new-theme
```

The theme templates include options for Tailwind CSS and daisyUI with a Node build step, and a plain option with none. The `copy` template starts from a theme you already have installed.

Themes also carry a `compatibility` block. Add it before you publish, and see [GPM Submission](/2/themes/gpm-submission) for the theme release checklist.

## Working on Admin Next

Admin Next is two repositories. `grav-plugin-admin2` is what gets installed on a site. It contains the PHP wrapper and a built copy of the app under `app/`. `grav-admin-next` is the SvelteKit source.

To change the UI, clone both as siblings and build from the plugin folder:

```bash
cd ~/Projects/grav
git clone https://github.com/getgrav/grav-admin-next.git
cd grav-plugin-admin2
./bin/build.sh
```

The script runs `npm run build` in the SvelteKit project and copies the output into `app/`. While you work, `npm run dev:plugin` inside `grav-admin-next` rebuilds into the plugin on every change.

The app is built for a fixed base path. If your admin route is not the default, pass the path when you build:

```bash
ADMIN2_BASE=/my-site/admin2 ./bin/build.sh
```

Admin Next has no direct access to Grav. Everything it does is an API call, so if you need new data in the admin you add an endpoint to the API plugin or your own plugin first. That is also how plugins extend the admin: see the [API Developer Guide](/2/api/developer-guide).

## Working on the API Plugin

The API plugin is a normal Grav plugin. Symlink it into your development site with `bin/grav install -p api`, generate an API key from Admin Next, and test with `curl`:

```bash
curl -s https://grav2.test/api/v1/system/info \
  -H "X-API-Key: $GRAV_API_KEY" | jq
```

Send authentication in an `X-API-Key` header rather than `Authorization`. Some PHP-FPM setups drop the `Authorization` header before PHP sees it.

The [API](/2/api) chapter documents every endpoint. If you add or change an endpoint, update its page under `api-docs/` in the plugin so the reference stays accurate.

## Contributing to the Core

Grav uses the [GitFlow](https://nvie.com/posts/a-successful-git-branching-model/) model. Day-to-day work happens on `develop`. Features go in `feature/` branches that merge into `develop`. Releases merge `develop` into `master` and get a tag with a plain version number such as `2.1.6`.

To send a change:

1. Fork the repository and branch from `develop`.
2. Make the change and add or update tests.
3. Run `composer test` and `composer phpstan`. Both must pass.
4. Open a pull request against `develop`. Say what the change does and why.

Report bugs in the repository that owns the code. Core bugs go to `getgrav/grav`. Admin bugs go to `grav-plugin-admin2`, API bugs to `grav-plugin-api`, and plugin or theme bugs to that plugin's or theme's own repository. If you are not sure, the [Discord](https://chat.getgrav.org) is the quickest place to ask.

## AI-Assisted Development

Team Grav publishes Claude Code skills that encode the API and Admin Next integration patterns. They are useful for porting a 1.x plugin or scaffolding a new one. See [AI-Assisted Development](/2/migration/ai-assisted-development).

## Further Reading

The Grav blog has a developer series that walks through the same ground with longer examples:

- [Grav 2.0 for Plugin Developers: Overview](https://getgrav.org/blog/grav-2-for-plugin-developers)
- [Compatibility Flags](https://getgrav.org/blog/grav-2-dev-compatibility-flags)
- [API Integration for Plugins](https://getgrav.org/blog/grav-2-dev-api-integration)
- [Admin Next: Custom Form Fields](https://getgrav.org/blog/grav-2-dev-admin-next-custom-fields)
- [Admin Next: Custom Pages](https://getgrav.org/blog/grav-2-dev-admin-next-custom-pages)
- [Admin Next: Panels and Menu Bar](https://getgrav.org/blog/grav-2-dev-admin-next-panels-menubar)
- [Markdown Extensions](https://getgrav.org/blog/grav-2-dev-markdown-extensions)

The free [git-sync](https://github.com/trilbymedia/grav-plugin-git-sync) and [license-manager](https://github.com/getgrav/grav-plugin-license-manager) plugins are complete, shipping examples of Admin Next integration and are worth reading end to end.
