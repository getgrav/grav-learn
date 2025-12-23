---
title: Permissions
taxonomy:
    category: docs
routes:
    aliases:
      - '/admin-panel/pages-permissions'
process:
    twig: true
---

![Accounts Permissions](accounts-permissions.png?width=2030&classes=shadow)

User and Group permissions for managing account related information are:

[div class="table table-striped table-keycol"]
| Option                                | Value                             | Description                                                       |
| :-----                                | :-----                            | :-----                                                            |
| **Configuration**                     | *admin.configuration*             | Gives the user access to the **Configuration** area of the admin. |
| &nbsp; &nbsp; **Accounts Configuration** | *admin.configuration.accounts*    | Gives the user access to the **Accounts Configuration** found inside the **Accounts** area of the admin.  |
| **Accounts**                          | *admin.accounts*                  | Gives the user full access to the **Accounts** area of the admin.    |
| &nbsp; &nbsp; **Create**              | *admin.accounts.create*           | Gives the user access to **Create** user accounts and groups.        |
| &nbsp; &nbsp; **Read**                | *admin.accounts.read*             | Gives the user access to **Read** user accounts and groups.          |
| &nbsp; &nbsp; **Update**              | *admin.accounts.update*           | Gives the user access to **Update** user accounts and groups.        |
| &nbsp; &nbsp; **Delete**              | *admin.accounts.delete*           | Gives the user access to **Delete** user accounts and groups.        |
| &nbsp; &nbsp; **List**                | *admin.accounts.list*             | Gives the user access to **Accounts** area of the admin.             |
[/div]

The possible values for the permissions are:

[div class="table table-striped table-keycol"]
| Option                                | Value                         | Description                                                                               |
| :-----                                | :-----                        | :-----                                                                                    |
| **Allowed**                           | `true`                        | **Allows** action to be performed if there is no **Denied** permission at the same level. |
| **Denied**                            | `false`                       | **Denies** action from being performed. If user has both **Allowed** and **Denied** set, **Denied** permission wins. |
| **Not set**                           | `null`                        | No effect, but acts as **Denied** if no other rules apply.                                |
[/div]

Permissions set specifically for the user account take precedence over the group permissions. If the permission has not been set in the user account, access check will be performed against all the user groups the user belongs to. If any of the user groups have **Denied** the action, user has no permission for the action. Otherwise, if any of the user groups have **Allowed** the action, permission will be granted. If permission has not been set in any of the user's groups, **Super User** permission acts as universal **Allowed**, otherwise **Denied** will be applied.
