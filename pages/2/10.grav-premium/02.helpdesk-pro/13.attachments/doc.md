---
title: Attachments
taxonomy:
    category: docs
description: Who can see a file, how files are served and stored, upload limits and allowed types, the optional private bucket, and cleanup.
---

# Attachments

Clients and staff can add files to replies and notes: screenshots, logs, PDFs, exports. Helpdesk Pro treats every file as private data. A file is only ever sent by your site, after the same access check that decides who can read its message, and nothing Helpdesk Pro renders, returns from the API or puts in an email contains a storage, bucket or CDN address.

## Who can see a file

A file belongs to one message and takes that message's visibility.

- A file on a **public reply** can be fetched by everyone who can read the ticket: its requester, its cc's, clients who can read the project's shared tickets, and staff who work the project.
- A file on an **internal note** is internal too. Only staff who work the project can fetch it. It never appears in the portal, in a client email or in a client's API view.
- A **draft** (uploaded but not yet sent) can only be fetched by the person who uploaded it, so a composer can show a preview.
- Access follows the ticket at the moment of the request. A cc taken off a ticket loses access to its files at once; a deleted message's files are staff-only; a deleted ticket's files are gone for clients.

Every refusal is a plain `404 Not Found`, whether the file does not exist, belongs to a ticket the visitor cannot read, sits on a note, or is someone else's draft.

## How files are served

Two routes stream files, and both run the check above on every request:

| Route | Used by | Signed in with |
|---|---|---|
| `GET {mount}/_file/{id}/{name}` | The client portal and links in client emails | The site session. A signed-out visitor is asked to sign in and comes back to the file. |
| `GET /api/v1/helpdesk-pro/attachments/{id}` | The staff desk | The API token or session, plus `helpdesk-pro.desk` |

The `{name}` part is only there so a browser saves the file under a sensible name; the id decides which file is sent.

Every response is sent with:

- `Cache-Control: private, max-age=300` for files on public replies, and `private, no-store` for internal files and drafts, so no shared cache or CDN keeps a copy.
- `X-Content-Type-Options: nosniff` and the content type Helpdesk Pro decided at upload (from its checked extension), never the type the uploader's browser claimed.
- `Content-Disposition: inline` only for raster images (png, jpg, gif, webp). Everything else, including SVG, HTML and text files, downloads.
- A sandboxing `Content-Security-Policy`, `Cross-Origin-Resource-Policy: same-origin`, `Referrer-Policy: no-referrer` and `X-Robots-Tag: noindex, nofollow`.

There is never a redirect. When files are also kept in a bucket, the site fetches the bytes and sends them itself.

In the desk and the portal, images show as thumbnails that open full size and other files as named chips. An image pasted into an email shows where it sat in the message and is not listed again below. A reader who may not open that file sees only its name.

## Upload limits and file types

| Rule | Where it comes from |
|---|---|
| Largest file | `attachments.max_mb` (10 MB). PHP's `upload_max_filesize` and `post_max_size` must be at least as large, or PHP drops the upload first. |
| Files per message | `attachments.max_per_message` (10). |
| Allowed types | `attachments.extensions`. The type comes from the extension and is checked against the content: images must decode as their named type, and PDF, zip, Office and gzip files must start with their format's signature. |
| Never allowed | Program and script types (php, phtml, phar, exe, js, sh, bat, jar, ps1, .htaccess and more), even if listed in `attachments.extensions`. |
| Browser-active types | SVG, HTML and XML can be allowed, but always download, never show inline. |
| Upload rate | `attachments.uploads_per_hour` (60) per person, or per hashed IP address for guests. |

A dangerous extension hidden inside a file name is neutralized: `invoice.php.pdf` is stored as `invoice_php.pdf`. Path parts, quotes and control characters are removed from names. A pasted image with no useful name is named `pasted-image-<date>-<time>.png` (or the right extension).

Any signed-in person who is not blocked may upload, and staff through the API. Guests may upload only while `portal.guest_submissions` is on and at least one public project accepts new requests. With `attachments.enabled` off nobody can upload, but files already attached stay readable.

## Storage

Files are stored once per content: the file name on disk is the SHA-256 of its bytes, so the same screenshot sent to three tickets is stored once. They live in `user/data/helpdesk-pro/files/` (beside the database). The directory gets a deny-all `.htaccess`, and files on disk carry no extension, so nothing there is ever run or served by the web server directly.

> [!WARNING]
> On nginx or Caddy, keep `user/data` unreachable, as Grav's recommended configuration does. See [Installation](../installation#the-database).

### A private bucket (optional)

With `attachments.storage.s3.enabled` on and the endpoint, bucket, key and secret filled in, every new file is also uploaded to an S3-compatible bucket (Cloudflare R2, Amazon S3, Backblaze B2, MinIO). The local copy stays the one that is served. When a file is missing locally (a rebuilt server, a moved site), it is fetched back from the bucket on its first request.

The bucket must be private: Helpdesk Pro never gives out bucket URLs. Objects are stored under `attachments.storage.s3.prefix` with `Cache-Control: private, no-store` and `Content-Disposition: attachment`, so even a bucket exposed by mistake would not render them. The secret is never returned by any endpoint.

### Cleanup

The hourly `attachments.gc` job:

1. deletes drafts nobody sent within `attachments.draft_hours` (24 hours);
2. recomputes each stored file's reference count, repairing counts left behind when a ticket was deleted permanently;
3. deletes stored files nothing uses any more, locally and from the bucket, once `attachments.grace_days` (7 days) have passed. Uploading the same bytes again during the grace period brings the file back.

A file referenced as the raw source of an email message is kept as long as that message exists.

## Settings

On the **Attachments** tab of the plugin's settings:

| Key | Default | What it does |
|---|---|---|
| `attachments.enabled` | `true` | Lets clients and staff add files. Existing files stay readable when off. |
| `attachments.max_mb` | `10` | The largest file accepted, in megabytes. |
| `attachments.max_per_message` | `10` | How many files one message can carry. |
| `attachments.extensions` | `[png, jpg, jpeg, gif, webp, pdf, txt, log, csv, zip, json, md]` | The extensions people may upload. |
| `attachments.uploads_per_hour` | `60` | Uploads per person (or per guest address) per hour. `0` turns the limit off. |
| `attachments.draft_hours` | `24` | Uploads never sent with a message are deleted after this many hours. |
| `attachments.grace_days` | `7` | A stored file nothing uses is kept this many days before it is deleted. |
| `attachments.storage.s3.enabled` | `false` | Also keep a copy of every file in a private S3-compatible bucket. |
| `attachments.storage.s3.endpoint` | `''` | The bucket service's HTTPS endpoint, without the bucket name. |
| `attachments.storage.s3.bucket` | `''` | The bucket. |
| `attachments.storage.s3.region` | `auto` | `auto` for Cloudflare R2; the bucket's region elsewhere. |
| `attachments.storage.s3.key` | `''` | Access key id. |
| `attachments.storage.s3.secret` | `''` | Secret access key. Never sent to the browser. |
| `attachments.storage.s3.prefix` | `helpdesk` | The folder inside the bucket. |

## The upload flow

The portal's reply box and form, and the desk's composer, all upload the same way. Files go up as soon as they are picked, dropped or pasted, and are attached when the message is sent.

1. **Upload each file as a draft.** The first upload has no token; the answer carries one. Send that token with every further upload for the same message.
2. **Send the message with the token** as `attachments_token`. The message endpoint claims the sender's drafts under that token and attaches them with the message's visibility. A token is used once.

Only drafts the same person uploaded under that token move, and a client can never attach to a note. Files beyond `attachments.max_per_message` stay drafts and expire.

| Method and path | Who | What it does |
|---|---|---|
| `POST {mount}/_upload` | Signed-in people; guests while guest submissions are possible | Uploads a draft. Multipart fields `file`, `token`, `filename`, `inline` (`1` for a pasted image) and the `helpdesk-portal` nonce (or the `X-Helpdesk-Nonce` header). Answers `201` with the draft; `400` for an expired nonce, `403` when the visitor may not upload, `422` for a file that breaks a rule. |
| `POST {mount}/_upload/{id}/remove` | The draft's uploader | Removes a draft. |
| `POST /helpdesk-pro/attachments` | `helpdesk-pro.desk` | Uploads a draft from the desk. The same fields, no nonce. |
| `GET /helpdesk-pro/attachments/{id}` | `helpdesk-pro.desk`, and the file must be readable | Streams the file to the desk. |
| `DELETE /helpdesk-pro/attachments/{id}` | `helpdesk-pro.desk`, the draft's uploader | Removes a draft (`204`). |

Without JavaScript, the portal forms post a plain `<input type="file" name="attachments[]" multiple>` with the message, and the files are stored and claimed the same way.

The three API routes have no MCP tools. AI clients see files as the `attachments` list on each timeline message.

## Related

- [Outbound email](../outbound-email#files-in-client-email)
- [Inbound email](../inbound-email#attachments-and-inline-images)
- [People and privacy](../people-and-privacy#erase-a-person)
