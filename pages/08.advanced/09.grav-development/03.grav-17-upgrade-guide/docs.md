---
title: Upgrading to Grav 1.7
taxonomy:
    category: docs
last_checked: 1.7.0 (01/19/2021)
---

Grav 1.7 introduces a few new features, improvements, bug fixes and provides many architectural changes which pave the road towards Grav 2.0. Here are a few highlights:

* **Flex Objects**: A new way to build your own data types.
* **Symfony Server**: Run Grav without needing to install web server.
* **Improved Multi-Language**: Better language fallbacks, improved admin support.
* **Improved Multi-Site**: Admin has improved multi-site support.
* **Improved Admin ACL**: Full CRUD support for users and pages.
* **Improved Media Support**: Support `webp` image format, lazy loading and more.
* **Improved Caching**: New `{% cache %}` tag and improved performance especially in admin.
* **XSS Detection in Forms**: Forms will not submit if potential XSS is detected in them. Check the [documentation](/forms/forms/form-options#xss-checks) on how to disable the checks.
* **Better Debugging Tools**: [Clockwork](https://underground.works/clockwork/) integration, Twig profiling and support for [Tideways XHProf](https://github.com/tideways/php-xhprof-extension) PHP Extension for performance profiling.

!!!! **IMPORTANT:** For most people, Grav 1.7 should be a simple upgrade without any issues, but like any upgrade, it is recommended to **take a backup** of your site and **test the upgrade in a testing environment** before upgrading your live site.

### Most Common Issues

1.  ###### HTML is displayed as **code** on your site rather than being **rendered** as HTML as intended.
    This behavior is a result of the new default of **auto-escaping** being true in Grav 1.7.  This is a security enhancement, and if you are upgrading from a version prior to 1.7, we automatically enable **Twig Compatibility** setting in the system configuration to ensure your old Twig code will continue to function.  If you manually update to 1.7 or upgrade in any way that does not go through the GPM self upgrade process, you should set this setting yourself.

    Check out the [Twig section](#twig) of this guide for full details...

2.  ###### Getting errors about invalid YAML.
    As we have upgraded to a newer version of Symfony framework, the YAML parser is stricter than it was in versions prior to 1.7.  To handle this we have included an older version of the parser that is available when enabling **Yaml Compatibility**.  This is automatically handled for you if you upgrade to Grav 1.7 via GPM, but if you have upgraded manually, you will need to set this value yourself.

    Check out the [YAML section](#yaml) of this guide for full details...

3. ###### Admin showing up with untranslated strings

   If your admin is displaying with untranslated strings in the interface, it's most likely because you have previously disabled **Language Translations**.  This was buggy in previous versions of Grav and disabling it, didn't actually disable translations throughout the admin as intended.  This is **fixed** in Grav 1.7 and this setting is doing what it is intended to do, show the translation codes in uppercase rather than the translated strings themselves.

   Check out the [Troubleshooting](#troubleshooting-issues) section for the fix.

4. ###### Errors on Saving or Non-functioning Admin plugins
   In Grav 1.7 we introduced **Flex Pages** as the new default page management UI.  Also, to optimize performance, we stopped initializing pages on every admin call.  Switching back to regular **Grav Pages** might temporarily resolve your issue.  This is done by editing the **FlexObjects** plugin and disabling **Pages (Admin)**.

   To properly address the issue, custom plugins should be updated to support both **Grav Pages** and **Flex Pages** by using `PageInterface` and also should explicitly Pages when required.

   Check out the [Pages section](#pages-1) and [Admin Section](#admin) of this guide for full details...

    There have also been some specific plugin issues that have already been discovered. Check out the [Troubleshooting](#troubleshooting-issues) section of this page for specific issues with plugins.

5. ###### Page blueprints stop working or give error about a loop
   **Grav 1.7.8** adds support for defining any **blueprint** in your theme. This means that if you have page blueprints in `blueprints/pages/` folder, standard blueprint locations are used, just like in plugins. Unfortunately some older themes may have a mix of files in `blueprints/` and `blueprint/pages`, which breaks the detection and causes either missing fields in admin when editing the pages or a fatal error: `Loop detected while extending blueprint file`.

   If either of these errors happen, check out the [Troubleshooting](#troubleshooting-issues) section for the fix.

### Quick Update Guide

!! **Grav 1.7** requires **PHP 7.3.6** or later version. The recommended version is the latest **PHP 7.4** release.

### YAML

!!!! **IMPORTANT:** Grav 1.7 YAML parser is more strict and your site may break if you have syntax errors in your configuration files or page headers. However, if you update your existing site using `bin/gpm` or `Admin Plugin` upgrade process keeps most of the broken YAML syntax working.

To revert to the old behavior you need to make sure you have following setting in `user/config/system.yaml`:

```yaml
strict_mode:
  yaml_compat: true
```

or in Admin under **Configuration** → **Advanced** -> **YAML Compatibility**

![Yaml Compatibility](yaml-compat.png?classes=shadow)

!!! **TIP:** **Grav 1.6 Upgrade Guide** has a dedicated **[YAML Parsing](/advanced/grav-development/grav-16-upgrade-guide#yaml-parsing)** section to help you to fix these issues.

By default, Grav 1.7 uses a **Symfony 4.4 YAML parser**, which follows the [YAML standard specification](https://yaml.org/spec?target=_blank) more closely than the older versions of Grav. This means that YAML files which previously worked just fine, may cause errors resulting from being invalid YAML. However, Grav will by default still fall back to the older 3.4 version of the parser to keep your site up and running.

!!! **TIP:** You should run **CLI command** `bin/grav yamllinter` or visit in **Admin** > **Tools** > **Reports** before and after upgrade and fix all the YAML related warnings and errors.

### Twig

!!!! **IMPORTANT:** Grav 1.7 enables **Twig Auto-Escaping** by default. However, if you update your existing site using `bin/gpm` or `Admin Plugin` upgrade process keeps the existing auto-escape settings.

To revert to the old behavior you need to make sure you have following settings in `user/config/system.yaml`:

```yaml
twig:
  autoescape: false
strict_mode:
  twig_compat: true
```

or in Admin under **Configuration** → **Advanced** -> **Twig Compatibility**

And please remember to clear cache after doing this!

![Twig Compatibility](twig-compat.png?classes=shadow)

!!! **TIP:** **Grav 1.6 Upgrade Guide** has a dedicated **[Twig](/advanced/grav-development/grav-16-upgrade-guide#twig)** section. It is very important to read it first!

Twig template engine has been updated to version 1.43, but it also supports Twig 2.13. In order to support this newer version of Twig, you need to update any old syntax in your Twig templates. **Grav 1.6 Upgrade Guide** helps you to do this.

Additional changes in templating are:

* Added a new `{% cache %}` Twig tag eliminating need for `twigcache` extension.
* Added `array_diff()` twig function
* Added `template_from_string()` twig function
* Added a new `svg_image()` twig function to make it easier to 'include' SVG source in Twig
* Improved `url()` twig function to take third parameter (`true`) to return URL on non-existing file instead of returning false
* Improved `|array` twig filter to work with iterators and objects with `toArray()` method
* Improved `authorize()` twig function to work better with nested rule parameters
* Improved `|yaml_serialize` twig filter: added support for `JsonSerializable` objects and other array-like objects
* Added default templates for `external.html.twig`, `default.html.twig`, and `modular.html.twig`
* **BACKWARDS COMPATIBILITY BREAK**: Use `{% script 'file.js' at 'bottom' %}` instead of `in 'bottom'` which is broken

## Forms

!!!! **IMPORTANT:** Grav 1.7 changes the behavior of **Strict Validation**. However, if you update your existing site using `bin/gpm` or `Admin Plugin` upgrade process keeps the existing strict mode behaviour.

**Strict mode Improvements**: Inside forms, declaring `validation: strict` was not as strict as we hoped because of a bug. The strict mode should prevent forms from sending any extra fields and this was fixed into Grav 1.7. Unfortunately many of the old forms declared to be strict even if they had extra data in them.

To revert to the old behavior you need to make sure you have following setting in `user/config/system.yaml`:

```yaml
strict_mode:
  blueprint_compat: true
```

**XSS Injection Detection** is now enabled in all the frontend forms by default. Check the [documentation](/forms/forms/form-options#xss-checks) on how to disable or customize the checks per form and per field.

Because of this, we added new configuration option `system.strict_mode.blueprint_compat: true` to maintain old `validation: strict` behavior. It is recommended to turn off this setting to improve site security, but before doing that, please search through all your forms if you were using `validation: strict` feature. If you were, either remove the line or test if the form still works.

! **NOTE:** This backwards compatibility fallback mechanism will be removed in Grav 2.0

### Environments and Multi-Site

!!!! **Important:** Grav 1.7 moves [environments](/advanced/environment-config) into `user://env` folder. The old location still works, but it is better to move environments into a single location future features may rely on it.

Grav 1.7 also adds support for [Server Based Environment Configuration](/advanced/environment-config#server-based-environment-configuration) and [Server Based Multi-Site Configuration](/advanced/multisite-setup#server-based-multi-site-configuration). This feature comes handy if you want to use for example docker containers and you want to make them independent of the domain you happen to use. Or if do not want to store secrets in the configuration, but to store them in your server setup.

In addition `setup.php` file can now be in either `GRAV_ROOT/setup.php` or `GRAV_ROOT/GRAV_USER_PATH/setup.php`. The second location makes it easier to use environments with git repositories containing only user folder.

### User Accounts

Admin has now new [Accounts Administration](/admin-panel/accounts) using **Flex Users**:

* [User Accounts Manager](/admin-panel/accounts/users)
* [User Groups Manager](/admin-panel/accounts/groups)

!!! **NOTE:** Flex Users feature is not yet used in the frontend of your site.

### Pages

The existing [Pages Administration](/admin-panel/page) has been greatly improved with **Flex Pages**:

* Reworked list view: Far better support for large sites
* Better access control: [CRUD ACL](/admin-panel/page/permissions) support with page owners
* Better multi-language support

!! **BACKWARDS COMPATIBILITY BREAK**: We fixed 404 error page when you go to non-routable page with routable, visible child pages under it. Now you get redirected to the first routable, visible child page instead. This is probably what you wanted in the first place.

!!! **NOTE:** Flex Pages feature is not yet used in the frontend of your site.

### Multi-language

Grav 1.7 changed the behavior of how the multi-language fallbacks work for the pages.

Previously if the page did not exist with the requested language, the old implementation looked up the next supported language. This meant that the untranslated page was always displayed, but the page could be using some unknown language to the reader.

The new behavior is to fall back only to the default language of the site. This default behavior can be overridden by setting fallback languages per language by using `system.languages.content_fallback` configuration option.

If the page does not exist in any of the fallback languages, **404 Not Found** will be displayed instead.

!! **BACKWARDS COMPATIBILITY BREAK**: Please add correct fallback languages for the page content in `system.yaml` or admin: **Configuration** > **System** > **Languages** > **Content Language Fallback**.

### Media

Media handling has been greatly improved in Grav 1.7. Some highlights are:

* Support for `webp` image format
* Markdown: Added support for native `loading=lazy` attributes on images.  Can be set in `system.images.defaults` or per md image with `?loading=lazy`
* Added ability to `noprocess` specific items only in Link/Image Excerpts, e.g. `http://foo.com/page?id=foo&target=_blank&noprocess=id`

### CLI

Some highlights are:

* All CLI commands now accept `--env` and `--lang` parameters to set the environment and the used language respectively (`-e` does not work anymore)
* Added new `bin/grav server` CLI command to easily run Symfony or PHP built-in web servers
* Improved `Scheduler` cron command check and more useful CLI information
* Added new `-r <job-id>` option for Scheduler CLI command to force-run a job
* Improved `bin/grav yamllinter` CLI command by adding an option to find YAML Linting issues from the whole site or custom folder
* CLI/GPM command failures now return non-zero code (allowing error detection if command fails)

### Configuration

Added new configuration option to keep default language in `.md` files if set to `false`
  * system.yaml: `languages.include_default_lang_file_extension`: **true**|false
  * Admin: **Configuration** > **System** > **Languages** > **Include default language in file extension**

Added new configuration option to set fallback content languages individually for every language
  * system.yaml: `languages.content_fallback`: See [Language Configuration](/content/multi-language#language-configuration)
  * Admin: **Configuration** > **System** > **Languages** > **Content Language Fallback**

Added new configuration option to choose between debugbar and clockwork
  * system.yaml: `debugger.provider`: **clockwork**|debugbar
  * Admin: **Configuration** > **System** > **Debugger** > **Debugger Provider**

Added new configuration option to hide potentially sensitive information
  * system.yaml: `debugger.censored`: **false**|true
  * Admin: **Configuration** > **System** > **Debugger** > **Censor Sensitive Data**

Added new configuration option to maintain old `validation: strict` behavior
  * system.yaml: `strict_mode.blueprint_compat`: **true**|false
  * Admin: **Configuration** > **System** > **Advanced** > **Blueprint Compatibility**

Added system configuration support for `HTTP_X_FORWARDED` headers (host disabled by default)
  * system.yaml: `http_x_forwarded.protocol`: **true**|false
  * Admin: **Configuration** > **System** > **Advanced** > **HTTP_X_FORWARDED_PROTO Enabled**
  * system.yaml: `http_x_forwarded.host`: true|**false**
  * Admin: **Configuration** > **System** > **Advanced** > **HTTP_X_FORWARDED_HOST Enabled**
  * system.yaml: `http_x_forwarded.port`: **true**|false
  * Admin: **Configuration** > **System** > **Advanced** > **HTTP_X_FORWARDED_PORT Enabled**
  * system.yaml: `http_x_forwarded.ip`: true|**false**
  * Admin: **Configuration** > **System** > **Advanced** > **HTTP_X_FORWARDED IP Enabled**

Added new configuration option `security.sanitize_svg` to remove potentially dangerous code from SVG files
  * security.yaml: `sanitize_svg`: **true**|false
  * Admin: **Configuration** > **Security** > **Sanitize SVG**

## DEVELOPERS

### Debugging

* Added support for [Clockwork](https://underground.works/clockwork) developer tools (now default debugger)
* Added support for [Tideways XHProf](https://github.com/tideways/php-xhprof-extension) PHP Extension for profiling method calls
* Added Twig profiling for Clockwork debugger

### Use composer autoloader

* Upgraded `bin/composer.phar` to `2.0.2` which is all new and much faster
* Please add `composer.json` file to your plugin and run `composer update --no-dev` (and remember to keep it updated):

    composer.json
    ```json
    {
        "name": "getgrav/grav-plugin-example",
        "type": "grav-plugin",
        "description": "Example plugin for Grav CMS",
        "keywords": ["example", "plugin"],
        "homepage": "https://github.com/getgrav/grav-plugin-example",
        "license": "MIT",
        "authors": [
            {
                "name": "...",
                "email": "...",
                "homepage": "...",
                "role": "Developer"
            }
        ],
        "support": {
            "issues": "https://github.com/getgrav/grav-plugin-example/issues",
            "docs": "https://github.com/getgrav/grav-plugin-example/blob/master/README.md"
        },
        "require": {
            "php": ">=7.1.3"
        },
        "autoload": {
            "psr-4": {
                "Grav\\Plugin\\Example\\": "classes/",
                "Grav\\Plugin\\Console\\": "cli/"
            },
            "classmap":  [
                "example.php"
            ]
        },
        "config": {
            "platform": {
                "php": "7.1.3"
            }
        }
    }
    ```

  See [Composer schema](https://getcomposer.org/doc/04-schema.md)

* Please use autoloader instead of `require` in the code:

    example.php
    ```php
      /**
       * @return array
       */
      public static function getSubscribedEvents(): array
      {
          return [
              'onPluginsInitialized' => [
                  // This is only required in Grav 1.6. Grav 1.7 automatically calls $plugin->autolaod() method.
                  ['autoload', 100000],
              ]
          ];
      }

      /**
       * Composer autoload.
       *
       * @return \Composer\Autoload\ClassLoader
       */
      public function autoload(): \Composer\Autoload\ClassLoader
      {
          return require __DIR__ . '/vendor/autoload.php';
      }
    ```

* Plugins & Themes: Call `$plugin->autoload()` and `$theme->autoload()` automatically when object gets initialized
* Make sure your code does not use `require` or `include` for loading classes

### Plugin/Theme Blueprints (`blueprints.yaml`)

* Please add:
    ```yaml
    slug: folder-name
    type: plugin|theme
    ```
* Make sure you update your dependencies. I recommend setting Grav to either 1.6 or 1.7 and update your code/vendor to PHP 7.1
    ```yaml
    dependencies:
        - { name: grav, version: '>=1.6.0' }
    ```

* Added `themes` to cached blueprints and configuration
* **Grav 1.7.8** adds support for defining any **blueprint** in your theme. Move all files and folders in `blueprints/` into `blueprints/pages/` to keep your theme forward compatible. Also remember to update minimum Grav dependency to `>=1.7.8`.

### Sessions

* Session ID now changes on login to prevent session fixation issues
* Added `Session::regenerateId()` method to properly prevent session fixation issues

### ACL

* `user.authorize()` now requires user to be authorized (passed 2FA check), unless the rule contains `login` in its name.
* Added support for more advanced ACL (CRUD)

* **BC BREAK** `user.authorize()` and Flex `object.isAuthorized()` now have two deny states: `false` and `null`.

    Make sure you do not have strict checks against false: `$user->authorize($action) === false` (PHP)  or `user.authorize(action) is same as(false)` (Twig).

    For the negative checks you should be using `!user->authorize($action)` (PHP) or `not user.authorize(action)` (Twig).

    The change has been done to allow strong deny rules by chaining the actions if previous ones do not match: `user.authorize(action1) ?? user.authorize(action2) ?? user.authorize(action3)`.

    Note that Twig function `authorize()` will still **keeps** the old behavior!

### Pages

* Added default templates for `external.html.twig`, `default.html.twig`, and `modular.html.twig`
* Admin uses `Flex Pages` by default (can be disabled from `Flex-Objects` plugin)

  ![Disable Flex Pages](disable-flex-pages.png?classes=shadow)

* Added page specific admin permissions support for `Flex Pages`
* Added root page support for `Flex Pages`
* Fixed wrong `Pages::dispatch()` calls (with redirect) when we really meant to call `Pages::find()`
* Added `Pages::getCollection()` method
* Moved `collection()` and `evaluate()` logic from `Page` class into `Pages` class

* **DEPRECATED** `$page->modular()` in favor of `$page->isModule()`
* **DEPRECATED** `PageCollectionInterface::nonModular()` in favor of `PageCollectionInterface::pages()`
* **DEPRECATED** `PageCollectionInterface::modular()` in favor of `PageCollectionInterface::modules()`

* **BC BREAK** Fixed `Page::modular()` and `Page::modularTwig()` returning `null` for folders and other non-initialized pages. Should not affect your code unless you were checking against `false` or `null`.
* **BC BREAK** Always use `\Grav\Common\Page\Interfaces\PageInterface` instead of `\Grav\Common\Page\Page` in method signatures
* Admin now uses `Flex Pages` by default, collection will behave in slightly different way
* **BC BREAK** `$page->topParent()` may return page itself instead of null
* **BC BREAK** `$page->header()` may now `\Grav\Common\Page\Header` return object instead of `stdClass`, you need to handle both (Flex vs regular)

### Media

* Added `MediaTrait::freeMedia()` method to free media (and memory)
* Added support for uploading and deleting images directly in `Media` by using PSR-7
* Adjusted asset types to enable extension of assets in class
* **BC BREAK** Media no longer extends `Getters`, accessing `$media->$filename` no longer works, use `$media[$filename]` instead!

### Markdown

* **BC BREAK** Upgraded Parsedown to 1.7 for Parsedown-Extra 0.8. Plugins that extend Parsedown may need a fix to render as HTML
* Added new `Excerpts::processLinkHtml()` method

### Users

* Added experimental support for `Flex Users` in the frontend (not recommended to use yet)
* Admin uses `Flex Users` by default (can be disabled from `Flex-Objects` plugin)
* Improved `Flex Users`: obey blueprints and allow Flex to be used in admin only
* Improved `Flex Users`: user and group ACL now supports deny permissions
* Changed `UserInterface::authorize()` to return `null` having the same meaning as `false` if access is denied because of no matching rule
* **DEPRECATED** `\Grav\Common\User\Group` in favor of `$grav['user_groups']`, which contains Flex UserGroup collection
* **BC BREAK** Always use `\Grav\Common\User\Interfaces\UserInterface` instead of `\Grav\Common\User\User` in method signatures

### Flex

* Do not use `Framework` Flex classes directly, it's better to use or extend classes under `Grav\Common\Flex\Types\Generic` namespace
* Added `$grav['flex']` to access all registered Flex Directories
  * Added `FlexRegisterEvent` which triggers when `$grav['flex']` is being accessed the first time
* Added `hasFlexFeature()` method to test if `FlexObject` or `FlexCollection` implements a given feature
* Added `getFlexFeatures()` method to return all features that `FlexObject` or `FlexCollection` implements
* Added `FlexObject::refresh()` method to make sure object is up to date
* Added `FlexStorage::getMetaData()` to get updated object meta information for listed keys
* Added `FlexDirectoryInterface` interface
* Added search option `same_as` to Flex Objects
* `Flex Pages` method `$page->header()` returns `\Grav\Common\Page\Header` object, old `Page` class still returns `stdClass`
* Renamed `PageCollectionInterface::nonModular()` into `PageCollectionInterface::pages()` and deprecated the old method
* Renamed `PageCollectionInterface::modular()` into `PageCollectionInterface::modules()` and deprecated the old method
* `FlexDirectory::getObject()` can now be called without any parameters to create a new object
* Implemented customizable configuration per flex directory type
* **DEPRECATED** `FlexDirectory::update()` and `FlexDirectory::remove()`
* **BC BREAK** Moved all Flex type classes under `Grav\Common\Flex`
* **BC BREAK** `FlexStorageInterface::getStoragePath()` and `getMediaPath()` can now return null
* **BC BREAK** Flex objects no longer return temporary key if they do not have one; empty key is returned instead
* **BC BREAK** Added reload argument to `FlexStorageInterface::getMetaData()`
* You can add `edit_list.html.twig` file to a form field in order to customize look in the listing view

### Multi-language

* Improved language support for `Route` class
* Translations: rename MODULAR to MODULE everywhere
* Added `Language::getPageExtensions()` to get full list of supported page language extensions
* **BC BREAK** Fixed `Language::getFallbackPageExtensions()` to fall back only to default language instead of going through all languages

### Multi-site

* Added support for having all sites / environments under `user/env` folder

### Serialization

* All classes now use PHP 7.4 serialization. The old `Serializable` methods are now final and cannot be overridden.

### Blueprints

* Added `flatten_array` filter to form field validation
* Added support for `security@: or: [admin.super, admin.pages]` in blueprints (nested AND/OR mode support)
* Blueprint validation: Added `validate: value_type: bool|int|float|string|trim` to `array` to filter all the values inside the array
* If your plugins has blueprints folder, initializing it in the event will be too late. Do this instead:

    ```php
    class MyPlugin extends Plugin
    {
        /** @var array */
        public $features = [
            'blueprints' => 0, // Use priority 0
        ];
    }
    ```

### Events

* Use `Symfony EventDispatcher` directly instead of `rockettheme/toolbox` wrapper.
* Added `$grav->dispatchEvent()` method for PSR-14 events
* Added `PluginsLoadedEvent` which triggers after plugins have been loaded but not yet initialized
* Added `SessionStartEvent` which triggers when session is started
* Added `FlexRegisterEvent` which triggers when `$grav['flex']` is being accessed the first time
* Added `PermissionsRegisterEvent` which triggers when `$grav['permissions']` is being accessed the first time
* Added `onAfterCacheClear` event
* Check `onAdminTwigTemplatePaths` event, it should NOT be:

    ```php
    public function onAdminTwigTemplatePaths($event)
    {
        // This code breaks all the other plugins in admin, including Flex Objects
        $event['paths'] = [__DIR__ . '/admin/themes/grav/templates'];
    }
    ```
    but:
    ```php
    public function onAdminTwigTemplatePaths($event)
    {
        // Add plugin template path for admin.
        $paths = $event['paths'];
        $paths[] = __DIR__ . '/admin/themes/grav/templates';
        $event['paths'] = $paths;
    }
    ```

### JavaScript

* Updated bundled JQuery to latest version `3.5.1`

### Misc

* Added `Utils::functionExists()`: PHP 8 compatible `function_exists()`
* Added `Utils::isAssoc()` and `Utils::isNegative()` helper methods
* Added `Utils::simpleTemplate()` method for very simple variable templating
* Added `Utils::fullPath()` to get the full path to a file be it stream, relative, etc.
* Support customizable null character replacement in `CSVFormatter::decode()`
* Added new `Security::sanitizeSVG()` function
* Added `$grav->close()` method to properly terminate the request with a response
* Added `Folder::countChildren()` method to determine if a folder has child folders
* Support symlinks when saving `File`
* Added `Route::getBase()` method
* **BC BREAK** Make `Route` objects immutable. This means that you need to do: `{% set route = route.withExtension('.html') %}` (for all `withX` methods) to keep the updated version.
* Better `Content-Encoding` handling in Apache when content compression is disabled
* Added a `Uri::getAllHeaders()` compatibility function
* Allow `JsonFormatter` options to be passed as a string

### CLI

* **BC BREAK** Many plugins initialize Grav in a wrong way, it is not safe to initialize plugins and theme by yourself
    * Following calls require Grav 1.6.21 or later, so it is recommended to set Grav dependency to that version
    * Inside `serve()` method:
    * Call `$this->setLanguage($langCode);` before doing anything else if you want to set the language (or use default)
    * Call one of following:
        * `$this->initializeGrav();` Already called if you're in `bin/plugin`, otherwise you may need to call this one
        * `$this->initializePlugins();` This initializes grav, plugins (up to `onPluginsInitialized`)
        * `$this->initializeThemes();` This initializes grav, plugins and theme
        * `$this->initializePages();` This initializes grav, plugins, theme and everything needed by pages
* It is a good idea to prefix your CLI command classes with your plugin name, otherwise there may be naming conflicts (we already have some!)

### Used Libraries

* Updated Symfony Components to 4.4, please update any deprecated features in your code
* **BC BREAK** Please run `bin/grav yamllinter` to find any YAML parsing errors in your site (including your plugins and themes).

## PLUGINS

### Admin

* Added `Content Editor` option to user account blueprint

* **BC BREAK** Admin will not initialize frontend pages anymore, this has been done to greatly speed up Admin plugin.

    Please call `$grav['admin']->enablePages()` or `{% do admin.enablePages() %}` if you need to access frontend pages. This call can be safely made multiple times.

    If you're using `Flex Pages`, please use Flex Directory instead, it will make your code so much faster.

* Admin now uses Flex for editing `Accounts` and `Pages`. If your plugin hooks into either of those, please make sure they still work.

* Admin cache is enabled by default, make sure your plugin clears cache when needed. Please avoid clearing all cache!

### Shortcode Core

* **DEPRECATED** Every shortcode needs to have `init()` method, classes without it will stop working in the future.

## Troubleshooting Issues

#### `ERROR: flex-objects.html.twig template not found for page`

If you get this error after upgrading to Grav 1.7, it might be related to a plugin called `content-edit`.  If you disable this plugin, the error should resolve itself. [Grav Issue #3169](https://github.com/getgrav/grav/issues/3169)

#### Untranslated Admin

If your admin plugin looks like this:

![Untranslated Admin](untranslated.png?classes=shadow)

The fix is very easy, and can be done even when not fully translated. Simply navigate to `PLUGIN_ADMIN.CONFIGURATION` and then in `PLUGIN_ADMIN.LANGUAGES`, set `PLUGIN_ADMIN.LANGUAGE_TRANLATIONS` to `PLUGIN_ADMIN.YES`:

![Fix translations](fix-translations.png?classes=shadow)

#### Page blueprints stop working in Admin

If you cannot see your custom fields when editing the page, your theme is using two conflicting locations for page blueprints.

If the theme was not created by you, please report a bug to the theme author.

To fix the bug, you need to move all files and folders in your theme from `blueprints/` to `blueprints/pages/` (requires **Grav 1.7.8+**). Alternatively if the theme must support older versions of Grav, do the opposite.

#### Error: Loop detected while extending blueprint file

The easiest fix for loop error is to move the files into their proper location, please see the above issue.

Alternatively you can fix the issue by changing the broken page blueprint from:

```yaml
extends@:
    type: [NAME]
    context: 'blueprints://pages'
```

where `[NAME]` is the filename (without the file extension) of the blueprint itself, to:

```yaml
extends@: self@
```

#### Missing CSS Styling in Admin

It has been reported that after upgrading to latest Grav 1.7 and Admin 1.10, some admin pages appear broken and not fully styled.  THis could be related to the `imagecreate` plugin.  Disabling this plugin is not enough, you must **completely remove** the plugin, and then the error should resolve  itself.  [Admin Issue #2035](https://github.com/getgrav/grav-plugin-admin/issues/2035)

## Reverting back to latest Grav 1.6

While we recommend resolving any issues you may have to ensure that Grav 1.7 and future updates will be an easy upgrade, there are going to be scenarios where you have custom plugin functionality, or don't have the developer resources handy, and just need to get back to Grav 1.6 quickly.

If you have CLI access to the site, this can be done by running these commands from the **root of your Grav 1.7** site:

```bash
wget -q https://getgrav.org/download/core/grav-update/1.6.31 -O tmp/grav-update-v1.6.31.zip
wget -q https://getgrav.org/download/plugins/admin/1.9.19 -O tmp/grav-plugin-admin-v1.9.19.zip
unzip tmp/grav-update-v1.6.31.zip -d tmp
unzip tmp/grav-plugin-admin-v1.9.19.zip -d tmp
cp -rf tmp/getgrav-grav-plugin-admin-5d86394/* user/plugins/admin/
cp -rf tmp/grav-update/* ./
```

Basically it does a **direct-install** of the latest version of Grav 1.6 and Admin 1.9 on top of your current installation.  It doesn't touch the `user/` folder so your content and plugins are not impacted.

For those who do not have CLI access, download [grav-update-v1.6.31.zip](https://github.com/getgrav/grav/releases/download/1.6.31/grav-update-v1.6.31.zip) and [grav-plugin-admin-1.9.19.zip](https://github.com/getgrav/grav-plugin-admin/archive/1.9.19.zip) files using the links given here. Unzip the files into your filesystem. Then use your favorite FTP/SFTP client to copy all the Grav files to your `WEBROOT` and Admin files into `WEBROOT/user/plugins/admin`.
