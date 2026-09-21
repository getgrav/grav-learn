---
title: Translations Editor
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

The endpoints behind the Admin Next translations editor. They let you browse every translation string that Grav core, plugins and themes ship, see how complete each language is, and override any string for this site. Overrides are stored per language in `user/languages/<lang>.yaml`.

These routes live under `/i18n`, not `/translations`, and they require authentication. The public [Get Translations](/2/api/endpoints/system/get-translations) endpoint (`GET /translations/{lang}`) is a different thing: it is the admin's own dictionary, served without authentication and filled in from English, so it can't tell a missing string from one translated with the same words. The editor reads the sources directly so that a missing string reads as missing.

Permissions: `api.translations.read` for the reads, `api.translations.write` for saving overrides, machine translation and importing. Demo accounts get 403 on every write.

## Cell states

Each key in the editor has a cell per language, with a `value`, the `shipped` value (what the source provides, or `null`) and a `state`:

| State | Meaning |
|-------|---------|
| `shipped` | The value comes from a plugin, theme or core language file |
| `overridden` | This site has its own value in `user/languages/<lang>.yaml` |
| `missing` | No source ships the key in this language and there is no override, so visitors see a fallback |

A row's `known` is `false` when no source ships the key at all and only a site override names it, for example a typo or a string from a plugin that was removed. Those rows are listed so they can be found and fixed.

## Language codes

Language codes must look like `en`, `fr`, `pt-BR` or `zh-Hant`. On the `/i18n/overrides/{lang}` routes a code that doesn't match is a 422. Query parameters such as `lang` and `source_lang` fall back to the editor's default language instead: the site's default language when a source ships it, else `en`, else the first language any source ships.

## Migrating from translation-strings

Sites that used the translation-strings plugin can bring those overrides in with [Import Status](/2/api/endpoints/translations/import-status) and [Import Translation Strings](/2/api/endpoints/translations/import-translation-strings). While that plugin is enabled its values still win over `user/languages`, so import first, check the result, then disable the plugin.
