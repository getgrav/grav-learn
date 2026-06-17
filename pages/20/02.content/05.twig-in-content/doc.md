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

### 1. Enable the security gate

In the Admin panel, go to **Configuration → Security** and open the **Twig Content** section. Two toggles control the gate:

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

### 2. Opt in per page

Enabling the gate does not turn Twig on everywhere. Each page still has to opt in through its front matter, exactly as in 1.7:

```yaml
---
title: My Page
process:
    twig: true
---
```

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
* If you are logged in as a super administrator and `admin_hint` is enabled, Grav adds an HTML comment near the blocked expression pointing you at the log.

So if a page shows raw `{{ something() }}` after you've enabled the gate, the sandbox blocked `something()`. Check `logs/security.log` to see which member it didn't recognize.

## Customizing the Sandbox

If you have decided that a particular Twig member is safe to run against content your authors could write, you can add it to the allow-list in `user/config/security.yaml`. Your additions merge on top of the defaults:

```yaml
twig_sandbox:
  allowed_functions:
    - my_safe_function
  allowed_filters:
    - my_safe_filter
  allowed_tags:
    - my_safe_tag
```

Methods and properties are allowed per class, using a list of `class`/`methods` (or `class`/`properties`) rows:

```yaml
twig_sandbox:
  allowed_methods:
    - class: 'Grav\Plugin\MyGallery\Gallery'
      methods: 'render, thumbnail'
```

Plugin developers can register their own safe members programmatically through the `onBuildTwigSandboxPolicy` event, so a plugin works in sandboxed content without each site having to edit `security.yaml`. See the [Developer Upgrade Guide](../../migration/developer-upgrade-guide#twig-content-sandbox) for the event signature and a worked example.

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
