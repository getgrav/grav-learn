---
title: Developer Guide
taxonomy:
    category: docs
---
# API Developer Guide

This guide covers how plugin developers can integrate with the Grav API and Admin2 — the new Svelte 5 SPA admin plugin (powered by the API) that supersedes the deprecated classic Admin plugin in Grav 2.0.

## Extending the API

Any plugin can add custom API endpoints. See the [Plugin API Integration](/20/plugins/plugin-api-integration) guide for the full step-by-step.

The short version:

1. Subscribe to `onApiRegisterRoutes` in your plugin
2. Register routes pointing to a controller class
3. Create a controller extending `AbstractApiController`

## Custom Admin Fields via Web Components

Admin2 renders plugin configuration forms using blueprint schemas, just like the classic admin. Standard field types (text, toggle, select, array, list, etc.) work automatically.

For **custom field types** — fields with specialized UI that standard types can't handle — plugins can ship **Web Components** that Admin2 loads on demand.

### How It Works

1. Admin2 encounters an unknown field type in a blueprint
2. It checks if the plugin declared custom fields in its API response
3. If found, it fetches the JavaScript file from the API
4. The JavaScript defines a Custom Element
5. Admin2 mounts the element and communicates via properties and events

### File Convention

Place web component JavaScript files at:

```
your-plugin/
  admin-next/
    fields/
      yourfieldtype.js      # One JS file per custom field type
```

When Admin2 loads a plugin's detail page, the API automatically discovers files in `admin-next/fields/` and includes them in the response:

```json
{
  "slug": "your-plugin",
  "custom_fields": {
    "yourfieldtype": "yourfieldtype"
  }
}
```

### Web Component Contract

Each JavaScript file must define a Custom Element using the tag name provided via `window.__GRAV_FIELD_TAG`:

```javascript
const TAG = window.__GRAV_FIELD_TAG;

class YourFieldType extends HTMLElement {
  // Properties set by Admin2
  set field(f) { this._field = f; this._render(); }
  set value(v) { this._value = v; this._render(); }
  get value() { return this._value; }

  connectedCallback() {
    this.attachShadow({ mode: 'open' });
    this._render();
  }

  _render() {
    // Build your UI in this.shadowRoot
  }

  _emitChange(newValue) {
    this.dispatchEvent(new CustomEvent('change', {
      detail: newValue,
      bubbles: true
    }));
  }
}

customElements.define(TAG, YourFieldType);
```

**Properties** (set by Admin2):
- `field` — The blueprint field definition object (label, help, options, validate, etc.)
- `value` — The current field value

**Events** (emitted by your component):
- `change` — `CustomEvent` with `detail` set to the new value

### Injected Globals

Before Admin2 executes your field script, it sets a small set of globals on `window`. These are the entire interface between your component and the admin runtime. The first four are injected immediately before your script runs; the rest are set once at app boot and are available to every component.

| Global | Description |
|--------|-------------|
| `window.__GRAV_FIELD_TAG` | The Custom Element tag name assigned to this field, in the form `grav-{plugin}--{fieldType}`. Always `customElements.define()` with this value. |
| `window.__GRAV_API_SERVER_URL` | Base URL of the Grav site (e.g. `https://mysite.com`). |
| `window.__GRAV_API_PREFIX` | API prefix (default `/api/v1`). |
| `window.__GRAV_API_TOKEN` | JWT access token already obtained by Admin2, ready to send as `X-API-Token`. |
| `window.__GRAV_DIALOGS` | Admin2's confirm-dialog helper. Use it instead of native `confirm()`/`alert()`/`prompt()`. |
| `window.__GRAV_ADMIN_BASE` | Base path of Admin2, useful for building internal links. |
| `window.__GRAV_NAVIGATE` | Function for SPA navigation (falls back to `window.location.href` if absent). |
| `window.__GRAV_I18N` | Locale/direction bridge: `__GRAV_I18N.dir` is `'ltr'` or `'rtl'`, and `__GRAV_I18N.subscribe(fn)` fires on language change. See [RTL and Internationalization](#rtl-and-internationalization). |
| `window.__GRAV_CONTENT_LANG` | The active content language. |

> [!NOTE]
> There is **no** `window.__GRAV_ENVIRONMENT` global for field components. Admin2 manages the active environment through its own authenticated session, so you do not need to send an `X-Grav-Environment` header from a field. If you have seen that header in older field code, it was a no-op.

### Accessing the API

Your web component can call any API endpoint, including custom endpoints your plugin registers. Authentication is already handled for you via the injected globals:

```javascript
function apiUrl(path) {
  const base = window.__GRAV_API_SERVER_URL || '';
  const prefix = window.__GRAV_API_PREFIX || '/api/v1';
  return `${base}${prefix}${path}`;
}

function apiHeaders(json = false) {
  const headers = {};
  const token = window.__GRAV_API_TOKEN;
  // Use X-API-Token instead of Authorization: Bearer. FastCGI / PHP-FPM / CGI
  // setups (MAMP's mod_fastcgi is the common culprit) silently strip the
  // Authorization header before it reaches PHP; X-* headers pass through
  // cleanly. The server also accepts Authorization: Bearer as a fallback.
  if (token) headers['X-API-Token'] = token;
  if (json) headers['Content-Type'] = 'application/json';
  return headers;
}

async function apiGet(path) {
  const resp = await fetch(apiUrl(path), { headers: apiHeaders() });
  const json = await resp.json();
  return json.data || json;
}
```

### Light DOM vs Shadow DOM

You can render your field into either light DOM (`this.innerHTML`) or a shadow root (`this.attachShadow({ mode: 'open' })`). The trade-off:

- **Light DOM** inherits Admin2's typography and color tokens automatically, so simple read-only or text fields need almost no styling. The cost is that the host page's styles can leak into your markup.
- **Shadow DOM** gives you complete style isolation, which is what you want for anything with significant custom UI. The cost is that you provide all of your own CSS inside a `<style>` block, and Admin2's theme tokens are not inherited (read them explicitly via CSS custom properties such as `var(--foreground)`, `var(--background)`, `var(--border)`, `var(--primary)`, `var(--muted-foreground)`).

As a rule of thumb: read-only displays usually want light DOM; interactive pickers usually want Shadow DOM.

### Dialogs: Never Use Native `confirm()` / `alert()` / `prompt()`

Native browser dialogs break the Admin2 visual language and block the event loop. Admin2 exposes `window.__GRAV_DIALOGS` for confirmations instead:

```javascript
async _deleteItem(slug) {
  const ok = await window.__GRAV_DIALOGS?.confirm({
    title: 'Delete item?',
    message: `"${slug}" will be permanently removed. This cannot be undone.`,
    confirmLabel: 'Delete',
    variant: 'destructive',     // adds a warning icon and red confirm button
  });
  if (!ok) return;
  // ... proceed
}
```

The signature is:

```typescript
window.__GRAV_DIALOGS.confirm({
  title?: string;          // default: "Are you sure?"
  message: string;         // required body text
  confirmLabel?: string;   // default: "Confirm"
  cancelLabel?: string;    // default: "Cancel"
  variant?: 'destructive' | 'default';
}): Promise<boolean>       // true on confirm, false on cancel / Escape / backdrop click
```

Always use optional chaining (`?.`) so your component degrades gracefully if it is ever loaded outside Admin2. Keep `message` to a sentence or two, put the noun in `title` ("Delete page?") and the consequence in `message` ("All revisions will be lost.").

### Modals and Overlays

If your field needs a modal (e.g., a picker dialog), append it to `document.body` rather than rendering it inside the shadow DOM. This avoids overflow constraints from the form layout:

```javascript
_openModal() {
  const modal = document.createElement('div');
  modal.id = '__my-plugin-modal';
  modal.innerHTML = `<style>...</style><div class="modal">...</div>`;
  document.body.appendChild(modal);
}

_closeModal() {
  document.getElementById('__my-plugin-modal')?.remove();
}
```

> [!WARNING]
> When rendering in `document.body`, your CSS will be affected by the host page's styles (including Tailwind CSS). Use unique class prefixes and explicit property values to avoid conflicts. In particular, Tailwind v4 sets `* { min-height: 0 }` which can collapse elements — add `min-height: auto` to your containers.

### RTL and Internationalization

Admin2 runs in both left-to-right and right-to-left, following the user's admin language (Arabic, Hebrew, Persian, Urdu, and anything else flagged RTL). Field components should honor the active direction.

The contract lives on `window.__GRAV_I18N`:

```javascript
window.__GRAV_I18N.dir              // 'ltr' | 'rtl' — read-only snapshot
window.__GRAV_I18N.subscribe(fn)    // fires on locale (and direction) change; returns an unsubscribe fn
```

`<html dir>` is also set, so anything in the normal CSS cascade picks up the direction for free. Inside Shadow DOM you read it explicitly:

```javascript
_getDir() {
  if (window.__GRAV_I18N?.dir) return window.__GRAV_I18N.dir;
  return document.documentElement.getAttribute('dir') === 'rtl' ? 'rtl' : 'ltr';
}

connectedCallback() {
  this._render();
  // Admin2 can switch language without a full reload — re-apply on change.
  this._i18nUnsub = window.__GRAV_I18N?.subscribe?.(() => this._applyDir());
}

disconnectedCallback() {
  this._i18nUnsub?.();
}
```

Prefer logical CSS properties (`padding-inline-start`, `margin-inline-end`, `inset-inline-start`, `text-align: start`) so a single rule works in both directions. Pin any embedded code/source editor to `dir="ltr"` regardless of admin direction, since code is always left-to-right.

### Accessibility

Treat your custom element like any other interactive control. Use semantic HTML (`<button>` rather than a clickable `<div>`), wire up keyboard handlers, set `aria-label` / `aria-describedby` where appropriate, and respect `prefers-reduced-motion` for animations. If your field is interactive and uses Shadow DOM, test it with at least one screen reader.

### Supporting Both Classic Admin and Admin2

Plugins that need to keep working in the classic Twig/jQuery admin (for sites still on Grav 1.7) as well as Admin2 will carry two field implementations for a while. The core Team plugins keep these as separate files rather than sharing a layer. The **codesh** plugin, for example, ships `admin/js/codeshtheme-field.js` for classic admin and `admin-next/fields/codeshtheme.js` for Admin2, side by side:

```
your-plugin/
  admin/
    js/
      codeshtheme-field.js     # Classic admin: jQuery-based UI
  admin-next/
    fields/
      codeshtheme.js           # Admin2: Web Component UI
```

For most fields that small amount of duplication is the simplest path. If a field has substantial shared logic (input validation, data parsing, a non-trivial API client), you can factor that into a plain ESM module under your plugin and import it from both sides: the web-component side imports it at runtime, the classic side bundles it through whatever build it already uses. No new toolchain is required either way.

## Real-World Example: Code Syntax Highlighter

The [Codesh plugin](https://github.com/trilbymedia/grav-plugin-codesh) provides two custom field types as a reference implementation:

### Custom API Endpoints

Codesh registers its own endpoints for theme and grammar management:

```php
// In codesh.php
public function onApiRegisterRoutes(Event $event): void
{
    $routes = $event['routes'];
    $routes->get('/codesh/themes', [ApiController::class, 'themes']);
    $routes->post('/codesh/themes/import', [ApiController::class, 'importTheme']);
    $routes->delete('/codesh/themes/{name}', [ApiController::class, 'deleteTheme']);
    $routes->get('/codesh/grammars', [ApiController::class, 'grammars']);
    $routes->post('/codesh/grammars/import', [ApiController::class, 'importGrammar']);
    $routes->delete('/codesh/grammars/{slug}', [ApiController::class, 'deleteGrammar']);
}
```

### Custom Field: Theme Picker (`codeshtheme`)

A visual theme selector with code preview cards:

- **File**: `admin-next/fields/codeshtheme.js`
- **Blueprint usage**: `type: codeshtheme` with `variant: dark` or `variant: light`
- **Features**: Modal grid with 62+ themes, syntax-highlighted code previews, search, dark/light/custom filters, import/delete for custom themes
- **API calls**: `GET /codesh/themes`, `POST /codesh/themes/import`, `DELETE /codesh/themes/{name}`

```yaml
# In blueprints.yaml
theme_dark:
  type: codeshtheme
  label: Dark Theme
  help: Syntax highlighting theme for dark mode
  variant: dark
  default: helios-dark
```

### Custom Field: Grammar List (`codeshgrammarlist`)

A multi-column display of available TextMate grammars:

- **File**: `admin-next/fields/codeshgrammarlist.js`
- **Blueprint usage**: `type: codeshgrammarlist`
- **Features**: 4-column responsive layout, import button for custom grammars, delete for custom entries, shows aliases
- **API calls**: `GET /codesh/grammars`, `POST /codesh/grammars/import`, `DELETE /codesh/grammars/{slug}`

### Key Patterns from Codesh

1. **Separate API controller** — `classes/ApiController.php` handles all REST endpoints
2. **Reuses existing managers** — `ThemeManager` and `GrammarManager` are used by both the classic admin and API controller
3. **File upload handling** — Falls back to `$_FILES` when PSR-7 `getUploadedFiles()` returns empty
4. **Modal in document.body** — The theme picker appends its modal to `document.body` to escape shadow DOM constraints
5. **Single-pass tokenized highlighting** — Uses a single regex with alternation groups for syntax highlighting to avoid self-matching

## Custom Admin Pages

Beyond custom field types, plugins can register their own **full pages** in the Admin2 sidebar. This lets plugins provide dedicated management interfaces — like the License Manager's license editing page — without modifying Admin2 itself.

There are two rendering modes:

- **Blueprint mode** — The plugin provides a Grav blueprint, and Admin2 renders the form automatically. Best for data-driven pages (settings, key-value editors, configuration panels).
- **Component mode** — The plugin provides a full-page web component. Best for completely custom UIs that don't map to a standard form.

### Sidebar Registration

To add an entry to the Admin2 sidebar, subscribe to the `onApiSidebarItems` event and append your item:

```php
public static function getSubscribedEvents()
{
    return [
        'onApiSidebarItems' => ['onApiSidebarItems', 0],
    ];
}

public function onApiSidebarItems(Event $event): void
{
    $items = $event['items'] ?? [];
    $items[] = [
        'id'       => 'license-manager',
        'plugin'   => 'license-manager',
        'label'    => 'Licenses',
        'icon'     => 'fa-key',
        'route'    => '/plugin/license-manager',
        'priority' => 10,
    ];
    $event['items'] = $items;
}
```

**Sidebar item properties:**

| Property   | Type    | Required | Description |
|------------|---------|----------|-------------|
| `id`       | string  | yes      | Unique identifier for this sidebar item |
| `plugin`   | string  | yes      | The owning plugin's slug |
| `label`    | string  | yes      | Display name shown in the sidebar |
| `icon`     | string  | yes      | FontAwesome icon class (e.g. `fa-key`) |
| `route`    | string  | yes      | Admin2 route path (e.g. `/plugin/license-manager`) |
| `priority` | integer | no       | Sort order; higher values appear earlier (default: 0) |
| `badge`    | string  | no       | Optional badge text or count shown next to the label |

Admin2 calls `GET /sidebar/items` on load. The API fires `onApiSidebarItems`, collects all items from plugins, and returns them.

### Page Definition

When a user navigates to a plugin page, Admin2 calls `GET /gpm/plugins/{slug}/page` to get the page definition. Subscribe to `onApiPluginPageInfo` to provide it:

```php
public static function getSubscribedEvents()
{
    return [
        'onApiPluginPageInfo' => ['onApiPluginPageInfo', 0],
    ];
}

public function onApiPluginPageInfo(Event $event): void
{
    if ($event['plugin'] !== 'license-manager') {
        return;
    }

    $event['definition'] = [
        'id'            => 'license-manager',
        'plugin'        => 'license-manager',
        'title'         => 'License Manager',
        'icon'          => 'fa-key',
        'page_type'     => 'blueprint',
        'blueprint'     => 'licenses',
        'data_endpoint' => '/licenses/form-data',
        'save_endpoint' => '/licenses',
        'actions'       => [
            [
                'id'       => 'import',
                'label'    => 'Import',
                'icon'     => 'fa-upload',
                'upload'   => true,
                'endpoint' => '/licenses/import',
            ],
            [
                'id'       => 'export',
                'label'    => 'Export',
                'icon'     => 'fa-download',
                'download' => true,
                'endpoint' => '/licenses/export',
            ],
            [
                'id'      => 'save',
                'label'   => 'Save',
                'icon'    => 'fa-check',
                'primary' => true,
            ],
        ],
    ];
}
```

> [!NOTE]
> Always check `$event['plugin']` before setting the definition. Every plugin listening to `onApiPluginPageInfo` receives every request — only respond when the slug matches yours.

#### Blueprint Mode

Set `page_type` to `'blueprint'` and provide:

| Property        | Description |
|-----------------|-------------|
| `blueprint`     | Name of the blueprint file (without `.yaml`) in `admin/blueprints/` |
| `data_endpoint` | API path that returns current data in blueprint-compatible format |
| `save_endpoint` | API path that receives a PATCH with the form data |

Admin2 fetches the blueprint via `GET /blueprints/plugins/{plugin}/pages/{pageId}`, loads the current data from `data_endpoint`, renders the form, and sends saves to `save_endpoint`.

The blueprint file lives in the standard Grav location:

```
your-plugin/
  admin/
    blueprints/
      your-page.yaml       # Standard Grav blueprint YAML
```

#### Component Mode

Set `page_type` to `'component'` and place a JavaScript file at:

```
your-plugin/
  admin-next/
    pages/
      your-plugin.js       # Full-page web component
```

Admin2 fetches the script via `GET /gpm/plugins/{slug}/page-script`, sets the tag name via `window.__GRAV_PAGE_TAG`, and mounts the element in the content area. The same globals (`__GRAV_API_SERVER_URL`, `__GRAV_API_PREFIX`, `__GRAV_API_TOKEN`) are available for API calls.

You can also use **both modes together**: set `page_type` to `'blueprint'` and also ship a `pages/{slug}.js` file. The API response will include `has_custom_component: true`, letting Admin2 render the blueprint form alongside custom component sections.

### Action Buttons

The `actions` array defines buttons rendered in the page header toolbar. Each action is an object with these properties:

| Property   | Type    | Description |
|------------|---------|-------------|
| `id`       | string  | Unique action identifier |
| `label`    | string  | Button text |
| `icon`     | string  | FontAwesome icon class |
| `primary`  | boolean | If `true`, this is the main save action (uses form data, calls `save_endpoint`) |
| `upload`   | boolean | If `true`, clicking opens a file picker and POSTs the file to `endpoint` |
| `download` | boolean | If `true`, clicking triggers a file download from `endpoint` |
| `endpoint` | string  | API path for upload/download actions |
| `confirm`  | string  | If set, shows a confirmation dialog with this message before executing |

A page typically has one `primary` save button plus optional import/export or custom actions.

### Real-World Example: License Manager

The [license-manager plugin](https://github.com/getgrav/grav-plugin-license-manager) is a complete reference implementation of a custom admin page using blueprint mode.

#### Event Handlers

The plugin subscribes to three events:

```php
public static function getSubscribedEvents()
{
    return [
        'onPluginsInitialized'  => ['onPluginsInitialized', 0],
        'onApiRegisterRoutes'   => ['onApiRegisterRoutes', 0],
        'onApiSidebarItems'     => ['onApiSidebarItems', 0],
        'onApiPluginPageInfo'   => ['onApiPluginPageInfo', 0],
    ];
}
```

- `onApiRegisterRoutes` — Registers REST endpoints for license CRUD, import, export, and product status
- `onApiSidebarItems` — Adds the "Licenses" entry to the sidebar
- `onApiPluginPageInfo` — Returns the page definition with blueprint reference, data/save endpoints, and import/export actions

#### API Endpoints

The `LicenseApiController` provides these endpoints:

| Method | Path | Description |
|--------|------|-------------|
| GET    | `/licenses/form-data` | Returns license data in blueprint-compatible format (used by `data_endpoint`) |
| PATCH  | `/licenses` | Saves all licenses from the form (used by `save_endpoint`) |
| POST   | `/licenses/import` | Imports a `licenses.yaml` file (upload action) |
| GET    | `/licenses/export` | Downloads `licenses.yaml` (download action) |
| GET    | `/licenses/products-status` | Returns installation status of licensed products |

#### Custom Field: Products Status

The blueprint includes a `products-status` custom field type that displays a read-only list of licensed products with their installation state:

```yaml
# admin/blueprints/licenses.yaml
form:
  validation: loose
  fields:
    licenses:
      type: array
      style: vertical
      placeholder_key: PLUGIN_LICENSE_MANAGER.SLUG
      placeholder_value: PLUGIN_LICENSE_MANAGER.LICENSE
    products_status:
      type: products-status
      style: vertical
```

The web component (`admin-next/fields/products-status.js`) calls `GET /licenses/products-status` and renders each product with its status (enabled, disabled, installed, or not installed). Authentication uses the `window.__GRAV_API_TOKEN` global, sent as an `X-API-Token` request header.

#### How It All Fits Together

1. Admin2 loads and calls `GET /sidebar/items` — the license-manager adds its "Licenses" entry
2. User clicks the sidebar item, Admin2 navigates to `/plugin/license-manager`
3. Admin2 calls `GET /gpm/plugins/license-manager/page` — the plugin returns its page definition
4. Admin2 sees `page_type: 'blueprint'`, fetches the blueprint from `GET /blueprints/plugins/license-manager/pages/licenses`
5. Admin2 loads current data from `GET /licenses/form-data`
6. The form renders with standard fields (array for licenses) and a custom field (products-status web component)
7. The Save button sends a PATCH to `/licenses`; Import/Export trigger their respective endpoints

## Other Admin2 Extension Points

Beyond full plugin pages and custom fields, Admin2 exposes several smaller surfaces plugins can contribute to. Each one follows the same pattern: a GET endpoint that fires an event, plugins append items to the event data, and Admin2 renders the collected results. Web-component payloads (where applicable) live under `admin-next/{subdir}/{slug}.js` inside the plugin and are served on demand by dedicated script endpoints.

| Surface | Endpoint | Registration event | Web component (if any) | Script endpoint |
|---------|----------|-------------------|------------------------|-----------------|
| Full plugin page | `GET /gpm/plugins/{slug}/page` | `onApiPluginPageInfo` | `admin-next/pages/{slug}.js` | `GET /gpm/plugins/{slug}/page-script` |
| Custom blueprint field | (automatic discovery) | (filesystem) | `admin-next/fields/{type}.js` | `GET /gpm/plugins/{slug}/field/{type}` |
| Sidebar item | `GET /sidebar/items` | `onApiSidebarItems` | (none — links to a plugin page) | — |
| Settings panel | `GET /settings/panels` | `onApiAdminSettingsPanels` | (blueprint-mode only) | — |
| Menubar item | `GET /menubar/items` | `onApiMenubarItems` | (none — POSTs to action endpoint) | — |
| Menubar action | `POST /menubar/actions/{plugin}/{action}` | `onApiMenubarAction` | — | — |
| Floating widget | `GET /floating-widgets` | `onApiFloatingWidgets` | `admin-next/widgets/{slug}.js` | `GET /gpm/plugins/{slug}/widget-script` |
| Context panel | `GET /context-panels` | `onApiContextPanels` | `admin-next/panels/{slug}.js` | `GET /gpm/plugins/{slug}/panel-script` |
| Custom report | `GET /reports` | `onApiGenerateReports` | `admin-next/reports/{reportId}.js` | `GET /gpm/plugins/{slug}/report-script/{reportId}` |

The current authenticated user is always passed in the event data — use it to skip registrations when the user doesn't have the permissions required to use that feature.

### Settings Panels

Settings panels render as cards inside Admin2's Settings page, rather than as standalone sidebar entries. Use them for configuration that belongs with other system settings. The payload shape is the same as a blueprint-mode plugin-page definition — a blueprint file plus `data_endpoint` / `save_endpoint` — no component support.

```php
public static function getSubscribedEvents()
{
    return [
        'onApiAdminSettingsPanels' => ['onApiAdminSettingsPanels', 0],
    ];
}

public function onApiAdminSettingsPanels(Event $event): void
{
    $user = $event['user'];
    if (!$user->authorize('api.config.write')) {
        return;
    }

    $panels = $event['panels'] ?? [];
    $panels[] = [
        'id'            => 'login-settings',
        'plugin'        => 'my-plugin',
        'label'         => 'Login & Security',
        'description'   => 'Authentication timeouts and 2FA policy.',
        'icon'          => 'fa-shield-alt',
        'blueprint'     => 'login-settings',
        'data_endpoint' => '/my-plugin/login-settings/data',
        'save_endpoint' => '/my-plugin/login-settings/save',
        'priority'      => 10,
    ];
    $event['panels'] = $panels;
}
```

Panels are sorted by `priority` descending, then by insertion order for ties.

### Menubar Items & Actions

Menubar items are one-click buttons in Admin2's top toolbar. Each item declares an `action` key; when the user clicks, Admin2 POSTs to `/menubar/actions/{plugin}/{action}`, which fires `onApiMenubarAction`. Use this for quick tasks like "warm cache", "clear opcache", or "purge CDN".

```php
public static function getSubscribedEvents()
{
    return [
        'onApiMenubarItems'  => ['onApiMenubarItems', 0],
        'onApiMenubarAction' => ['onApiMenubarAction', 0],
    ];
}

public function onApiMenubarItems(Event $event): void
{
    $items = $event['items'] ?? [];
    $items[] = [
        'id'      => 'warm-cache',
        'plugin'  => 'warm-cache',
        'label'   => 'Warm Cache',
        'icon'    => 'fa-tachometer',
        'action'  => 'warm',
        'confirm' => 'Warm the cache now?',
    ];
    $event['items'] = $items;
}

public function onApiMenubarAction(Event $event): void
{
    if ($event['plugin'] !== 'warm-cache') {
        return;
    }

    // $event['body'] and $event['user'] are available.
    $result = $this->warmCache();

    $event['result'] = [
        'status'  => 'success',
        'message' => "Warmed {$result['pages']} pages in {$result['duration']}s.",
    ];
}
```

Handlers **must** check `$event['plugin']` before responding — every plugin listening to `onApiMenubarAction` receives every request. `status: 'success'` returns HTTP 200; `status: 'error'` returns 400.

### Floating Widgets

Floating widgets are persistent UI — chat assistants, live notification panels, AI helpers — that stay mounted across page navigation in Admin2. Each widget ships a web component at `admin-next/widgets/{slug}.js`.

```php
public function onApiFloatingWidgets(Event $event): void
{
    $widgets = $event['widgets'] ?? [];
    $widgets[] = [
        'id'       => 'ai-pro-chat',
        'plugin'   => 'ai-pro',
        'label'    => 'AI Assistant',
        'icon'     => 'bot',
        'priority' => 10,
    ];
    $event['widgets'] = $widgets;
}
```

### Context Panels

Context panels are slide-in panels triggered by toolbar buttons inside Admin2 editors (e.g., the page editor). Use them for editor-scoped tools like revision history, SEO analysis, AI suggestions, or link checking.

```php
public function onApiContextPanels(Event $event): void
{
    $panels = $event['panels'] ?? [];
    $panels[] = [
        'id'            => 'revisions',
        'plugin'        => 'revisions-pro',
        'label'         => 'Revision History',
        'icon'          => 'history',
        'contexts'      => ['pages'],           // show in page editor only
        'priority'      => 10,
        'width'         => 900,
        'badgeEndpoint' => '/revisions-pro/badge', // optional {count: N}
    ];
    $event['panels'] = $panels;
}
```

`contexts` controls which Admin2 editors surface the trigger button. `badgeEndpoint` is polled for a `{count: N}` response to drive a numeric badge on the button.

### Custom Reports

Plugins can contribute cards to Admin2's Reports page, either as pre-rendered Markdown/HTML or as interactive web components. Report web components live at `admin-next/reports/{reportId}.js` and are loaded on demand.

```php
public function onApiGenerateReports(Event $event): void
{
    $reports = $event['reports'] ?? [];
    $reports[] = [
        'id'        => 'seo-summary',
        'plugin'    => 'seo-magic',
        'title'     => 'SEO Summary',
        'icon'      => 'fa-search',
        'component' => 'seo-summary',           // resolved to admin-next/reports/seo-summary.js
        'priority'  => 20,
    ];
    $event['reports'] = $reports;
}
```

Set `component` to `null` to use Admin2's default renderer with a pre-computed `items` array; set it to an id matching the filename to ship a custom web component.

## Compatibility Declaration

Declare API compatibility in your plugin's `blueprints.yaml`:

```yaml
compatibility:
  grav:
    - 2.0
  api:
    - 1.0
```

This signals to the ecosystem that your plugin:
- Has been tested with the API plugin
- Ships web components for any custom field types (if applicable)
- Works correctly with Admin2

## Webhooks

The API plugin can dispatch outgoing webhooks for every mutation event. Plugins don't need to do anything special — the API's `WebhookDispatcher` listens for `onApi*` events and forwards them to every configured webhook URL whose event filter matches. Users manage webhooks via the [Webhooks endpoints](/20/api/endpoints/webhooks) (or the Admin2 webhooks UI).

Webhook events map to API events as follows:

| API Event | Webhook Event |
|-----------|---------------|
| `onApiPageCreated` | `page.created` |
| `onApiPageUpdated` | `page.updated` |
| `onApiPageDeleted` | `page.deleted` |
| `onApiPageMoved` | `page.moved` |
| `onApiPageTranslated` | `page.translated` |
| `onApiPagesReordered` | `pages.reordered` |
| `onApiMediaUploaded` | `media.uploaded` |
| `onApiMediaDeleted` | `media.deleted` |
| `onApiUserCreated` | `user.created` |
| `onApiUserUpdated` | `user.updated` |
| `onApiUserDeleted` | `user.deleted` |
| `onApiConfigUpdated` | `config.updated` |
| `onApiPackageInstalled` | `gpm.installed` |
| `onApiPackageRemoved` | `gpm.removed` |
| `onApiGravUpgraded` | `grav.upgraded` |

Webhook POSTs are signed with HMAC-SHA256 of the body using the per-webhook secret and sent as `X-Hub-Signature-256: sha256=...`. Deliveries are logged per-webhook; use `GET /webhooks/{id}/deliveries` to inspect history.
