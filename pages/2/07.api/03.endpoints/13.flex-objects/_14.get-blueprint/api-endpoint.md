---
title: Get Blueprint
api:
    method: GET
    path: '/blueprints/flex-objects/{type}'
    description: 'Return the serialized form blueprint for a Flex directory, ready for a client to render the create/edit form. Labels are resolved to the signed-in user''s admin language, and the `onApiBlueprintResolved` event fires so plugins can adjust the field list.'
    parameters:
        - name: type
          type: string
          location: path
          required: true
          description: 'The Flex directory key.'
    request_example: ''
    response_example: '{"data": {"fields": [{"name": "name", "type": "text", "label": "Name"}, {"name": "email", "type": "email", "label": "Email"}]}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access` permission.'
        - code: '404'
          description: 'Directory not found or not enabled.'
---

This is the form definition (fields, types, labels, validation), not object data. It is what Admin Next requests to build the editor for a Flex object. Use [Get Object](#get-object) for a record's values.
