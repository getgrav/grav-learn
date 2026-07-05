---
title: Events
taxonomy:
    category: docs
---
# API Events

The API fires events before and after every write operation, and uses events to let plugins extend the Admin2 UI (sidebars, menubars, widgets, context panels, settings panels, custom field components, custom reports). Plugins react to these events to validate, modify data, cancel operations, or compose UI.

## Page Events

| Event | When | Data |
|-------|------|------|
| `onApiBeforePageCreate` | Before page creation (mutable) | `route`, `header`, `content`, `template`, `lang` |
| `onApiPageCreated` | After page created | `page`, `route`, `lang` |
| `onApiBeforePageUpdate` | Before page update (mutable) | `page`, `data` (request body) |
| `onApiPageUpdated` | After page updated | `page` |
| `onApiBeforePageDelete` | Before page deletion | `page`, `lang` (null for full deletion) |
| `onApiPageDeleted` | After page deleted | `route`, `lang` (null for full deletion) |
| `onApiPageMoved` | After page moved | `page`, `old_route`, `new_route` |
| `onApiBeforePageTranslate` | Before translation created (mutable) | `page`, `lang`, `header`, `content` |
| `onApiPageTranslated` | After translation created | `page`, `route`, `lang` |
| `onApiBeforePageAdoptLanguage` | Before adopting a base file as a specific language | `page`, `route`, `lang`, `from_file`, `to_file` |
| `onApiPageLanguageAdopted` | After base file renamed to language-specific filename | `page`, `route`, `lang` |
| `onApiBeforePageSync` | Before a translation is overwritten from another language (mutable) | `page`, `source_lang`, `target_lang`, `header`, `content` |
| `onApiPageSynced` | After translation overwritten | `page`, `route`, `source_lang`, `target_lang` |
| `onApiBeforePagesReorder` | Before children reordering | `parent`, `order` |
| `onApiPagesReordered` | After children reordered | `parent`, `order` |
| `onApiBeforePagesReorganize` | Before bulk move/reorder | `operations` (resolved list) |
| `onApiPagesReorganized` | After bulk move/reorder | `operations` |

## Media Events

| Event | When | Data |
|-------|------|------|
| `onApiBeforeMediaUpload` | Before each file upload | `page`, `filename`, `type`, `size` |
| `onApiMediaUploaded` | After upload completes | `page`, `filenames` |
| `onApiBeforeMediaDelete` | Before media deletion | `page`, `filename` |
| `onApiMediaDeleted` | After media deleted | `page`, `filename` |

## Config Events

| Event | When | Data |
|-------|------|------|
| `onApiConfigUpdated` | After config saved | `scope`, `data` |

## Auth & User Events

| Event | When | Data |
|-------|------|------|
| `onApiUserLogin` | After successful password or 2FA login | `user`, `method` (`password`/`2fa`), `ip`, `request` |
| `onApiUserLoginFailure` | After any failed login attempt | `username`, `reason` (`password`/`2fa`/`disabled`/`no_api_access`), `ip` |
| `onApiUserLogout` | After `/auth/revoke` with a valid token | `user`, `ip`, `request` |
| `onApiPasswordReset` | After successful `/auth/reset-password` | `user`, `ip` |
| `onApiUserCreated` | After user created (via `/users` or `/auth/setup`) | `user` |
| `onApiUserUpdated` | After user updated | `user` |
| `onApiBeforeUserDelete` | Before user deletion | `user` |
| `onApiUserDeleted` | After user deleted | `username` |
| `onApiUser2faEnabled` | After 2FA turned on | `user` |
| `onApiUser2faDisabled` | After 2FA turned off | `user`, `forced_by_admin` (bool) |
| `onApiSetupComplete` | After first-run setup creates the initial super-admin | `user` |

## GPM Events

| Event | When | Data |
|-------|------|------|
| `onApiBeforePackageInstall` | Before install | `package`, `type` (`plugin`/`theme`) |
| `onApiPackageInstalled` | After install | `package`, `type` |
| `onApiBeforePackageRemove` | Before removal | `package`, `type` |
| `onApiPackageRemoved` | After removal | `package`, `type` |
| `onApiBeforePackageUpdate` | Before single package update | `package`, `type` |
| `onApiPackageUpdated` | After package update | `package`, `type` |
| `onApiBeforeGravUpgrade` | Before Grav core upgrade | `current_version`, `available_version` |
| `onApiGravUpgraded` | After Grav core upgrade | `previous_version`, `new_version` |

## Blueprint Events

| Event | When | Data |
|-------|------|------|
| `onApiBlueprintResolved` | After a plugin blueprint is serialized (mutable) | `fields`, `plugin`, `user` |

## Admin2 Integration Events

These are called while Admin2 composes the UI. Plugins append items/widgets/panels to the event data to register their integrations. The current user is passed in so listeners can gate registration on permissions.

| Event | Endpoint | Data |
|-------|----------|------|
| `onApiSidebarItems` | `GET /sidebar/items` | `items`, `user` |
| `onApiMenubarItems` | `GET /menubar/items` | `items`, `user` |
| `onApiMenubarAction` | `POST /menubar/actions/{plugin}/{action}` | `plugin`, `action`, `body`, `user`, `result` (mutable) |
| `onApiFloatingWidgets` | `GET /floating-widgets` | `widgets`, `user` |
| `onApiContextPanels` | `GET /context-panels` | `panels`, `user` |
| `onApiAdminSettingsPanels` | `GET /settings/panels` | `panels`, `user` |
| `onApiPluginPageInfo` | `GET /gpm/plugins/{slug}/page` | `plugin`, `definition` (mutable), `user` |
| `onApiGenerateReports` | `GET /reports` | `reports`, `user` |
| `onApiDashboardNotifications` | `GET /dashboard/notifications` | `notifications` (mutable, grouped by location), `user`, `force` |
| `onApiUserListFilters` | `GET /users/filters` | `filters`, `defaultFilter`, `showAll`, `user` |
| `onApiUserListFilter` | `GET /users?filter={id}` | `filter`, `collection` (mutable), `query`, `user` |
| `onApiUserListColumns` | `GET /users/columns` | `columns`, `user` |
| `onApiUserListColumnData` | `GET /users` | `usernames`, `data` (mutable), `user` |

### Users list filter tabs

These two events let a plugin add a tab to the Users list that shows a filtered set of accounts — the Admin Next equivalent of admin-classic's Users-page tabs.

`onApiUserListFilters` collects the tabs for the nav row. Append a tab descriptor to the `filters` array; the core endpoint prepends the built-in `all` ("All Users") tab and drops any tab the caller isn't authorized for. The event also carries two page-level policies — `defaultFilter` (the tab the client opens on when the URL has no `filter`) and `showAll` (set it to `false` to suppress the "All Users" tab when showing every account isn't a useful landing view):

```php
public function onApiUserListFilters(Event $event): void
{
    // Event has no by-reference offsetGet — append via read-modify-write,
    // the same idiom as onApiSidebarItems / onApiMenubarItems.
    $filters = $event['filters'];
    $filters[] = [
        'id'        => 'active',           // selected via ?filter=active; 'all' is reserved
        'plugin'    => 'my-plugin',
        'label'     => 'Active',           // plain text, not a translation key
        'icon'      => 'fa-bolt',          // optional
        'priority'  => 10,                 // optional, higher sorts earlier
        'authorize' => 'api.users.read',   // optional, string or any-of array
    ];
    $event['filters'] = $filters;

    // Optional page-level policy.
    $event['defaultFilter'] = 'active';    // land here with no ?filter in the URL
    $event['showAll'] = false;             // hide the built-in "All Users" tab
}
```

The `icon` field accepts the shared `IconSpec` format: a Font Awesome shorthand (`fa-bolt`, `fa-regular:clock`, `fa-brands:github`), any icon CSS classes Admin2 already loads (`class:ti ti-user`), or a safe structured SVG object (`['type' => 'svg', 'path' => '…']`). Raw SVG markup is not accepted — SVG icons are rebuilt from whitelisted tags and attributes.

`defaultFilter` is honoured only when it maps to a tab the caller can actually see, otherwise it falls back to the first tab in the row. `showAll => false` drops "All Users" only once at least one of the plugin's own tabs survives authorization, so the row can never end up empty.

`onApiUserListFilter` runs while `GET /users?filter={id}` builds the listing — after search and sort, but **before** permission/group filtering and pagination. The plugin owning the active `filter` id narrows the collection and assigns it back; the core endpoint still applies the caller's access scope and paginates, so a tab can only narrow what's already visible, never widen it:

```php
public function onApiUserListFilter(Event $event): void
{
    if ($event['filter'] !== 'active') {
        return;
    }
    $collection = $event['collection']; // FlexCollectionInterface
    $event['collection'] = $collection->filterBy(['state' => 'enabled']);
}
```

Filter tabs require the Flex-accounts backend (the Grav default); the legacy filesystem account store degrades to the `all` tab only.

### Users list columns

These two events let a plugin add its own columns to the Users list — a WhatsApp link, a subscription expiry date, a login count — without touching the table markup. The contract is deliberately narrow: a plugin *declares* a column and *supplies scalar values*, but Admin2 owns rendering, layout, refreshes and list state. There is no path for a plugin to inject markup or a renderer.

`onApiUserListColumns` collects the extra columns, exposed as `GET /users/columns` (mirroring `/users/filters`, gated by `api.users.read`). Append a column descriptor to the `columns` array:

```php
public function onApiUserListColumns(Event $event): void
{
    // Event has no by-reference offsetGet — append via read-modify-write,
    // the same idiom as onApiUserListFilters / onApiSidebarItems.
    $columns = $event['columns'];
    $columns[] = [
        'id'        => 'my-plugin-valid-till', // required, unique
        'plugin'    => 'my-plugin',
        'label'     => 'Valid until',          // plain text, not a translation key
        'field'     => 'subscription.valid_till', // key into each user's data map
        'formatter' => 'datetime',             // one of the built-in formatters below
        'sortable'  => false,                  // optional; client-side, current page only
        'priority'  => 50,                     // optional, higher sorts earlier
        'authorize' => 'api.users.read',       // optional, string or any-of array
    ];
    $event['columns'] = $columns;
}
```

The `formatter` is validated against a fixed whitelist — `text`, `link`, `date`, `datetime`, `boolean`, `number`, `badge` — and an unknown value falls back to `text`. The server only ever names a formatter; the client renders it, so no renderer function or HTML crosses the wire. A `link` value is href-validated on the client (relative or `http(s)` only; anything else renders as inert text). The `authorize` check is re-run server-side and the field is stripped from the response.

`onApiUserListColumnData` supplies the per-user values. It fires **once per list response**, and its `usernames` list contains only the accounts already selected after search, filter, permission scoping and pagination — so a plugin resolves data for the current page, never for every account. Return a `username => [ field => value ]` map:

```php
public function onApiUserListColumnData(Event $event): void
{
    $data = $event['data'];
    foreach ($event['usernames'] as $username) {   // current page only
        $data[$username] = [
            'subscription.valid_till' => $this->validTill($username),
        ];
    }
    $event['data'] = $data;
}
```

Those values are merged into each serialized user under an `extra` map on `GET /users`, keyed by the column's `field`, so there is no second endpoint to call and no client-side join. Only scalars (and null) survive the merge — arrays, objects and oversized values are dropped — and the event is isolated, so a listener that throws degrades to missing values rather than breaking the listing. Like filter tabs, columns require the Flex-accounts backend.

## Webhook Event Mapping

The outgoing webhook dispatcher listens for a subset of the above events and translates them into webhook events with the following names:

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

See the [Webhooks endpoints](/20/api/endpoints/webhooks) for creating and managing webhook subscriptions. Webhooks fire *after* the API event, so listeners that mutate state via `onApi*` events will see their changes reflected in the outgoing payload.

## Admin-Compatible Events (`onAdmin*`)

The API also fires the same events that Grav's classic Admin plugin fires. This ensures third-party plugins that subscribe to admin events (SEO Magic, Auto Date, Mega Frontmatter, etc.) work correctly regardless of whether changes come from the classic admin UI or the API/Admin2.

Both event families fire for every operation — admin events first, then API events.

| Event | When | Data |
|-------|------|------|
| `onAdminCreatePageFrontmatter` | Page create (before save) | `header`, `data` |
| `onAdminSave` | Before save (page, user, config) | `object` (by reference), `page` |
| `onAdminAfterSave` | After save | `object`, `page` |
| `onAdminAfterDelete` | After page deletion | `object`, `page` |
| `onAdminAfterSaveAs` | After page move/rename | `path` |
| `onAdminAfterAddMedia` | After media upload | `object`, `page` |
| `onAdminAfterDelMedia` | After media deletion | `object`, `page`, `media`, `filename` |

### Event Ordering Example

For a page create operation, events fire in this order:

1. `onApiBeforePageCreate` — API before event
2. `onAdminCreatePageFrontmatter` — admin frontmatter injection
3. `onAdminSave` — admin pre-save (plugins can modify the page)
4. `onAdminAfterSave` — admin post-save (indexing, notifications)
5. `onApiPageCreated` — API after event (triggers webhooks)

### Subscribing from a Plugin

Do **not** gate the subscription of these admin-compatible events behind an `isAdmin()` check in `onPluginsInitialized()`. When a save comes through the API (which is how Admin2 saves everything), the request is not handled by the classic Admin plugin, so `$grav['admin']` is registered later during request dispatch by the API's `AdminProxy`. At `onPluginsInitialized()` time it is not yet set, so `isAdmin()` still returns `false` and any handlers you register inside an `isAdmin()` block are never subscribed. The result is a plugin whose save/delete logic silently never runs under Admin2.

!!! A common 1.7-era pattern was to register `onAdminAfterSave` only when `isAdmin()` was true. That no longer works for API/Admin2 writes. These events only fire during admin/API write operations anyway, so it is safe to subscribe to them unconditionally.

Register them directly in `getSubscribedEvents()`, or unconditionally in `onPluginsInitialized()`:

```php
public static function getSubscribedEvents(): array
{
    return [
        'onPluginsInitialized'    => ['onPluginsInitialized', 0],
        // Always registered — these only fire during admin/API writes:
        'onAdminAfterSave'        => ['onObjectSave', 0],
        'onAdminAfterDelete'      => ['onObjectDelete', 0],
        'onAdminAfterSaveAs'      => ['onObjectMove', 0],
        'onFlexObjectAfterSave'   => ['onObjectSave', 0],
        'onFlexObjectAfterDelete' => ['onObjectDelete', 0],
    ];
}
```

Note that Flex objects (and Flex Pages) fire `onFlexObjectAfterSave` / `onFlexObjectAfterDelete` — the `*After*` variants — not the bare `onFlexObjectSave` / `onFlexObjectDelete` names. Subscribe to the variant that matches the data you need.

## Route Registration

Plugins extend the API with custom endpoints by subscribing to one event:

| Event | When | Data |
|-------|------|------|
| `onApiRegisterRoutes` | During router initialization | `routes` (`ApiRouteCollector`) |

See the [Plugin API Integration](/20/plugins/plugin-api-integration) guide for details.

## Using Events in Your Plugin

```php
public static function getSubscribedEvents(): array
{
    return [
        'onApiPageCreated' => ['onPageChanged', 0],
        'onApiPageUpdated' => ['onPageChanged', 0],
        'onApiPageDeleted' => ['onPageChanged', 0],
    ];
}

public function onPageChanged(Event $event): void
{
    // Rebuild search index, clear CDN cache, etc.
    $page = $event['page'] ?? null;
    $route = $event['route'] ?? $page?->route();

    $this->rebuildIndex($route);
}
```
