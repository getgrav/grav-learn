---
title: AI-Assisted Development
taxonomy:
    category: docs
---
# AI-Assisted Development

Porting a plugin or theme from Grav 1.7 to Grav 2.0 is mostly mechanical work: declare a compatibility flag, expose your functionality as API endpoints if you have admin features, port your blueprints and language files to work with Admin 2.0, and adjust to Symfony, Twig, and PHP version bumps.

Mechanical work is exactly the kind of work AI agents are good at. The Grav team ships a set of **Claude Code Skills** that encode the patterns, conventions, and gotchas of Grav 2.0 plugin development. With these skills installed, an AI agent like [Claude Code](https://www.anthropic.com/claude-code) has the project-specific knowledge it needs to do this work correctly the first time.

This page documents what each skill covers, when to invoke it, and roughly what to expect from the agent.

> [!NOTE]
> These skills are designed for [Claude Code](https://www.anthropic.com/claude-code), Anthropic's official terminal-based coding agent. The same patterns work with other coding agents, but the skill files in their current form are Claude Code's [Skills format](https://docs.claude.com/en/docs/claude-code/skills).

## What is a Skill?

A Claude Code Skill is a markdown file that an AI agent loads on demand when its trigger conditions match what you've asked it to do. Each skill packages:

- **When to use it**: trigger conditions so the agent picks it up automatically
- **What to do**: step-by-step procedures, conventions, and patterns specific to a domain
- **Reference material**: file paths, event names, class names, blueprint shapes, and other facts that aren't easy for an agent to discover from a cold start

Skills live in your home directory or alongside the project they apply to. When the agent matches a trigger, the skill content joins its working context for the rest of that task.

## Available Skills for Grav 2.0 Plugin Work

### `grav-api-integration`

Adding REST API endpoints to a Grav 2.0 plugin via the first-party [Grav API plugin](/20/api).

**Use when:**

- Working under `user/plugins/<plugin>/` on code that exposes plugin functionality as HTTP endpoints
- The user mentions the Grav API, `AbstractApiController`, `ApiResponse`, or `onApiRegisterRoutes`

**Covers:**

- Controller setup extending `AbstractApiController`
- Route registration via `onApiRegisterRoutes`
- Permission checks and the authentication model
- Response helpers, exceptions, error envelopes
- `curl`-based testing patterns

Use the heavier `grav-api-admin-next-integration` skill instead if your plugin also needs custom Admin Next UI.

### `grav-api-admin-next-integration`

The full Admin Next integration story for a Grav 2.0 plugin: API endpoints **plus** custom admin UI.

**Use when:**

- Migrating an admin-classic plugin to Admin Next
- Adding any Admin Next UI to a plugin (sidebar, menubar, fields, pages, widgets, panels, reports)
- Working under `user/plugins/<plugin>/admin-next/` or on event handlers prefixed `onApi*`

**Covers:**

- All `onApi*` event handlers and their roles
- API endpoints (`onApiRegisterRoutes`)
- Sidebar items, menubar/toolbar buttons, floating widgets
- Plugin pages (blueprint and component modes)
- Custom field types
- Custom reports
- Blueprint modifications
- Permissions, languages, and config exposure to web components

### `grav-translations`

Translation strings in a Grav 2.0 plugin: `languages/<lang>.yaml`, `languages.yaml`, and blueprint label/help/title strings.

**Use when:**

- Editing language YAMLs in a plugin
- Adding blueprint fields with `label:`, `help:`, `title:`, `text:`, or `description:` props
- Debugging missing or humanised labels in Admin 2.0 (for example, a label rendering as `"Xss Security"` instead of `"XSS Security for Content"`)
- Porting a Grav 1.7 plugin's lang file to support Admin 2.0
- Auditing a plugin or core for translation gaps

**Covers:**

- The ICU-vs-flat lookup chain on both Admin 2.0's client and the API plugin's server
- Canonical key namespaces (`PLUGIN_ADMIN.*` shared vocabulary vs `PLUGIN_<MYPLUGIN>.*` plugin-private)
- The dual-target (Grav 1.7 + 2.0) lang YAML structure
- HTML rendering in help text
- The disabled-plugin filter that keeps stale strings out of Admin 2.0
- The `i18n-blueprint-audit.mjs` script for spotting gaps

## A Typical Porting Workflow

Once Claude Code is installed and you have the skills available in your home directory's skills folder, porting an existing plugin looks roughly like this:

1. Open the plugin's working directory in a terminal.
2. Start Claude Code: `claude`.
3. Ask the agent something like:
   > "This plugin is currently Grav 1.7-only. Port it to support Grav 2.0 as well: add the compatibility flag, port the admin UI to Admin Next, expose its CRUD operations as API endpoints, and update the language files for ICU."
4. The agent will pick up `grav-api-admin-next-integration` and `grav-translations` automatically based on what you've asked it to do. It'll inspect the plugin's existing code, propose a plan, and then implement it step by step.
5. Review each diff as it's produced. Run the plugin against a Grav 2.0 install (the staged install from the [migration wizard](../02.assisted-migration) is ideal for this) and iterate on anything that doesn't behave correctly.
6. Once it works, add `'2.0'` to the [`compatibility:` flag](/20/plugins/plugin-compatibility) in `blueprints.yaml`, bump the version, and release.

> [!TIP]
> Review the diffs. The agent's output is usually correct but it is not infallible. The goal is to skip the boilerplate, not to skip the engineering judgement.

## Where to Find the Skills

The official skill files live in the [Grav documentation repository](https://github.com/getgrav/grav-learn) under `skills/`. Drop them in your Claude Code skills directory (typically `~/.claude/skills/`) and they will be available in every Claude Code session.

For details on the Skills format itself, including how to write your own, see Anthropic's [Skills documentation](https://docs.claude.com/en/docs/claude-code/skills).

## What These Skills Are Not

These skills do not replace the [API](/20/api), [plugin compatibility](/20/plugins/plugin-compatibility), or [admin translations](/20/plugins/admin-translations) reference docs. They tell an agent which patterns to apply and which mistakes to avoid; the reference docs are the source of truth for what the patterns are. If you're doing the porting work by hand, work from the reference docs. If you're handing the work to an agent, install the skills so the agent has the same context.
