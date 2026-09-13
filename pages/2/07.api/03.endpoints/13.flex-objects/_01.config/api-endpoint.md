---
title: Get Flex Config
api:
    method: GET
    path: '/flex-objects/config'
    description: 'Return UI-relevant Flex Objects plugin configuration (never secrets). Used by the admin to bootstrap the Flex Objects UI.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"enabled": true, "built_in_css": true, "admin_list": {"per_page": 15}}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
---

Lightweight configuration endpoint. The list of directories is returned separately by `GET /flex-objects` so callers that only need config stay small.
