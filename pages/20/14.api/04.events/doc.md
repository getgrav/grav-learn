---
title: Events
taxonomy:
    category: docs
---
# API Events

The API fires events before and after all write operations, allowing plugins to react, validate, modify data, or cancel operations.

## API Events (`onApi*`)

These are the API plugin's own events, fired for every mutation:

### Page Events

| Event | When | Data |
|-------|------|------|
| `onApiBeforePageCreate` | Before page creation | `route`, `header`, `content`, `template`, `lang` |
| `onApiPageCreated` | After page created | `page`, `route`, `lang` |
| `onApiBeforePageUpdate` | Before page update | `page`, `data` (request body) |
| `onApiPageUpdated` | After page updated | `page` |
| `onApiBeforePageDelete` | Before page deletion | `page`, `lang` |
| `onApiPageDeleted` | After page deleted | `route`, `lang` |
| `onApiPageMoved` | After page moved | `page`, `old_route`, `new_route` |
| `onApiBeforePageTranslate` | Before translation created | `page`, `lang`, `header`, `content` |
| `onApiPageTranslated` | After translation created | `page`, `route`, `lang` |

### Media Events

| Event | When | Data |
|-------|------|------|
| `onApiBeforeMediaUpload` | Before each file upload | `page`, `filename`, `type`, `size` |
| `onApiMediaUploaded` | After upload completes | `page`, `filenames` |
| `onApiBeforeMediaDelete` | Before media deletion | `page`, `filename` |
| `onApiMediaDeleted` | After media deleted | `page`, `filename` |

### Config, User, and GPM Events

| Event | When | Data |
|-------|------|------|
| `onApiConfigUpdated` | After config saved | `scope`, `data` |
| `onApiUserCreated` | After user created | `user` |
| `onApiUserUpdated` | After user updated | `user` |
| `onApiBeforeUserDelete` | Before user deletion | `user` |
| `onApiUserDeleted` | After user deleted | `username` |
| `onApiBeforePackageInstall` | Before package install | `package`, `type` |
| `onApiPackageInstalled` | After install complete | `package`, `type` |

## Admin-Compatible Events (`onAdmin*`)

The API also fires the same events that Grav's admin plugin fires. This ensures third-party plugins that subscribe to admin events (SEO Magic, Auto Date, Mega Frontmatter, etc.) work correctly regardless of whether changes come from the admin UI or the API.

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

### Using Events in Your Plugin

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

## Route Registration

Plugins can extend the API with custom endpoints:

| Event | When | Data |
|-------|------|------|
| `onApiRegisterRoutes` | During router init | `routes` (ApiRouteCollector) |

See the [Plugin API Integration](/20/plugins/plugin-api-integration) guide for details.
