---
title: List Objects
api:
    method: GET
    path: '/flex-objects/{type}'
    description: 'List the objects in a Flex directory with search, sorting, and pagination. Each item is reduced to the directory''s configured list fields (plus `key`).'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default 20, max 1000).'
        - name: search
          type: string
          required: false
          description: 'Search term applied across the directory''s searchable fields.'
        - name: sort
          type: string
          required: false
          description: 'Field to sort by.'
        - name: order
          type: string
          required: false
          description: 'Sort direction: `asc` (default) or `desc`.'
    request_example: ''
    response_example: '{"data": [{"key": "ada", "name": "Ada Lovelace", "email": "ada@example.com"}], "meta": {"total": 1, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `list` permission.'
        - code: '404'
          description: 'Directory type not found or not enabled.'
---

The `key` on each item is the object identifier you pass as `{key}` to the single-object endpoints.
