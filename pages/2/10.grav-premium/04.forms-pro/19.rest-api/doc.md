---
title: REST API
taxonomy:
    category: docs
description: Read and manage Forms Pro forms and entries over HTTP. Covers authentication, the permission each endpoint needs, listing and filtering entries, updating entries, exports, file downloads, saving forms with ETags and the error format.
---

# REST API

Forms Pro adds endpoints to Grav's [API plugin](../../../api), under `/api/v1/forms-pro`. Admin2 uses the same endpoints for the builder and the entries list, so anything you can do there you can do from a script: pull new entries into another system, mark them read, export them, or create forms from a template.

All requests need an account with `api.access` and the Forms Pro permission the endpoint asks for (see [Permissions](../permissions)). Every example below was run against a live site.

## Authenticate

Get a token with the account's login, then send it in the `X-API-Token` header. An API key (`X-API-Key`) works as well (see [API authentication](../../../api/authentication)).

```bash
TOKEN=$(curl -s -X POST https://example.com/api/v1/auth/token \
  -H 'Content-Type: application/json' \
  -d '{"username": "forms-bot", "password": "..."}' | jq -r .data.access_token)

curl -s -H "X-API-Token: $TOKEN" https://example.com/api/v1/forms-pro/forms
```

A request with no or bad credentials gets a `401`. One with a valid account that lacks the permission gets a `403`.

Responses are JSON. A successful one is `{"data": ...}`. A list that is paged also has `meta.pagination` with `page`, `per_page`, `total` and `total_pages`. An error has `status`, `title`, `detail` and, for a failed check on what you sent, an `errors` list of `field` and `message`:

```json
{
  "status": 422,
  "title": "Unprocessable Entity",
  "detail": "The form definition is invalid.",
  "errors": [
    {
      "field": "process.0.redirect",
      "message": "The 'redirect' action ends the submission, so it must come after 'message' and every other action that should run. Move it to the end of the list."
    }
  ]
}
```

## Endpoints

Paths are relative to `/api/v1/forms-pro`.

| Method and path | Permission | What it does |
|---|---|---|
| `GET /config` | `forms.read` or `submissions.read` | The plugin's public settings, the version, and what the caller may do. |
| `GET /badge` | `forms.read` or `submissions.read` | The unread count for all forms (`null` when nothing is unread). |
| `GET /catalog`, `/catalog/fields`, `/catalog/actions` | `forms.read` | The field and action catalog the builder uses. |
| `GET /forms` | `forms.read` | All forms, newest change first. |
| `POST /forms` | `forms.write` | Create a form. |
| `GET /forms/{name}` | `forms.read` | One form's definition, with its ETag. |
| `PUT /forms/{name}` | `forms.write` | Replace a form's definition. |
| `DELETE /forms/{name}` | `forms.write` and `submissions.write` | Delete a form and all its entries. |
| `POST /forms/{name}/duplicate` | `forms.write` | Copy a form. |
| `GET /forms/{name}/export` | `forms.read` | The form's YAML file as a download. |
| `GET /submissions` | `submissions.read` | Entry totals and unread counts for each form. |
| `GET /forms/{name}/submissions` | `submissions.read` | A page of entries. |
| `GET /forms/{name}/submissions/{id}` | `submissions.read` | One entry in full. |
| `PATCH /forms/{name}/submissions/{id}` | `submissions.write` | Change an entry's status, star or notes. |
| `DELETE /forms/{name}/submissions/{id}` | `submissions.write` | Delete an entry. |
| `POST /forms/{name}/submissions/bulk` | `submissions.write` | Mark, star or delete several entries. |
| `GET /forms/{name}/submissions/export` | `submissions.read` | All entries as CSV or JSON. |
| `GET /forms/{name}/submissions/{id}/files/{index}` | `submissions.read` | One uploaded file of an entry. |

Visitors do not use this API to send a form. They post to the page the form is on, as with any Form plugin form.

## Entries

### List and filter

```bash
curl -s -H "X-API-Token: $TOKEN" \
  "https://example.com/api/v1/forms-pro/forms/contact-us/submissions?status=new&sort=created&dir=desc&per_page=20&q=Ada"
```

| Query | Meaning |
|---|---|
| `page`, `per_page` | Paging. 20 entries a page by default. |
| `sort` | `created` (default), `status` or `starred`. |
| `dir` | `desc` (default) or `asc`. |
| `status` | `new` or `read`. |
| `starred` | `1`, `true` or `yes` for starred entries only. |
| `q` | Entries with this text in any answer. Case-insensitive, matches part of a word. |

A value that is not allowed for `sort` or `status` gets a `422` naming the allowed values. Each row has `id`, `status`, `starred`, `created` (a Unix time), and a short preview.

### One entry

`GET /forms/{name}/submissions/{id}` returns the stored record and a `display` list, which is the entry as Admin2 shows it, with labels and readable text, in form order:

```json
{
  "data": {
    "data": {
      "name": { "first": "Ada", "last": "Lovelace" },
      "email": "ada@example.com",
      "topic": "support",
      "message": "Hello"
    },
    "files": [],
    "ip": "203.0.113.7",
    "user_agent": "Mozilla/5.0 ...",
    "id": "f06c5bcb8cc7",
    "form": "contact-us",
    "created": 1794627588,
    "status": "new",
    "starred": false,
    "notes": "",
    "display": [
      { "name": "name", "label": "Your name", "type": "pro-name", "kind": "text", "text": "Ada Lovelace", "empty": false }
    ],
    "title": "Ada Lovelace"
  }
}
```

Reading an entry over the API does not mark it read. Do that with a `PATCH`.

### Change an entry

```bash
curl -s -X PATCH -H "X-API-Token: $TOKEN" -H 'Content-Type: application/json' \
  -d '{"status": "read", "starred": true, "notes": "Called back on Monday"}' \
  https://example.com/api/v1/forms-pro/forms/contact-us/submissions/f06c5bcb8cc7
```

`status` is `new` or `read`, and the body may have any of the three keys. The answers themselves cannot be changed. The reply is the entry.

For several entries, `POST /forms/{name}/submissions/bulk` takes an `action` and a list of `ids`. The actions are `read`, `unread`, `star`, `unstar` and `delete`. It answers with how many entries it changed:

```bash
curl -s -X POST -H "X-API-Token: $TOKEN" -H 'Content-Type: application/json' \
  -d '{"action": "read", "ids": ["f06c5bcb8cc7", "4d03036195f6"]}' \
  https://example.com/api/v1/forms-pro/forms/contact-us/submissions/bulk
# {"data": {"affected": 2}}
```

An entry that is deleted is gone for good. `DELETE /forms/{name}/submissions/{id}` answers `204`.

### Export

```bash
curl -s -H "X-API-Token: $TOKEN" \
  "https://example.com/api/v1/forms-pro/forms/contact-us/submissions/export?format=csv" -o contact-us.csv
```

`format` is `csv` (the default) or `json`. Both return every entry of the form as an attachment named `<form>-submissions.<format>`. The columns and the way values are written are described under [Export](../entries#export).

### Uploaded files

`GET /forms/{name}/submissions/{id}/files/{index}` downloads one file. `{index}` is the file's position in the entry's `files` list, starting at `0`. The reply is an attachment with the original file name, the file's own content type, and `X-Content-Type-Options: nosniff`. A file that is no longer on disk gets a `404`.

## Forms

### Create

```bash
curl -s -X POST -H "X-API-Token: $TOKEN" -H 'Content-Type: application/json' \
  -d '{"name": "newsletter", "title": "Newsletter"}' \
  https://example.com/api/v1/forms-pro/forms
```

`name` is required. It is turned into a lowercase name with dashes, so `Bad Name!` becomes `bad-name`, and a name that is taken gets a `422`. Without a `definition`, the form is a starter: a honeypot, a Submit button, and the **Store Submission** and **Message** actions. With one, the form is your definition, which is checked first. The reply, status `201`, has the saved `definition` and its `etag`.

A definition is the same data as the form's YAML file: `title`, `fields`, `buttons`, `process` and the other keys described on the [Settings tab](../settings-tab) page.

### Read and replace

`GET /forms/{name}` returns `{"data": {"name", "definition", "etag"}}` and the ETag in the response header too. `PUT /forms/{name}` takes `{"definition": {...}}` and replaces the whole definition, so fetch the form, change it, and send it back.

To make sure nobody else saved in between, send the ETag you read in an `If-Match` header:

```bash
curl -s -X PUT -H "X-API-Token: $TOKEN" -H 'Content-Type: application/json' \
  -H "If-Match: $ETAG" -d @form.json \
  https://example.com/api/v1/forms-pro/forms/newsletter
```

If the form changed since then, the answer is `409 Conflict`. `If-Match` is optional, and without it the new definition always replaces the old one. Admin2 sends it, which is how the builder can tell you that a form changed elsewhere and must be reloaded before saving.

The definition is checked before it is saved, with the same rules as the builder. A bad one gets a `422` with the problems in `errors`, each with its `field` path such as `process.0.redirect`. The checks include:

- `fields` is a map keyed by field name, and every field has a `type`.
- `process` is a list in which each entry holds one action, such as `- notify: {...}`.
- A terminal action (`redirect`, `display`) is last.
- A **Recipients** field has an address for every choice, and each address is valid.
- The `call` action is refused unless **Expose Call Action** is on.

### Duplicate, export and delete

`POST /forms/{name}/duplicate` takes an optional `{"to": "new-name"}`. Without it the copy is named after the original, with `-copy`.

`GET /forms/{name}/export` returns the form's YAML as a download, which you can put in another site's `user/data/forms-pro/forms/`.

`DELETE /forms/{name}` answers `204` and removes the form and every entry. It needs both write permissions, because of the entries. The site's caches are refreshed, so pages that embed the form stop showing it.

## Related

- [Permissions](../permissions)
- [Entries](../entries)
- [Webhooks](../webhooks)
- [API authentication](../../../api/authentication)
