---
title: Page Permissions
menu: Permissions
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/pages-permissions'
process:
    twig: true
---

![Pages Permissions](page-permissions.png?width=2030&classes=shadow)

User / Group permissions for Pages are:

[div class="table table-striped table-keycol"]
| Option                                | Value                         | Description                                                       |
| :-----                                | :-----                        | :-----                                                            |
| **Configuration**                     | *admin.configuration*         | Gives the user access to the **Configuration** area of the admin. |
| &nbsp; &nbsp; **Pages Configuration** | *admin.configuration.pages*   | Gives the user access to the **Pages Configuration** found inside the **Pages** area of the admin.  |
| **Pages**                             | *admin.pages*                 | Gives the user full access to the **Pages** area of the admin.    |
| &nbsp; &nbsp; **Create**              | *admin.pages.create*          | Gives the user access to **Create** pages.                        |
| &nbsp; &nbsp; **Read**                | *admin.pages.read*            | Gives the user access to **Read** pages.                          |
| &nbsp; &nbsp; **Update**              | *admin.pages.update*          | Gives the user access to **Update** pages.                        |
| &nbsp; &nbsp; **Delete**              | *admin.pages.delete*          | Gives the user access to **Delete** pages.                        |
| &nbsp; &nbsp; **List**                | *admin.pages.list*            | Gives the user access to **Pages** area of the admin.             |
[/div]

!! **WARNING:** All actions in Grav are only checked against a single permission type. If you prevent user from listing or reading pages in admin, but still allow users to perform create, update and delete, they can perform those actions. This means that even if users cannot see the `Pages` in admin, they can visit the edit page directly and perform those actions from there.

!!! **TIP:** Starting from Grav 1.7, you can and should restrict the **CRUD** access for the individual pages and their children directly from the pages themselves.

The possible values for the permissions are:

[div class="table table-striped table-keycol"]
| Option                                | Value                         | Description                                                                               |
| :-----                                | :-----                        | :-----                                                                                    |
| **Allowed**                           | `true`                        | **Allows** action to be performed if there is no **Denied** permission at the same level. |
| **Denied**                            | `false`                       | **Denies** action from being performed. If user has both **Allowed** and **Denied** set, **Denied** permission wins. |
| **Not set**                           | `null`                        | No effect, but acts as **Denied** if no other rules apply.                                |
[/div]

Permissions set specifically for the user account take precedence over the group permissions. If the permission has not been set in the user account, access check will be performed against all the user groups the user belongs to. If any of the user groups have **Denied** the action, user has no permission for the action. Otherwise, if any of the user groups have **Allowed** the action, permission will be granted. If permission has not been set in any of the user's groups, **Super User** permission acts as universal **Allowed**, otherwise **Denied** will be applied.

Permissions set for the user accounts and user groups act as default permissions for managing the pages. All of these rules can be overridden inside any page [Security](/admin-panel/page/security) tab.

### Page CRUD Access Check Workflow

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

### Root Page

![Root Page](page-permissions.png?width=2030&classes=shadow)

Root page is a special page in Grav 1.7+ which allows site admins to set default permissions for all the pages. It can only be seen by **Super User** or a user who has **Pages Configuration** rights.

The root page will be saved into `user/pages/root.md` file and does not contain any content as the page is currently unreachable (this may change in the future).
