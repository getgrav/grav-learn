---
title: Demo Mode
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Control the demo-mode reset engine, for public demo sites. A demo account is any account with `access.api.demo` set. Demo accounts can read, but writes are blocked except for the permissions listed in `plugins.api.demo.writable`, and some reads that reveal server paths or other visitors' data are hidden from them.

A baseline is a snapshot of the content folders that demo accounts can write to. Once one is captured, the demo content is put back to it every `reset_interval` minutes, either lazily during API requests (`reset_on_request`) or by a scheduler job (`reset_on_schedule`), or both. Nothing is reset until a baseline exists.

Permissions: [Demo Status](/2/api/endpoints/demo/demo-status) needs any authenticated account. [Capture Baseline](/2/api/endpoints/demo/capture-baseline) and [Reset Demo](/2/api/endpoints/demo/reset-demo) need a super admin (a scoped API key needs the `admin.super` scope), and demo accounts are always refused on them, even when they are super, so a visitor can't save a vandalized state as the baseline or force a reset.

## Status fields

All three routes return the same status object:

| Field | Meaning |
|-------|---------|
| `baseline_exists` | Whether a baseline has been captured |
| `writable` | The permissions a demo account may still use for writes (`plugins.api.demo.writable`, default `api.pages.write` and `api.media.write`) |
| `roots` | The content folders those permissions map to and that a reset restores: `pages` (`user/pages`), `media` (`user/media`) and `data` (`user/data`, for `api.flex*` permissions), where they exist |
| `reset_interval` | Minutes between resets |
| `reset_on_request` | Whether stale content is reset lazily during API requests |
| `reset_on_schedule` | Whether a scheduler job performs resets |
| `last_reset` | Unix timestamp of the last reset, or `null` if none has run |
| `seconds_until_reset` | Seconds until the next reset is due; `0` means due now, `null` when there is no baseline |
