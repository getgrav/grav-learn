---
title: MCP
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Tool manifests for [Model Context Protocol](https://modelcontextprotocol.io) servers. An MCP server such as the [Grav MCP Server](/2/advanced/mcp-server) already has tools for everything the API plugin does itself, but it can't know about routes that other plugins add through `onApiRegisterRoutes`. A plugin describes those routes as tools, in an `mcp.yaml` file at its root or in code through the [`onApiMcpTools`](/2/api/events) event, and [List MCP Tools](/2/api/endpoints/mcp/list-tools) serves the union of every enabled plugin's tools so the MCP server can register them at startup without code written per plugin.

Permissions: `api.access`. Each tool is filtered further by the permission it names.
