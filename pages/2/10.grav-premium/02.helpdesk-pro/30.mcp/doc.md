---
title: MCP
taxonomy:
    category: docs
description: Work tickets from an AI client through grav-mcp, with every Helpdesk Pro tool, its permission, and how replies differ from notes.
---

# MCP

Helpdesk Pro describes its API as MCP tools, so an AI client (Claude Desktop, Claude Code, Cursor and others) can read and work tickets through [grav-mcp](https://github.com/getgrav/grav-mcp). The descriptions live in the plugin's `mcp.yaml`. The API plugin serves them from `GET /mcp/tools`, and grav-mcp turns each one into a tool named `helpdesk_<name>`, for example `helpdesk_list_tickets`.

## How it works

Every tool is one [REST API](../rest-api) route with a description, an input schema and a permission. grav-mcp calls the route with your credentials, so a tool can never do more than you could do with the same API key: the route checks the permission, and the same access rules decide which tickets and messages come back. A tool whose permission you do not hold is not offered to you at all.

Read tools are marked read-only, and deletes are marked destructive, so a client can ask before running them.

## Connect an AI client

1. Create an API key for a staff account (see [REST API](../rest-api#authenticate)). A key with scopes needs `helpdesk-pro.desk` and whatever else the tools you want need.
2. Configure grav-mcp with your site's address and that key.
3. Start with `get_bootstrap`: it returns the projects, statuses, labels and staff, with the ids every other tool takes.

## Replies and notes

`add_message` writes on a ticket. `visibility: public` is a reply: the requester and cc'd clients read it and it is emailed to them. `visibility: internal` is a staff note the client never sees.

> [!TIP]
> When an AI drafts on your behalf, ask it for a note first if you want to review the text before the client hears anything.

Pass `based_on_message_id` (the newest public message the model read) and the tool refuses with `thread_changed` when the client wrote in meanwhile, returning the new messages. A reply is never written against a stale conversation.

Before merging, an AI client should call `preview_merge` and show its reasons, then call `merge_ticket` with `confirm`.

## Tools

| Area | Tools | Permission |
|---|---|---|
| Desk | `get_config`, `get_bootstrap`, `get_counts` | desk |
| Status | `get_status` | settings |
| Tickets | `list_tickets`, `create_ticket`, `get_ticket`, `update_ticket`, `get_ticket_timeline`, `mute_ticket`, `get_board`, `bulk_update_tickets` | desk |
| Deleting | `delete_ticket`, `restore_ticket`, `delete_message` | tickets.delete |
| Messages | `add_message`, `edit_message`, `get_message_original` | desk |
| Participants | `list_participants`, `add_participant`, `remove_participant` | desk |
| Triage and merging | `triage_ticket`, `preview_merge`, `merge_ticket` | triage |
| People | `list_people`, `get_person` | desk |
| People changes | `create_person`, `update_person`, `get_person_privacy`, `send_sign_in_link`, `merge_person`, `erase_person`, `link_person_account`, `unlink_person_account`, `place_legal_hold`, `release_legal_hold` | people.manage |
| Projects | `list_projects`, `get_project` | desk |
| Project changes | `create_project`, `reorder_projects`, `update_project`, `delete_project`, `set_project_members` | projects.manage |
| Statuses | `list_statuses` (desk); `create_status`, `reorder_statuses`, `update_status`, `delete_status` | projects.manage |
| Labels | `list_labels` (desk); `create_label`, `update_label`, `delete_label` | projects.manage |
| Custom fields | `list_fields`, `get_field`, `get_ticket_fields`, `set_ticket_fields` (desk); `create_field`, `update_field`, `delete_field`, `restore_field`, `reorder_fields` | projects.manage |
| Saved replies | `list_saved_replies`, `get_saved_reply`, `create_saved_reply`, `update_saved_reply`, `delete_saved_reply`, `render_saved_reply`, `apply_saved_reply` | desk (shared ones need library.manage) |
| Saved views | `list_saved_views`, `create_saved_view`, `update_saved_view`, `delete_saved_view` | desk (shared ones need library.manage) |
| Notifications | `list_notifications`, `mark_notifications_read`, `mark_all_notifications_read`, `get_preferences`, `update_preferences` | desk |
| Search and knowledge base | `search`, `suggest_articles`, `find_similar_tickets`, `get_ticket_context` (desk); `rebuild_search` | settings |
| Email | `send_test_email` | settings |
| Inbound email | `list_inbound_log`, `get_inbound_entry`, `get_inbound_original`, `retry_inbound`, `release_inbound`, `get_inbound_status`, `test_inbound` | settings |
| Rules | `list_rules`, `get_rule_catalog`, `get_rule`, `create_rule`, `update_rule`, `delete_rule`, `reorder_rules`, `test_rule` | settings |
| SLA | `list_sla_policies`, `get_sla_policy`, `list_business_hours`, `get_business_hours`, `get_ticket_sla` (desk); `create_sla_policy`, `update_sla_policy`, `delete_sla_policy`, `reorder_sla_policies`, `create_business_hours`, `update_business_hours`, `delete_business_hours` | settings |
| Ratings | `list_ratings`, `get_ticket_rating` (desk); `get_ratings_summary` | reports |
| Reports | `get_report` | reports |
| Organizations | `list_organizations`, `get_organization`, `list_organization_members`, `get_person_organization`, `set_ticket_organization` (desk); `create_organization`, `update_organization`, `delete_organization`, `add_organization_member`, `add_organization_members_by_domain`, `remove_organization_member`, `set_person_organization` | people.manage |
| Notification channels | `list_channels`, `get_channel`, `create_channel`, `update_channel`, `delete_channel`, `test_channel` | settings |

Every permission is a `helpdesk-pro.*` action from [Projects and permissions](../projects-and-permissions#permissions).

- **Rules** act with the system's authority on every ticket, so the rules tools need `helpdesk-pro.settings`. Give them to an AI client only with an API key you would trust to configure the desk. `list_rules` gives each rule as one sentence (`summary`) with anything it names that is no longer there (`problems`), so a client can read a rule back before changing it.
- **Channel** tools never return a webhook URL or signing secret (both come back masked, and sending the mask back keeps them). `test_channel` sends a real test message and returns the endpoint's own answer.
- **Custom field** values are already on `get_ticket` and `list_tickets` under `extra.fields`. To set them on a new ticket, call `set_ticket_fields` after `create_ticket`.

## Routes without a tool

A few routes are for Admin Next and the browser only, and have no tool: the sidebar badge (`GET /helpdesk-pro/badge`), the live update config and presence heartbeat, and the attachment upload, download and draft removal routes. AI clients see files as the `attachments` list on each timeline message.

## Related

- [REST API](../rest-api)
- [Projects and permissions](../projects-and-permissions)
