---
title: List Groups
api:
    method: GET
    path: /groups
    description: 'List user groups, sorted by group name. Requires `api.users.read`.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 1000)'
        - name: search
          type: string
          required: false
          description: 'Filter by a free-text query across the group name, readable name and description.'
    request_example: ''
    response_example: |
        {
            "data": [
                {
                    "groupname": "editors",
                    "readableName": "Editors",
                    "description": "Can edit site content",
                    "icon": "users",
                    "enabled": true,
                    "access": { "api": { "access": true, "pages": { "read": true, "write": true } } }
                }
            ],
            "meta": {
                "pagination": { "page": 1, "per_page": 20, "total": 1, "total_pages": 1 }
            },
            "links": {
                "self": "/api/v1/groups?page=1&per_page=20"
            }
        }
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden (missing `api.users.read`)'
---

Groups are always read from, and saved to, `user/config/groups.yaml`. Groups that exist only in an environment overlay are not listed, so every group this endpoint returns can also be edited or deleted.
