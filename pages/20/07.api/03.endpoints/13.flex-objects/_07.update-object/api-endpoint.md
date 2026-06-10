---
title: Update Object
api:
    method: PATCH
    path: '/flex-objects/{type}/{key}'
    description: 'Update an existing object. The request body contains only the fields to change (a partial merge). Optionally send an `If-Match` header with the ETag from a prior fetch to guard against concurrent edits.'
    parameters:
        - name: type
          type: string
          required: true
          description: 'The Flex directory type (e.g. `contacts`).'
        - name: key
          type: string
          required: true
          description: 'The object key.'
    request_example: '{"email": "grace.hopper@example.com"}'
    response_example: '{"data": {"key": "grace-hopper", "name": "Grace Hopper", "email": "grace.hopper@example.com"}}'
    response_codes:
        - code: '200'
          description: 'Object updated. The response carries the new `ETag`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing the directory''s `update` permission.'
        - code: '404'
          description: 'Directory or object not found.'
        - code: '409'
          description: 'The supplied `If-Match` ETag is stale; the object changed since you fetched it.'
        - code: '422'
          description: 'Validation error.'
---

This is a partial update: fields you omit are left untouched. Use `PATCH`, not `POST` (posting to an object URL is not allowed).
