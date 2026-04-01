---
title: Developer Guide
taxonomy:
    category: docs
---
# API Developer Guide

This guide covers how plugin developers can integrate with the Grav API and the next-generation admin interface (admin-next).

## Extending the API

Any plugin can add custom API endpoints. See the [Plugin API Integration](/18/plugins/plugin-api-integration) guide for the full step-by-step.

The short version:

1. Subscribe to `onApiRegisterRoutes` in your plugin
2. Register routes pointing to a controller class
3. Create a controller extending `AbstractApiController`

## Custom Admin Fields via Web Components

Admin-next renders plugin configuration forms using blueprint schemas, just like the classic admin. Standard field types (text, toggle, select, array, list, etc.) work automatically.

For **custom field types** — fields with specialized UI that standard types can't handle — plugins can ship **Web Components** that admin-next loads on demand.

### How It Works

1. Admin-next encounters an unknown field type in a blueprint
2. It checks if the plugin declared custom fields in its API response
3. If found, it fetches the JavaScript file from the API
4. The JavaScript defines a Custom Element
5. Admin-next mounts the element and communicates via properties and events

### File Convention

Place web component JavaScript files at:

```
your-plugin/
  admin-next/
    fields/
      yourfieldtype.js      # One JS file per custom field type
```

When admin-next loads a plugin's detail page, the API automatically discovers files in `admin-next/fields/` and includes them in the response:

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
  // Properties set by admin-next
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

**Properties** (set by admin-next):
- `field` — The blueprint field definition object (label, help, options, validate, etc.)
- `value` — The current field value

**Events** (emitted by your component):
- `change` — `CustomEvent` with `detail` set to the new value

### Accessing the API

Your web component can call API endpoints. Authentication details are available via globals:

```javascript
// API connection details (set by admin-next before loading your script)
const serverUrl = window.__GRAV_API_SERVER_URL;  // e.g. "https://mysite.com"
const apiPrefix = window.__GRAV_API_PREFIX;       // e.g. "/api/v1"
const apiToken  = window.__GRAV_API_TOKEN;        // Bearer token (pre-set by admin-next)

// Read auth token from admin-next's localStorage (alternative to __GRAV_API_TOKEN)
function getAuth() {
  try {
    const auth = JSON.parse(localStorage.getItem('grav_admin_auth') || '{}');
    return {
      token: auth.accessToken || '',
      env: auth.environment || ''
    };
  } catch {
    return { token: '', env: '' };
  }
}

// Make authenticated API calls
async function apiGet(path) {
  const { token, env } = getAuth();
  const headers = {};
  if (token) headers['Authorization'] = `Bearer ${token}`;
  if (env) headers['X-Grav-Environment'] = env;

  const resp = await fetch(`${serverUrl}${apiPrefix}${path}`, { headers });
  const json = await resp.json();
  return json.data || json;
}
```

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

### Sharing Code Between Old and New Admin

Plugin authors can share business logic between the classic Twig/jQuery admin and admin-next web components:

```
your-plugin/
  admin/
    lib/
      data-utils.js         # Shared: API calls, data parsing
      validation.js          # Shared: input validation
    js/
      my-field.js            # Classic admin: jQuery-based UI
  admin-next/
    fields/
      myfieldtype.js         # Admin-next: Web Component UI
                             # Can import from ../../admin/lib/
```

The `admin/lib/` directory holds framework-agnostic logic. Both the jQuery-based fields and web components import from it.

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

Beyond custom field types, plugins can register their own **full pages** in the admin-next sidebar. This lets plugins provide dedicated management interfaces — like the License Manager's license editing page — without modifying admin-next itself.

There are two rendering modes:

- **Blueprint mode** — The plugin provides a Grav blueprint, and admin-next renders the form automatically. Best for data-driven pages (settings, key-value editors, configuration panels).
- **Component mode** — The plugin provides a full-page web component. Best for completely custom UIs that don't map to a standard form.

### Sidebar Registration

To add an entry to the admin-next sidebar, subscribe to the `onApiSidebarItems` event and append your item:

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
| `route`    | string  | yes      | Admin-next route path (e.g. `/plugin/license-manager`) |
| `priority` | integer | no       | Sort order; higher values appear earlier (default: 0) |
| `badge`    | string  | no       | Optional badge text or count shown next to the label |

Admin-next calls `GET /sidebar/items` on load. The API fires `onApiSidebarItems`, collects all items from plugins, and returns them.

### Page Definition

When a user navigates to a plugin page, admin-next calls `GET /gpm/plugins/{slug}/page` to get the page definition. Subscribe to `onApiPluginPageInfo` to provide it:

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

Admin-next fetches the blueprint via `GET /blueprints/plugins/{plugin}/pages/{pageId}`, loads the current data from `data_endpoint`, renders the form, and sends saves to `save_endpoint`.

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

Admin-next fetches the script via `GET /gpm/plugins/{slug}/page-script`, sets the tag name via `window.__GRAV_PAGE_TAG`, and mounts the element in the content area. The same globals (`__GRAV_API_SERVER_URL`, `__GRAV_API_PREFIX`, `__GRAV_API_TOKEN`) are available for API calls.

You can also use **both modes together**: set `page_type` to `'blueprint'` and also ship a `pages/{slug}.js` file. The API response will include `has_custom_component: true`, letting admin-next render the blueprint form alongside custom component sections.

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

The web component (`admin-next/fields/products-status.js`) calls `GET /licenses/products-status` and renders each product with its status (enabled, disabled, installed, or not installed) using the `window.__GRAV_API_TOKEN` global for authentication.

#### How It All Fits Together

1. Admin-next loads and calls `GET /sidebar/items` — the license-manager adds its "Licenses" entry
2. User clicks the sidebar item, admin-next navigates to `/plugin/license-manager`
3. Admin-next calls `GET /gpm/plugins/license-manager/page` — the plugin returns its page definition
4. Admin-next sees `page_type: 'blueprint'`, fetches the blueprint from `GET /blueprints/plugins/license-manager/pages/licenses`
5. Admin-next loads current data from `GET /licenses/form-data`
6. The form renders with standard fields (array for licenses) and a custom field (products-status web component)
7. The Save button sends a PATCH to `/licenses`; Import/Export trigger their respective endpoints

## Compatibility Declaration

Declare API compatibility in your plugin's `blueprints.yaml`:

```yaml
compatibility:
  grav:
    - 1.8
  api:
    - 1.0
```

This signals to the ecosystem that your plugin:
- Has been tested with the API plugin
- Ships web components for any custom field types (if applicable)
- Works correctly with admin-next

## Webhooks

The API plugin can dispatch webhooks for all mutation events. Plugins don't need to do anything special — the API's `WebhookDispatcher` listens for `onApi*` events and forwards them to configured webhook URLs.

Webhook events map directly to API events:

| API Event | Webhook Event |
|-----------|---------------|
| `onApiPageCreated` | `page.created` |
| `onApiPageUpdated` | `page.updated` |
| `onApiPageDeleted` | `page.deleted` |
| `onApiMediaUploaded` | `media.uploaded` |
| `onApiUserCreated` | `user.created` |
| `onApiConfigUpdated` | `config.updated` |
| `onApiPackageInstalled` | `gpm.installed` |
