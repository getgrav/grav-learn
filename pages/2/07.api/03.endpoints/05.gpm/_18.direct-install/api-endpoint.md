---
title: Direct Install
api:
    method: POST
    path: '/gpm/direct-install'
    description: 'Install a plugin or theme from a URL or uploaded zip — bypasses the GPM repository lookup. Accepts either a JSON body with `url`, or a multipart upload with a `file` field. Useful for private/unpublished packages, pre-release builds, or local development. Requires `api.gpm.write`.'
    parameters:
        - name: url
          type: string
          required: false
          description: 'An `http://` or `https://` URL of the package zip (mutually exclusive with `file`). Paths on the server are refused; upload a local zip as `file` instead.'
        - name: file
          type: file
          required: false
          description: 'Uploaded zip file (multipart; mutually exclusive with `url`).'
    request_example: '{"url": "https://downloads.example.com/builds/my-plugin-1.0.0.zip"}'
    response_example: '{"data": {"message": "Package installed successfully via direct install."}}'
    response_codes:
        - code: '201'
          description: 'Package installed.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
        - code: '422'
          description: 'Neither `url` nor a valid `file` was provided, or `url` is not an http(s) address.'
        - code: '500'
          description: 'Installation failed.'
---
