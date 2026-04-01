---
title: Upload Avatar
template: api-endpoint
api:
    method: POST
    path: '/users/{username}/avatar'
    description: 'Upload a custom avatar image for a user. Send as multipart/form-data.'
    parameters:
        - name: username
          type: string
          required: true
          description: 'The username to upload the avatar for'
        - name: avatar
          type: file
          required: true
          description: 'Image file (JPEG, PNG, GIF, or WebP)'
    request_example: ''
    response_example: '{"data": {"username": "admin", "email": "admin@example.com", "avatar": {"name": "admin-a1b2c3d4.jpg", "type": "image/jpeg"}}}'
    response_codes:
        - code: '201'
          description: 'Avatar uploaded'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden'
        - code: '404'
          description: 'User not found'
        - code: '422'
          description: 'Validation error (no file or invalid image type)'
---

