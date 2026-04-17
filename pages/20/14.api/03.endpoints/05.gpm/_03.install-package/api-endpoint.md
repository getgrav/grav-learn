---
title: Install Package
api:
    method: POST
    path: /gpm/install
    description: 'Install a plugin or theme from the GPM repository.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to install'
        - name: type
          type: string
          required: true
          description: 'Package type: plugin or theme'
        - name: license
          type: string
          required: false
          description: 'License key for premium packages'
    request_example: '{"package": "sitemap", "type": "plugin"}'
    response_example: ''
    response_codes:
        - code: '201'
          description: 'Package installed'
        - code: '401'
          description: 'Unauthorized'
        - code: '422'
          description: 'Validation error (package not found or install failed)'
---

