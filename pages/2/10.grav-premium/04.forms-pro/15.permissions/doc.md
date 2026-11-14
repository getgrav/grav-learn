---
title: Permissions
taxonomy:
    category: docs
description: Which accounts can see Forms Pro, build forms and read entries. Lists the four permissions and the parent key, what each allows in Admin Next and the REST API, and sample groups.
---

# Permissions

Forms Pro adds permissions to Grav's account system, so you decide who can build forms and who can only handle what visitors sent. They apply to Admin Next and the [REST API](../rest-api). Anyone on the public site can fill in and send a form, whatever their account.

## The permissions

An account needs `api.access` (the general permission to use Admin Next and the API) plus one or more of these. Super users have all of them.

| Permission | Label in the account editor | Allows |
|---|---|---|
| `api.forms-pro.forms.read` | Forms Pro, Read Forms | See the forms list, open a form in the builder (read-only), see its YAML export, and load the field and action catalog. |
| `api.forms-pro.forms.write` | Forms Pro, Manage Forms | Create, change, duplicate and delete forms. Give it together with read. |
| `api.forms-pro.submissions.read` | Forms Pro, Read Submissions | See the **Entries** section and a form's **Entries** tab, open entries, download their files and export them. |
| `api.forms-pro.submissions.write` | Forms Pro, Manage Submissions | Mark entries read or unread, star them, write notes, and delete them. |
| `api.forms-pro` | Forms Pro API (Full) | A parent key: grants all four above. |

Grav treats a permission as covering everything under it, so `api.forms-pro.forms` grants both `forms.read` and `forms.write`, and `api.forms-pro` grants all four. `write` does not include `read`: give an account both when it should be able to change what it sees.

Some actions need two permissions:

- **Deleting a form** needs `forms.write` and `submissions.write`, because deleting a form deletes its entries too. The delete confirmation says how many entries go with it. An account that can edit forms but not manage entries sees a note that it needs the Manage Submissions permission as well.
- **Opening an entry marks it read** only for an account with `submissions.write`. An account with only `submissions.read` can open entries and they stay **New**.

## What each account sees

Admin Next hides what an account cannot use, so people are not offered buttons that would only fail.

- **Forms Pro** appears in the sidebar for an account with `forms.read`, `submissions.read` or `api.forms-pro`.
- An account with `forms.read` and `forms.write` sees the builder with a **Save** button.
- An account with `forms.read` only sees each form read-only, with a notice (**Your account can view this form but not change it**). The forms list shows a similar notice.
- An account with `submissions.read` and not `forms.read` is an **entries-only** account. The Forms Pro page opens on **Entries**, with the list of forms that have entries, and there is no builder. The unread badge on the sidebar item still works for it.
- An account with none of the four permissions sees **Nothing to show**, with a message to ask an administrator for the Forms Pro permissions.

## Sample groups

Create groups under **Accounts** and give people the group:

| Group | Permissions |
|---|---|
| `forms-editors` | `api.access`, `api.forms-pro.forms.read`, `api.forms-pro.forms.write` |
| `forms-readers` | `api.access`, `api.forms-pro.submissions.read` |
| `forms-inbox` | `api.access`, `api.forms-pro.submissions.read`, `api.forms-pro.submissions.write` |
| `forms-admins` | `api.access`, `api.forms-pro` |

In an account's YAML, the same thing for a group looks like this:

```yaml
access:
  api:
    access: true
    forms-pro:
      submissions:
        read: true
        write: true
```

## Permissions on forms and the site

- The permissions govern what an account can do in Admin Next and through the REST API. They do not hide a form from site visitors. A form is public wherever you embed it.
- Entries hold what visitors typed, often personal data. Give `submissions.read` to as few people as needed, and remember that anyone with it can export every entry of every form.
- There are no permissions for a single form. The four apply to all forms.
- The **Call Function** action runs PHP, so it is hidden unless **Expose Call Action** is on in the plugin settings, whatever the permissions. See [Configuration](../configuration).

## Related

- [Installation](../installation#give-your-team-access)
- [REST API](../rest-api)
- [Entries](../entries)
