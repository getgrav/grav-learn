---
title: ACL
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/pages-acl'
process:
    twig: true
---

[User Group Page Permissions Image]

User / Group permissions for Pages are:

* `Configuration`
  * `Pages Configuration` allows user to change pages specific configuration
* `Pages`
  * `Create` allows user to create pages or child pages
  * `Read` allows user to see contents of the page(s)
  * `Update` allows user to update content of the page
  * `Delete` allows user to delete page and its children
  * `List` allows user to see the pages admin

The rules for user and group CRUD permissions are:

1. **Allowed** (`true`) gives the permission but continues to look the other rules
1. **Deny** (`false`) is instant Deny (terminates)
1. **Not set** (`null`) has no effect, but acts as **Deny** if no other rules apply

These configuration options are global and can be overridden inside any page to give users more specific CRUD ACL.

[Page Security Tab image]

Page specific CRUD ACL works by using user groups only. In addition, it has two special groups named `authors` and `defaults`, which give special access to page owners, and a default fallback to all logged in users.

TABS
* `Page Access` (= frontend ACL)
  * `Menu Visibility Requires Access`
  * `Page Access` (list of permissions allowed|denied)
* `Page Permissions` (= admin ACL)
  * `Inherit Permissions` (from parent)
  * `Page Authors` (list of users)
  * `Page Groups` (CRUD per group + author & default)

CRUD authorization check workflow for an individual page is following:

1. Set **action** = `Create`, `Read`, `Update`, `Delete` or `List`
1. Go through all `Page Groups` from the current page
  - **match** special `authors` group if the user is listed in `Page Authors`
  - **match** special `defaults` group if the user is logged in
  - **match** the group if the user also has the group
  - if **match**
     - if **action** authorize returns `Deny`: stop immediately and *return* `false`
     - if **action** authorize returns `Allow`: set **allow flag** = `true`
  - continue to the next group
1. After going through all the groups, check if user has permission for the action
  - if **allow flag** is `true`: return `true`
1. Check user's global Pages administration permissions (only once)
  - if **action** authorize returns `Deny`: *return* `false`
  - if **action** authorize returns `Allow`: *return* `true`
1. Check if page inherits parent permissions
  - if `Inherit Permissions` = `Yes`, do the same checks with the parent page
  - else *return* `null`

There is also &lt;ROOT&gt; page, which allows you to set default permissions for all the pages (until you override them in any of the descedants). Only super user can see this page.

### Configuration

[Pages Configuration Image]

* Compatibility
  * Admin event compatibility

* Caching (common with all Flex Objects)
  * Enable Index Caching
  * Index Cache Lifetime (seconds)
  * Enable Object Caching
  * Object Cache Lifetime (seconds)
  * Enable Render Caching
  * Render Cache Lifetime (seconds)

### Root Page

Root page is a special page in Grav 1.7+ which allows site admins to set default permissions for all the pages. It can only be seen by `Super User` or a user who has `Pages Configuration` rights.

The root page will be saved into `user/pages/root.md` file and does not contain any content as the page is currently unreachable (this may change in the future).
