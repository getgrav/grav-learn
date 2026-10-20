---
title: Demo Mode
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Control the demo-mode reset engine, for public demo sites. See [Demo Mode](/2/api/demo-mode) for setting a demo up. A demo account is any account with `access.api.demo` set. Demo accounts can read, but every write is refused except the grants listed in `plugins.api.demo.writable` (read-only when empty, the default) and the plugin routes in `plugins.api.demo.allow_routes`. Reads that reveal server paths, logs, backups or the audit trail are hidden from them. A refused request gets a 403 with the error code `demo_mode_write_blocked`.

A baseline is a saved copy of the folders a reset restores. Once one is captured, those folders are put back to it every `reset_interval` minutes, either on the first API request after the interval (`reset_on_request`) or by a scheduler job (`reset_on_schedule`), or both. Nothing is reset until a baseline exists.

Permissions: [Demo Status](/2/api/endpoints/demo/demo-status) needs any authenticated account. [Capture Baseline](/2/api/endpoints/demo/capture-baseline) and [Reset Demo](/2/api/endpoints/demo/reset-demo) need a super admin (a scoped API key needs the `admin.super` scope), and demo accounts are always refused on them, even when they are super, so a visitor can't save a vandalized state as the baseline or force a reset.

## Status fields

All three routes return the same status object:

| Field | Meaning |
|-------|---------|
| `baseline_exists` | Whether a baseline has been captured |
| `baseline_at` | Unix timestamp of the baseline, or `null` when there is none |
| `writable` | `plugins.api.demo.writable` as configured: the grants demo accounts may use, such as `api.pages.update` or the shorthand `api.pages.write` |
| `roots` | The folders a reset restores: `pages`, `media` and `config` (plus `environments/<name>` for each environment's settings folder) from the grants, `plugins` and `themes` with `include_code`, and each `extra_roots` folder by its path under `user/`, where they exist |
| `reset_interval` | Minutes between resets |
| `reset_on_request` | Whether a reset starts on the first API request after the interval |
| `reset_on_schedule` | Whether a scheduler job performs resets |
| `last_reset` | Unix timestamp of the last reset (or of the baseline, if no reset has run since), or `null` |
| `seconds_until_reset` | Seconds until the next reset is due; `0` means due now, `null` when there is no baseline |
