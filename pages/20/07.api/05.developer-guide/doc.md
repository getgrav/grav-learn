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

> **Themes can provide custom fields too.** Everything in this section applies equally to a theme: place the file at `your-theme/admin-next/fields/yourfieldtype.js`. Admin2 tracks which provider supplies each field type and fetches its script from the matching route (`/gpm/themes/{slug}/field/{type}` for a theme, `/gpm/plugins/{slug}/field/{type}` for a plugin), so a theme-provided field loads correctly when used in any blueprint.

### How It Works

1. Admin2 encounters an unknown field type in a blueprint
2. It checks if the plugin declared custom fields in its API response
3. If found, it fetches the plugin's field bundle from the API — **all** of that plugin's field scripts in a single request (see [Loading, Bundling & Caching](#loading-bundling-caching))
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

### Loading, Bundling & Caching

You don't have to do anything to opt into this, but it's worth understanding how Admin2 actually fetches your field scripts — because it shapes one rule you must follow.

**One request per plugin, not per field.** When a blueprint puts several of your custom fields on the same screen, Admin2 does **not** fetch them one at a time. It requests the whole plugin's field set in a single call:

```
GET /api/v1/gpm/{plugins|themes}/{slug}/fields
```

The API reads every file in your `admin-next/fields/` directory and returns them as one JSON map of `{ "fieldType": "<javascript source>", … }`. Admin2 fetches this bundle once per plugin, then evaluates each field's source locally — so a plugin shipping seven custom fields costs **one** round-trip, not seven. (The original per-field route, `GET …/field/{type}`, still exists and is used by the classic admin and as a fallback.)

> [!IMPORTANT]
> Because each field's source is evaluated **separately** — each in its own scope with its own `window.__GRAV_FIELD_TAG` — every file in `admin-next/fields/` must be **self-contained**. Don't share top-level variables between two field files and don't `import` one field file from another; treat each as a standalone script that ends in `customElements.define(TAG, …)`. Pull shared logic into a build step that inlines it into each output file, or duplicate the small bit you need.

**Cached aggressively, revalidated cheaply.** The bundle (and the per-field route) carry an `ETag` derived from your files' modification time and size, and Admin2 also caches the response body in `localStorage`. On every later load it revalidates with `If-None-Match`, so an unchanged bundle comes back as a tiny `304 Not Modified` and is served from cache — your multi‑megabyte editor field is downloaded once per release, not on every page open. Because the validator tracks file mtime and size, rebuilding a field during development invalidates it immediately, so you always get fresh code while iterating.

**No rate-limit cost, bounded concurrency.** These script routes are exempt from the API's per-user rate limit (they're static assets, not actions), and Admin2 caps how many requests it runs in parallel. So even a page that pulls in fields from many plugins at once won't trip the limiter or flood the server with a burst of simultaneous downloads.

> [!NOTE]
> This pattern — discover a plugin's contributions on disk, serve them in **one** conditionally-cached bundle, and fan out the work on the client — is the recommended shape for any plugin that ships a fleet of admin-next assets (fields, and by the same token your own grouped config/bootstrap endpoints). It keeps the editor's first paint fast no matter how many plugins are installed.

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
| `window.__GRAV_DIALOGS` | Admin2's dialog helper: `confirm()` for yes/no, plus `form()` and `open()` for richer modals (see [Modals and Overlays](#modals-and-overlays)). Use it instead of native `confirm()`/`alert()`/`prompt()`. |
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

The same `window.__GRAV_DIALOGS` object that provides `confirm()` also opens richer modals, so you rarely need to hand-roll one. Both methods resolve a result, or `null` if the user dismisses the modal (Escape, backdrop, or Cancel), and only one modal shows at a time — extra calls queue.

!! Requires grav-plugin-api `1.0.0-rc.16` / Admin2 `2.0.0-rc.16` or later. Older builds only have `__GRAV_DIALOGS.confirm()`.

**`form()` — an inline-field form, no component to ship.** Define the fields in JS and get the values back:

```javascript
const values = await window.__GRAV_DIALOGS.form({
  title: 'New Article',
  fields: [
    { name: 'title',   label: 'Title', required: true },
    { name: 'section', label: 'Section', type: 'select',
      options: [{ value: 'news', label: 'News' }, { value: 'blog', label: 'Blog' }] },
    { name: 'pinned',  label: 'Pinned', type: 'toggle' },   // text | textarea | select | toggle | number
  ],
  submitLabel: 'Create',
  size: 'md',                                               // sm | md | lg | xl
});
if (values) { /* { title, section, pinned } — e.g. POST /pages */ }
```

**`open()` — your own modal web component.** Ship it at `admin-next/modals/{id}.js` (mounted as `grav-{slug}--modal-{id}`, served by `GET /gpm/plugins/{slug}/modal-script/{id}`):

```javascript
const result = await window.__GRAV_DIALOGS.open({
  plugin: 'my-plugin',
  component: 'my-modal',         // → admin-next/modals/my-modal.js
  title: 'My Modal',
  props: { route: '/blog' },     // set as properties on the element
  size: 'lg',
});
```

Inside the component, hand a result back by dispatching `resolve` (with your value as `detail`), or dismiss with `cancel` / `close` — the same idiom as the floating-widget `close` event:

```javascript
this.dispatchEvent(new CustomEvent('resolve', { detail: { id: 42 } }));
```

> [!NOTE]
> For "create a page of type X under Y", you usually don't need a modal at all — deep-link Admin2's own new-page form instead. See [Menubar Items & Actions](#menubar-items-actions) for the `route` intent and the `/pages/new` query params.

**Hand-rolled overlays (fallback).** If you need an overlay neither method covers, append it to `document.body` rather than the shadow DOM, to avoid overflow constraints from the form layout:

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
| `badge`    | string  | no       | Static badge text or count shown next to the label |
| `badgeEndpoint` | string | no  | API path returning `{ count: N }` for a badge that refreshes at runtime |
| `authorize` | string\|array | no | Permission(s) required to see the item; an array is an any-of test. Stripped before the item reaches the client |

Admin2 calls `GET /sidebar/items` on load. The API fires `onApiSidebarItems`, collects all items from plugins, and returns them.

#### Dynamic badges

A `badge` value is static — it only changes when the sidebar is fully reloaded. For a count that updates on its own (pending items, unread messages, and so on), add a `badgeEndpoint` instead:

```php
$items[] = [
    'id'            => 'pushy',
    'plugin'        => 'pushy',
    'label'         => 'Pushy',
    'icon'          => 'fa-key',
    'route'         => '/plugin/pushy',
    'priority'      => 10,
    'badgeEndpoint' => '/pushy/badge',   // returns { count: N }
];
```

The endpoint returns a count:

```php
public function badge(ServerRequestInterface $request): ResponseInterface
{
    return ApiResponse::create(['count' => $this->pendingCount()]);
}
```

Admin2 fetches it when the sidebar loads and re-fetches on content, config, plugin, and theme changes. The live count overrides the static `badge`. For an immediate update from your own plugin page or widget — without waiting for a refresh event — dispatch a window event:

```js
window.dispatchEvent(new CustomEvent('grav:sidebar:badge', {
    detail: { id: 'pushy', count: 42 },
}));
```

This is the same badge mechanism context panels use (see [Context Panels](#context-panels)).

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

##### Communicating with the toolbar

A component-mode page has no blueprint form, so Admin2 can't track its changes the way it does for blueprint pages. Instead, the component and the header toolbar talk through two DOM events dispatched on the component's own element:

- **`page-action`** (toolbar → component) — Admin2 dispatches this when a toolbar action that your component owns is clicked: any action without an `endpoint`, **including the `primary` action**. The event `detail` is `{ id, label }`.
- **`page-state`** (component → toolbar) — your component dispatches this to report its own state, which drives the `primary` action button. The `detail` accepts `{ dirty, valid, busy }` (all keys optional, merged on each dispatch):
    - `dirty` — set `true` once there are unsaved changes. The `primary` button stays **disabled until the component reports `dirty: true`**.
    - `valid` — set `false` to keep the `primary` button disabled while the component's input is invalid.
    - `busy` — set `true` to show a spinner on the `primary` button while a save is in flight.

```js
class MyPluginPage extends HTMLElement {
    connectedCallback() {
        this.attachShadow({ mode: 'open' });
        // Run our save when the primary (or any endpoint-less) action fires
        this.addEventListener('page-action', (e) => {
            if (e.detail?.id === 'save') this._save();
        });
        this._render();
    }

    _onChange() {
        // Enable the primary Save button
        this.dispatchEvent(new CustomEvent('page-state', { detail: { dirty: true } }));
    }

    async _save() {
        this.dispatchEvent(new CustomEvent('page-state', { detail: { busy: true } }));
        try {
            await this._persist();
            window.__GRAV_TOAST?.success('Saved');
            // Re-disable Save until the next edit
            this.dispatchEvent(new CustomEvent('page-state', { detail: { dirty: false, busy: false } }));
        } catch (err) {
            window.__GRAV_TOAST?.error('Save failed');
            this.dispatchEvent(new CustomEvent('page-state', { detail: { busy: false } }));
        }
    }
}
```

A component that never dispatches `page-state` leaves the `primary` button permanently disabled, so a component page that needs a working Save button must report `dirty: true` at least once.

Toasts and dialogs are available globally to any web component, so you don't need to roll your own:

- `window.__GRAV_TOAST.{success,error,info,warning}(message, options)` — `options` is forwarded to the toaster (e.g. `{ duration: 6000 }`).
- `window.__GRAV_DIALOGS.confirm({ title, message, variant })` — returns a `Promise<boolean>`. Use `variant: 'destructive'` for delete/clear actions. Never use native `confirm()` / `alert()` / `prompt()`.

### Action Buttons

The `actions` array defines buttons rendered in the page header toolbar. Each action is an object with these properties:

| Property   | Type    | Description |
|------------|---------|-------------|
| `id`       | string  | Unique action identifier |
| `label`    | string  | Button text |
| `icon`     | string  | FontAwesome icon class |
| `primary`  | boolean | If `true`, this is the main save action. In **blueprint mode** it submits the form data to `save_endpoint`. In **component mode** it dispatches a `page-action` event to your component and is enabled only while the component reports `dirty: true` via `page-state` (see [Communicating with the toolbar](#communicating-with-the-toolbar)) |
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

#### Client-side intents: `route` and `modal`

Instead of a server `action`, a menubar item can carry a **client-side intent** that runs in Admin2 with no round-trip. When `route` or `modal` is present it takes precedence over `action` (a `confirm`, if set, still runs first). Both fields pass straight through the API, so no `onApiMenubarAction` handler is needed.

```php
public function onApiMenubarItems(Event $event): void
{
    $items = $event['items'] ?? [];

    // `route` navigates the SPA. Deep-link the native new-page form with a
    // preset parent and a locked template — the Admin2 replacement for the
    // classic "custom page creation modal" cookbook recipe. /pages/new reads
    // three optional query params: parent, template (locks the picker), title.
    $items[] = [
        'id'     => 'new-article',
        'plugin' => 'my-plugin',
        'label'  => 'New Article',
        'icon'   => 'fa-plus',
        'route'  => '/pages/new?parent=/blog&template=item&title=New%20Article',
    ];

    // `modal` opens one of the plugin's own modal web components
    // (admin-next/modals/{component}.js — see "Modals and Overlays").
    $items[] = [
        'id'     => 'quick-thing',
        'plugin' => 'my-plugin',
        'label'  => 'Quick Thing',
        'icon'   => 'fa-bolt',
        'modal'  => [
            'component' => 'quick-thing',
            'title'     => 'Quick Thing',
            'size'      => 'lg',            // sm | md | lg | xl
            // 'props' => [...], 'useStandardHeader' => false,
        ],
    ];

    $event['items'] = $items;
}
```

#### Presentation & placement

Beyond the required fields, an item accepts optional keys that control how and where it renders. All pass straight through the API (no allowlist) and apply to action buttons, `route`/`modal` intents, and `href` links alike.

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `variant` | string | no | Color emphasis: `default` (muted icon, the default), `primary`, `success`, `warning`, or `danger`. Maps to Admin2 theme tokens, never a raw color, so buttons stay readable in light and dark. |
| `showLabel` | bool | no | Render the `label` text beside the icon instead of using it only as a tooltip. Turns a small icon into a readable labelled button. Default: `false`. |
| `size` | string | no | `sm` (default, a compact icon) or `md` (taller, with roomier padding). |
| `placement` | string | no | Which toolbar zone the button renders in. `start` (the default) is the open space on the left of the header, kept clear of the destructive Clear Cache action — use it for everyday plugin actions. `end` places the button beside the core actions (View site / Clear Cache), behind a divider, for buttons that genuinely belong with system maintenance. The core actions themselves are never plugin-movable. |
| `priority` | integer | no | Order within the zone; higher values appear earlier (further left). Ties keep plugin registration order. Default: `0`. |

```php
public function onApiMenubarItems(Event $event): void
{
    $items = $event['items'] ?? [];

    // An everyday action: labelled, left-hand zone, ordered ahead of others.
    $items[] = [
        'id'        => 'new-article',
        'plugin'    => 'my-plugin',
        'label'     => 'New Article',
        'icon'      => 'fa-plus',
        'route'     => '/pages/new?parent=/blog&template=item',
        'variant'   => 'primary',
        'showLabel' => true,
        'placement' => 'start',   // left zone, away from Clear Cache
        'priority'  => 10,
    ];

    // A maintenance action that belongs beside the core controls.
    $items[] = [
        'id'        => 'purge-cdn',
        'plugin'    => 'my-plugin',
        'label'     => 'Purge CDN',
        'icon'      => 'fa-cloud',
        'action'    => 'purge',
        'confirm'   => 'Purge the CDN cache?',
        'placement' => 'end',     // beside View site / Clear Cache
    ];

    $event['items'] = $items;
}
```

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

### Notifications & Toasts

There are two ways a plugin tells the user something in Admin2, and they serve different purposes:

- **Notifications** are persistent and dismissible — a banner above the dashboard or an item in the dashboard's Notifications widget. Use them for standing conditions ("an untrusted host is configured", "a backup is overdue").
- **Toasts** are transient — they pop in, then fade. Use them for the immediate result of an action ("Cache warmed", "Save failed").

#### Persistent notifications (`onApiDashboardNotifications`)

Listen for `onApiDashboardNotifications` and append to the `notifications` array, which is **grouped by location**. The location is the array key you push into:

- `top` — a rotating banner shown above the dashboard. Best for one important standing notice.
- `dashboard` (and `feed`) — items in the dashboard's Notifications widget list.

```php
public static function getSubscribedEvents()
{
    return [
        'onApiDashboardNotifications' => ['onApiDashboardNotifications', 0],
    ];
}

public function onApiDashboardNotifications(Event $event): void
{
    // Only raise the notice while the condition actually holds.
    if ($this->hostIsTrusted()) {
        return;
    }

    // Event has no by-reference offsetGet — read, modify, write back.
    $notifications = $event['notifications'] ?? [];
    $notifications['top'][] = [
        'id'             => 'my-plugin-untrusted-host', // unique; dismissal keys off this
        'date'           => date('c'),                  // ISO 8601
        'message'        => $this->grav['language']->translate('PLUGIN_MY_PLUGIN.UNTRUSTED_HOST_NOTICE'),
        'icon'           => 'shield-alert',             // Lucide icon name, or an emoji
        'title'          => 'Security',                 // optional bold lead-in
        'reappear_after' => '+7 days',                  // optional; see below
        // 'action'      => ['label' => 'Fix it', 'url' => '/admin/config/system'],
    ];
    $event['notifications'] = $notifications;
}
```

Item fields:

| Field | Required | Description |
| --- | --- | --- |
| `id` | yes | Unique id. Dismissal and `reappear_after` key off this. |
| `message` | yes | The text. Inline Markdown is rendered (links, emphasis). |
| `date` | yes | ISO 8601 timestamp (`date('c')`). Shown beside dashboard-widget items. |
| `icon` | no | A [Lucide](https://lucide.dev) icon name (`shield-alert`, kebab or PascalCase) or an emoji. |
| `title` | no | Bold lead-in shown before the message. |
| `action` | no | `['label' => '…', 'url' => '…']` — renders a button that opens the URL in a new tab. |
| `link` | no | Makes a dashboard-widget item's whole row a link (opens in a new tab). |
| `reappear_after` | no | A `strtotime()` interval (`+7 days`, `+1 month`). After the user dismisses the notice, it returns once this interval elapses. Without it, dismissal is permanent for that user. |
| `type` | no | `info`, `notice`, `warning`, or `promo` (default behavior for unknown values matches a plain item). `promo` renders in the Notifications widget as a gradient card and additionally honors `image` and `accent` (`purple`, `blue`, `teal`, `amber`, `rose`). |

Dismissal is per-user and automatic: when the user closes a notice, Admin2 POSTs to `/dashboard/notifications/{id}/hide`, which records the time in `user://data/notifications/{username}.yaml`. Plugin notices are merged fresh on every request (never cached), but they still flow through this dismiss + `reappear_after` handling, so a notice stays gone until the condition recurs or the interval elapses.

> The visual treatment is driven by `type`, `icon`, and (for promos) `accent`/`image` — there is no per-level color on a standard notice, so reach for a clear `icon` and `title` to signal severity.

#### Transient toasts

From a **web component** (custom field, plugin page, widget, panel, modal), use the injected global — never a native `alert()`:

```javascript
window.__GRAV_TOAST.success('Settings saved');
window.__GRAV_TOAST.error('Could not reach the service', { duration: 8000 });
// also: .info(msg, opts), .warning(msg, opts). `duration` is ms; omit for the default.
```

From a **save or action endpoint**, return a toast hint so the server controls the message instead of Admin2's generic "saved" toast. Put a top-level `toast` object (or a bare `message` string) in the response body:

```php
return ApiResponse::create([
    'toast' => [
        'message'     => 'Settings saved — reindexing in the background.',
        'type'        => 'success',   // success | error | info | warning
        'duration'    => 8000,        // ms; 0 (or dismissible: true) = stays until closed
        'dismissible' => true,
    ],
]);
```

For the **menubar action** path (`onApiMenubarAction`), the `result` envelope already drives a toast — `status: 'success'` shows a success toast with `message`, `status: 'error'` shows an error toast:

```php
$event['result'] = ['status' => 'success', 'message' => 'CDN cache purged.'];
```

#### Blocking a save with an error

To **stop** a save and tell the user why, throw from your controller. A `ValidationException` (HTTP 422) carries field-level errors; Admin2 shows the message, points at the offending field, and keeps the form open so nothing is lost:

```php
use Grav\Plugin\Api\Exceptions\ValidationException;

if ($problem) {
    throw new ValidationException('Content failed validation.', [
        ['field' => 'header.markdown', 'message' => 'Unbalanced code fence.'],
    ]);
}
```

For a non-field error with a longer-lived toast, use `ErrorResponse` with a toast hint (the 5th argument):

```php
use Grav\Plugin\Api\Response\ErrorResponse;

return ErrorResponse::create(422, 'Validation failed', 'Content failed validation.', [], [
    'duration'    => 0,      // stays until dismissed
    'dismissible' => true,
]);
```

Either way the save does not complete and the editor stays open — the answer to "show a warning but let the user fix it" versus "let it through": throw to block, return a `toast` hint to inform.

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
