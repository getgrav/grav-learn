---
title: Troubleshooting & FAQ
taxonomy:
    category: docs
process:
    twig: false
---

When a Flex directory misbehaves, the cause is almost always one of a handful of usual suspects: a directory that was never enabled, a permissions block that was never declared, a storage strategy that cannot hold media, or a cache that needs clearing. This page is a symptom-cause-fix reference. Find the heading that matches what you are seeing, then work through the checks in order.

!!! Most Flex problems clear up after a `bin/grav clear`. If something looks wrong right after you edit a blueprint or config, run the cache clear first, then re-check before you go any deeper.

### My directory does not appear in the Admin Next sidebar

A directory that is registered but invisible is usually one of these:

1. **The Flex Objects plugin is disabled.** Check Admin Next under Plugins that Flex Objects is enabled. Nothing renders without it.
2. **The directory is not toggled on.** A blueprint file sitting in `user/blueprints/flex-objects/` is not active until you enable it. Go to Plugins > Flex Objects and add the blueprint to the directories field. This appends the blueprint path to the plugin config; without it the type is never registered.
3. **The current user lacks list permission.** The auto sidebar only lists directories the logged-in account is allowed to list. A non-super account needs `api.<type>.list` (see the permissions symptom below). If you are testing as an editor and the entry is missing for them but present for a super admin, this is the cause.
4. **The directory opted out of the sidebar.** A blueprint can set `admin.menu.list.hidden_in_admin_next: true` to keep itself out of the auto sidebar (for example, when a plugin provides its own custom navigation). If that flag is set, the directory is intentionally hidden.
5. **The cache is stale.** After enabling a directory or editing its blueprint, run `bin/grav clear` so the registered types are rebuilt.

### The REST API returns 403 for my custom directory

This is the single most common Flex support issue since flex-objects 1.4.3, and it is working as designed.

The 1.4.3 security fix (GHSA-23vq-365v-qcmh) introduced **default-deny**: a directory whose blueprint defines **no** `config.admin.permissions` block is denied to every non-super-admin over the REST API. If your custom directory has no permissions declared, only super admins can reach it, and everyone else gets a 403.

The fix is to declare permissions in the blueprint. Declare **both** an `admin.<type>` prefix (legacy, for classic accounts) **and** an `api.<type>` prefix (for Admin Next and the REST API), then grant the acting user the actions they need.

[codesh=yaml]
config:
  admin:
    permissions:
      admin.contacts:
        type: crud
        label: 'Contacts'
      api.contacts:
        type: crud
        label: 'Contacts (API)'
[/codesh]

The actions Flex uses are `list`, `create`, `read`, `update`, and `delete`. To let an editor browse and view records without changing them, grant `api.contacts.list` and `api.contacts.read`. Add `create`, `update`, and `delete` as the role requires.

!!! Super admins always pass. Admin Next sessions carry `api.super` and classic accounts carry `admin.super`; either one grants full access to every directory. If a request works as a super admin but 403s for an editor, the missing piece is a per-type grant, not a bug.

See the [Blueprint Reference permissions section](/20/advanced/flex/custom-types/blueprint-reference#permissions) for the full permission block structure, and the [Flex Objects API docs](/20/api/endpoints/flex-objects) for how tokens and grants are checked per endpoint.

### Media upload fails, or my objects have no media

Not every storage strategy supports per-object media. The storage strategy is set in `config.data.storage`:

[div class="table-keycol"]

| Strategy | Per-object media? |
| :--- | :--- |
| `SimpleStorage` | No. All objects live in one file, with no per-object folder to hold uploads. |
| `FileStorage` | No dedicated media folder per object. One file per object in a shared folder. |
| `FolderStorage` | Yes. One folder per object, which is where uploaded media is stored. |

[/div]

If a media or file field will not accept uploads, or your objects never seem to have any media, you are almost certainly on `SimpleStorage`. Switch the directory to `FolderStorage` so each object gets its own folder:

[codesh=yaml]
config:
  data:
    storage:
      class: 'Grav\Framework\Flex\Storage\FolderStorage'
      options:
        folder: 'user-data://contacts'
[/codesh]

!!! Changing storage strategy does not migrate existing records for you. If you already have objects under `SimpleStorage`, plan a data conversion (see `bin/plugin flex-objects convert-data`) before switching, or you will end up with records the new strategy cannot read.

### My data is stale, or edits do not show up

Flex uses an index for fast listing and lookup, and that index is cached. When what you see lags behind the underlying files, run:

[codesh=bash]
bin/grav clear
[/codesh]

Two things to know:

- **Index caching.** The collection index is built once and cached. If you edit object files directly on disk (rather than through Admin Next or the API), the index will not notice until the cache is cleared or the source files change on disk.
- **The same-second-save caveat.** Flex detects changes partly by file modification time, which has one-second resolution. Two saves to the same object within the same second can look identical to the index, so the second change may not register until the next save or a cache clear. If you are scripting rapid successive writes to one object, space them out or clear the cache between them.

### Objects disappeared, or will not save, after I edited the blueprint

Editing a blueprint changes how objects are read and written, but it does not rewrite the files you already have. Two rules keep you out of trouble:

- **Keep old objects loadable and savable.** If you rename or remove fields, remember that existing files still contain the old keys. As long as the object can still be loaded and saved, those values are preserved on save even when they are no longer shown in the form. Avoid changes that make previously valid data unreadable.
- **Corrupt files get skipped.** When Flex builds its index, a file it cannot parse (invalid YAML/JSON/Markdown, a truncated write, a wrong extension for the configured formatter) is skipped rather than aborting the whole collection. That is why a single bad file makes one object "disappear" from the list while the rest load fine. Check the file that vanished for a syntax error, and confirm its format matches the directory's configured formatter (`Json`, `Yaml`, `Markdown`, `Serialize`, `Ini`, or `Csv`).

!!! If an object vanished right after a hand-edit, open its file and validate it. A stray tab, an unquoted colon, or a half-written save is the usual culprit, and fixing the file brings the object straight back after a cache clear.

### List columns are empty

The Admin Next list view renders the columns named in `config.admin.list.fields`. Empty columns almost always mean a name mismatch:

- **Every listed field must exist in `form.fields`.** A key under `admin.list.fields` that is not defined in the form has no value to render, so its column comes up blank. Check for typos and for fields you removed from the form but left in the list config.
- **Nested values need a dot path.** If the value lives inside a nested field (for example, an address group), reference it with its full dot path, such as `address.city`, not just `city`.

[codesh=yaml]
config:
  admin:
    list:
      fields:
        name:
          link: edit
        email: true
        address.city: true
[/codesh]

### Blueprint changes are not taking effect

If edits to a blueprint seem ignored, check these two things:

1. **Clear the cache.** Blueprints are compiled and cached. Run `bin/grav clear` after any blueprint edit.
2. **Confirm the file location.** A user-defined directory blueprint lives at `user/blueprints/flex-objects/<type>.yaml`. If the type is shipped by a plugin or theme, its blueprint lives inside that package, and a copy you placed elsewhere is not the one being loaded. Make sure you are editing the file that is actually registered in the plugin's directories config.

## Migrating a 1.7 Flex type to 2.0

If you are bringing a Flex directory across from Grav 1.7, most of the blueprint carries over unchanged. The work is in removing config that targeted the old classic (Vue) admin and adding the permission prefixes the new stack requires. Work through this checklist:

- [ ] **Remove classic-only admin config.** The classic Vue admin was removed in flex-objects 1.4.2. Delete any config that only made sense there: custom `router` and `redirects` blocks tied to the old admin, VueTable list hints, and any custom `preview` view. Admin Next drives the list and edit UI from `config.admin` (`list.fields`, `list.options`, `edit`, `export`) instead.
- [ ] **Add `api.<type>` permission prefixes.** This is the step people forget. A 1.7 blueprint typically only declared `admin.<type>` permissions. Under default-deny (1.4.3+), non-super users also need an `api.<type>` prefix or the REST API and Admin Next grants will 403. Declare both prefixes and grant your editors the actions they need.
- [ ] **Verify the storage path.** Confirm `config.data.storage` still points at the right location, and that the strategy matches what you need (use `FolderStorage` if the type has media). Streams like `user-data://` should resolve to where your records actually live.
- [ ] **Retest media.** If the type has media or file fields, upload and remove a file through Admin Next after migration to confirm the storage folder is writable and per-object media works end to end.
- [ ] **Clear the cache and re-check both faces.** Run `bin/grav clear`, then confirm the directory appears in the Admin Next sidebar, lists its objects, and answers the REST API for both a super admin and a normal editor account.

!!! When in doubt about which permission actions to grant or how a specific endpoint checks them, cross-reference the [Blueprint Reference permissions section](/20/advanced/flex/custom-types/blueprint-reference#permissions) and the [Flex Objects API docs](/20/api/endpoints/flex-objects). Getting the `api.<type>` grants right is what resolves the large majority of post-migration 403s.
