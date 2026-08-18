---
title: Twig in Content
description: How Grav 2.0 gates and sandboxes Twig inside page content, how to enable it, how to customize the sandbox, and the safer alternatives.
page-toc:
  active: true
taxonomy:
    category: docs
---

# Twig in Content

Grav can process **Twig** inside a page's Markdown content, so you can write expressions like `{{ ... }}` and tags like `{% ... %}` directly in a page body. In Grav 2.0 this behavior changed for security reasons: Twig in content is now **disabled by default**, and when you enable it, the content runs inside a **security sandbox**.

===

!! This page is about Twig authored inside **page content**. The `.html.twig` files in your theme and plugins are trusted code on disk and are **never** sandboxed. Nothing on this page affects normal theme or plugin development.

## What Changed in 2.0

In Grav 1.7, any page with `process.twig: true` in its front matter had its content run through Twig with no restrictions. Because page content is authored by anyone with edit access, that meant a page editor could write Twig that read configuration secrets, touched the filesystem, or in the worst case executed code on the server. This class of vulnerability is known as **Server-Side Template Injection (SSTI)**.

Grav 2.0 closes that hole with two independent layers:

1. **A gate.** Twig in content does not run at all unless an administrator explicitly enables it in security configuration.
2. **A sandbox.** When content Twig does run, only an allow-list of safe tags, filters, functions, methods, and properties is permitted. Everything else is blocked.

The two are separate. The gate decides *whether* content Twig runs; the sandbox decides *what it can do* once it does. Enabling the gate does not disable the sandbox.

## Enabling Twig in Content

### 1. Choose a profile

In the Admin panel, go to **Configuration → Security**. At the top of the page is a single **Twig in Content** profile selector that covers the common cases:

| Profile | Effect |
| --- | --- |
| **Off** | Content Twig never runs. The default. |
| **Trusted roles only** | Content Twig runs, but only super users and holders of the `admin.pages_twig` permission can enable it on a page. |
| **All editors** | Content Twig runs, and any user with page-edit access can enable it on the pages they edit. |
| **Custom** | Shown only when your saved settings do not match a named profile (for example a hand-edited combination). Picking a named profile replaces it. |

Picking a profile writes the two underlying keys for you, so you rarely need to touch them directly. They stay available below the selector as the advanced view:

| Setting | Default | Effect |
| --- | --- | --- |
| **Process Enabled** | Off | Master switch. While off, content Twig never runs, regardless of any page's front matter. |
| **Editor Enabled** | Off | Controls who may toggle `process.twig` from the page editor. Off: only users with the `admin.pages_twig` permission (or a super user). On: anyone with page-edit access. |

The equivalent settings in `user/config/security.yaml`:

```yaml
twig_content:
  process_enabled: true
  editor_enabled: true
```

The profiles map to those keys like this: **Off** is both off, **Trusted roles only** is `process_enabled: true` with `editor_enabled: false`, and **All editors** is both on.

### 2. Know what the gate turns on

With **Process Enabled** on, the gate is the single source of truth for content Twig, and **every page processes Twig in its content by default**. This is a change from 1.7, where each page opted in individually through its front matter. You no longer flag pages one at a time.

If you want to keep a specific page from running Twig in its content, opt that page *out* in its front matter:

```yaml
---
title: My Page
process:
    twig: false
---
```

An explicit `process.twig` value on a page (`true` or `false`) always wins over the gate, so you can still force Twig on for a single page, but you rarely need to. Because the switch enables content Twig across the whole site, turn it on deliberately.

### Keeping literal `{{ }}` in content

When content Twig is enabled, Grav evaluates every `{{ ... }}` and `{% ... %}` in a page's content. That is a problem if the double braces are meant for something other than Grav, such as a Formspree form field, or a Vue, Handlebars, or Angular template you are embedding. Grav resolves the expression, finds nothing, and the braces disappear from the output.

You have two ways to keep the literal braces:

1. Opt the whole page out of content Twig with `process.twig: false` in its front matter (shown above).
2. Wrap just the affected markup in a `verbatim` tag so Grav leaves it untouched while the rest of the page still processes Twig:

```twig
{% verbatim %}
<input type="hidden" name="subject" value="Feedback: {{ user_subject }} {{ topic }}" />
{% endverbatim %}
```

On a default install content Twig is off, so these braces already pass straight through and no escaping is needed.

### 3. Clear the cache

After changing security configuration or a page's `process` setting, clear the cache so pages re-render:

```bash
bin/grav cache
```

!!! If **Process Enabled** is off and a page sets `process.twig: true`, the page's Twig is **not** rendered. The raw `{{ ... }}` and `{% ... %}` markup is returned as literal text, and a notice is written to `logs/security.log`.

## The Sandbox

Once content Twig runs, it runs inside the sandbox defined under `twig_sandbox` in `system/config/security.yaml`. The sandbox allows a generous set of safe, read-only Twig out of the box, which covers the large majority of real-world use:

* **Tags** for control flow and composition: `if`, `for`, `set`, `block`, `include`, `embed`, `macro`, `apply`, `with`, `verbatim`, and more.
* **Filters** such as `date`, `upper`, `lower`, `default`, `markdown`, `json_encode`, `number_format`, `nicetime`, `slug`, `length`, `join`, `sort`, and many others.
* **Functions** such as `url`, `authorize`, `t`, `media_directory`, `theme_var`, `nicetime`, `dump`, and the standard Twig helpers like `range`, `min`, `max`, and `cycle`.
* **Read-only methods and properties** on everyday objects: the current `page` (title, header, media, children, collection, taxonomy, and so on), its `media`, the `uri`, the active `user`, and the active `language`.

The complete default lists live in `system/config/security.yaml` under `twig_sandbox` and can be reviewed in the Admin panel under **Configuration → Security → Twig Sandbox**.

### What happens when something is blocked

The sandbox fails gently rather than throwing a fatal error:

* The blocked expression **renders as literal text** in the output, so you can see exactly what was stopped.
* A line is written to `logs/security.log` naming the blocked tag, filter, function, method, or property, along with the page route and a hint on how to allow it.
* The same event is recorded for the **Twig in Content report** (see below), so you do not have to read the log file to find out what was blocked.
* If you are logged in as a super administrator and `admin_hint` is enabled, Grav adds an HTML comment near the blocked expression pointing you at the log.

So if a page shows raw `{{ something() }}` after you've enabled the gate, the sandbox blocked `something()`. The report names the exact member it did not recognize and how to allow it.

## The content XSS check

The blueprint XSS validator inspects the **raw** content you save, so a payload assembled at render time (for example `{{ "on" ~ "error" }}`, which only becomes `onerror` once Twig runs) slips past it. Grav closes that gap **when the page is saved**: it renders the editor's own Twig in isolation through the same sandboxed pass described above, runs the XSS detector over the result, and rejects the save if the rendered markup is dangerous. The rejection is written to `logs/security.log`.

Because the check runs at save time and only ever sees the editor's own output, no shortcode, plugin or theme markup is ever inspected, and viewing a page costs nothing extra. Accounts covered by `security.xss_whitelist` (super administrators by default) are exempt, matching the raw-source validator.

The patterns it matches are the ones under `security.xss_enabled` and `security.xss_dangerous_tags` in `system/config/security.yaml` — the same list `bin/grav security` uses.

> [!NOTE]
> There is no setting for this check, and no separate scan of the finished page at render time. Grav 2.0.1 through 2.0.10 had one, gated by `security.twig_content.xss_scan_output` and later `security.content.xss_scan_output`. Both keys were retired in **Grav 2.0.11**, along with `security.xss_allowed_iframe_hosts` and the `onXssTrustedMarkup` / `onXssAllowedIframeHosts` events that only fed it, and are stripped from `user/config/security.yaml` automatically on upgrade.

## The Twig in Content Report

Every silent failure on this page (a gated page, a sandbox block, a page leaking raw Twig) is collected into one place in Admin: **Tools → Reports → Twig in Content**. It saves you from reading `logs/security.log` by hand. The report shows:

* **The current state** at a glance: whether the gate and the sandbox are on.
* **Pages leaking raw Twig.** Any page whose content contains `{{ ... }}` or `{% ... %}` that will not render (because the gate is off, or that page has Twig turned off) is listed with a plain-language reason and a link straight to the page editor.
* **Recent blocks.** The most recent gate blocks and sandbox blocks, each with the page route and the same hint that goes to the log. A sandbox block carries an **Add to allowlist** button that appends the blocked member to the correct list for you, with the full existing list preserved (see [Customizing the Sandbox](#customizing-the-sandbox)).
* **Scan content.** A button that scans every page's content for tags, filters, and functions the sandbox does not currently allow, so you can see what your content needs *before* you turn the gate on rather than discovering it page by page.

When you open a page in the editor, the same information appears as an inline banner at the top of that page if its content would leak raw Twig or recently hit a block, with a link to the full report.

!! A page can carry `process.twig: true` (often left over from a Grav 1.7 site) while the gate is off. In 2.0 that flag is only a request: the gate still has the final say, so those pages render raw. The report calls this out explicitly so you can either pick a profile to enable Twig or remove the stale flag.

## Customizing the Sandbox

If you have decided that a particular Twig member is safe to run against content your authors could write, you can add it to the allow-list. First, an important caveat about how these lists merge.

The sandbox allow-lists are **not additive when edited by hand.** The flat lists (`allowed_functions`, `allowed_filters`, `allowed_tags`) are each replaced wholesale by whatever you put under that key in `user/config/security.yaml`, and the per-class lists (`allowed_methods`, `allowed_properties`) merge by position, so a partial list silently overwrites the existing entries. Writing this:

```yaml
twig_sandbox:
  allowed_functions:
    - my_safe_function
```

would drop every built-in safe function (`url`, `t`, and the rest) and leave only `my_safe_function`, breaking far more than it fixes. There are three safe ways to add a member:

* **Use the report (easiest).** When a member is blocked, the **Twig in Content** report (under **Tools → Reports**) lists it with an **Add to allowlist** button. One click appends it to the correct list with every existing entry preserved. This is the quickest safe path because you act on the exact member Grav just blocked.
* **Use Admin.** Under **Configuration → Security → Twig Sandbox**, each field is pre-loaded with the current full list. Add your entry and save, and Grav writes the complete list back, so the defaults are never lost.
* **Edit by hand with the full list.** Copy the entire default list for that key out of `system/config/security.yaml` into your `user/config/security.yaml`, then append your addition, keeping every existing entry intact.

The same rule applies to the per-class methods and properties lists: include every existing `class`/`methods` (or `class`/`properties`) row alongside any you add.

```yaml
twig_sandbox:
  allowed_methods:
    - class: 'Grav\Plugin\MyGallery\Gallery'
      methods: 'render, thumbnail'
    # ...plus every default row copied from system/config/security.yaml
```

Plugin developers can register their own safe members programmatically through the `onBuildTwigSandboxPolicy` event, so a plugin works in sandboxed content without each site having to edit `security.yaml` at all. **This is the durable fix for plugin-provided members**, and it avoids the full-list maintenance burden entirely. See the [Developer Upgrade Guide](../../migration/developer-upgrade-guide#twig-content-sandbox) for the event signature and a worked example.

!!! Only allow members that are safe to run against content authored by anyone with page-edit access. Adding a member to the allow-list is the same trust decision as exposing it in the first place. If a function reads files, evaluates strings, or reaches into Grav's container, leave it off the list.

### The `config` variable

By default the `config` Twig variable is **empty** inside sandboxed content, so page authors cannot read your site configuration (which may contain secrets). If you need read access to non-sensitive config from content, turn on **Config Access** in the **Twig Content** section, or set `twig_content.config_access: true`. With it on, `config` becomes a filtered facade that still redacts sensitive subtrees listed under `twig_sandbox.config_denied_paths` (by default: `plugins`, `streams`, `security`, `backups`, `scheduler`).

### Disabling the sandbox

The sandbox can be turned off entirely with `twig_sandbox.enabled: false`, which removes all SSTI protection from editor-authored content. **This is strongly discouraged** on any site where more than one fully trusted person can edit pages. There is almost always a narrower customization (allow-listing a specific member) that solves the real problem without removing the protection.

## A Better Path: Move Twig Out of Content

The sandbox exists for the cases where you genuinely need Twig in content, but the recommended approach in Grav 2.0 is to avoid Twig in content wherever you can. It mixes presentation logic into plain writing, it is harder for non-technical authors to edit safely, and it ties content to template internals. Two patterns cover almost every case.

### Use a page template

If a single page needs template logic, give it its own template in your theme and reference it with `template:` in the front matter. Templates are trusted and unsandboxed, and template logic belongs there. The page body goes back to being clean Markdown.

### Use a shortcode

For repeatable, author-friendly pieces, a custom **shortcode** is usually the better answer. Instead of teaching authors a Twig snippet (and allow-listing whatever it needs), you give them one short, readable tag, and all the logic lives in your plugin's PHP. No Twig runs in the content, so there is nothing for the sandbox to block.

See [Creating a Shortcode](../creating-a-shortcode) for a step-by-step "Twig before, shortcode after" walkthrough. The community [Shortcode Core](https://github.com/getgrav/grav-plugin-shortcode-core) plugin also provides a large set of ready-made shortcodes.
