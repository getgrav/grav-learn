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
