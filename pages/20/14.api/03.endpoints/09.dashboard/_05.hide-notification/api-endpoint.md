---
title: Hide Notification
api:
    method: POST
    path: '/dashboard/notifications/{id}/hide'
    description: 'Dismiss a dashboard notification for the current user. Records a timestamp in `user://data/notifications/{username}.yaml` so that notification is filtered out of future `GET /dashboard/notifications` responses.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Notification id (from the `GET /dashboard/notifications` response).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Notification dismissed.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.write` permission.'
---
