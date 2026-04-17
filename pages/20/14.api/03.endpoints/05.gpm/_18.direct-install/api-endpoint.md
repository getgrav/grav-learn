---
title: Direct Install
api:
    method: POST
    path: '/gpm/direct-install'
    description: 'Install a plugin or theme from a URL or uploaded zip — bypasses the GPM repository lookup. Accepts either a JSON body with `url`, or a multipart upload with a `file` field. Useful for private/unpublished packages, pre-release builds, or local development.'
    parameters:
        - name: url
          type: string
          required: false
          description: 'URL of the package zip (mutually exclusive with `file`).'
        - name: file
          type: file
          required: false
          description: 'Uploaded zip file (multipart; mutually exclusive with `url`).'
    request_example: '{"url": "https://example.com/builds/my-plugin-1.0.0.zip"}'
    response_example: '{"data": {"message": "Package installed successfully via direct install."}}'
    response_codes:
        - code: '201'
          description: 'Package installed.'
        - code: '400'
          description: 'Neither `url` nor a valid `file` was provided.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
        - code: '500'
          description: 'Installation failed.'
---
