---
title: MCP
taxonomy:
    category: docs
description: Run your newsletter from an AI client through grav-mcp, with every Mailroom tool, the permission it needs, and the routes that have none.
---

# MCP

Mailroom describes its admin API as MCP tools, so an AI client (Claude Desktop, Claude Code, Cursor and others) can read your audience, write campaigns and look into deliverability through [grav-mcp](https://github.com/getgrav/grav-mcp). The descriptions live in the plugin's `mcp.yaml`. The API plugin serves them from `GET /mcp/tools`, and grav-mcp turns each into a tool named `mailroom_<name>`, for example `mailroom_list_subscribers`.

## How it works

Every tool is one [REST API](../rest-api) route with a description, an input schema and a permission. grav-mcp calls the route with your credentials, so a tool can never do more than you could with the same API key, and a tool whose permission you do not hold is not offered to you at all.

Read tools are marked read-only, and deletes and bulk changes are marked destructive, so a client can ask before running them.

## Connect an AI client

1. Create an API key for an account with Mailroom's permissions (see [REST API](../rest-api#authenticate)). Leave `mailroom.send` off the key unless you want the client able to put mail in inboxes.
2. Configure grav-mcp with your site's address and that key.
3. Start with `mailroom_get_overview` and `mailroom_list_lists`: they return the counts and the list ids every other tool takes.

> [!TIP]
> Sending is a permission of its own because a campaign cannot be taken back. A key with `mailroom.view` and `mailroom.manage` lets an AI client draft campaigns, build segments and answer questions, and leaves the send button to you.

A few habits that keep answers honest:

- Run `mailroom_count_campaign_audience` or `mailroom_preview_segment` before saving, to see who a campaign or segment would reach.
- Segment counts are cached; read `counted_at` beside a count, and use `mailroom_count_segment` when it has to be true now.
- `mailroom_add_subscriber` and `mailroom_bulk_subscribers` ask how to add people: `mode: invite`, or `mode: subscribed` with a `note` saying where they agreed.

## Tools

| Area | Tools | Permission |
|---|---|---|
| Overview | `get_overview`, `get_settings` | view |
| Campaigns | `list_campaigns`, `get_campaign`, `count_campaign_audience`, `list_campaign_recipients`, `list_campaign_links`, `get_campaign_timeline`, `preview_campaign_catch_up` | view |
| Campaign changes | `create_campaign`, `update_campaign`, `delete_campaign`, `preview_campaign`, `pause_campaign`, `cancel_campaign` | manage |
| Sending | `send_campaign_test`, `start_campaign`, `resume_campaign`, `catch_up_campaign`, `retry_failed_campaign_sends` | send |
| Subscribers | `list_subscribers`, `get_subscriber` | view |
| Subscriber changes | `add_subscriber`, `update_subscriber`, `unsubscribe_subscriber`, `resubscribe_subscriber`, `confirm_subscriber`, `delete_subscriber`, `bulk_subscribers`, `export_subscriber_data` | manage |
| Imports | `list_imports`, `get_import` | view |
| Lists and tags | `list_lists`, `list_tags` (view); `create_list`, `update_list`, `create_tag`, `delete_tag` | manage |
| Templates | `list_templates`, `get_template` (view); `create_template`, `update_template`, `delete_template`, `preview_template` | manage |
| Suppressions | `list_suppressions` (view); `add_suppression`, `remove_suppression` | manage |
| Segments | `list_segments`, `get_segment`, `get_segment_vocabulary`, `preview_segment` (view); `create_segment`, `update_segment`, `delete_segment`, `count_segment` | manage |
| Deliverability | `check_deliverability` (view); `recheck_deliverability` | manage |
| Providers | `generate_provider_secret`, `set_up_provider_webhook` | manage |
| Automations | `list_automations`, `get_automation`, `list_automation_recipes` (view); `create_automation`, `update_automation`, `delete_automation`, `activate_automation`, `pause_automation`, `resume_automation`, `enrol_in_automation`, `exit_automation_enrolment`, `use_automation_recipe` | manage |
| Reports | `get_newsletters_report` | view |
| Erasure | `erase_address` | manage |

Every permission is `mailroom.view`, `mailroom.manage` or `mailroom.send`; the send tools need `mailroom.manage` as well. `export_subscriber_data` is the one read that needs `mailroom.manage`, like the CSV export.

## Routes without a tool

A few routes are for the admin or return a file rather than something a model can read, and have no tool:

- `GET /mailroom/labels`, the admin's own strings, and `GET /mailroom/section-script`, which loads the admin page;
- `POST /mailroom/imports/preview` and `POST /mailroom/imports`, which take a file upload;
- `GET /mailroom/subscribers/export` and `GET /mailroom/reports/{type}.csv`, which answer CSV files;
- the `GET` forms of the campaign and template previews (the tools use the `POST` form).

To import through an AI client, have it prepare the file and run `bin/plugin mailroom import:csv` on the server, or use the admin.

## Related

- [REST API](../rest-api)
- [Installation](../installation#give-your-team-access)
