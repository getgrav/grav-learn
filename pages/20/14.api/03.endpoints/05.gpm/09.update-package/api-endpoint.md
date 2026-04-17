---
title: Update Package
template: api-endpoint
api:
    method: POST
    path: /gpm/update
    description: 'Update a specific installed plugin or theme to the latest version.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to update'
    request_example: '{"package": "admin"}'
    response_example: '{"data": {"message": "Package ''admin'' updated successfully.", "package": "admin"}}'
    response_codes:
        - code: '200'
          description: 'Package updated'
        - code: '401'
          description: 'Unauthorized'
        - code: '422'
          description: 'Package not updatable or not installed'
        - code: '500'
          description: 'Update failed'
---

