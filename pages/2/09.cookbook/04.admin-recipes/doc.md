---
title: Admin Recipes
page-toc:
  active: true
  depth: 1
taxonomy:
    category: docs
---

# Admin Recipes

This page collects problems and solutions related to customizing the Admin2 interface. Admin2 is the SvelteKit single-page app that talks to your site through the [REST API](../../api); plugins extend it by subscribing to `onApi*` events and, where needed, shipping small web components. For the full reference behind these recipes, see the [API Developer Guide](../../api/developer-guide).

!! These recipes require the API plugin `1.0.0-rc.16` / Admin2 `2.0.0-rc.16` or later.

## Add a custom page-creation button

#### Problem:

You want an easy way to create a new blog post in the correct folder by clicking a button in the admin, rather than walking through the generic **Add Page** flow each time. We will use a blog post for this example.

#### Solution:

On the legacy admin-classic interface this was done with an `add_modals` block in `user/config/plugins/admin.yaml` pointing at a custom blueprint. **Admin2 does not use that mechanism.** Toolbar buttons are contributed by a plugin through the `onApiMenubarItems` event, and a button can either deep-link the native new-page form or open your own modal. Pick whichever fits.

##### Option A — deep-link the native new-page form (simplest)

A menubar item can carry a client-side `route` intent that navigates Admin2's own **Add Page** screen with the parent and template pre-filled. The template picker is **locked** when supplied, so the button always creates the page type you intend. No blueprint, no web component, no save handler — you reuse the native form's slug, validation, and multi-language handling for free.

In your plugin:

```php
public static function getSubscribedEvents(): array
{
    return [
        'onApiMenubarItems' => ['onApiMenubarItems', 0],
    ];
}

public function onApiMenubarItems(\RocketTheme\Toolbox\Event\Event $event): void
{
    $items = $event['items'] ?? [];
    $items[] = [
        'id'     => 'new-post',
        'plugin' => 'my-plugin',          // your plugin slug
        'label'  => 'New Post',           // button tooltip
        'icon'   => 'fa-plus',            // Font Awesome icon
        // Deep-link the Add Page form. /pages/new reads three optional params:
        //   parent   — preselects the parent page
        //   template — preselects AND locks the template picker
        //   title    — prefills the title (and seeds the slug)
        'route'  => '/pages/new?parent=/blog&template=post&title=New%20Post',
    ];
    $event['items'] = $items;
}
```

That single handler gives you a **New Post** button in the top toolbar that opens the Add Page form with the parent set to `/blog`, the template locked to `post`, and the title pre-filled.

##### Option B — a custom modal

When you need fields the native form doesn't have, open a modal instead. The quickest route needs no web component — define the fields inline and Admin2 builds the form for you. From a plugin web component (for example a [floating widget](../../api/developer-guide#floating-widgets) or [custom field](../../api/developer-guide#custom-admin-fields-via-web-components)):

```javascript
const values = await window.__GRAV_DIALOGS.form({
  title: 'New Post',
  fields: [
    { name: 'title',   label: 'Post Title', required: true },
    { name: 'summary', label: 'Summary', type: 'textarea' },
  ],
  submitLabel: 'Create',
});
if (values) {
  // Create the page through the REST API.
  await fetch(`${window.__GRAV_API_SERVER_URL}${window.__GRAV_API_PREFIX || '/api/v1'}/pages`, {
    method: 'POST',
    headers: { 'X-API-Token': window.__GRAV_API_TOKEN, 'Content-Type': 'application/json' },
    body: JSON.stringify({
      route: '/blog/' + values.title.toLowerCase().replace(/\s+/g, '-'),
      title: values.title,
      template: 'post',
      content: values.summary,
    }),
  });
}
```

For richer UI (multi-step, live data, custom layout) ship a modal web component at `admin-next/modals/{id}.js` and wire it straight to a menubar button:

```php
$items[] = [
    'id'     => 'new-post',
    'plugin' => 'my-plugin',
    'label'  => 'New Post',
    'icon'   => 'fa-plus',
    'modal'  => [
        'component' => 'new-post',   // → admin-next/modals/new-post.js
        'title'     => 'New Post',
        'size'      => 'lg',         // sm | md | lg | xl
    ],
];
```

The component returns its result by dispatching a `resolve` event (or `cancel`/`close` to dismiss). See [Modals and Overlays](../../api/developer-guide#modals-and-overlays) for the full contract.

##### Locking down what gets created

However the create request arrives, you can enforce the template and inject default frontmatter server-side with the `onApiBeforePageCreate` event, so a post always lands with the right type and header regardless of the client:

```php
public function onApiBeforePageCreate(\RocketTheme\Toolbox\Event\Event $event): void
{
    if (str_starts_with((string) $event['route'], '/blog/')) {
        $event['template'] = 'post';
        $header = $event['header'] ?? [];
        $header['date'] = date('Y-m-d H:i');
        $event['header'] = $header;
    }
}
```

> [!NOTE]
> Unlike the admin-classic `add_modals` recipe, which any site could add through `user/config/plugins/admin.yaml`, an Admin2 toolbar button is registered from a plugin. If you do not already have one, a tiny single-file plugin with just the `onApiMenubarItems` handler above is enough.
