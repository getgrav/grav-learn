---
title: Get Directory Metadata
api:
    method: GET
    path: '/flex-objects/{type}/metadata'
    description: 'Return one directory''s Admin Next metadata (list/edit config, search settings, resolved list-column field types and option labels). Unlike List Directories, this endpoint also serves built-in directories such as user-accounts, so a dedicated Admin Next page can reuse the Flex list/detail configuration without adding a duplicate sidebar entry.'
    parameters:
        - name: type
          type: string
          location: path
          required: true
          description: 'The Flex directory key.'
    request_example: ''
    response_example: '{"data": {"type": "contacts", "title": "Contacts", "description": "Address book", "icon": "fa-address-book", "list": {"fields": {"name": {}, "email": {}}}, "edit": {}, "search": {"fields": ["name", "email"]}, "field_types": {"name": "text", "email": "email"}, "field_options": {}, "export": {}}}'
    response_codes:
        - code: '200'
          description: 'Success.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.access`, or the user lacks `list` permission on the directory.'
        - code: '404'
          description: 'Directory not found or not enabled.'
---

This is the same payload each entry of [List Directories](#list-directories) carries, fetched for a single directory. `field_types` and `field_options` let the client render typed list cells (dates as dates, choice values as their labels) instead of raw stored values.
