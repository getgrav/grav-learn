---
title: Groups and Permissions
taxonomy:
    category: docs
---

!! See the [Grav Admin FAQ](https://learn.getgrav.org/admin-panel/faq#adding-and-managing-users), to learn how to manage users

## Defining groups

By default, Grav does not provide any group. You need to define them.

Groups are defined in the user/config/groups.yaml file. If that file does not exist yet, create it.

Here’s an example of a user groups definition:

[prism classes="language-yaml line-numbers"]
registered:
  icon: users
  readableName: 'Registered Users'
  description: 'The group of registered users'
  access:
    site:
      login: true
paid:
  readableName: 'Paid Members'
  description: 'The group of paid members'
  icon: money
  access:
    site:
      login: true
      paid: true
administrators:
  groupname: administrators
  readableName: Administrators
  description: 'The group of administrators'
  icon: child
  access:
    admin:
      login: true
    site:
      login: true
[/prism]

Here we define 3 groups.

## Assigning a user to a group

Every user can be assigned to a group.

Simply add

[prism classes="language-yaml line-numbers"]
groups: 
  - paid
[/prism]

to a user’s yaml file under `user/accounts`.

You can add multiple groups:

[prism classes="language-yaml line-numbers"]
groups:
  - administrators
  - another-group
[/prism]

You can also edit a user’s group information through the Admin Plugin.

## Permissions

Users assigned to a group inherit the group permissions. You can for example define a group that has permission `site.paid` by adding:

[prism classes="language-yaml line-numbers"]
  access:
    site:
      paid: true
[/prism]

to the group definition in `user/config/groups.yaml`.

When a user is assigned to that group, it will inherit the site.paid: true permission.

When a user belongs to multiple groups, it's enough that a group provides a permission, and it will be added to the user's permissions.

### Fine-tuning permissions on a user level

You can fine-tune the permissions on a user level too, as usual. With groups, you can define a global permission and deny it on a user level, by adding

[prism classes="language-yaml line-numbers"]
  access:
    site:
      paid: false
[/prism]

to a user’s yaml file.
