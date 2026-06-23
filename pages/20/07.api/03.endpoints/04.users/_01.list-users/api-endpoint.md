---
title: List Users
api:
    method: GET
    path: /users
    description: 'List all user accounts.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
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
          description: 'Active Users-tab id (see `GET /users/filters`). Fires `onApiUserListFilter` so a plugin can narrow the listing before pagination. Omit or use `all` for the unfiltered list.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
---

