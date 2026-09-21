---
title: List Users
api:
    method: GET
    path: /users
    description: 'List user accounts, sorted by username. A caller with `api.users.read` sees every account; any other caller gets a one-row listing holding only their own account, in the same paginated format.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 1000, both set in the plugin''s `pagination` config)'
        - name: search
          type: string
          required: false
          description: 'Filter by a free-text query across username, email, and fullname.'
        - name: access
          type: string
          required: false
          description: 'Filter to users with effective access to a permission (e.g. `admin.login`, `api.super`). `permission` is accepted as an alias.'
        - name: group
          type: string
          required: false
          description: 'Filter to members of a single account group.'
        - name: filter
          type: string
          required: false
          description: 'Active Users-tab id (see `GET /users/filters`). Fires `onApiUserListFilter` so a plugin can narrow the listing before pagination. Works with both the Flex and the plain file account storage. Omit or use `all` for the unfiltered list.'
    request_example: ''
    response_example: |
        {
            "data": [
                {
                    "username": "editor",
                    "email": "editor@example.com",
                    "fullname": "Jane Editor",
                    "title": "",
                    "state": "enabled",
                    "language": "",
                    "content_editor": "",
                    "access": { "api": { "access": true, "pages": { "read": true, "write": true } } },
                    "groups": [],
                    "avatar_url": null,
                    "twofa_enabled": false,
                    "twofa_secret": false,
                    "created": "2026-09-01T10:00:00+00:00",
                    "modified": "2026-09-01T10:00:00+00:00"
                }
            ],
            "meta": {
                "pagination": { "page": 1, "per_page": 20, "total": 1, "total_pages": 1 }
            },
            "links": {
                "self": "/api/v1/users?page=1&per_page=20"
            }
        }
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Each user row also carries the values of any custom fields the site added to the account blueprint, and an `extra` map when a plugin supplies [column values](/2/api/endpoints/users/list-user-columns) for it. `twofa_secret` is a boolean that only says whether a secret has been generated; the secret itself is never returned.

