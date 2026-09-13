---
title: Delete Webhook
api:
    method: DELETE
    path: '/webhooks/{id}'
    description: 'Delete a webhook. Delivery history is also removed.'
    parameters:
        - name: id
          type: string
          required: true
          description: 'Webhook id (path param).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '204'
          description: 'Webhook deleted.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.webhooks.write` permission.'
        - code: '404'
          description: 'Webhook not found.'
---
