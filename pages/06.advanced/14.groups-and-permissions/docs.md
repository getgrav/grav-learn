---
title: Groups and Permissions
taxonomy:
    category: docs
---

>>> See the [Grav Admin FAQ](http://learn.getgrav.org/admin-panel/faq#adding-and-managing-users), to learn how to manage users

## Defining groups

By default, Grav does not provide any group. You need to define them.

Groups are defined in the user/config/groups.yaml file. If that file does not exist yet, create it.

Here’s an example of a user groups definition:

```yaml
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
```

Here we define 3 groups.

## Assigning a user to a group

Every user can be assigned to a group.

Simply add

```yaml
groups: paid
```

to a user’s yaml file under `user/accounts`.

You can add multiple groups by listing the groups with an array notation:

```yaml
groups:
  - administrators
  - another-group
```

You can also edit a user’s group information through the Admin Plugin.

## Permissions

Users assigned to a group inherit the group permissions. You can for example define a group that has permission `site.paid` by adding:

```yaml
  access:
    site:
      paid: true
```

to the group definition in `user/config/groups.yaml`.

When a user is assigned to that group, it will inherit the site.paid: true permission.

### Fine-tuning permissions on a user level

You can fine-tune the permissions on a user level too, as usual. With groups, you can define a global permission and deny it on a user level, by adding

```yaml
  access:
    site:
      paid: false
```

to a user’s yaml file.