---
title: Delete Blueprint File
api:
    method: DELETE
    path: /blueprint-upload
    description: 'Delete a file saved by a blueprint file field, plus its `.meta.yaml` sidecar if present.'
    parameters:
        - name: path
          type: string
          required: true
          description: 'Logical path of the file, relative to the user folder (`user/` prefix optional)'
        - name: scope
          type: string
          required: false
          description: 'Owner of the field''s blueprint: `plugins/<slug>`, `themes/<slug>`, `pages/<route>` or `users/<username>`. Only needed with `field`.'
        - name: field
          type: string
          required: false
          description: 'Full name of the blueprint field the file belongs to. With `scope`, lets a field''s `allow_extensions` cover deleting its own files.'
    request_example: |
        {
          "path": "user/themes/quark/images/logo/logo.png"
        }
    response_example: ''
    response_codes:
        - code: '204'
          description: 'File deleted, or it was already gone'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.media.write` permission, a target in `user/config/` or `user/env/*/config/`, a non-image file under `user/accounts/`, or another account''s file without `api.users.write`'
        - code: '422'
          description: 'Missing `path`, traversal or null bytes in it, a refused file type, or a target that is not a regular file'
---

`path` is the logical path the upload returned, relative to the user folder; the `user/` prefix is optional. `..` and null bytes are rejected.

The same extension rules as [Blueprint File Upload](/2/api/endpoints/media/blueprint-upload) apply, so config files can't be deleted through this endpoint, and neither can page content (`.md`, `.markdown`) or stylesheets (`.css`, `.scss`, `.sass`, `.less`) unless `field` and `scope` name a field whose blueprint allows them with `allow_extensions` and the file sits in that field's own folder. Under `user/accounts/` only image files can be deleted, and without `api.users.write` (or super user) only your own avatar, meaning a file your account's `avatar` field points at.

The call is idempotent: a file that no longer exists returns 204.
