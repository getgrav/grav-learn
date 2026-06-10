---
title: Algolia Pro
description: Dive into the powerful Algolia Pro features and customization
taxonomy:
    category: docs
---

# Algolia Pro

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

The Algolia Pro plugin makes use of the **sitemap** plugin to function properly. These are available via GPM, and because the plugin has dependencies you just need to proceed and install the Algolia Pro plugin, and confirm when prompted to install the others:

```
$ bin/gpm install algolia-pro
```

You can also install the plugin via the **Plugins** section in the admin plugin.

## Configuration

**Algolia Pro** has a lot of configuration options that can apply to various functionalities: [Plugin](#plugin-configration), [Frontend](frontend), [Backend / Indexing](backend).

For the sake of better organizing the documentation, we have split these areas into separated pages, so you can fully focus on what you are looking for.

[div class="algolia-pro-subdocs"]
| [![Frontend Docs](frontend-docs.png?class=image-shadow,subdocs)](frontend) | [![Backend Docs](backend-docs.png?class=image-shadow,subdocs)](backend) |
|----------------------------------------------------------------------------|-------------------------------------------------------------------------|
[/div]

### Plugin Configuration

![Sidebar Menu Item](sidebar.png?cropResize=241&classes=image-shadow,right&style=width:auto;margin-top:3rem;)  
Traditionally, plugins can be configured from the "Plugins" section in the Admin, however due to the nature of Algolia Pro and the different areas of configuration, we have consolidated everything in an Admin menu item.

You will be able to reach these settings either from the sidebar or, if you are in the plugin settings, a note will link you to the proper location.

#### Plugin Options

![Plugin Options](plugin-options.png?class=shadow)

- **Plugin status** → Will enable or disable the entire plugin.

- **Production Mode** → When disable, it will stop any API communication with the Algolia service. Useful for for development and to try `dry run` queries.

- **Admin Index Events** → When enabled, it will trigger a reindex of an object/page when the `onAdminAfterSave` or `onAdminAfterDelete` events are triggered

- **Site Index Events** → Similar to **Admin Index Events**, enabling this will reindex of an object/page when the `onFlexObjectAfterSave` or `onFlexObjectAfterDelete` events are triggered

- **Algolia Pro Actions**  
  - `Reindex Now` → A shortcut button for manual reindexing. This is the same shortcut as the one found in the Admin Quick Tray. 
  - `Reset Index` → This will first reset all the **Smart Indexing** data, then fully flush all the remote indexing data, then fully reindex. 


#### Algolia API

![Algolia API](plugin-api.png?class=shadow)

- **Application ID** → The ID of the application allowed to perform API actions. Follow the [Algolia: Create an Application](#algolia-create-application) guide below to create one.

- **Search only API Key** → The "Search-Only API Key" associated to the application ID specified above. Follow the [Algolia: Create an Application](#algolia-create-application) guide below to create one.

- **Admin API Key** → The "Admin API key" associated to the application ID specified above. Follow the [Algolia: Create an Application](#algolia-create-application) guide below to create one.

#### Core Options

![Core Options](core-options.png?class=shadow)

- **Base Index Name** → The default index name. Used to prefix indices on Algolia. Every index on Algolia Pro can configure their own index name. This is generally something that identifies this specific site in case you have multiple sites or indexes using one Algolia account.

- **User Agent** (advanced) → The User Agent utilized to sign the requests to Algolia when performing API calls and Page Crawler indexing.

- **Controller Class** (advanced) → The default class to utilize for indexing and querying. If you have a need to create your own controller class, just reference it here...

#### Index Schedule

![Index Schedule](scheduler.png?class=image-shadow)

Algolia Pro integrates with [Grav's Scheduler](https://learn.getgrav.org/17/advanced/scheduler?target=_blank) to automate the task of periodically indexing your content.

- **Add AlgoliaPro to Scheduler** → When enabled, AlgoliaPro gets added to the scheduler jobs list. 
 
- **Run Indexing at** → The recurring timing at which the job gets executed. This uses the cronjob format.

## Algolia: Create an Application {#algolia-create-application}

In order for Algolia Pro to be able to communicate with the Algolia service for searching and indexing, it is required that you create an Application first. If you don't have an account already, first thing you should do is  [create one](https://www.algolia.com/users/sign_up?target=_blank).

Algolia has a very generous Free plan that should serve well for most cases. As a free account, you will be only allowed to have one application. If you are purchasing Algolia Pro for your clients, you should create an account on their behalf.

Once you followed the sign-up process to the end, follow these steps from the dashboard:

1. Click on the **application name** (this can also read as 'Unnamed application') at the top left of the dashboard and select the **"Create Application"** option
1. Choose a **name** and a **plan**. For this guide we are going to name the Application **"Algolia Pro Docs"** and select the **"Free"** plan.
1. Click on **"Next Step: Data Center"** on the right sidebar and pick the datanceter that best work for your site. Algolia automatically gives a ping estimate based on your location. Keep in mind this estimated response is between Algolia and you specifically, not the server where Algolia Pro will reside on.
1. Click **"Review Application Details"**
1. Accept the terms and click **"Create Application"**

If everything worked correctly, you should now be greeted back to your dashbord and notice your application name at the top, in this case **"Algolia Pro Docs"**. Below your name is also where you will be able to finally access the API Keys.

![Algolia App](algolia-app.png?class=image-shadow&cropResize=600)

Clicking on API Keys will take you to the page where you can retrieve the keys necessary for Algolia Pro.

![Algolia API Keys](algolia-api.png?class=image-shadow&cropResize=600)

> [!NOTE]
> You can click the lock icon to show/hide the Admin API Key. You can also click the right icon to copy to clipboard.

## Upgrading to Algolia Pro 1.1.0 (Algolia API v3 → v4) {#upgrading-to-1-1}

> [!NOTE]
> **Breaking Change**: Algolia Pro 1.1.0 upgrades the underlying Algolia PHP client from **v3** to **v4**. If you have custom classes that extend `BaseSearch`, `GravPageSearch`, `FlexSearch`, or `CrawlPageSearch`, you **must** update them.

### Why This Change?

Algolia deprecated their v3 PHP client and released v4 with a redesigned API. The most significant change is that the `SearchIndex` object no longer exists. Instead, all index operations are performed directly on the `SearchClient` using the index name as a string parameter.

### What Changed

The `BaseSearch::getIndexer()` method return type changed from `SearchIndex` to `string`:

**Before (v3):**

```php
use Algolia\AlgoliaSearch\SearchIndex;

protected function getIndexer(?string $index): SearchIndex
{
    $index_name = $this->getIndexName($index);
    $search_index = $this->search_client->initIndex($index_name);

    if ($this->production_mode === true) {
        $search_index->setSettings($settings);
    }

    return $search_index;  // SearchIndex object
}
```

**After (v4):**

```php
protected function getIndexer(?string $index): string
{
    $index_name = $this->getIndexName($index);

    if ($this->production_mode === true) {
        $this->search_client->setSettings($index_name, $settings);
    }

    return $index_name;  // string
}
```

### How to Update Custom Classes

If you have a custom class that extends any of the Algolia Pro search classes, you need to make two changes:

#### 1. Update the `getIndexer()` Return Type

If you override `getIndexer()`, change the return type from `SearchIndex` to `string` and return the index name instead of a `SearchIndex` object:

```php
// Before (v3)
use Algolia\AlgoliaSearch\SearchIndex;

class MyCustomSearch extends BaseSearch
{
    protected function getIndexer(?string $index): SearchIndex
    {
        $search_index = $this->search_client->initIndex($index_name);
        $search_index->setSettings($settings);
        return $search_index;
    }
}

// After (v4)
class MyCustomSearch extends BaseSearch
{
    protected function getIndexer(?string $index): string
    {
        $index_name = $this->getIndexName($index);
        $this->search_client->setSettings($index_name, $settings);
        return $index_name;
    }
}
```

#### 2. Update All Index Operations

Any code that called methods on the `SearchIndex` object must now call the equivalent method on `$this->search_client`, passing the index name as the first argument:

```php
// Before (v3) - methods called on SearchIndex object
$index = $this->getIndexer($name);
$index->setSettings($settings);
$index->saveObjects($records);
$index->deleteObjects($objectIDs);
$index->clearObjects();
$results = $index->search($query, $params);

// After (v4) - methods called on SearchClient with index name
$index_name = $this->getIndexer($name);
$this->search_client->setSettings($index_name, $settings);
$this->search_client->saveObjects($index_name, $records);
$this->search_client->deleteObjects($index_name, $objectIDs);
$this->search_client->clearObjects($index_name);
$results = $this->search_client->searchSingleIndex($index_name, ['query' => $query] + $params);
```

> [!NOTE]
> Note: The `search()` method has been renamed to `searchSingleIndex()` in v4, and the query string is now passed inside the params array.

### Quick Reference: v3 → v4 Method Changes

| v3 (`SearchIndex`)            | v4 (`SearchClient`)                              |
|-------------------------------|---------------------------------------------------|
| `initIndex($name)`           | _(removed — use index name string directly)_       |
| `$index->setSettings($s)`   | `setSettings($indexName, $s)`                      |
| `$index->getSettings()`     | `getSettings($indexName)`                          |
| `$index->saveObjects($r)`   | `saveObjects($indexName, $r)`                      |
| `$index->deleteObjects($ids)`| `deleteObjects($indexName, $ids)`                 |
| `$index->clearObjects()`    | `clearObjects($indexName)`                         |
| `$index->search($q, $p)`    | `searchSingleIndex($indexName, ['query'=>$q]+$p)` |
| `$index->partialUpdateObjects($r)` | `partialUpdateObjects($indexName, $r)`     |
| `$index->getIndexName()`    | _(just use the string directly)_                   |

[div class="algolia-pro-subdocs"]
| [![Frontend Docs](frontend-docs.png?class=image-shadow,subdocs)](frontend) | [![Backend Docs](backend-docs.png?class=image-shadow,subdocs)](backend) |
|----------------------------------------------------------------------------|-------------------------------------------------------------------------|
[/div]
