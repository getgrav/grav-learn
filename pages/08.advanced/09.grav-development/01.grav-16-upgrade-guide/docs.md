---
title: Grav 1.6 Upgrade Guide
taxonomy:
    category: docs
---

Grav 1.6 is the largest update since the initial release of Grav. It introduces a few new features, improvements, bug fixes and provides many architectural changes which pave the road towards Grav 2.0. 

!!!! **IMPORTANT:** For most people, Grav 1.6 should be a simple upgrade without any issues, but like any upgrade, it is recommended to **take a backup** of your site and **test the upgrade in a testing environment** before upgrading your live site.

Whether you are a developer or administrator of your site, your test site should have [Debug Bar](/advanced/debugging#debug-bar) enabled. This is because of Debug Bar has some useful tools which help you to ensure your site will be better prepared to run on later versions of Grav.

!!! **TIP:** For more information how to enable the feature, please see [Debugging & Logging](https://learn.getgrav.org/16/advanced/debugging) section in the documentation.

## Deprecated Debug Bar Tab

For our purposes, we are looking **Deprecated** tab in the Debug Bar, which allows you to identify deprecated issues and fix or report them before upgrading to later Grav versions. Fixing the issues found in the **Deprecated** tab will help you to make your site faster and save you time when it is time to during future upgrades.

![Deprecated Tab](deprecated-tab.png?classes=shadow)

! **NOTE:** that **Deprecated** tab shows up only if deprecated calls are detected in the page

To make sure that you catch all the issues, you should either clear the cache and run Grav with caching disabled to maximize the chance you will catch all the errors. Even by following these steps, you may notice that some of the YAML/Twig errors appear only after clearing the cache.

The **Deprecated** tab contains a list of deprecated features which were found. Every issue is clickable and opens up deprecation message, which has a short explanation from the issue as well as trace back, which allows you to locate and fix the code. In the right side you can see type of the deprecated error and in lower right corner you can filter the displayed types by clicking on the badges.

When you open up the deprecation message, the content may first feel overwhelming. But in most cases you can ignore most of the content and just read the first few lines: message, file and line (if available).

There are a few types of deprecation issues:

* `yaml`: YAML or Markdown file uses deprecated YAML syntax. 
* `twig`: Twig file contains deprecated Twig syntax or there was another Twig related issue.
* `grav`: Something is calling deprecated Grav method or using deprecated property.
* `vendor`: Something is using deprecated 3rd party library code.
* `unknown`: Unknown deprecated message.

## YAML Parsing

! **NOTE:** In Grav 1.6 YAML has stricter parsing with a fallback for backwards compatibility

Grav 1.6 uses a **Symfony 4.2 YAML parser**, which follows the [YAML standard specification](https://yaml.org/spec?target=_blank) much more closely than the previously parser from Symfony **3.4**. This means that YAML files which previously worked just fine, may cause errors resulting from being invalid YAML. However, if the file fails to load with the new **4.2** version of the parser, Grav will by default still fall back to the older **3.4** version of the parser to keep your site up and running. However this will decrease the performance of the site and you should catch and fix the issues to ensure optimal performance. 

! **NOTE:** This backwards compatibility fallback mechanism will be removed in Grav 2.0

The Debug Bar can be used to spot any deprecated YAML. Just open the Debug Bar and look at the **Deprecated** tab. If the tab cannot be found, no issues were detected.

!!! **TIP:** You can filter any **YAML** issues by looking at the **badges in the bottom-right corner** of the Debug Bar. Simply filter to only show **YAML** issues by clicking the other buttons to disable them.

! **NOTE:** YAML errors require you to clear cache the errors will only be picked up when the YAML files are decoded.

##### Look for these YAML errors:

- Do not use `@`, `\``, `|`, `%` and `>` at the beginning of an unquoted string: do not use `@data-options: []`, use `data-options@: []` instead.
- Always add whitespace after a colon `:` for the keys: do not use `key:value`, use `key: value` instead.
- Always quote `null`, `true`, `false`, `2.0` (floats) in keys; keys can only be either integers or strings.
- Also quote `null`, `true`, `false`, `2` and `2.0` in values if they are meant to be strings.
- When surrounding strings with double-quotes, you must now escape `\` characters.

### YAML Compatibility Mode

By default, YAML Compatibility Mode has been turned on in Grav 1.6. This will allow older sites to keep on working after upgrade, but it is not ideal to be used in new sites or if you have already fixed and tested your site against all YAML parsing errors.

You can change this setting in `user/config/system.yaml`:

[prism classes="language-yaml line-numbers"]
strict_mode:
  yaml_compat: false
[/prism]

Our recommendation is not to touch this setting on existing sites just yet, rather you should create test sites with compatibility mode **false**. Also any new site made with Grav 1.6 or later should have compatibility mode turned off during development as it allows you to save a lot of time when it is time to upgrade to Grav 2.0.

## Twig

### Deferred Blocks

You should update your theme to version that add support for deferred asset blocks to provide full Grav 1.6 support. Alternatively, if you have a custom modified theme or developed your own, you should update it yourself in order to ensure that it keeps working with the new features and later versions of Grav and its plugins by following the guide in the [Important Theme Updates](https://getgrav.org/blog/important-theme-updates) blog post.

### Deprecated Twig

Grav 2.0 will be using **Twig 2** instead of Twig 1 that is currently used in the Grav 1.x releases. There are a few deprecated features which have been removed in Twig 2, which is why you should make sure that you catch and fix all of those issues before upgrading to Grav 2.0 down the road. 

The Debug Bar can be used to spot any deprecated Twig issues. Just open the Debug Bar and click on the **Deprecated** tab.

##### Look for these Twig issues:

- Macros imported in a file will not be available in child templates anymore (via an include call for instance). You need to import macros explicitly in each file where you are using them.
- Filter `|replace()` will only work with associated array as the parameter: `{ "I like this and that."|replace({'this': 'foo', 'that': 'bar'}) }}`.
- Test `sameas()` should now be written as `same as()`.

More information of what has been deprecated [can be found here](https://twig.symfony.com/doc/1.x/deprecated.html?target=_blank).

### Auto-Escaping

Grav has been rather safe from vulnerabilities, except from XSS attacks, which can be triggered without much effort on any code which does not properly escape untrusted input from a user. Twig is an easy way to write template files, but at the same time it is too easy to forget that most of the variables which are used in the template files are not sanitized before being used. Even if they are filtered and safe, they may contain special characters which should be escaped to make the HTML code valid.

For example you may have a Twig template like this:

[prism classes="language-twig line-numbers"]
{% set my_string = '<script>echo("hello there!");<script>' %}
<p>
    {{ my_string }}
</p>
[/prism]

By default Grav has **Twig auto-escaping turned off** for simplicity and clarity of templates, but unfortunately this was a poor decision because nobody, including us, remembers to always escape variables which either may contain special characters or are coming from an untrusted source. To make the things worse, it is usually not known if the variable is HTML-safe or not. To make sure that a site is protected from most XSS vulnerabilities, you should enable auto-escaping in your configuration. Unfortunately themes and plugins that utilize Twig templates tend to not work with the setting turned on -- and templates written without explicit escaping are most likely vulnerable to malicious content.

With the example above, as auto-escaping is disabled, the output will render as pure HTML, and an alert box with `"hello there!"` will popup.  However, this should be escaped using the `|e` Twig escape filter (or `|e('html')`:

[prism classes="language-twig line-numbers"]
{% set my_string = '<script>echo("hello there!");<script>' %}
<p>
    {{ my_string|e }}
</p>
[/prism]

Because of most people tend to forget to escape the variables in Twig and because using `|e` everywhere can make the template files harder to read, there is a new setting in `user/config/system.yaml`:


[prism classes="language-yaml line-numbers"]
strict_mode:
  twig_compat: false
[/prism]

This setting forces `auto-escaping` to be turned on in all Twig template files and disables the old setting to turn it on and off. The side effect of the setting is that your site will likely contain a few escaped pieces of content, which you will need to fix by using `|raw` filter for all the content which needs to contain HTML and HTML only. Many templates and plugins have not yet been updated to work with escaping forced on, so please report of any bugs in those to allow them to be fixed in a timely manner.

The transition to use auto-escaping will not be easy. During the transition all the template files should either contain both `|e` and `|raw` filters on every variable to make sure that the template file is safe to be used in both modes, or you can surround all the template code with `{% autoescape %}` Twig tags.

See https://twig.symfony.com/doc/1.x/tags/autoescape.html for more information.
