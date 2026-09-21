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
          description: 'Number of results per page. Defaults to the directory''s `admin.list.options.per_page`, else the API default (20); capped at 1000.'
        - name: search
          type: string
          required: false
          description: 'Search term applied across the directory''s searchable fields.'
        - name: filters
          type: object
          required: false
          description: 'Exact-match field filters, as `filters[field]=value` query params or a JSON object string. An array value matches any of its values; `key` or `id` matches the object key.'
        - name: sort
          type: string
          required: false
          description: 'Field to sort by. Defaults to the directory''s `admin.list.options.order.by`, else unsorted.'
        - name: order
          type: string
          required: false
          description: 'Sort direction: `asc` or `desc`. Defaults to the directory''s configured order direction, else `asc`.'
    request_example: ''
    response_example: '{"data": [{"key": "ada", "name": "Ada Lovelace", "email": "ada@example.com"}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 1, "total_pages": 1}}, "links": {"self": "https://example.com/api/v1/flex-objects/contacts?page=1&per_page=20"}}'
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

The `key` on each item is the object identifier you pass as `{key}` to the single-object endpoints. A directory with no configured list fields returns each object's full data instead. When the directory configures a related detail list (`admin.list.detail`) that the user can see, each item also carries a `__detail` object describing the related directory, the filter that selects its records, and whether the user can edit or delete them.
