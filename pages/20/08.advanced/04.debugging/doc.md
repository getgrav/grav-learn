---
title: Debugging & Logging
process:
    twig: false
taxonomy:
    category: docs
---

# Debugging & Logging

When developing themes and plugins there is often a need to display **debugging** information. Grav 2.0 keeps all of the frontend debugging tools you know from 1.7, and adds a dedicated workflow for the new **Admin2** interface, which is a JavaScript single page application talking to the [API Plugin](/20/api) rather than a set of server rendered Twig pages.

This page is split into two parts:

1. **Frontend debugging** (themes, plugins, page rendering) which works the same as it always has.
2. **Admin debugging** (Admin2 + the API) which has its own tools because the old HTML debug bar cannot render inside the SPA.

## Frontend debugging

### Debug Bar

Grav ships with a **Debug Bar** for the frontend. It is **disabled** by default and can be turned on globally or for your [development environment](../environment-config) only via the `system.yaml` configuration file:

[codesh=yaml line-numbers="true"]
debugger:
  enabled: true                     # Enable the Grav debugger and the settings below
  provider: clockwork               # 'clockwork' (recommended) or 'debugbar'
  shutdown:
    close_connection: true          # Close the connection before onShutdown(). Set false while debugging.
[/codesh]

With `provider: debugbar` the PHP Debug Bar renders directly on the page and reports **processing time**, **memory usage**, and tabs for **Messages**, **Request**, **Exceptions**, **Configuration**, and a **Timeline**.

With `provider: clockwork` the same data is sent through response headers instead of being drawn on the page, and you read it in the [Clockwork browser extension](https://underground.works/clockwork/) (available for Chrome and Firefox). Clockwork is the recommended provider for 2.0 because the same mechanism also powers admin debugging (see below).

### Dump command for PHP

To inspect a PHP variable or object while rendering the **frontend**, use the `dump()` command. It accepts any valid PHP value and renders a formatted, colorized display:

[codesh=php]
dump($myvariable);
[/codesh]

You can also send a value to the **Messages** tab of the debugger without writing to the output stream:

[codesh=php]
$this->grav['debugger']->addMessage($myvariable);
[/codesh]

!!! `dump()` writes into the page output. That is fine for the frontend, but it **corrupts JSON responses** on the API path. When debugging Admin2 or any `onApi*` hook, use `addMessage()` instead. See [Debugging the API & hooks](#debugging-the-api-amp-hooks) below.

### Dump command for Twig

Twig variables can be dumped from a template. This requires the Twig debugger, enabled globally or per environment in `system.yaml`:

[codesh=yaml line-numbers="true"]
twig:
  debug: true                       # Enable the Twig debugger
[/codesh]

[codesh=twig line-numbers="true"]
{{ dump(page.header) }}
[/codesh]

You can label multiple dumps so they are easy to tell apart:

[codesh=twig line-numbers="true"]
{{ dump('page.header output:', page.header) }}
[/codesh]

### Dump to the browser console from Twig

When no page refresh occurs, or to inspect a value before the page is returned, log it straight to the browser console:

[codesh=twig]
<script> console.log({{ page.header|json_encode|raw }}) </script>
[/codesh]

## Debugging Admin2

The new admin is a single page application. It never renders the server side HTML debug bar, so the classic in-page toolbar does not appear there. Instead, Admin2 gives you two complementary tools, both driven by the same Clockwork data Grav already produces.

First, enable the debugger in `system.yaml` (the `clockwork` provider, as shown above). Every API response then carries Clockwork headers, which is all the two tools below need.

### The built-in API Debug panel

When the debugger is enabled, a small **bug icon** appears in the bottom left corner of Admin2. Clicking it opens the **API Debug** panel, which requires no browser extension:

* It lists the most recent API requests the admin has made, each showing the **method**, **status**, **path**, and **client side duration**.
* Clicking a request loads its server side **Clockwork profile**: the response time measured on the server, the number of database queries, memory usage, and the full **log / dump** output for that request.

This is the fastest way to see what the admin is doing and to read any values your plugin logged during a request. The panel only appears while the debugger is enabled, so it never shows in production.

### The Clockwork browser extension

For a deeper view, install the [Clockwork browser extension](https://underground.works/clockwork/). Because Admin2 talks to the API over XHR/fetch and every API response carries the `X-Clockwork-Id` header, the extension picks up **each individual API call** automatically. You get Clockwork's full timeline, log, database, and performance panels per request, exactly as you would for a normal page load.

#### Reading profiler data from a remote site

Clockwork reads its data from a `/__clockwork/` endpoint on your site. That endpoint answers very early in Grav's bootstrap, before sessions, accounts, and plugins exist, so there is no logged-in user for it to authorize against. Since **Grav 2.0.22** it therefore answers only two kinds of request:

* requests coming **from the machine Grav itself runs on**, and
* requests presenting a **shared secret** you set in `system.debugger.token`.

On a local development site nothing changes: you browse `localhost` and Grav sees a loopback request, so Clockwork keeps working with no configuration.

On a **remote** site, a staging server or a VM you reach over the network, your browser is not the machine Grav runs on. Clockwork will show:

> Authentication failed. Debugger metadata requires authentication.

with a password box. That box is Clockwork's own prompt, and it is asking for the token. Set one in `system.yaml`:

[codesh=yaml line-numbers="true"]
debugger:
  enabled: true
  provider: clockwork
  token: 'a-long-random-secret'     # Shared secret for reading /__clockwork/ data remotely
[/codesh]

Then type that same value into Clockwork's password box. The extension performs a handshake against `/__clockwork/auth` and remembers the result, so you are only asked once per browser.

> [!NOTE]
> **TIP:** Leaving `token` empty is the secure default, not a broken state. It means the profiler data can only be read from the server itself, which is what you want on any site you have not deliberately opened up. Only set a token when you actually need to profile over the network, and treat it like a password: profiler records include request parameters, configuration, and log output.

If you would rather not set a token at all, you can still read the data from the server itself, for example over SSH:

[codesh=bash]
curl -s http://localhost/__clockwork/latest
[/codesh]

> [!NOTE]
> **NOTE:** Session cookies and the `Authorization` / `X-API-Token` headers are always stripped from stored profiler records, whatever the `censored` option is set to, because a recorded session cookie is a replayable login.

### Debugging the API & hooks

Plugin code that runs on the API path, such as an [`onApi*` event handler](/20/api) or a controller extending `AbstractApiController`, **must not** call `dump()`. The API returns JSON, and `dump()` writes into that body, producing a broken response.

Send the value to the debugger instead. It is captured by Clockwork and shown in both the API Debug panel and the browser extension, without touching the response body:

[codesh=php]
// From anywhere you have the Grav container (e.g. an onApi* hook):
$this->grav['debugger']->addMessage($myvariable, 'info');
[/codesh]

Controllers that extend `AbstractApiController` have a convenience helper that does the same thing and JSON encodes arrays and objects for you:

[codesh=php]
// Inside an API controller method:
$this->debug($myvariable, 'my-label');
$this->debug(['route' => $route, 'count' => $items], 'lookup');
[/codesh]

Both calls are no-ops when the debugger is disabled, so they are safe to leave in development code paths. Open the API Debug panel, click the relevant request, and your message appears in its **Log / dumps** list.

## Error display

The detailed error page provides backtraces and relevant code blocks to help isolate critical errors. It is **disabled** by default, so enable it for development:

[codesh=yaml line-numbers="true"]
errors:
  display: true
[/codesh]

For production, disable the detailed page and rely on the log file instead:

[codesh=yaml line-numbers="true"]
errors:
  display: false
  log: true
[/codesh]

## Logging

Grav provides a simple but powerful logging feature. Use any of the standard severity levels:

[codesh=php line-numbers="true"]
$this->grav['log']->info('My informational message');
$this->grav['log']->notice('My notice message');
$this->grav['log']->debug('My debug message');
$this->grav['log']->warning('My warning message');
$this->grav['log']->error('My error message');
$this->grav['log']->critical('My critical message');
$this->grav['log']->alert('My alert message');
$this->grav['log']->emergency('Emergency, emergency, there is an emergency here!');
[/codesh]

All messages are appended to the `/logs/grav.log` file. Logging works identically on the frontend and the API path, which makes it a reliable fallback when you want a record of what happened across requests.
