---
title: MCP Server
taxonomy:
    category: docs
---

# Grav MCP Server

The [Grav MCP Server](https://github.com/getgrav/grav-mcp) exposes a Grav 2.0 site to agentic AI clients through the [Model Context Protocol](https://modelcontextprotocol.io) (MCP). It is a standalone **Node.js** application distributed as the [`grav-mcp`](https://www.npmjs.com/package/grav-mcp) package on npm. It is **not** a Grav plugin: it runs inside your AI client (Claude Code, Claude Desktop, Cursor, or any MCP-aware client) and talks to your site over HTTP through the first-party [Grav API Plugin](/20/api).

The design principle is simple: **Admin2 is the client for humans, the MCP server is the client for AI, and both go through the same API**. The MCP server has no privileged backdoor into Grav. Every operation it performs is an authenticated, permission-checked HTTP request against `/api/v1`, exactly like any other API consumer.

!!! The MCP server requires the [API Plugin](/20/api) to be installed and enabled on the target Grav site. The MCP server itself holds no content logic; it is a translation layer between MCP tool calls and the Grav REST API.

## Architecture

```
┌─────────────────┐   stdio / HTTP    ┌──────────────┐   HTTPS + X-API-Key   ┌──────────────────┐
│   AI Client     │ ◀──────────────▶  │  grav-mcp    │ ◀───────────────────▶ │  Grav API Plugin │
│ (Claude, etc.)  │   MCP protocol    │ (Node.js)    │   REST /api/v1        │  (PHP, on site)  │
└─────────────────┘                   └──────────────┘                       └──────────────────┘
```

1. The AI client launches `grav-mcp` as a subprocess (stdio transport) or connects to a running instance (HTTP transport).
2. `grav-mcp` advertises its catalog of **tools**, **resources**, and **prompts** to the client.
3. When the model calls a tool, `grav-mcp` translates it into an authenticated HTTP request to the Grav API.
4. The API plugin authenticates the request, checks permissions, performs the operation against the filesystem, and returns structured JSON.

Because the API plugin is the single point of mutation, the MCP server inherits the API's permission model, optimistic concurrency (ETags), rate limiting, and event/webhook system for free.

## Requirements

- **Node.js 18+** on the machine running the AI client.
- A Grav 2.0 site with the **API Plugin** installed and enabled.
- An API key generated for the user the AI should act as.

## Installation and Configuration

There is nothing to install manually. The `grav-mcp` package is run on demand via `npx`, so configuration happens entirely in your AI client.

### 1. Generate an API key

On the Grav site, generate a key for an appropriate user (see [Permissions and Security](#permissions-and-security) before choosing which user):

```bash
bin/plugin api keys:generate --user=admin --name="Claude MCP"
```

The key (prefixed `grav_`) is displayed once. Copy it immediately. Key management commands (`keys:list`, `keys:revoke`) are documented in the [API Authentication](/20/api/authentication) reference.

### 2. Register the server with your AI client

The MCP server is configured through two environment variables: `GRAV_API_URL` (your site's API base URL) and `GRAV_API_KEY` (the key you just generated).

**Claude Code / Claude Desktop / Cursor** and most MCP clients use the standard `mcpServers` config block:

```json
{
  "mcpServers": {
    "grav": {
      "command": "npx",
      "args": ["-y", "grav-mcp"],
      "env": {
        "GRAV_API_URL": "https://mysite.com/api",
        "GRAV_API_KEY": "grav_your_api_key_here"
      }
    }
  }
}
```

Restart (or reconnect) the client and the full Grav toolset becomes available.

### 3. (Optional) Run directly for testing

The same configuration works on the command line:

```bash
GRAV_API_URL=https://mysite.com/api GRAV_API_KEY=grav_abc123 npx grav-mcp
```

## Configuration Reference

Every option can be set as an environment variable or as a CLI flag. CLI flags take precedence.

| Environment variable | CLI flag | Required | Description |
|----------------------|----------|----------|-------------|
| `GRAV_API_URL`       | `--url`         | Yes | Base URL of the Grav API (for example `https://mysite.com/api`). |
| `GRAV_API_KEY`       | `--key`         | Yes | API key for authentication. Must start with `grav_`. |
| `GRAV_ENVIRONMENT`   | `--environment` | No  | Targets a specific `user/env/*` environment for configuration scopes (sent as the `X-Config-Environment` header). |
| —                    | `--transport`   | No  | `stdio` (default) or `http`. |
| —                    | `--port`        | No  | Port for the HTTP transport. Default `3100`. |

## Transports

### stdio (default)

The default transport. The AI client spawns `grav-mcp` as a child process and communicates over standard input/output. This is the right choice for local, single-user clients such as Claude Code, Claude Desktop, and Cursor.

### HTTP

For remote or multi-user deployments, run a long-lived server that clients connect to over HTTP:

```bash
npx grav-mcp --url https://mysite.com/api --key grav_abc123 --transport http --port 3100
```

## Tools

The server exposes **70 semantic tools across 11 domains**. These are named, typed operations (not raw REST endpoints), described in language the model can reason about.

### Pages (10)

| Tool | Purpose |
|------|---------|
| `list_pages` | List pages in the content tree. |
| `get_page` | Retrieve a single page (frontmatter + content). |
| `create_page` | Create a new page. |
| `update_page` | Update a page's frontmatter and/or content. |
| `delete_page` | Delete a page. |
| `move_page` | Move a page to a new route. |
| `copy_page` | Copy a page to a new route. |
| `reorder_pages` | Reorder sibling pages. |
| `batch_pages` | Apply multiple page operations atomically. |
| `reorganize_pages` | Bulk-restructure a subtree in one operation. |

### Multilingual (5)

| Tool | Purpose |
|------|---------|
| `list_languages` | List configured site languages. |
| `get_page_translations` | List the translations of a page. |
| `create_translation` | Create a translation for a page. |
| `adopt_page_language` | Adopt/assign a language for a page. |
| `compare_translations` | Compare two language versions of a page. |

### Media (8)

| Tool | Purpose |
|------|---------|
| `list_page_media` | List media attached to a page. |
| `upload_page_media` | Upload media to a page. |
| `delete_page_media` | Delete media from a page. |
| `list_site_media` | List site-level media. |
| `upload_site_media` | Upload site-level media. |
| `delete_site_media` | Delete site-level media. |
| `create_media_folder` | Create a media folder. |
| `manage_media_folder` | Rename/move/delete a media folder. |

### Configuration (3)

| Tool | Purpose |
|------|---------|
| `list_config_scopes` | List available configuration scopes. |
| `get_config` | Read a configuration scope (returns an ETag). |
| `update_config` | Update a configuration scope (ETag-checked, per-environment aware). |

### Users (6)

| Tool | Purpose |
|------|---------|
| `list_users` | List user accounts. |
| `get_user` | Retrieve a single user. |
| `create_user` | Create a user. |
| `update_user` | Update a user. |
| `delete_user` | Delete a user. |
| `manage_api_keys` | List/create/revoke a user's API keys. |

### Package Manager (9)

| Tool | Purpose |
|------|---------|
| `list_packages` | List installed plugins/themes. |
| `get_package_info` | Get details for a package. |
| `search_packages` | Search the GPM repository. |
| `check_updates` | Check for available updates. |
| `install_package` | Install a plugin/theme (resolves blueprint dependencies). |
| `update_package` | Update a single package. |
| `update_all_packages` | Update all packages. |
| `upgrade_grav` | Upgrade Grav core. |
| `remove_package` | Remove a package. |

### System (10)

| Tool | Purpose |
|------|---------|
| `get_system_info` | Retrieve system/environment information. |
| `clear_cache` | Clear Grav's cache. |
| `get_logs` | Read system logs. |
| `create_backup` | Create a backup. |
| `list_backups` | List backups. |
| `get_scheduler` | Inspect scheduler jobs/status. |
| `run_scheduler` | Run the scheduler. |
| `list_environments` | List configured environments. |
| `create_environment` | Create a new environment. |
| `get_password_policy` | Read the active password policy. |

### Dashboard and Reports (7)

| Tool | Purpose |
|------|---------|
| `get_dashboard_stats` | Retrieve dashboard statistics. |
| `get_notifications` | List dashboard notifications. |
| `dismiss_notification` | Dismiss a notification. |
| `run_reports` | Run diagnostic reports. |
| `get_dashboard_widgets` | List dashboard widgets. |
| `update_dashboard_layout` | Update the current user's dashboard layout. |
| `update_site_dashboard_layout` | Update the site-wide default dashboard layout. |

### Webhooks (4)

| Tool | Purpose |
|------|---------|
| `list_webhooks` | List configured webhooks. |
| `manage_webhook` | Create/update/delete a webhook. |
| `get_webhook_deliveries` | Inspect a webhook's delivery log. |
| `test_webhook` | Send a test payload to a webhook. |

### Blueprints and Schema (6)

| Tool | Purpose |
|------|---------|
| `list_page_templates` | List available page templates. |
| `get_blueprint` | Retrieve a resolved blueprint schema. |
| `get_permissions` | Retrieve the permission catalog. |
| `get_taxonomy` | Retrieve taxonomy types and values. |
| `upload_blueprint_file` | Upload a blueprint file. |
| `delete_blueprint_file` | Delete a blueprint file. |

### Plugin Discovery (2)

| Tool | Purpose |
|------|---------|
| `discover_plugins` | Discover admin features contributed by installed plugins. |
| `plugin_action` | Trigger a plugin-provided action. |

## Resources

In addition to tools, the server exposes **5 resources** the model can read for context without performing an action:

| Resource URI | Description |
|--------------|-------------|
| `grav://system/info` | System and environment information. |
| `grav://user/permissions` | The authenticated API user's effective permissions. |
| `grav://languages` | Configured site languages. |
| `grav://templates` | Available page templates. |
| `grav://taxonomy` | Taxonomy types and their values. |

## Prompts

The server ships **6 workflow prompts** that package common multi-step jobs into a single guided flow:

| Prompt | Workflow |
|--------|----------|
| `create_blog_post` | Guided creation of a blog post (template, frontmatter, media, taxonomy). |
| `translate_page` | Translate a page into another configured language. |
| `site_health_check` | Run a comprehensive site health audit. |
| `content_audit` | Audit content quality and metadata. |
| `plugin_setup` | Search, install, and configure a plugin. |
| `bulk_update` | Apply bulk frontmatter updates across many pages. |

## Authentication

Every request the MCP server makes carries the API key in an `X-API-Key` header:

```
X-API-Key: grav_abc123...
```

This is the same API-key authentication described in the [API Authentication](/20/api/authentication) reference. When `GRAV_ENVIRONMENT` is set, the server also sends an `X-Config-Environment` header so configuration reads and writes target the correct environment.

On startup the client validates its key against the API's `/me` endpoint to read the user's effective permissions, so unsupported operations can be reported cleanly rather than failing late.

## Permissions and Security

The most important thing to understand about the MCP server's security model is that **it inherits the permissions of the user its API key belongs to, and nothing more**. There is no separate "AI" permission set. The same `api.pages.write`, `api.config.write`, `api.gpm.write` (and so on) permissions that gate any API consumer gate the AI.

This means you control what an AI can do by controlling which user the key is issued to:

- Issuing the key for a super-admin user gives the AI full access to the site.
- Issuing the key for a user scoped to only page and media permissions confines the AI to content work, with no ability to change configuration, manage users, or install packages.

!!! Create a dedicated, least-privilege user for AI access rather than reusing your primary admin account. A key can never exceed the permissions of the user it belongs to, so the user account is your security boundary. Per-key permission scoping is not yet enforced independently of the user.

### Concurrency safety

All configuration and page writes go through the API's **ETag-based optimistic concurrency**. The server reads an `ETag` on `GET` and sends it back as `If-Match` on writes. If the resource changed in between (for example, a human edited the same page in Admin2), the API returns `409 Conflict` instead of silently overwriting, and the agent must re-fetch and reconcile.

### Observability

The MCP server does not add its own audit log. Instead, every write through the API fires a structured event (`onApiPageCreated`, `onApiConfigUpdated`, and the rest of the `onApi*` family), and those events drive the API's **webhook** system. To record AI-initiated changes, point a webhook at your logging or notification endpoint. Webhook deliveries are HMAC-signed so you can verify their origin. See the [API Events](/20/api/events) reference for the full event list.

## Development and Maintenance

For contributors working on the server itself, the repository provides the usual scripts:

```bash
npm run typecheck        # Type-check the TypeScript sources
npm test                 # Run the unit test suite
npm run build            # Compile to dist/
npm run audit:api        # Verify tool coverage against the live API plugin
npm run changelog:since  # Report API plugin changes since the last reviewed version
```

The `audit:api` and `changelog:since` scripts exist to keep the tool catalog in sync with the API plugin as it evolves, by comparing the server's `@api METHOD /path` annotations against the plugin's actual routes.

## See Also

- [REST API](/20/api) — the API the MCP server is built on.
- [API Authentication](/20/api/authentication) — key generation and management.
- [API Events](/20/api/events) — the events that drive webhooks and auditing.
- [grav-mcp on GitHub](https://github.com/getgrav/grav-mcp)
- [grav-plugin-api on GitHub](https://github.com/getgrav/grav-plugin-api)
- [Model Context Protocol](https://modelcontextprotocol.io)
